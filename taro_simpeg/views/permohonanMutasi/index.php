<?php
$this->setPageTitle('Permohonan Mutasis');
$this->breadcrumbs = array(
    'Permohonan Mutasis',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('permohonan-mutasi-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array()),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
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
    ));
    ?>
</div><!-- search-form -->
<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
<?php
$display = (landa()->checkAccess("permohonanMutasi", "d") == 0) ? 'none' : '';
$button = "";
if (landa()->checkAccess("permohonanMutasi", 'r'))
    $button .= '{view} ';
if (landa()->checkAccess("permohonanMutasi", 'u'))
    $button .= '{update} ';
if (landa()->checkAccess("permohonanMutasi", 'd'))
    $button .= '{delete}';

      $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'ws-finish-form',
            'enableAjaxValidation' => false,
            'method' => 'post',
            'type' => 'horizontal',
            'action' => url('permohonanMutasi/otoritas'),
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
                'class' => 'table table-striped'
            )
        ));
?>
<button type="submit" name="delete" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>
        <button type="submit" name="otoritas" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-info pull-right"><span class="icon16 entypo-icon-publish white"></span> Otoritas Checked </button>

<!--<button type="submit" name="action" value="del" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>    
<button type="submit" name="action" value="oto" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-info pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Otoritas Checked</button>    -->
<br>
<br>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'permohonan-mutasi-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
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
            'name' => 'status',
            'type'=>'raw',
            'header' => 'Otoritas',
            'value' => '$data->statusoto',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        'nomor_register',
        'tanggal',
        array(
            'name' => 'pegawai_id',
            'value' => '$data->pegawai',
        ),
        array(
            'name' => 'new_unit_kerja_id',
            'value' => '$data->unitKerja',
        ),
        array(
            'name' => 'new_tipe_jabatan',
            'value' => '$data->tipeJabatan',
        ),
        array(
            'name' => 'new_jabatan_struktural_id',
            'header' => 'Jabatan Baru',
            'value' => '$data->jabatan',
        ),
        'tmt',
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

