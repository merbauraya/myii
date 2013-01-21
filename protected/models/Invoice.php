<?php

/**
 * This is the model class for table "tbl_invoice".
 *
 * The followings are the available columns in table 'tbl_invoice':
 * @property integer $id
 * @property integer $client_id
 * @property integer $contact_id
 * @property integer $user_id
 * @property string $invoice_number
 * @property string $date_entered
 * @property string $notes
 * @property integer $is_quote
 * @property integer $status_id
 * @property string $due_date
 * 
 * The followings are the available model relations:
 * @property Client $client
 * @property Contact $contact
 * @property InvoiceStatus $status
 * @property User $user
 * @property InvoiceItem[] $invoiceItems
 */
class Invoice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Invoice the static model class
	 */
	 
	 const INVOICE_ONLY = 0;
	 const QUOTE_ONLY = 1;
	 const INVOICE_AND_QUOTE=2;
	 public $invoice_subtotal;
	 public $client_name;
	 public $contact_name;
	 public $outstanding_amount;
	 
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_invoice';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('client_id, contact_id, user_id, is_quote, status_id,cancelled', 'numerical', 'integerOnly'=>true),
			array('invoice_number', 'length', 'max'=>45),
			array('date_entered, due_date,notes,terms', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(' client_id, invoice_number, date_entered, is_quote, status_id,invoice_subtotal,client_name,contact_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'client' => array(self::BELONGS_TO, 'Client', 'client_id'),
			'contact' => array(self::BELONGS_TO, 'Contact', 'contact_id'),
			'status' => array(self::BELONGS_TO, 'InvoiceStatus', 'status_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'invoiceItem' => array(self::HAS_MANY, 'InvoiceItem', 'invoice_id'),
			'invoiceAmount'=> array(self::HAS_ONE,'InvoiceAmount','invoice_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'client_id' => 'Client',
			'contact_id' => 'Contact',
			'user_id' => 'User',
			'invoice_number' => 'Invoice Number',
			'date_entered' => 'Date Entered',
			'notes' => 'Notes',
			'is_quote' => 'Is Quote',
			'status_id' => 'Status',
			'event_date'=> 'Event Date',
			'due_date'=>'Due Date',
			'terms'=> 'Terms and Condition'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('invoice_number',$this->invoice_number,true);
		$criteria->compare('date_entered',$this->date_entered,true);
		//$criteria->compare('notes',$this->notes,true);
		$criteria->compare('is_quote',$this->is_quote);
		$criteria->compare('status_id',$this->status_id);
		$criteria->addCondition('cancelled=0');
		$criteria->addCondition('is_dirty=0');
		$criteria->with=array('invoiceAmount','client','contact');
		$criteria->compare('invoiceAmount.invoice_subtotal',$this->invoice_subtotal,true);
		$criteria->compare('t.client_id',$this->client_id);
			
		$criteria->compare('client.name',$this->client_name,true);
		$criteria->compare('contact.name',$this->contact_name,true);
		return new CActiveDataProvider( $this, array(
		    'criteria'=>$criteria,
		    'sort'=>array(
		        'attributes'=>array(
		            'invoice_subtotal'=>array(
		                'asc'=>'invoiceAmount.invoice_subtotal',
		                'desc'=>'invoiceAmount.invoice_subtotal DESC',
		            ),
		            '*',
		        ),
		    ),
		));
		
	}
	public static function getNextInvoiceNumber()
	{
		$per = date('Y').date('m');
		//$inv = InvoiceNumber::model()->loadByPeriod($per);
		
			$inv = new InvoiceNumber();
			$inv->yearmonth_id = $per;
		
		
		
		
		if($inv->save())
			return date('Y').'-'.date('m').'-'. sprintf("%05d",$inv->id);
	
	}
	public function getOpenQuotations($quoteOrInvoice=self::INVOICE_AND_QUOTE)
	{
		$criteria = new CDbCriteria;
		$status = InvoiceStatus::model()->getOpenStatus();
		//$criteria->addCondition("status_id= {$status}");
        if ($quoteOrInvoice == self::QUOTE_ONLY)
			$criteria->addCondition('is_quote=1');
		if ($quoteOrInvoice == self::INVOICE_ONLY)
			$criteria->addCondition('is_quote=0');
		$criteria->addCondition('cancelled=0');
		$criteria->addCondition('is_dirty=0');
		$criteria->with = array('client','invoiceAmount');
		$criteria->order = 'is_quote desc';
		//$data = $this::model()->with('client')->findAll($criteria);
        return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	
		
	}
	public function getOutstandingInvoices()
	{
		$criteria = new CDbCriteria;
		$status = InvoiceStatus::model()->getOpenStatus();
		$criteria->addCondition("status_id= {$status}");
		$criteria->addCondition('is_quote=0');
		$criteria->addCondition('is_dirty=0');
		$criteria->with = array('client','invoiceAmount');
		$models = $this->findAll($criteria);
		//recreate array for dropdownlist display format
		// INVOICE_NUM - Client Name
		$data= array();
		foreach ($models as $model){
			
			$data[$model->id]=$model->invoice_number .' - ' . substr($model->client->name,0,25);
			
		}     
		//CVarDumper::dump($data);
		//CVarDumper::dump($models);
		return $data;
		
		
	
	}
	
	public function getOutstandingAmount($id)
	{
		$sql = 'select invoice_balance ' .
			   'from tbl_invoice_amount ' .
			   'where invoice_id = :id ';
		$cmd = Yii::app()->db->createCommand($sql);
		
			
		$bal = $cmd->queryScalar(array(':id'=>$id));
		return $bal;
	}
/**
 * Return total sales for current month, based on system date
 * If null is returned, total sales will be converted to zero
 */
	public function getMonthlySales()
	{
		$dtCompare = GenericUtils::getMonthStartEndDate();
		$total = $this->getTotalSalesBetweenDate($dtCompare['start'],
									      $dtCompare['end']);
		
		
		if ($total===NULL)
			$total=0;
		return $total;
	}
/**
 * Return total sales for the given start and end date
 * @startDate start date for comparison 
 * @endDate  end date for comparison
 */
	private function getTotalSalesBetweenDate($startDate,$endDate)
	{
		$sql = "select sum(b.invoice_subtotal) as total_sales 
				from tbl_invoice a,tbl_invoice_amount b
				where is_quote=0
				and is_dirty=0
				and cancelled=0
				and b.invoice_id = a.id
				and a.date_entered between :start and :end";
		$cmd = Yii::app()->db->createCommand($sql);
		$total = $cmd->queryScalar(array(
							':start'=>$startDate,
							':end'=>$endDate)
		);
		return $total;
	}
/**
 * Return total sales for current week, based on system date
 * If null is returned, total sales will be converted to zero
 */	
	public function getWeeklySales()
	{
		
		$dtCompare = GenericUtils::getWeekStartEndDate();
		$total = $this->getTotalSalesBetweenDate($dtCompare['start'],
									      $dtCompare['end']);
		
		
		
		if ($total===NULL)
			$total=0;
	//	Yii::trace('matle '.$dtCompare['start'] . ' '. 
	//			$dtCompare['end']. ' '. $total);
		return $total;
				
	}
	
	 public function behaviors()
	{
    	return array('datetimeI18NBehavior' => 
					array('class' => 'ext.DateTimeI18NBehavior')); // 'ext' is in Yii 1.0.8 version. For early versions, use 'application.extensions' instead.
	}

}