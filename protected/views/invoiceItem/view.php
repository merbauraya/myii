<?php
/* @var $this InvoiceItemController */
/* @var $model InvoiceItem */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InvoiceItem', 'url'=>array('index')),
	array('label'=>'Create InvoiceItem', 'url'=>array('create')),
	array('label'=>'Update InvoiceItem', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete InvoiceItem', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvoiceItem', 'url'=>array('admin')),
);
?>

<h1>View InvoiceItem #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'invoice_id',
		'inventory_id',
		'item_name',
		'item_description',
		'item_date',
		'item_quantity',
		'item_price',
		'item_sub_total',
	),
)); ?>
