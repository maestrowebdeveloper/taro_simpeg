<?php
$this->setPageTitle('Create User Message Details');
$this->breadcrumbs=array(
	'User Message Details'=>array('index'),
	'Create',
);

?>

<?php 
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Create', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>url('userMessage'), 'linkOptions'=>array()),
	),
));
$this->endWidget();
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>