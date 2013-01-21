<?php
/* @var $this InvoiceController */
/* @var $model Invoice */

$this->breadcrumbs=array(
	'Invoices'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Invoice', 'url'=>array('index')),
	array('label'=>'Create Invoice', 'url'=>array('create')),
	array('label'=>'Update Invoice', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Invoice', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Invoice', 'url'=>array('admin')),
);
?>

<h6 class="form-title">View Invoice #<?php echo $model->invoice_number; ?></h6>
<div class="portlet-content">
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'cssFile'=>Yii::app()->baseUrl. '/css/detailview.css',
	'attributes'=>array(
		array('label'=>'Client',
			  'name'=>'client.name'
			  
			  ),
		
		
		array('label'=>'Contact',
			  'name'=>'contact.name'
			  
			  ),
		'date_entered',
		'notes',
		'is_quote',
		'status_id',
		array('label'=>'Payment',
			  'name'=>'invoiceAmount.invoice_paid'
			  
			  ),
		array('label'=>'Amount',
			  'name'=>'invoiceAmount.invoice_subtotal'
			  
			  ),
		 array('label'=>'Invoice Balance',
		  'name'=>'invoiceAmount.invoice_balance'
		  
		  ), 
	),
)); ?>

<p> Invoice Details</p>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'invoice-grid',
	'dataProvider'=>$invoiceItem,
	 'enableSorting'=>false,
	'columns'=>array(
		array('name'=>'item_name','value'=>'$data->item_name'),
		array('name'=>'item_date','value'=>'$data->item_date'),
		array('name'=>'item_quantity','value'=>'$data->item_quantity'),
		array('name'=>'item_price','value'=>'$data->item_price'),
		array('name'=>'item_price','value'=>'$data->item_sub_total'),
			
		
	),
)); 

?>
</div>