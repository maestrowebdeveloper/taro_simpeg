<?php
$this->setPageTitle('Permohonan Ijin Belajars');
$this->breadcrumbs=array(
	'Permohonan Ijin Belajars',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('permohonan-ijin-belajar-grid', {
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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array()),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Pencarian', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('RangePrint'), 'linkOptions' => array(), 'visible' => true),
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
	$display = (landa()->checkAccess("permohonanIjinBelajar","d")==0)?'none':'';
	$button = "";
    if (landa()->checkAccess("permohonanIjinBelajar", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("permohonanIjinBelajar", 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess("permohonanIjinBelajar", 'd')) 
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
	'id'=>'permohonan-ijin-belajar-grid',
	'dataProvider'=>$model->search(),
        'type'=>'striped bordered condensed',
        'template'=>'{items}{pager}{summary}',
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
		'nomor_register',
		array(
            'name' => 'nama',
            'value' => '$data->nama',            
        ),        
        array(
            'name' => 'golongan',
            'value' => '$data->golongan',            
        ), 
        array(
            'name' => 'unit_kerja',
            'value' => '$data->unit_kerja',            
        ), 
        array(
            'name' => 'jabatan',
            'value' => '$data->jabatan',            
        ), 
        array(
            'name' => 'jenjang_pendidikan',
            'value' => '$data->jenjang_pendidikan',            
        ), 
        array(
            'name' => 'tanggal',
            'value' => '$data->tanggal',            
        ),

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
            'htmlOptions'=>array('style'=>'width: 125px;text-align:center'),
           )
	),
));$this->endWidget(); ?>

