<?php

/**
 * This is the model class for table "tbl_client".
 *
 * The followings are the available columns in table 'tbl_client':
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zipcode
 * @property string $phone
 * @property string $fax
 * @property string $email
 * @property string $mobile
 * @property string $web_address
 * @property integer $active
 * @property integer $client_type_id
 *
 * The followings are the available model relations:
 * @property ClientType $clientType
 * @property Contact[] $contacts
 */
class Client extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Client the static model class
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
		return 'tbl_client';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, address, address2, city, state, zipcode', 'required'),
			array('active, client_type_id', 'numerical', 'integerOnly'=>true),
			array('city, state', 'length', 'max'=>50),
			array('name,address,address2','length','max'=>100),
			array('zipcode', 'length', 'max'=>6),
			array('phone, fax, mobile', 'length', 'max'=>15),
			array('email', 'length', 'max'=>70),
			array('web_address', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, address, address2, city, state, zipcode, phone, fax, email, mobile, web_address, active, client_type_id', 'safe', 'on'=>'search'),
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
			'clientType' => array(self::BELONGS_TO, 'ClientType', 'client_type_id'),
			'contact' => array(self::HAS_MANY, 'Contact', 'client_id'),
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
			'address' => 'Address',
			'address2' => 'Address2',
			'city' => 'City',
			'state' => 'State',
			'zipcode' => 'Zipcode',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'web_address' => 'Web Address',
			'active' => 'Active',
			'client_type_id' => 'Client Type',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zipcode',$this->zipcode,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('web_address',$this->web_address,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('client_type_id',$this->client_type_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}