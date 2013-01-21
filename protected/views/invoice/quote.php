<?php
	$quoteInvoice = $_GET['is_quote'] ? "Quotation" : "Invoice";

?>

<h6 class="form-title">Create <?php echo $quoteInvoice ?></h6>
<div class="form-wrapper">
	

		<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'invoice-form',
			'type'=>'horizontal',
			'enableAjaxValidation'=>false,
		)); 

		?>
		<?php echo $form->datepickerRow($model, 'date_entered',
        		array('prepend'=>'<i class="icon-calendar"></i>',
				'options'=>array(
					'format'=>'dd/mm/yyyy'))
				
				); 
		?>
		
		<?php echo $form->dropDownListRow($model, 'client_id',
       CHtml::listData(Client::model()->findAll(), 'id', 'name')); 
	   
	   
	   ?>	

			
	

	
<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'id'=>'createquote',
			'label'=>'Create ' . $quoteInvoice ,
		)); ?>
		
		
	</div>

 <?php $this->endWidget(); ?>

</div>