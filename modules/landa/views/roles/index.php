<?php
$this->setPageTitle('Group '.$type);
$this->breadcrumbs = array(
    'Roles',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('roles-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<?php
if (isset($type)) {
    $sType = $type;
} else {
    $sType = '';
}
$display = (landa()->checkAccess($sType,"d")==0)?'none':'';
$visible = (landa()->checkAccess($sType,"c"))?true:false;
$button = "";
    if (landa()->checkAccess($sType, 'r')) 
        $button .= '{view} ';    
    if (landa()->checkAccess($sType, 'u')) 
        $button .= '{update} ';    
    if (landa()->checkAccess($sType, 'd')) 
        $button .= '{delete}';   

$this->beginWidget('zii.widgets.CPortlet', array(
    'htmlOptions' => array(
        'class' => ''
    )
));
$this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'pills',
    'items' => array(
        array('visible' => $visible, 'label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create', array('type' => $sType)), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index', array('type' => $sType)), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
//		array('label'=>'Export ke PDF', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GeneratePdf'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
//		array('label'=>'Export ke Excel', 'icon'=>'icon-download', 'url'=>Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions'=>array('target'=>'_blank'), 'visible'=>true),
    ),
));
$this->endWidget();
?>



<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->


<?php

$visible = "";
if ($type == 'user') {
    $visible = 'false';
}

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
 <input type="hidden" value="<?php echo $sType;?>" name="type"/>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'roles-grid',
    'dataProvider' => $model->search($sType),
    'type' => 'striped bordered condensed',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
         array(
                'class' => 'CCheckBoxColumn',
                'htmlOptions' => array('style' => 'display:'.$display),
                'headerHtmlOptions'=>array('style'=>'display:'.$display), 
                'selectableRows' => 2,
                'checkBoxHtmlOptions' => array(
                    'name' => 'ceckbox[]',
                    'value' => '$data->id',
                ),
            ), 
        'name',
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $button,
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'url' => 'Yii::app()->createUrl("landa/roles/view", array("id"=>$data->id,"type"=>"' . $sType . '"))',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
                    'url' => 'Yii::app()->createUrl("landa/roles/update", array("id"=>$data->id,"type"=>"' . $sType . '"))',
                    'options' => array(
                        'class' => 'btn btn-small update'
                    )
                ),
                'delete' => array(
                    'label' => 'Hapus',
                    'url' => 'Yii::app()->createUrl("landa/roles/delete", array("id"=>$data->id,"type"=>"' . $sType . '"))',
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

