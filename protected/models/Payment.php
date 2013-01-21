<?php

/**
 * This is the model class for table "tbl_payment".
 *
 * The followings are the available columns in table 'tbl_payment':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $method_id
 * @property string $pay_date
 * @property string $amount
 * @property string $note
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
 
class Payment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Payment the static model class
	 */
	 
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
		return 'tbl_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('invoice_id, method_id, amount,pay_date', 'required'),
			array('amount,outstanding_amount','numerical'),
			array('invoice_id, method_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'length', 'max'=>8),
			array('pay_date, note,outstanding_amount', 'safe'),
			array('amount','compare','compareAttribute'=>'outstanding_amount','operator'=> '<=', 'on'=>'create, update'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, invoice_id, method_id, pay_date, amount, note', 'safe', 'on'=>'search'),
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
			'invoice' => array(self::BELONGS_TO, 'Invoice', 'invoice_id'),
			'paymentMethod' => array(self::BELONGS_TO, 'PaymentMethod', 'method_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'invoice_id' => 'Invoice',
			'method_id' => 'Method',
			'pay_date' => 'Payment Date',
			'amount' => 'Amount',
			'note' => 'Note',
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
		//todo need to add client, invoiceamount info in payment
		$criteria->compare('id',$this->id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('method_id',$this->method_id);
		$criteria->compare('pay_date',$this->pay_date,true);
		$criteria->compare('amount',$this->amount,true);
		$criteria->compare('note',$this->note,true);
		$criteria->with = array('invoice');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function paymentSummary()
	{
		$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM tbl_payment')->queryScalar();
		
		$sql = 'select  
				a.id, a.invoice_id,a.pay_date,a.amount,a.note,a.method_id,
				b.client_id, c.name as client_name,
				b.invoice_number,b.date_entered,
				d.name as pay_method, e.invoice_balance
				from tbl_payment a,
				tbl_invoice b, tbl_client c,
				tbl_payment_method d, tbl_invoice_amount e
				where a.invoice_id = b.id
				and c.id = b.client_id
				and a.method_id = d.id
				and e.invoice_id = b.id
				order by a.pay_date desc';
		
		
		$dataProvider = new CSqlDataProvider($sql, array(
        'totalItemCount'=>$count,
		'keyField' =>'id',	
        'pagination'=>array(
            'pageSize'=>15,
        ),
    ));
		return $dataProvider;
		
	}
	 public function behaviors()
{
    return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); // 'ext' is in Yii 1.0.8 version. For early versions, use 'application.extensions' instead.
}
}