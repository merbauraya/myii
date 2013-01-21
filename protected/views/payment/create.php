<?php
/* @var $this PaymentController */
/* @var $model Payment */
$this->menu=array(
	array('label'=>'List Payment', 'url'=>array('index')),
	array('label'=>'Manage Payment', 'url'=>array('admin')),
);
?>

<h6 class="form-title">Create Payment</h6>
<div class="form-wrapper" id="f_payment">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>