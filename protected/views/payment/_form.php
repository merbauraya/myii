<?php
/* @var $this PaymentController */
/* @var $model Payment */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'payment-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	
)); ?>
	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	
	
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->dropDownListRow($model, 'invoice_id',
			   Invoice::model()->getOutstandingInvoices(),
			   array(
			   'onChange'=>'$(\'#f_payment\').addClass(\'loading\')',
			   'prompt'=>'--Select Invoice--',
			   'ajax'=>array(
			   'type'=>'post',
			   
			   'url'=>CController::createUrl('payment/outstandingamount'),
			   'success'=>'function(data) { 
			   		$(\'#Payment_outstanding_amount\').val(data);
					$(\'#f_payment\').removeClass(\'loading\'); }',
			   	'error'=>'function(data){
					$(\'#f_payment\').removeClass(\'loading\');
						}',		   
			   
			   ))
			   
			   
		); 
	
	?>		   
		   
    <?php echo $form->textFieldRow($model, 'outstanding_amount', array(
									'readonly'=>true,
									'class'=>'span2',
									'prepend'=>'<i class="myicon-rm"></i>')
									); ?>   	
									
	<?php echo $form->textFieldRow($model,'amount',array(
								   'class'=>'span2',
								   'prepend'=>'<i class="myicon-rm"></i>')
								  
	); ?>
	<?php echo $form->dropDownListRow($model, 'method_id',
			CHtml::listData(PaymentMethod::model()->findAll(), 'id', 'name'));	
	?>	
	<?php echo $form->datepickerRow($model, 'pay_date',
        		array('prepend'=>'<i class="icon-calendar"></i>',
				'class'=>'span2',
				'options'=>array(
					'format'=>'dd/mm/yyyy'))
				
				); 
	?>
	<?php echo $form->textAreaRow($model,'note',array('class'=>'span6')); ?>	
	
	
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'id'=>'createquote',
			'label'=>'Create Payment',
		)); ?>
		
		
	</div>
		
<?php $this->endWidget(); ?>

