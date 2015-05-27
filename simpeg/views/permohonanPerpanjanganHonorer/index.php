<?php
$this->setPageTitle('Permohonan Perpanjangan Honorers');
$this->breadcrumbs = array(
    'Permohonan Perpanjangan Honorers',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('permohonan-perpanjangan-honorer-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(), 'visible' => landa()->checkAccess('permohonanPerpanjanganHonorer', 'c')),
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
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<?php
$display = (landa()->checkAccess("permohonanPerpanjanganHonorer", "d") == 0) ? 'none' : '';
$button = "";
if (landa()->checkAccess("permohonanPerpanjanganHonorer", 'r'))
    $button .= '{view} ';
if (landa()->checkAccess("permohonanPerpanjanganHonorer", 'u'))
    $button .= '{update} ';
if (landa()->checkAccess("permohonanPerpanjanganHonorer", 'd'))
    $button .= '{delete}';

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'chargeAdditional-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url('permohonanPerpanjanganHonorer/perpanjang'),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>

<button type="submit" name="delete" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>    
<button type="submit" name="perpanjang" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-warning pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Perpanjang Checked</button>    
<br>
<br>

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'permohonan-perpanjangan-honorer-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{items}{pager}{summary}',
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
        'nomor_register',
//        'tanggal',
        array(
            'name' => 'tanggal',
            'value' => '$data->tgl',
        ),
        array(
            'name' => 'honorer_id',
            'value' => '$data->honorer',
        ),
        array(
            'name' => 'masa_kerja',
            'value' => '$data->masa_kerja',
        ),
        array(
            'name' => 'honor_saat_ini',
            'value' => 'landa()->rp($data->honor_saat_ini)',
        ),
        array(
            'name' => 'tmt_mulai',
            'value' => '$data->tmtMulai',
        ),
        array(
            'name' => 'tmt_selesai',
            'value' => '$data->tmtSelesai',
        ),
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

