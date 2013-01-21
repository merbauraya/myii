<?php
$this->breadcrumbs=array(
	'Clients',
);

$this->menu=array(
	array('label'=>'Create Client','url'=>array('create')),
	array('label'=>'Manage Client','url'=>array('admin')),
);
?>
<h6 class="form-title">View Clients</h6>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'client-grid',
	'type'=>'striped bordered condensed',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'name',
		'address',
		'address2',
		'city',
		'state',
		/*
		'zipcode',
		'phone',
		'fax',
		'email',
		'mobile',
		'web_address',
		'active',
		'client_type_id',
		*/
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>

