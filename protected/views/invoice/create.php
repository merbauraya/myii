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


?>

<h6 class="form-title">Create <?php echo $_GET['isQuote'] ? "Quotation" : "Invoice" ?></h6>
<?php
	$summary = $this->renderPartial('_form',array('model'=>$model),true);
	$detail = $this->renderPartial('//invoiceItem/_detail',array('model'=>$model,'invoiceItem'=>$invoiceItem,'invoiceID'=>$model->id),true);
$this->beginWidget('bootstrap.widgets.TbTabs', array(
	'type'=>'tabs', // 'tabs' or 'pills'
	'tabs'=>array(
		array('label'=>'Summary', 'content'=>$summary, 'active'=>true),
		array('label'=>'Items', 'content'=>$detail),
		array('label'=>'Notes', 'content'=>$this->renderPartial('note',array('model'=>$model),true)),
	),
));

$this->endWidget();
?>
