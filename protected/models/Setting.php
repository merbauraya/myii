<?php

/**
 * This is the model class for table "tbl_settings".
 *
 * The followings are the available columns in table 'tbl_settings':
 * @property integer $id
 * @property string $key
 * @property string $value
 */
class Setting extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Setting the static model class
	 */
	 
	const ACTIVE_COMPANY = 'active_company';
	const QUOTE_TC = 'quotation_TC';
	const INVOICE_TC='invoice_TC';
	const QUOTE_PREFIX='quotation_prefix';
	const INVOICE_PREFIX = 'invoice_prefix';
	const CURRENCY_SYMBOL = 'currency_symbol';
	const SHOW_CURRENCY_IN_DOCUMENT = 'show_currency_in_document';
	const INVOICE_DUE_AFTER = 'invoice_due_after';
	const COMPANY_NAME = 'company_name';
	const COMPANY_REGISTRATION_NO='co_registration_no';
	const COMPANY_ADDRESS_1 = 'co_address1';
	const COMPANY_ADDRESS_2 = 'co_address2';
	const COMPANY_ZIPCODE = 'co_zipcode';
	const COMPANY_CITY = 'co_city';
	const COMPANY_STATE = 'co_state';
	const COMPANY_PHONE='co_phone';
	const COMPANY_EMAIL='co_email';
	const COMPANY_WEB_URL = 'co_web_url';
	
	
	const mySQLDateFormat = 'Y-m-d';
	const dateDisplayFormat = 'd/m/Y';
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_settings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('setting_key, value', 'required'),
			array('setting_key', 'length', 'max'=>30),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, setting_key, value', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'setting_key' => 'Key',
			'value' => 'Value',
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
		$criteria->compare('setting_key',$this->setting_key,true);
		$criteria->compare('value',$this->value,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function getActiveCompany()
	{
		
		$model = $this->find('setting_key=?',array(self::ACTIVE_COMPANY));
		if ($model != null)
			return $model->id;
	}
	public function getTermandCondition($isQuote)
	{
		$key = self::INVOICE_TC;
		if ($isQuote)
			$key = self::QUOTE_TC;
		return $this->getValueFromKey($key);
	
	
	}
	//get prefix for quote/invoice number. default=I, means invoice
	public function getQuoteInvoicePrefix($isQuote=false)
	{
		$key = self::INVOICE_PREFIX;
		if ($isQuote)	
			$key = self::QUOTE_PREFIX;
		return $this->getValueFromKey($key);
	}
	public function getCompanyName()
	{
		return $this->getValueFromKey(self::COMPANY_NAME);
	}
	
	public function getInvoiceDueAfter()
	{
			return $this->getValueFromKey(self::INVOICE_DUE_AFTER);
	
	}
	
	public function getCurrencySymbol()
	{
		return $this->getValueFromKey(self::CURRENCY_SYMBOL);
	
	}
	private function getValueFromKey($key)
	{
		$model= $this->find('setting_key=?',array($key));
		return $model->value;
	
	}
	public static function getStateList()
	{
		return array ('Johor','Kedah','Kelantan','Melaka','Negeri Sembilan','Selangor');
	
	}
	public static function getNumberComparisonOperator()
	{
		$data = array('empty'=>'','=' => '=', '>' => '>', '<' => '<','>=' =>'>=','<='=>'<=');
		return $data;
	
	}
	public function getCompanyInfo(){
		$criteria = new CDbCriteria();
		//$criteria->select('setting_key,value');
		$criteria->addInCondition('setting_key',array(
									'company_name',
									'co_address1',
									'co_address2',
									'co_zipcode',
									'co_city',
									'co_state',
									'co_registration_no',
									'co_email',
									'co_web_url',
									'co_phone')
								);
		$result = $this->findAll($criteria);
		$settings = array();
		foreach ($result as $item){
			$key = $item['setting_key'];
			//$settings[$]			
			$settings[$key] = $item['value'];
		}
		return $settings;
		
	}
	public static function convertDateToDBFormat($inDate)
	{
		$retVal = date(Setting::mySQLDateFormat, 
					strtotime(
						str_replace('/','-',$inDate)
					)
				  );
		
		return $retVal;
	}
	public static function convertToPHPFormat($inDate)
	{
		$retVal = date('Y-m-d',strtotime(str_replace('/', '-', $inDate)));
		return $retVal;
	}
}