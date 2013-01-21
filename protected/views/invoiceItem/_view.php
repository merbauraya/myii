<?php
/* @var $this InvoiceItemController */
/* @var $data InvoiceItem */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('invoice_id')); ?>:</b>
	<?php echo CHtml::encode($data->invoice_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inventory_id')); ?>:</b>
	<?php echo CHtml::encode($data->inventory_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_name')); ?>:</b>
	<?php echo CHtml::encode($data->item_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_description')); ?>:</b>
	<?php echo CHtml::encode($data->item_description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_date')); ?>:</b>
	<?php echo CHtml::encode($data->item_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->item_quantity); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('item_price')); ?>:</b>
	<?php echo CHtml::encode($data->item_price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_sub_total')); ?>:</b>
	<?php echo CHtml::encode($data->item_sub_total); ?>
	<br />

	*/ ?>

</div>