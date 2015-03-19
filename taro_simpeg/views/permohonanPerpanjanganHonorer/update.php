<?php
if (isset($_GET['v'])) {$this->setPageTitle('Lihat Permohonan Perpanjangan Honorers | ID : '. $model->id);
$this->breadcrumbs=array(
	'Permohonan Perpanjangan Honorers'=>array('index'),
	$model->id,
);
}else{$this->setPageTitle('Edit Permohonan Perpanjangan Honorers | ID : '. $model->id);
$this->breadcrumbs=array(
	'Permohonan Perpanjangan Honorers'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);
}
$this->beginWidget('zii.widgets.CPortlet', array(
	'htmlOptions'=>array(
		'class'=>''
	)
));
if (isset($_GET['v'])) {
    $this->widget('bootstrap.widgets.TbMenu', array(
	'type'=>'pills',
	'items'=>array(
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id)), 'linkOptions'=>array()),
		array('label'=>'Print', 'icon'=>'icon-print', 'url'=>'javascript:void(0);return false', 'linkOptions'=>array('onclick'=>'printDiv("surat");return false;')),

    )));
}else{
    $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'pills',
            'items'=>array(
                    array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                    array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'), 'linkOptions'=>array()),
                    array('label'=>'Edit', 'icon'=>'icon-edit', 'url'=>Yii::app()->controller->createUrl('update',array('id'=>$model->id)),'active'=>true, 'linkOptions'=>array()),
            ),
    ));
}
$this->endWidget();
?>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>