<?php

/**
 * This is the model class for table "tbl_invoice_item".
 *
 * The followings are the available columns in table 'tbl_invoice_item':
 * @property integer $id
 * @property integer $invoice_id
 * @property integer $inventory_id
 * @property string $item_name
 * @property string $item_description
 * @property string $item_date
 * @property integer $item_quantity
 * @property string $item_price
 * @property string $item_sub_total
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
class InvoiceItem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InvoiceItem the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_invoice_item';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_id, inventory_id, item_quantity', 'numerical', 'integerOnly'=>true),
			array('item_price, item_sub_total', 'length', 'max'=>10),
			array('item_name, item_description, item_date', 'safe'),
			array('item_price, item_sub_total,item_quantity', 'numerical', 'allowEmpty' => true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, invoice_id, inventory_id, item_name, item_description, item_date, item_quantity, item_price, item_sub_total', 'safe', 'on'=>'search'),
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
			'inventory_id' => 'Inventory',
			'item_name' => 'Item Name',
			'item_description' => 'Item Description',
			'item_date' => 'Item Date',
			'item_quantity' => 'Item Quantity',
			'item_price' => 'Item Price',
			'item_sub_total' => 'Item Sub Total',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('invoice_id',$this->invoice_id);
		$criteria->compare('inventory_id',$this->inventory_id);
		$criteria->compare('item_name',$this->item_name,true);
		$criteria->compare('item_description',$this->item_description,true);
		$criteria->compare('item_date',$this->item_date,true);
		$criteria->compare('item_quantity',$this->item_quantity);
		$criteria->compare('item_price',$this->item_price,true);
		$criteria->compare('item_sub_total',$this->item_sub_total,true);
		$criteria->addCondition('t.item_name is not null');
		$criteria->addCondition('t.item_name != ""');
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function findByInvoice($invoiceID)
	{
		$criteria = new CDbCriteria;
		$criteria->compare('invoice_id',$invoiceID);
		
		$item=InvoiceItem::model()->findAllByAttributes(
							array(),
							$condition = 'invoice_id = :invoiceID',
							$params = array(':invoiceID' => $invoiceID));
		
							
							 
							
		if ($item===null)
		{
			$item = new InvoiceItem();
			$item->invoice_id = $invoiceID;
		}
		//return new CActiveDataProvider($item,array('pagination'=>array('pageSize'=>10)));
		//return new CActiveDataProvider($this, array(
		//	'criteria'=>$criteria,
		//));
		return $item;
	}
	public function deleteOldItems($invoiceId,$itemsPK)
	{
		$criteria = new CDbCriteria;
		$criteria->addNotInCondition('id', $itemsPK);
        $criteria->addCondition("invoice_id= {$invoiceId}");
 
        $this::model()->deleteAll($criteria); 
	
	}
	/**
		get invoice amount
	**/
	public function getInvoiceAmount($invoiceID)
	{
		
	
	}
	public function behaviors()
{
    return array('datetimeI18NBehavior' => array('class' => 'ext.DateTimeI18NBehavior')); // 'ext' is in Yii 1.0.8 version. For early versions, use 'application.extensions' instead.
}
}