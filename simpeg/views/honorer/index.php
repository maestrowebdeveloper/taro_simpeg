<?php
$this->setPageTitle('Honorers');
$this->breadcrumbs = array(
    'Honorers',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('honorer-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('honorer', 'c')),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian & Export Excel', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
//        array('label' => 'Export ke Excel', 'icon' => 'icon-download', 'url' => Yii::app()->controller->createUrl('GenerateExcel'), 'linkOptions' => array('target' => '_blank'), 'visible' => true),
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
$display = (landa()->checkAccess("honorer", "d") == 0) ? 'none' : '';
$button = "";
if (landa()->checkAccess("honorer", 'r'))
    $button .= '{view} ';
if (landa()->checkAccess("honorer", 'u'))
    $button .= '{update} ';
if (landa()->checkAccess("honorer", 'd'))
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

<button type="submit" name="delete" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>    
<br>
<br>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'honorer-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{items}{pager}',
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'htmlOptions' => array('style' => 'text-align:center;display:' . $display),
            'headerHtmlOptions' => array('style' => 'width:25px;text-align:center;display:' . $display),
            'checkBoxHtmlOptions' => array(
                'name' => 'ceckbox[]',
                'value' => '$data->id',
            ),
        ),
        array(
            'name' => 'foto',
            'header' => 'Foto',
            'type' => 'raw',
            'value' => '"$data->smallFoto"',
            'htmlOptions' => array('style' => 'text-align: center; width:60px;')
        ),
        'nama',
        array(
            'name' => 'jabatan_fu_id',
            'value' => '$data->jabatan',
            'type' => 'raw',
            'htmlOptions' => array('style' => 'text-align: center; width:140px;')
        ),
        array(
            'name' => 'jabatan_struktural_id',
            'value' => '$data->unitKerja',
            'type' => 'raw',
            'htmlOptions' => array('style' => 'text-align: center; width:140px;')
        ),
        array(
            'name' => 'jabatan_struktural_id',
            'value' => '$data->satuanKerja',
            'type' => 'raw',
            'htmlOptions' => array('style' => 'text-align: center; width:140px;')
        ),
        array(
            'name' => 'tmt_kontrak',
            'header' => 'Kontrak pertama',
            'value' => '$data->tmtKontrak',
        ),
        array(
            'name' => 'tmt_mulai_kontrak',
            'header' => 'Tmt Mulai Kontrak',
            'value' => '$data->tmtMulaiKontrak',
        ),
        array(
            'name' => 'tmt_akhir_kontrak',
            'header' => 'Tmt Akhir Kontrak',
            'value' => '$data->tmtAkhirKontrak',
        ),
//        'tmt_kontrak',
//        'tmt_akhir_kontrak',	
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view} {update} {delete}',
            'buttons' => array(
                'view' => array(
                    'label' => 'Lihat',
                    'options' => array(
                        'class' => 'btn btn-small view'
                    )
                ),
                'update' => array(
                    'label' => 'Edit',
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
