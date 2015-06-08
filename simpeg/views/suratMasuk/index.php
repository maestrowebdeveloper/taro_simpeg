<?php
$this->setPageTitle('Surat Masuk');
$this->breadcrumbs=array(
	'Surat Masuk',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('surat-masuk-grid', {
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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array(),'visible'=>landa()->checkAccess('suratMasuk', 'c')),
                array('label'=>'List Data', 'icon'=>'icon-th-list', 'url'=>Yii::app()->controller->createUrl('index'),'active'=>true, 'linkOptions'=>array()),
		array('label'=>'Pencarian & Export Excel', 'icon'=>'icon-search', 'url'=>'#', 'linkOptions'=>array('class'=>'search-button')),
//        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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
	$display = (landa()->checkAccess("suratMasuk","d")==0)?'none':'';
	$button = "";
    if (landa()->checkAccess("suratMasuk", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("suratMasuk", 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess("suratMasuk", 'd')) 
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
	'id'=>'surat-keluar-grid',
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
		'pengirim',		
		array(
            'name' => 'sifat',
            'value' => 'ucwords($data->sifat)',            
        ), 		
		'nomor_surat',
		'perihal',
		
		array(
            'name' => 'tanggal_terima',
            'value' => 'landa()->date2Ind($data->tanggal_terima)',            
        ), 			
       array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {download} {update} {delete}',
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
				),
				'download' => array(
                    'label' => 'Download Document',
                    'icon' => 'icon-download ',
                    'url' => 'param("urlImg")."/surat_masuk/".$data->file',
                    'options' => array(
                        'class' => 'btn btn-small',                                                
                    )
                ),
				
			),
            'htmlOptions'=>array('style'=>'width: 145px;text-align:center'),
           )
	),
)); $this->endWidget();?>

