<?php
/* @var $this InvoiceItemController */
/* @var $model InvoiceItem */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceItem', 'url'=>array('index')),
	array('label'=>'Create InvoiceItem', 'url'=>array('create')),
	array('label'=>'View InvoiceItem', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage InvoiceItem', 'url'=>array('admin')),
);
?>

<h1>Update InvoiceItem <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>