<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Invoice', 'url'=>array('index')),
	array('label'=>'Manage Invoice', 'url'=>array('admin')),
);

$isQuote = $_GET['q'];
?>
<h6 class="form-title">View <?php echo $isQuote==1 ? "Quotation" : "Invoice"; ?></h6>						
								
<?php 
	
	
	$quoteOrInvoice = ($isQuote == 1 ? Invoice::QUOTE_ONLY : Invoice::INVOICE_ONLY);
	//echo $quoteOrInvoice;
$this->widget('zii.widgets.grid.CGridView', array(
 'id'=>'user-grid',
 'dataProvider'=>Invoice::model()->getOpenQuotations($quoteOrInvoice),
 'columns'=>array(
										array('name'=>'invoice_number','header'=>'Invoice/Quote Number'),
										array('name'=>'date_entered','header'=>'Invoice/Quote Date'),
										array('name'=>'client.name','header'=>'Client'),
										array('name'=>'invoiceAmount.invoice_subtotal','value'=>'$data->invoiceAmount->invoice_subtotal','header'=>'Amount'),
                  array(
                  'class'=>'CButtonColumn',
                           'template'=>'{view}{update}{delete}{newbutton}',
						    'deleteButtonImageUrl'=>Yii::app()->baseUrl.'/images/delete.png',
							'updateButtonImageUrl'=>Yii::app()->baseUrl.'/images/edit.png',
							'viewButtonImageUrl'=>Yii::app()->baseUrl.'/images/view.png',
                        'buttons'=>array(
                        'newbutton'=>array(
                            'label'=>'Quotation to Invoice',
							'imageUrl'=>Yii::app()->baseUrl.'/images/invoices.png',
							'url'=>'Yii::app()->createUrl("/invoice/QuoteToInvoice", array("id" => $data->id))',
                               ),              
                 
                     ),
  ),
 ),
));
 
?>						