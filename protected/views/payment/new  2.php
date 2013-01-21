<?php
$config = array(); $dataProvider = new CArrayDataProvider($rawData=$model->tasks, $config); 

$this->widget('zii.widgets.grid.CGridView', 
		array(  'dataProvider'=>$dataProvider,  
		'columns'=> array(              'id',           'name',                 'contents',             
			array(                  
				'class'=>'CButtonColumn',                      
					'viewButtonUrl'=>'Yii::app()->createUrl("Task/view", array("id"=>$data->id))',                  'updateButtonUrl'=>'Yii::app()->createUrl("Task/update", array("id"=>$data->id))',              )       ) ));
?>