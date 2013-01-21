<?php
/* @var $this InvoiceItemController */
/* @var $invoiceItem InvoiceItem */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-item-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($invoiceItem); ?>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'id'); ?>
		<?php echo $form->textField($invoiceItem,'id'); ?>
		<?php echo $form->error($invoiceItem,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'invoice_id'); ?>
		<?php echo $form->textField($invoiceItem,'invoice_id'); ?>
		<?php echo $form->error($invoiceItem,'invoice_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'inventory_id'); ?>
		<?php echo $form->textField($invoiceItem,'inventory_id'); ?>
		<?php echo $form->error($invoiceItem,'inventory_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_name'); ?>
		<?php echo $form->textArea($invoiceItem,'item_name',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($invoiceItem,'item_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_description'); ?>
		<?php echo $form->textArea($invoiceItem,'item_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($invoiceItem,'item_description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_date'); ?>
		<?php echo $form->textField($invoiceItem,'item_date'); ?>
		<?php echo $form->error($invoiceItem,'item_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_quantity'); ?>
		<?php echo $form->textField($invoiceItem,'item_quantity',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($invoiceItem,'item_quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_price'); ?>
		<?php echo $form->textField($invoiceItem,'item_price',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($invoiceItem,'item_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($invoiceItem,'item_sub_total'); ?>
		<?php echo $form->textField($invoiceItem,'item_sub_total',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($invoiceItem,'item_sub_total'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($invoiceItem->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->