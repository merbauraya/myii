<?php
/* @var $this InvoiceItemController */
/* @var $model InvoiceItem */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.format.js');
?>

<script type="text/javascript">
	/**
 * jQuery script for adding new content from template field
 *
 * NOTE!
 * This script depends on jquery.format.js
 *
 * IMPORTANT!
 * Do not change anything except specific commands!
 */
jQuery(document).ready(function(){
	hideEmptyHeaders();
	$(".add").click(function(){
		
		var template = jQuery.format(jQuery.trim($(this).siblings(".template").val()));
		//alert(template);
		var place = $(this).parents(".templateFrame:first").children(".templateTarget");
		//alert(place);
		//var i = place.find(".rowIndex").length>0 ? place.find(".rowIndex").max()+1 : 0;
		var i = place.find('tr').length > 0 ? place.find('tr').length +1: 0;
		//alert(x);
		//alert(i);
		$(template(i)).appendTo(place);
		place.siblings('.templateHead').show()
		// start specific commands

		// end specific commands
	});

	$(".remove").live("click", function() {
		$(this).parents(".templateContent:first").remove();
		hideEmptyHeaders();
	});
});

function hideEmptyHeaders(){
	$('.templateTarget').filter(function(){return $.trim($(this).text())===''}).siblings('.templateHead').hide();
}
</script>
<div class="form">
<?php  
echo CHtml::link('open dialog', '#', array(
   'onclick'=>'$("#mydialog").dialog("open"); return false;',));
   
 ?>
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-item-form',
	'enableAjaxValidation'=>false,
)); ?>
 
 
  <div class="complex">
        <span class="label">
            <?php echo Yii::t('ui', 'Persons'); ?>
        </span>
        <div class="panel">
            <table class="templateFrame grid" cellspacing="0">
                <thead class="templateHead">
                    <tr>
						<th>
							Inventory
						</th>
                        <th> 
                            Name
                        </th>
                        <th>
                            Quantity
                        </th>
						
                        <th>
                            Price
                        </th>
						<th>
							Sub Total
						</th>
						<th></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="add"><?php echo Yii::t('ui','New');?></div>
								<textarea class="template" rows="0" cols="0">
                                <tr class="templateContent">
                                    <td>
										<?php echo CHtml::dropDownList('InvoiceItem[{0}][inventory_id]','',CHtml::listData(Inventory::model()->findAll(), 'id', 'name'),array('prompt'=>'Not Assigned')); 
										
										echo CHtml::hiddenField('InvoiceItem[{0}][invoice_id]',$model->id);
										echo CHtml::hiddenField('InvoiceItem[{0}][id]','');
										?>
										
									</td>
									<td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_name]','',array('style'=>'width:100px')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_quantity]','',array('style'=>'width:50px')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_price]','',array('style'=>'width:50px')); ?>
                                    </td>
									<td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_sub_total]','',array('style'=>'width:50px')); ?>
                                    </td>
                                    <td>
                                        <div class="remove"><?php echo Yii::t('ui','Remove');?></div>
                                        <input type="hidden" class="rowIndex" value="{0}" />
                                    </td>
                                </tr>
                            </textarea>
                        </td>
                    </tr>
                </tfoot>
                <tbody class="templateTarget">
					
                </tbody>
            </table>
        </div><!--panel-->
    </div><!--complex-->
 <div class="action">
		<?php echo CHtml::submitButton(Yii::t('ui','Submit')); ?>
	</div>
 <?php $this->endWidget(); ?>
 
 
 
 <?php echo $invoiceID; ?>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Dialog box 1',
        'autoOpen'=>false,
    ),
));

?>

<?php //echo $this->renderPartial('//invoiceItem/_form', array('model'=>$model,'invoiceItem'=>$invoiceItem)); ?>

<button id="create-user">Create new user</button>

<?php	$this->endWidget('zii.widgets.jui.CJuiDialog');
?>


</div><!-- form -->