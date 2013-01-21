<?php
/* @var $this InvoiceItemController */
/* @var $model InvoiceItem */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InvoiceItem', 'url'=>array('index')),
	array('label'=>'Manage InvoiceItem', 'url'=>array('admin')),
);
?>

<h1>Create InvoiceItem</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>