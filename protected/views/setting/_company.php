<?php
/* @var $this SettingController */
/* @var $model Setting */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'invoice-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>


	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Company Name</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[0][key]',Setting::COMPANY_NAME); ?>
		<?php echo CHtml::textField('Setting[0][value]',$company['company_name'],
				array('class'=>'span6')); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Registration No</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[1][key]',Setting::COMPANY_REGISTRATION_NO); ?>
		<?php echo CHtml::textField('Setting[1][value]',$company['co_registration_no']); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Address 1</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[2][key]',Setting::COMPANY_ADDRESS_1); ?>
		<?php echo CHtml::textField('Setting[2][value]',$company[Setting::COMPANY_ADDRESS_1],
		
				array('class'=>'span6')); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Address 1</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[3][key]',Setting::COMPANY_ADDRESS_2); ?>
		<?php echo CHtml::textField('Setting[3][value]',$company[Setting::COMPANY_ADDRESS_2],array('class'=>'span6')); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Zipcode</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[4][key]',Setting::COMPANY_ZIPCODE); ?>
		<?php echo CHtml::textField('Setting[4][value]',$company[Setting::COMPANY_ZIPCODE]); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">City			</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[5][key]',Setting::COMPANY_CITY); ?>
		<?php echo CHtml::textField('Setting[5][value]',$company[Setting::COMPANY_CITY]); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>	
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">State			</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[6][key]',Setting::COMPANY_STATE); ?>
		<?php echo CHtml::textField('Setting[6][value]',$company[Setting::COMPANY_STATE]); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>
		<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Phone			</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[7][key]',Setting::COMPANY_PHONE); ?>
		<?php echo CHtml::textField('Setting[7][value]',$company[Setting::COMPANY_PHONE]); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>	
	<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Email			</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[8][key]',Setting::COMPANY_EMAIL); ?>
		<?php echo CHtml::textField('Setting[8][value]',$company[Setting::COMPANY_EMAIL],
		array('class'=>'span6')); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>	
		<div class="control-group ">
		 <span class="pull-left"><label class="control-label" for="TestForm_toggle">Web URL			</label>
		<div class="controls">
		<?php echo CHtml::hiddenField('Setting[9][key]',Setting::COMPANY_WEB_URL); ?>
		<?php echo CHtml::textField('Setting[9][value]',$company[Setting::COMPANY_WEB_URL],
		array('class'=>'span6')); ?>
		<?php echo $form->error($model,'value'); ?>
		</div>
				
	</div>		
	<div class="row buttons">
		<?php echo CHtml::submitButton('Save'); ?>
	</div>

<?php $this->endWidget(); ?>

