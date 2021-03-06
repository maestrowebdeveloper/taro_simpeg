<?php
$this->setPageTitle('Jabatan Fungsional');
$this->breadcrumbs=array(
	'Jabatan Fungsional',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('jabatan-fungsional-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array(),'visible'=>landa()->checkAccess('jabatanFt', 'c')),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
	),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php
	$display = (landa()->checkAccess("jabatanFt","d")==0)?'none':'';
	$button = "";
    if (landa()->checkAccess("jabatanFt", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("jabatanFt", 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess("jabatanFt", 'd')) 
        $button .= '{delete}';    

    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'chargeAdditional-form',
        'enableAjaxValidation' => false,
        'method' => 'post',
        'type' => 'horizontal',
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        )
    ));
    ?>

<button type="submit" name="delete" value="dd" style="margin-left: 10px;display:<?php echo $display;?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>    
 <br>
 <br>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'jabatan-fungsional-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{summary}{pager}{items}{pager}',
	'columns'=>array(
            array(
                'class' => 'CCheckBoxColumn',
                'selectableRows' => 2,
	            'htmlOptions' => array('style' => 'text-align:center;display:'.$display),
	            'headerHtmlOptions'=>array('style'=>'width:25px;text-align:center;display:'.$display),                
                'checkBoxHtmlOptions' => array(
                    'name' => 'ceckbox[]',
                    'value' => '$data->id',
                ),
            ),
//		'id',
		'nama',
		'keterangan',
		array(
            'name' => 'jabatan_ft_id',
            'type' => 'raw',
            'header' => 'Jabatan Fung. Tertentu',
            'value' => '$data->jabFt',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
//		'created',
		/*
                'created',
		'modified',
		*/
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {update} {delete}',
			'buttons' => array(
			      'view' => array(
					'label'=> 'Lihat',
					'options'=>array(
						'class'=>'btn btn-small view'
					)
				),	
                              'update' => array(
					'label'=> 'Edit',
					'options'=>array(
						'class'=>'btn btn-small update'
					)
				),
				'delete' => array(
					'label'=> 'Hapus',
					'options'=>array(
						'class'=>'btn btn-small delete'
					)
				)
			),
            'htmlOptions'=>array('style'=>'width: 125px'),
           )
	),
));
$this->endWidget()
?>

