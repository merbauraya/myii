<?php
/* @var $this SettingController */
/* @var $model Setting */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'setting-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::label('Quoation Prefix',false); ?>
		<?php echo CHtml::hiddenField('Setting[0][key]',Setting::QUOTE_PREFIX); ?>
		
		<?php echo CHtml::textField('Setting[0][value]',Setting::model()->getQuoteInvoicePrefix(true)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Invoice Prefix',false); ?>
		<?php echo CHtml::hiddenField('Setting[1][key]',Setting::INVOICE_PREFIX); ?>
		
		<?php echo CHtml::textField('Setting[1][value]',Setting::model()->getQuoteInvoicePrefix(false)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Invoice Due After',false); ?>
		<?php echo CHtml::hiddenField('Setting[10][key]',Setting::INVOICE_DUE_AFTER); ?>
		
		<?php echo CHtml::textField('Setting[10][value]',Setting::model()->getQuoteInvoicePrefix(false)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
		<div class="row">
		<?php echo CHtml::label('Quotation Terms',false); ?>
		<?php echo CHtml::hiddenField('Setting[2][key]',Setting::QUOTE_TC); ?>
		
		<?php echo CHtml::textArea('Setting[2][value]',Setting::model()->getTermandCondition(true),array('rows'=>6, 'cols'=>100)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Invoice Terms',false); ?>
		<?php echo CHtml::hiddenField('Setting[3][key]',Setting::INVOICE_TC); ?>
		
		<?php echo CHtml::textArea('Setting[3][value]',Setting::model()->getTermandCondition(false),array('rows'=>6, 'cols'=>100)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->