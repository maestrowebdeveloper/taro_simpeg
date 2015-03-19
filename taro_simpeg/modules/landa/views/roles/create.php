<?php
$this->setPageTitle('Tambah Group '.ucfirst($type));
$this->breadcrumbs=array(
	'Roles'=>array($type),
	'Create',
);

?>

<?php 
if(isset($type)){
    $sType = $type;
}else{
    $sType='user';
}
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
$this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'),'active'=>true, 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl($sType), 'linkOptions'=>array()),
	),
));
$this->endWidget();

?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'type'=>$type)); ?>