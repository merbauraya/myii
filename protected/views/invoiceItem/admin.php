<?php
/* @var $this InvoiceItemController */
/* @var $model InvoiceItem */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List InvoiceItem', 'url'=>array('index')),
	array('label'=>'Create InvoiceItem', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('invoice-item-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Invoice Items</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-item-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'invoice_id',
		'inventory_id',
		'item_name',
		'item_description',
		'item_date',
		/*
		'item_quantity',
		'item_price',
		'item_sub_total',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
