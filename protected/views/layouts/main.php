<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />


	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/grid.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css"/>
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="grid">
	<div class="gridrow space-top space-hbot">
			<?php
				echo CHtml::image(Yii::app()->request->baseUrl.'/images/hzlogo_small.jpg','Howzat Creation')
			?>
					
		</div>
	

	<div class="gridrow space-hbot" id="mainmenu">
		<?php $this->widget('bootstrap.widgets.TbNavbar', array(
	'brand' => 'Title',
	'fixed' =>false,
	'brand'=>'Home',
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.TbMenu',
			'items' => array(
					array('label'=>'Client', 'items'=> array(
				     array('label'=>'View Client', 'url'=>array('client/index')),
					 array('label'=>'Add Client', 'url'=>array('client/create')),
					 '---',
					 array('label'=>'Add Contact', 'url'=>array('contact/create')),
				)),
				array('label'=>'Invoice', 'items'=> array(
				     array('label'=>'Quotations', 'items'=>array(
					 	array('label'=>'Add Quotation', 'url'=>array('/invoice/quote','is_quote'=>'1')),
						array('label'=>'View Quotation', 'url'=>array('invoice/viewquote','q'=>'1')),
					 )
					 
					 ),
					  array('label'=>'Payment', 'items'=>array(
					     array('label'=>'Add Payment', 
						       'url'=>array('payment/create')),
					     array('label'=>'View Payment', 
						       'url'=>array('payment/index')),
					  )), 					  
					  array('label'=>'Create Invoice', 
					  	     'url'=>array('invoice/quote','is_quote'=>'0')), 					          array('label'=>'View Invoice', 'url'=>array('invoice/viewquote','q'=>'0')),
					  array('label'=>'Print Invoice/Quotation', 'url'=>array('invoice/selectInvoice')),
					  array('label'=>'Search Invoice', 'url'=>array('client/create')),
				)),
				    array('label'=>'Reports', 'items'=>array(
					 	array('label'=>'Client Statement', 'url'=>array('/invoice/quote','is_quote'=>'1')),
						array('label'=>'View Quotation', 'url'=>array('invoice/viewquote','q'=>'1')),
					 )
					 
					 ),
					  array('label'=>'Settings', 'items'=>array(
					 	array('label'=>'Systems', 'url'=>array('/setting/update')),
						array('label'=>'View Quotation', 'url'=>array('invoice/viewquote','q'=>'1')),
					 )
					 
					 ),
			)
		)
	)
)); 

?>
	</div><!-- mainmenu -->
	<div class="c12">
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	</div>
<div class="gridrow">
	<?php echo $content; ?>
</div>
	<div class="clear"></div>
	<div class="gridrow">
	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->
	</div>
</div><!-- page -->

</body>
</html>
