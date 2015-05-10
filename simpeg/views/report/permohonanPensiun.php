<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/permohonanPensiun?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Permohonan Pensiun');
$this->breadcrumbs = array(
    'Laporan Permohonan Pensiun',
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



            <div class="control-group "><label class="control-label" for="">Tanggal</label>
                <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'PermohonanPensiun[tanggal]',
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
                            'name' => 'PermohonanPensiun[created]',
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
$cari = isset($_GET['cari']);
if ($cari) {
    ?>
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN DATA PERMOHONAN PENSIUN PEGAWAI</h3><br>
        <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'daftar-pegawai-grid',
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
                    'value' => 'date("d m Y",strtotime($data->tanggal))',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'pegawai',
                array(
                    'name' => 'golongan',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->golongan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'Unit Kerja',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'Tipe Jabatan',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->tipe',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                array(
                    'name' => 'Jabatan',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->jabatan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'masa_kerja',
                array(
                    'name' => 'tmt',
                    'type' => 'raw',
                    'value' => 'date("d m Y",strtotime($data->tmt))',
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