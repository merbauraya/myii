<?php
/* @var $this InvoiceController */
/* @var $model Invoice */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'invoice-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->textFieldRow($model,'invoice_number',
					  array('class'=>'span2')); ?>	 
	<?php echo $form->dropDownListRow($model, 'client_id',
       CHtml::listData(Client::model()->findAll(), 'id', 'name')); ?>

	<?php echo $form->dropDownListRow($model, 'contact_id',
       CHtml::listData($model->client->contact, 'id', 'name'),
	   array('prompt','Not Assigned')); ?>
	   
	 	

<?php echo $form->datepickerRow($model, 'date_entered',
        		array('prepend'=>'<i class="icon-calendar"></i>',
				'class'=>'span2',
				'options'=>array(
					'format'=>'dd/mm/yyyy'))
				
				); 
		?>
		<?php echo $form->datepickerRow($model, 'due_date',
        		array('prepend'=>'<i class="icon-calendar"></i>',
					  'class'=>'span2',
				'options'=>array(
					'format'=>'dd/mm/yyyy'))
				
				); 
		?>
		
	<?php echo CHtml::hiddenField('is_quote',$model->is_quote); ?>
        <?php echo CHtml::hiddenField('status_id',$model->status_id); ?>
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'id'=>'createquote',
			'label'=>' Save ' ,
		)); ?>
		
		
	</div>
	
	
	
<?php $this->endWidget(); ?>


