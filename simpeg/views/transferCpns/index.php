<?php
$this->setPageTitle('Transfer Cpns');
$this->breadcrumbs = array(
    'Transfer Cpns',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('transfer-cpns-grid', {
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
        array('label' => 'Tambah', 'icon' => 'icon-plus', 'url' => Yii::app()->controller->createUrl('create'), 'linkOptions' => array(),'visible'=>landa()->checkAccess('transferCpns', 'c')),
        array('label' => 'List Data', 'icon' => 'icon-th-list', 'url' => Yii::app()->controller->createUrl('index'), 'active' => true, 'linkOptions' => array()),
        array('label' => 'Pencarian & Export Excel', 'icon' => 'icon-search', 'url' => '#', 'linkOptions' => array('class' => 'search-button')),
    ),
));
$this->endWidget();
?>

<?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>

<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$display = (landa()->checkAccess("transferCpns", "d") == 0) ? 'none' : '';
$button = "";
if (landa()->checkAccess("transferCpns", 'r'))
    $button .= '{view} ';
if (landa()->checkAccess("transferCpns", 'u'))
    $button .= '{update} ';
if (landa()->checkAccess("transferCpns", 'd'))
    $button .= '{delete}';
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'ws-finish-form',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url('transferCpns/transfer'),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'class' => 'table table-striped'
    )
        ));
?>
<button type="submit" name="delete" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-danger pull-right"><span class="icon16 brocco-icon-trashcan white"></span> Delete Checked</button>
<button type="submit" name="transfer" value="dd" style="margin-left: 10px;display:<?php echo $display; ?>" class="btn btn-info pull-right"><span class="icon16 entypo-icon-publish white"></span> Transfer Checked </button><br>


<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'transfer-cpns-grid',
    'dataProvider' => $model->search(),
    'type' => 'striped bordered condensed',
    'template' => '{summary}{pager}{items}{pager}',
    'columns' => array(
         array(
            'class' => 'CCheckBoxColumn',
            'selectableRows' => 2,
            'htmlOptions' => array('style' => 'text-align:center;display:' . $display),
            'headerHtmlOptions' => array('style' => 'width:25px;text-align:center;display:' . $display),
//             'cssClassExpression'=>'$data->status==2 ? "hidden" : ""', 
            'checkBoxHtmlOptions' => array(
                'name' => 'ceckbox[]',
                'value' => '$data->id',
            ),
        ),
//        'id',
         array(
            'name' => 'pegawai_id',
            'type' => 'raw',
            'header' => 'Pegawai',
            'value' => '$data->namaPegawai',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        'nomor_kesehatan',
        array(
            'name' => 'tanggal_kesehatan',
            'value' => '$data->tgl',
        ),
//        'tanggal_kesehatan',
//        'pelatihan_id',
        'nomor_diklat',
        array(
            'name' => 'status',
            'type' => 'raw',
            'header' => 'Transfer',
            'value' => '$data->statusname',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        /*
          'tanggal_diklat',
          'status',
         */
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
            'htmlOptions' => array('style' => 'width: 125px'),
        )
    ),
));

$this->endWidget();
?>

