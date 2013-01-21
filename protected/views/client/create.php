<?php
$this->breadcrumbs=array(
	'Clients'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Client','url'=>array('index')),
	array('label'=>'Manage Client','url'=>array('admin')),
);
?>

<h6 class="form-title">Create Client</h6>
<div class="form-wrapper">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>