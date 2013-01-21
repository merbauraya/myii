<?php
/* @var $this SettingController */
/* @var $model Setting */

$this->breadcrumbs=array(
	'Settings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Setting', 'url'=>array('index')),
	array('label'=>'Create Setting', 'url'=>array('create')),
	array('label'=>'View Setting', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Setting', 'url'=>array('admin')),
);
?>

<h6 class="form-title">Update Setting</h6>

<?php
$this->widget('zii.widgets.jui.CJuiTabs', array(
        'tabs' => array(
		   'Company' =>array('id'=>'General','content'=>$this->renderPartial('_company',array('model'=>$model,'company'=>$company),true)),
               'General' =>array('id'=>'General','content'=>$this->renderPartial('_general',array('model'=>$model),true)),
               'Invoice' => array('id'=>'invoice','content'=>$this->renderPartial('_invoice',array('model'=>$model),true)),
         ),
		  
         // additional javascript options for the tabs plugin
        'options' => array(
  //Click the selected tab to toggle its content closed/open.
   //To enable this functionality, set the collapsible option to true
  'collapsible' => true,
 
   //Open CJuitabs on mouse over
  'event'=>'click',   
         ),
));
?>



<?php //echo $this->renderPartial('_invoice', array('model'=>$model)); ?>