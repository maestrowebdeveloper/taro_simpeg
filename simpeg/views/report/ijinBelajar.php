<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/ijinBelajar?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Permohonan Ijin Belajar');
$this->breadcrumbs = array(
    'Laporan Permohonan Ijin Belajar',
);
?>
<script>
    function hide() {
        $(".well").hide();
        $(".form-horizontal").hide();
    }

</script>
<div class="well">

    <div class="row-fluid">
        <div class="span11">
            <div class="control-group ">
                <label class="control-label" for="">Tanggal</label>
                <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'PermohonanIjinBelajar[tanggal]',
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                            'value' => $model->tanggal,
                                )
                        );
                        ?>
                    </div>
                    S/D
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'PermohonanIjinBelajar[created]',
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                            'value' => $model->created,
                                )
                        );
                        ?>
                    </div>

                </div>
            </div>
        </div>



        <div class="span1"><?php if (!empty($model->id)) { ?>
                <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
            <?php } ?>
        </div>

    </div>
</div>


<div class="form-actions">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'ok white',
        'label' => 'View Report',
    ));
    ?>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'icon' => 'icon16 icomoon-icon-file-excel  white',
        'label' => 'Export Excel',
        'id' => 'export',
        'htmlOptions' => array(
            'name' => 'export'
        )
    ));
    ?>
</div>

<?php $this->endWidget(); ?>


<?php
if (isset($_GET['cari'])) {
    ?>
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN DATA IJIN BELAJAR PEGAWAI</h3><br>
        <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'ijin-belajar-grid',
            'dataProvider' => $model->search2(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                'id',
                array(
                    'name' => 'nomor_register',
                    'type' => 'raw',
                    'value' => '$data->nomor_register',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'tanggal',
                    'type' => 'raw',
                    'value' => 'landa()->date2Ind($data->tanggal)',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'NIP',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->nip',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'NamaPegawai',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->namaGelar',
//                'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'UnitKerja',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'jabatan',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->jabatan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'jenjang_pendidikan',
                array(
                    'name' => 'nama_jurusan',
                    'type' => 'raw',
                    'value' => '$data->namaJurusan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'nama_sekolah',
                    'type' => 'raw',
                    'value' => '$data->namaSekolah',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
            ),
        ));
        ?>
    </div>
    <?php
}
?>
<script>
    function printDiv(divName)
    {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>