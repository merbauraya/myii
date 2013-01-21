<?php

/**
 * This is the model class for table "tbl_inventory".
 *
 * The followings are the available columns in table 'tbl_inventory':
 * @property integer $id
 * @property string $name
 * @property double $unit_price
 * @property string $description
 * @property integer $inventory_type_id
 * @property string $stock_level
 *
 * The followings are the available model relations:
 * @property TblInventoryType $inventoryType
 * @property TblSupplierInventory[] $tblSupplierInventories
 */
class Inventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Inventory the static model class
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
		return 'tbl_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, inventory_type_id', 'required'),
			array('inventory_type_id', 'numerical', 'integerOnly'=>true),
			array('unit_price', 'numerical'),
			array('name, description', 'length', 'max'=>45),
			array('stock_level', 'length', 'max'=>6),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, unit_price, description, inventory_type_id, stock_level', 'safe', 'on'=>'search'),
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
			'inventoryType' => array(self::BELONGS_TO, 'TblInventoryType', 'inventory_type_id'),
			'tblSupplierInventories' => array(self::HAS_MANY, 'TblSupplierInventory', 'inventory_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'unit_price' => 'Unit Price',
			'description' => 'Description',
			'inventory_type_id' => 'Inventory Type',
			'stock_level' => 'Stock Level',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('unit_price',$this->unit_price);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('inventory_type_id',$this->inventory_type_id);
		$criteria->compare('stock_level',$this->stock_level,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}