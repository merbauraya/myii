<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/*
$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Invoice', 'url'=>array('index')),
	array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'View Invoice', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Invoice', 'url'=>array('admin')),
);*/
?>
<div class="outer_form">
	
	<?php
	if ($model->is_quote) {
		$form=$this->beginWidget('CActiveForm', array(
		'id'=>'invoice-form',
		'action'=>Yii::app()->createUrl('invoice/QuoteToInvoice/',array('id'=>$model->id)),
		'enableAjaxValidation'=>false,
	));
}	?>
	<h6 class="form-title">
		<?php 
			echo ($model->is_quote ? 'Quotation# :' : 'Invoice# :');
			echo $model->invoice_number; ?>

			<?php  
	
	
		if ($model->is_quote){
		echo CHtml::submitButton('Quote to Invoice',array('style'=>'float:right;')); 
		
 $this->endWidget(); 
		}
		?>
</h6>
</div>


	<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
               'Summary' =>array('id'=>'Summary','content'=>$this->renderPartial('_form',array('model'=>$model),true)),
               'Item' => array('id'=>'item','content'=>$this->renderPartial('//invoiceItem/_detail',array('model'=>$model,'invoiceItem'=>$invoiceItem,'invoiceID'=>$model->id,'action'=>'update'),true)),
               // panel 3 contains the content rendered by a partial view
               'Notes' =>array('id'=>'Notes','content'=>$this->renderPartial('note',array('model'=>$model),true)),
         ),
		  
         // additional javascript options for the tabs plugin
        'options' => array(
  //Click the selected tab to toggle its content closed/open.
   //To enable this functionality, set the collapsible option to true
  'collapsible' => false,
 
   //Open CJuitabs on mouse over
  'event'=>'click',   
         ),
));
?>
