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
		<?php echo CHtml::label('Currency Symbol',false); ?>
		<?php echo CHtml::hiddenField('Setting[0][key]',Setting::CURRENCY_SYMBOL); ?>
		
		<?php echo CHtml::textField('Setting[0][value]',Setting::model()->getCurrencySymbol()); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->