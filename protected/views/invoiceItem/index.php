<?php
/* @var $this InvoiceItemController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Invoice Items',
);

$this->menu=array(
	array('label'=>'Create InvoiceItem', 'url'=>array('create')),
	array('label'=>'Manage InvoiceItem', 'url'=>array('admin')),
);
?>

<h1>Invoice Items</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
