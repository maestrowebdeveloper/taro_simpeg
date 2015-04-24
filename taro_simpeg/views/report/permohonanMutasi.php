<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/permohonanMutasi?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Permohonan Mutasi');
$this->breadcrumbs = array(
    'Laporan Permohonan Mutasi',
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


            <?php
            $data = array('0' => '- Mutasi -') + array('luar_daerah' => '1 | Luar Daerah', 'dalam_daerah' => '2 | Dalam Daerah');
            echo $form->select2Row($model, 'mutasi', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );

            $data = array('0' => '- Status Otoritas -') + array('1' => '1 | Sudah di Otoritas', '2' => '2 | Belum di Otoritas');
            echo $form->select2Row($model, 'status', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '40%',
                ))
            );
            ?>
            <div class="control-group "><label class="control-label" for="">Tanggal</label>
                <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'PermohonanMutasi[tanggal]',
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
                            'name' => 'PermohonanMutasi[created]',
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
</div>

<?php $this->endWidget(); ?>


<?php
if (isset($_GET['cari'])) {
    ?>
    <div style="text-align: right">

        <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
        <!--<a class="btn btn-info pull-right" href="<?php // echo url("/permohonanMutasi/generateExcel");  ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
    </div>
    <div class="report" id="report" style="width: 100%">
        <h3 style="text-align:center">LAPORAN DATA MUTASI PEGAWAI</h3><br>
        <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'permohonan-mutasi-grid',
            'dataProvider' => $model->search2(),
            'type' => 'striped bordered condensed',
            'template' => '{summary}{pager}{items}{pager}',
            'columns' => array(
                'id',
                array(
                    'name' => 'Nomor Register',
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
                'unit_kerja_lama',
                array(
                    'name' => 'unitKerjaBaru',
                    'type' => 'raw',
                    'value' => '$data->unitKerja',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'tipe_jabatan_lama',
                array(
                    'name' => 'tipeJabatanBaru',
                    'type' => 'raw',
                    'value' => '$data->tipeJabatan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'jabatan_lama',
                array(
                    'name' => 'jabatanBaru',
                    'type' => 'raw',
                    'value' => '$data->jabatan',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
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