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
	$(".datepick").datepicker({'showAnim':'fold','dateFormat':'dd/mm/yy'});
	$(".add").click(function(){
		
		 $(".datepick").datepicker("destroy");
		var template = jQuery.format(jQuery.trim($(this).siblings(".template").val()));
		//alert(template);
		var place = $(this).parents(".templateFrame:first").children(".templateTarget");
		//alert(place);
		//var i = place.find(".rowIndex").length>0 ? place.find(".rowIndex").max()+1 : 0;
		var i = place.find('tr').length > 0 ? place.find('tr').length +1: 0;
		//alert(x);
		//alert(i);
		$(template(i)).appendTo(place);
		 $(".datepick").datepicker({'showAnim':'fold','dateFormat':'dd/mm/yy'});
		place.siblings('.templateHead').show()
		
		//alert(place);
		// start specific commands
		//enable datepicker
		
		// end specific commands
	});

	$(".remove").live("click", function() {
		$(this).parents(".templateContent:first").remove();
		hideEmptyHeaders();
	});
	 $(".inventory").live ("change",function () {
		//alert('q');
		//get selected text from inventory
		$ivSelected = $(this).find('option:selected').text();
		if ($ivSelected=='Not Assigned')
			$ivSelected='';
		//alert(ivSelected);
		$curID = $(this).attr('id');
		//alert (curID);
		$sID = $curID.match(/\d+/g);
		$('#InvoiceItem_'+ $sID + '_item_name').val($ivSelected);
		
	 });
});

function hideEmptyHeaders(){
	$('.templateTarget').filter(function(){return $.trim($(this).text())===''}).siblings('.templateHead').hide();
}
</script>
<div class="form">
 <?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'invoice-item-form',
	'enableAjaxValidation'=>false,
)); ?>
 
 
  <div class="tb-multirow">
             <div>
            <table class="templateFrame" cellspacing="0" width="100%">
                <thead class="templateHead">
                    <tr>
						<th>
							Date
						</th>
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
                        <td colspan="7">
                            <div class="add">
							<?php echo CHtml::image(Yii::app()->baseUrl."/images/add.png",'Add',array("class"=>"add",'title'=>'Add Row')); ?>
							<?php // echo Yii::t('ui','New');?></div>
								<textarea class="template" rows="0" cols="0">
                                <tr class="templateContent">
                                    <td>
									<?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>"InvoiceItem[{0}][item_date]",
	
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat' => 'dd/mm/yy', // save to db format
    ),
    'htmlOptions'=>array(
        'style'=>'width:100px;',
		'class'=>'datepick'
    ),
));?>
									
									</td>
									
									<td>
										<?php echo CHtml::dropDownList('InvoiceItem[{0}][inventory_id]','',CHtml::listData(Inventory::model()->findAll(), 'id', 'name'),array('prompt'=>'Not Assigned','class'=>'inventory')); 
										
										echo CHtml::hiddenField('InvoiceItem[{0}][invoice_id]',$model->id);
										echo CHtml::hiddenField('InvoiceItem[{0}][id]','');
										?>
										
									</td>
									<td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_name]','',array('style'=>'width:450px')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_quantity]','',array('style'=>'width:40px;text-align:right')); ?>
                                    </td>
                                    <td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_price]','',array('style'=>'width:60px;text-align:right')); ?>
                                    </td>
									<td>
                                        <?php echo CHtml::textField('InvoiceItem[{0}][item_sub_total]','',array('style'=>'width:80px;text-align:right')); ?>
                                    
									</td>
									<td class="button-column">
									
									<?php echo CHtml::image(Yii::app()->baseUrl."/images/delete.png",'Delete',array("class"=>"remove",'title'=>'Delete Row')); ?>
									
                                    <input type="hidden" class="rowIndex" value="{0}" />
									</td>
                                </tr>
                            </textarea>
                        </td>
                    </tr>
                </tfoot>
                <tbody class="templateTarget">
					<?php foreach($invoiceItem as $i=>$item): ?>
					
					<?php if($item){
					echo '<tr class="templateContent">';
					echo '	<td> ';}?>
						<?php	
						if ($item) {
						$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>"[$i]item_date",
	'model'=>$item,
    'attribute'=>"[$i]item_date",
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat' => 'dd/mm/yy', // save to db format
    ),
    'htmlOptions'=>array(
        'style'=>'width:100px;'
		
    ),
));
						echo '</td>';
						
						echo '<td>';}?>
							<?php if ($item) {
							echo     $form->dropDownList($item,"[$i]inventory_id",CHtml::listData(Inventory::model()->findAll(), 'id', 'name'),array('prompt'=>'Not Assigned','class'=>'inventory'));}	
								
						?>
								
															
							<?php if($item) {
								echo $form->hiddenField($item,"[$i]id"); 
						echo '</td>';
						echo '<td>'; }?>
							<?php 
								if ($item){
							echo $form->textField($item,"[$i]item_name",array('style'=>'width:450px')); 
						echo '</td>';
						echo '<td>'; }?>
							<?php 
							if ($item){
							echo $form->textField($item,"[$i]item_quantity",array('style'=>'width:40px')); 
						echo '</td>';
						echo '<td>'; }?>
							<?php 
							if ($item){
							echo $form->textField($item,"[$i]item_price",array('style'=>'width:60px;text-align:right')); 
						echo '</td>';
						echo '<td>';} ?>
							<?php 
							if ($item) {
							echo $form->textField($item,"[$i]item_sub_total",array('style'=>'width:80px;text-align:right')); 
							echo '</td>';
							echo '<td class="button-column">'; }?>
								
									<?php 
									if ($item){
									echo CHtml::image(Yii::app()->baseUrl."/images/delete.png",'Delete',array("class"=>"remove",'title'=>'Delete Row')); 
							
						echo '</td>';
						
						
					echo '</tr>' ;} ?>
				<?php endforeach; ?>
                </tbody>
            </table>
        </div><!--panel-->
    </div><!--complex-->
 <div class="action">
		
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'id'=>'createquote',
			'label'=>' Save ' ,
		)); ?>
		
	</div>
 <?php $this->endWidget(); ?>
 
 
 </div><!-- form -->