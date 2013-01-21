<?php

class InvoiceController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','quote','ViewQuote','selectInvoice','print','QuoteToInvoice','search' ),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		//load existing invoice item
		$items = new InvoiceItem();//::model()->findByInvoice($id);
		$items->invoice_id = $id;			
		
		$this->render('view',array(
			'model'=>$this->loadModel($id,TRUE),'invoiceItem'=>$items->search(),
		));
	}
	public function actionQuote($is_quote=1)
	{
		$model = new Invoice;
		$model->date_entered = date('d/m/Y');
		
		if (isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			$dueDays = Setting::model()->getInvoiceDueAfter();
			$invDate = Setting::model()->convertDateToDBFormat($_POST['Invoice']['date_entered']);
			
			
			$dueDate = new DateTime($invDate);
			$dueDate->add(new DateInterval('P'.$dueDays.'D'));
			$model->due_date = $dueDate->format('d/m/Y');
						
			$model->invoice_number = Setting::model()->getQuoteInvoicePrefix($is_quote).Invoice::model()->getNextInvoiceNumber();
			//$model->terms = 
			$model->is_quote=1;
			$model->status=0; //not valid inv/quote yet
			$model->is_dirty = 1;// 
			$invoiceItem = new InvoiceItem();
			if($model->save())
				$this->redirect(array('create',
									  'id'=>$model->id,
									  'isQuote'=>$is_quote,
									  'clientId'=>$_POST['Invoice']['client_id']
									  )
							    ); 
		} else {
			//cancelled clicked
		$this->render('quote',array('model'=>$model));
		}
	}
	/**
		Promote quotation to invoice
	**/
	public function actionQuoteToInvoice($id)
	{
		$model=$this->loadModel($id);
		$model->is_quote=0;
		$model->terms = Setting::model()->getTermandCondition($model->is_quote);
		
		//update quotation to invoice number
		$invoicePrefix = Setting::model()->getQuoteInvoicePrefix(false);
		$quotePrefix = Setting::model()->getQuoteInvoicePrefix(true);
		//CVarDumper::dump($invoicePrefix);
		//CVarDumper::dump($quotePrefix);
		//$xx = str_replace($quotePrefix,$invoicePrefix,$model->invoice_number);
		//CVarDumper::dump($xx);
		$model->invoice_number = str_replace($quotePrefix,$invoicePrefix,$model->invoice_number);
		$model->save(true);
		$this->redirect(array('invoice/update','id'=>$model->id,'xx'=>$xx,'q'=>$quotePrefix,'i'=>$invoicePrefix)); 
	
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($id='',$isQuote='',$clientId='')
	{
		//$model=new Invoice;
		$model=$this->loadModel($id);
		
		//set default Terms and Conditions
		$tc = Setting::model()->getTermandCondition($isQuote);
		$model->terms = $tc;
		
		$invoiceItem = new InvoiceItem;
		if (isset($clientId))
			$model->client_id = $clientId;
		if (isset($isQuote))
			$model->is_quote = $isQuote;
                //$model->status_id=$model->status::model()->getOpenStatus();
		$model->status_id = InvoiceStatus::model()->getOpenStatus();
                // Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			//$dDate = new DateTime($_POST['Invoice']['date_entered']);
			//$dueDate = $dDate->add(new DateInterval('P15D'));
			//$model->due_date = $dueDate;
			$model->status_id=InvoiceStatus::model()->getOpenStatus();
			$model->is_dirty=0;
			if($model->save())
				null;
				//$this->redirect(array('view','id'=>$model->id));
		}
		$invoice_total=0;
		//CVarDumper::dump($_POST['Invoice']);
			if (isset($_POST['InvoiceItem']))
			{
				$items = $_POST['InvoiceItem'];
				foreach($items as $i=>$item)
					if (isset($_POST['InvoiceItem'][$i]))
					{
						$item = new InvoiceItem;
						$item->attributes = $_POST['InvoiceItem'][$i];
						$invoice_total = $invoice_total + $_POST['InvoiceItem'][$i]['item_sub_total'];
						//CVarDumper::dump($item->attributes);
						$item->save(false);	
					}
					$this->saveInvoiceAmount($id,$invoice_total);
				
				$this->redirect(array('invoice/update','id'=>$model->id)); 
				//$this->render('update',array(
				//'model'=>$model,'invoiceItem'=>$invoiceItem,'id'=>$model->id
				//));
			}
		
		$this->render('create',array(
			'model'=>$model,'invoiceItem'=>$invoiceItem
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$is_quote = $model->is_quote;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			//$due_date = $_POST['Invoice']
			if ($model->validate())
				$model->save();
				
		}
		//delete existing invoice item which are not part of submitted data
		
		if (isset($_POST['InvoiceItem']))
		{
			$items = $_POST['InvoiceItem'];
			$itemsPK = array();//array_keys($items,'id');
			foreach($items as $i=>$item)
			{
				$itemsPK[$i] = $item['id'];		
			}
			
			//CVarDumper::dump($itemsPK);
			//CVarDumper::dump($id);
			//store item total
			$invoice_total=0;
			InvoiceItem::model()->deleteOldItems($id,$itemsPK);
			foreach($items as $i=>$item)
				if (isset($items[$i]))
				{
					
					$itemID = $item['id'];
					$item = InvoiceItem::model()->findByPk($itemID);
					if ($item === null)
						$item = new InvoiceItem();
					$item->attributes = $_POST['InvoiceItem'][$i];
					$item->invoice_id = $id;
					//CVarDumper::dump($item->attributes);
					$invoice_total = $invoice_total + $_POST['InvoiceItem'][$i]['item_sub_total'];
					$item->save(false);	
				}
				//CVarDumper::dump($item);
				//if not 
				//if ($is_quote)
					$this->saveInvoiceAmount($id,$invoice_total);
				
		}
		//load existing invoice item
		$items = InvoiceItem::model()->findByInvoice($id);
		$this->render('update',array(
			'model'=>$model,'invoiceItem'=>$items
		));
	}
	private function saveInvoiceAmount($invoiceID,$amount)
	{
		$inv_amt = InvoiceAmount::model()->loadByInvoice($invoiceID);
		if ($inv_amt === null)
			$inv_amt = new InvoiceAmount();
		$inv_amt->invoice_id = $invoiceID;
		$inv_amt->invoice_item_subtotal = $amount;
		$inv_amt->invoice_subtotal = $amount;
		$inv_amt->save(false);
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = $this->loadModel($id);
		$model->cancelled = 1;
		$model->save();
		//$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionSearch()
	{
	/*	if(isset($_GET['Invoice'])){
			$InvoiceNumber = $
		
		}
	*/		
		
		$this->render('_advancesearch',array());
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Invoice');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
        public function actionPrint($id)
        {
               //$model = $this->loadModel($id);
			   $this->layout = 'invoice';
			   $model=  Invoice::model()->with('invoiceItem','contact','client','invoiceAmount')->findByPk($id);
			   
			  // $co = Setting::model()->getActiveCompany();
			  // $company = Company::model()->loadModel($co);
			   $company = Setting::model()->getCompanyInfo();
			   $hdr = ($model->is_quote==1 ? 'Quotation' : 'Invoice');
			   $uri = Yii::app()->baseUrl . '/css/invoice.css';
			   $curr_symbol = Setting::model()->getCurrencySymbol();
			  // Yii::app()->clientScript->registerCssFile($uri, 'screen, projection');
			   $this->render('invoice',array(
                                     'model'=>$model,
									 'company'=>$company,
									 'header'=>$hdr,
									 'curr'=>$curr_symbol
                                     )
               );

        }
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	public function actionViewQuote()
	{
		$model = new Invoice();
		$this->render('viewquote',array(
			'model'=>$model
		));
	}
	public function actionselectInvoice()
	{
		$this->render('selectInvoice');
	
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id,$getRelatedModel=false)
	{
		if ($getRelatedModel){
			$model = Invoice::model()->with('client','invoiceAmount','contact')->findByPk($id);
		}
		else {
			$model=Invoice::model()->findByPk($id);
		}
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='invoice-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	function loadInvoiceItem($invoiceID)
	{
		$model = InvoiceItem::model()->findByInvoice($invoiceID);
		return $model;
	
	}
	
}
