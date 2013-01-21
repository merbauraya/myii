<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	
	<div class="row">
		<?php echo CHtml::label('Customer',false);?>
		<?php echo CHtml::listBox('Invoice[customer]','All Client',CHtml::listData(Client::model()->findAll(), 'id', 'name'),array('multiple'=>'multiple'));?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Invoice Number',false);?>
		<?php echo CHtml::textField('Invoice[invoice]','');?>
	</div>
	<div class="row">
		<?php echo CHtml::label('From Date',false);?>
		<?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Invoice[from_date]',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat' => 'dd/mm/yy', // save to db format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
		
    ),
));?>
	</div>
	<div class="row">
		<?php echo CHtml::label('To Date',false);?>
		<?php	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'Invoice[to_date]',
    // additional javascript options for the date picker plugin
    'options'=>array(
        'showAnim'=>'fold',
		'dateFormat' => 'dd/mm/yy', // save to db format
    ),
    'htmlOptions'=>array(
        'style'=>'height:20px;'
		
    ),
));?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Include Quote',false);?>
		<?php echo CHtml::checkBox('Invoice[quote]',false);?>
	</div>
	<div class="row">
		<?php echo CHtml::label('Amount',false);?>
		<?php echo CHtml::dropDownList('Invoice[amount_operator]','',Setting::model()->getNumberComparisonOperator(),array());?>
		<?php echo CHtml::textField('Invoice[amount]','');?>
		
	</div>
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>
<?php $this->endWidget(); ?>
</div>
<?
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$model->search(),
    'columns'=>array(
        'invoice_number',
        array('name'=>'client_name','value'=>'$data->client->name'),
        array( 'name'=>'author_search', 'value'=>'$data->author->username' ),
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));

?>