<?php
$this->setPageTitle('Pelatihan');
$this->breadcrumbs=array(
	'Pelatihan',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('pelatihan-grid', {
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
		array('label'=>'Tambah', 'icon'=>'icon-plus', 'url'=>Yii::app()->controller->createUrl('create'), 'linkOptions'=>array(),'visible'=>landa()->checkAccess('pelatihan', 'c')),
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
	$display = (landa()->checkAccess("pelatihan","d")==0)?'none':'';
	$button = "";
    if (landa()->checkAccess("pelatihan", 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess("pelatihan", 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess("pelatihan", 'd')) 
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
	'id'=>'pelatihan-grid',
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
		'nama',
		'keterangan',
		
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
)); $this->endWidget();?>

