<?php
$this->setPageTitle('Rekapitulasi Data Eselon');
$this->breadcrumbs = array(
    'Pegawai' => array('index'),
    'Rekapitulasi Data Eselon',
);
?>

<script stype="text/javascript">
    $('.search-form form').submit(function () {
        $.fn.yiiGridView.update('results', {
            data: $(this).serialize()
        });
        return false;
    });
</script>
<div class="search-form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'search-pegawai-form',
        'action' => Yii::app()->createUrl($this->route, array('cari' => 1)),
        'method' => 'get',
        'type' => 'horizontal',
    ));
    ?>
    <div class="well">

        <div class="row-fluid">


            <div class="control-group">
                <label class="control-label">Satuan Kerja<span class="required">*</span></label>
                <div class="controls">
                    <?php
                    $data = array('0' => '- Satuan Kerja -') + CHtml::listData(UnitKerja::model()->findAll(array('order' => 'id')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'name' => 'riwayat_jabatan_id',
                        'data' => $data,
                        'value' => isset($_GET['riwayat_jabatan_id']) ? $_GET['riwayat_jabatan_id'] : '',
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                    )));
                    ?>                 
                </div>
            </div>
            <div class="control-group">
                <label class="control-label">Eselon<span class="required">*</span></label>
                <div class="controls">
                    <?php
                    $data = CHtml::listData(Eselon::model()->findAll(array('order' => 'nama')), 'id', 'nama');
                    $this->widget(
                            'bootstrap.widgets.TbSelect2', array(
                        'htmlOptions' => array(
                            'multiple' => 'multiple',
                        ),
                        'name' => 'eselon_id',
                        'data' => $data,
                        'value' => isset($_GET['eselon_id']) ? $_GET['eselon_id'] : '',
                        'options' => array(
                            'width' => '40%;margin:0px;text-align:left',
                    )));
                    ?>                 
                </div>
            </div>


        </div>
        <div><?php if (!empty($_POST['Pegawai'])) { ?>
                <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
            <?php } ?>
        </div>

    </div>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'View Rekapitulasi',
        ));
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'icon' => 'ok white',
            'label' => 'Export ke Excel',
            'htmlOptions' => array(
                'name' => 'export'
            )
        ));
        ?>
    </div>

    <?php $this->endWidget(); ?>


    <?php
    if (isset($_GET['cari'])) {
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'daftar-pegawai-grid',
            'dataProvider' => $model->searchEselon(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
//        'nama',
                array(
                    'name' => 'nama',
                    'type' => 'raw',
                    'value' => '$data->namaGelar',
//            'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'nip',
                    'type' => 'raw',
                    'value' => '$data->nip',
//            'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'riwayat_pangkat_id',
                    'type' => 'raw',
                    'header' => 'Golongan',
                    'value' => '$data->Pangkat->golongan',
//            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'riwayat_jabatan',
            'type' => 'raw',
            'header'=>'Jabatan',
            'value' => '$data->jabatan',
//            'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'riwayat_pangkat_id',
                    'type' => 'raw',
                    'value' => '$data->pangkat',
//            'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'alamat',
                    'type' => 'raw',
                    'header' => 'Alamat',
                    'value' => '$data->alamat',
//            'htmlOptions' => array('style' => 'text-align:center'),
                ),
            ),
        ));
    }
    ?>
</div>
<script>
    function printDiv(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>
