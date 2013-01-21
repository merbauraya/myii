            <tbody class="templateTarget">
					<?php foreach($invoiceItem as $i=>$item): ?>
					<tr class="templateContent">
						<td>
						<?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>"[$i]item_date",
	'model'=>$item,
    'attribute'=>"[$i]item_date",
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat' => 'dd/mm/yy', // save to db format
    ),
    'htmlOptions'=>array(
        'style'=>'height:10px;width:100px;'
		
    ),
));?>
						</td>
						
						<td>
							<?php echo  
							    $form->dropDownList($item,"[$i]inventory_id",CHtml::listData(Inventory::model()->findAll(), 'id', 'name'),array('prompt'=>'Not Assigned','class'=>'inventory'));	?>
								
															
							<?php echo $form->hiddenField($item,"[$i]id"); ?>	
						</td>
						<td>
							<?php echo $form->textField($item,"[$i]item_name",array('style'=>'width:450px')); ?>
						</td>
						<td>
							<?php echo $form->textField($item,"[$i]item_quantity",array('style'=>'width:40px')); ?>
						</td>
						<td>
							<?php echo $form->textField($item,"[$i]item_price",array('style'=>'width:60px;text-align:right')); ?>
						</td>
						<td>
							<?php echo $form->textField($item,"[$i]item_sub_total",array('style'=>'width:80px;text-align:right')); ?>
							</td>
							<td class="button-column">
								
									<?php echo CHtml::image(Yii::app()->theme->baseUrl."/images/delete.png",'Delete',array("class"=>"remove","cursor"=>"pointer")); ?>
							
						</td>
						
						
					</tr>
				<?php endforeach; ?>
                </tbody>