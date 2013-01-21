<?php

/**
 * This is the model class for table "tbl_invoice_amount".
 *
 * The followings are the available columns in table 'tbl_invoice_amount':
 * @property integer $id
 * @property integer $invoice_id
 * @property string $invoice_item_subtotal
 * @property string $invoice_subtotal
 * @property string $invoice_discount
 * @property string $invoice_paid
 * @property string $invoice_balance
 *
 * The followings are the available model relations:
 * @property Invoice $invoice
 */
class InvoiceAmount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InvoiceAmount the static model class
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
		return 'tbl_invoice_amount';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('invoice_id', 'numerical', 'integerOnly'=>true),
			array('invoice_item_subtotal, invoice_subtotal, invoice_discount, invoice_paid, invoice_balance', 'length', 'max'=>8),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, invoice_id, invoice_item_subtotal, invoice_subtotal, invoice_discount, invoice_paid, invoice_balance', 'safe', 'on'=>'search'),
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
			'invoice_item_subtotal' => 'Invoice Item Subtotal',
			'invoice_subtotal' => 'Invoice Subtotal',
			'invoice_discount' => 'Invoice Discount',
			'invoice_paid' => 'Invoice Paid',
			'invoice_balance' => 'Invoice Balance',
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
		$criteria->compare('invoice_item_subtotal',$this->invoice_item_subtotal,true);
		$criteria->compare('invoice_subtotal',$this->invoice_subtotal,true);
		$criteria->compare('invoice_discount',$this->invoice_discount,true);
		$criteria->compare('invoice_paid',$this->invoice_paid,true);
		$criteria->compare('invoice_balance',$this->invoice_balance,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function loadByInvoice($invoiceID)
	{
		//$criteria = new CDbCriteria;
		//$criteria->compare('invoice_id',$invoiceID);
		
		$model=InvoiceAmount::model()->findByAttributes(
							array('invoice_id'=>$invoiceID));
						
		return $model;
	}
}