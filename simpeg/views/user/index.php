<?php
$this->setPageTitle(ucfirst($type));
$this->breadcrumbs = array(
    ucfirst($type),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('User-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('label' => 'Create', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create',array('type'=>$type)), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl($type), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
    ),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
        'type'=>$type,
    ));
    ?>
</div><!-- search-form -->

<?php
    $display = (landa()->checkAccess($type,"d")==0)?'none':'';  
    $button = "";
    if (landa()->checkAccess($type, 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess($type, 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess($type, 'd')) 
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
<?php
$view = ($type=='user')?'':'none';
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'User-grid',
    'dataProvider' => $model->search($type),
    'type' => 'striped bordered condensed',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
         array(
                'class' => 'CCheckBoxColumn',
                'htmlOptions' => array('style' => 'text-align:center;display:'.$display),
                'headerHtmlOptions'=>array('style'=>'width:25px;text-align:center;display:'.$display),   
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => array(
                    'name' => 'ceckbox[]',
                    'value' => '$data->id',
                ),
            ),  
       array(
           'name' => 'Foto',
            'type' => 'raw',
            'value' => '"$data->tagImg"', 
            'htmlOptions' => array('style' => 'text-align: center; width:180px;text-align:center;')
            ),
        array(
           'name' => 'Biodata',
            'type' => 'raw',
            'value' => '"$data->tagBiodata"', 
            'htmlOptions' => array('style' => 'text-align: center;')
            ),
        array(
           'name' => 'Access',
            'type' => 'raw',
            'value' => '"$data->tagAccess"', 
            'htmlOptions' => array('style' => 'text-align: center;display:'.$view),
            'headerHtmlOptions'=>array('style'=>'text-align:center;display:'.$view),                        
            ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $button,
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'url'=>'Yii::app()->createUrl("user/view", array("id"=>$data->id,"type"=>"'.$type.'"))',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'url'=>'Yii::app()->createUrl("user/update", array("id"=>$data->id,"type"=>"'.$type.'"))',
                    'options' => array(
                        'class' => 'btn btn-small update'
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'options' => array(
                        'class' => 'btn btn-small delete'
                    )
                )
            ),
            'htmlOptions' => array('style' => 'width: 125px;text-align:center'),
        )
    ),
));

$this->endWidget();
?>

