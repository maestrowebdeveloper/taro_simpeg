<?php
$this->setPageTitle('Data PNS');
$this->breadcrumbs = array(
    'Data PNS',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('pegawai-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('pegawai', 'c')),
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
$display = (landa()->checkAccess("pegawai", "d") == 0) ? 'none' : '';
$button = "";
if (landa()->checkAccess("pegawai", 'r'))
    $button .= '{view} ';
if (landa()->checkAccess("pegawai", 'u'))
    $button .= '{update} ';
if (landa()->checkAccess("pegawai", 'd'))
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
    'id' => 'pegawai-grid',
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
            'htmlOptions' => array('style' => 'text-align: left; width:60px;')
        ),
        array(
            'name' => 'nip',
            'header' => 'nip',
            'type' => 'raw',
            'htmlOptions' => array('style' => 'text-align: left; width:140px;')
        ),
        'nama',
        array(
            'name' => 'jabatan_struktural_id',
            'header'=>'Unit Kerja',
            'value' => '(isset($data->RiwayatJabatan->Struktural->nama)) ? $data->RiwayatJabatan->Struktural->nama : "-"',
        ),
        array(
            'header' => 'Gol',
            'name' => 'riwayat_pangkat_id',
            'type' => 'raw',
            'value' => '(isset($data->Pangkat->Golongan->nama)) ? $data->Pangkat->Golongan->nama : "-"',
            'htmlOptions' => array('style' => 'text-align: center;')
        ),
        array(
            'header' => 'Tipe',
            'name' => 'tipe_jabatan',
            'value' => 'ucwords($data->tipe_inisial)',
            'htmlOptions' => array('style' => 'text-align: center;')
        ),
        array(
            'name' => 'jabatan_struktural_id',
            'header' => 'Jabatan',
            'value' => 'ucwords($data->jabatan)',
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => $button,
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

