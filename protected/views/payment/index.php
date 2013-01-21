<?php
/* @var $this PaymentController */
/* @var $model Payment */

$this->breadcrumbs=array(
	'Payments'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Create Payment', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('payment-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h6 class="form-title">View Payments</h6>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'payment-grid',
	'dataProvider'=>$model->paymentSummary(),
	'columns'=>array(
		array('name'=>'id','header'=>'Receipt ID'),
		array('name'=>'pay_date','header'=>'Pay Date','value'=>'Yii::app()->dateFormatter->format("d/M/y", strtotime($data["pay_date"]))'),
		array('name'=>'invoice_number','header'=>'Invoice#'),
		array('name'=>'amount','header'=>'Amount'),
		array('name'=>'pay_method','header'=>'Payment Type'),
		array('name'=>'client_name','header'=>'Client'),
	
	 array(
                  'class'=>'CButtonColumn',
                           'template'=>'{update}{receipt}{delete}',
                        'buttons'=>array(
                        'update'=>array(
                            'label'=>'Update',
							'imageUrl'=>Yii::app()->baseUrl.'/images/edit.png',
							'url'=>'Yii::app()->createUrl("/payment/update", array("id" => $data["id"]))',
                               ), 
						'receipt'=>array(
                            'label'=>'Receipt',
							'imageUrl'=>Yii::app()->baseUrl.'/images/receipt.png',
							'url'=>'Yii::app()->createUrl("/payment/receipt", array("id" => $data["id"]))',
                               ),
						'delete'=>array(
                            'label'=>'Delete',
							'imageUrl'=>Yii::app()->baseUrl.'/images/delete.png',
							'url'=>'Yii::app()->createUrl("/payment/delete", array("id" => $data["id"]))',
                               ),  							   
                 
                     ),
	),
	)
)); ?>


