<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/penerimaHukuman?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pegawai Yang Menerima Hukuman');
$this->breadcrumbs = array(
    'Laporan Pegawai Yang Menerima Hukuman',
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
            $data = array('0' => '- Semua Hukuman -') + CHtml::listData(Hukuman::model()->findAll(), 'id', 'nama');
            echo $form->select2Row($model, 'hukuman_id', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '50%',
                ))
            );
            ?>


            <div class="control-group "><label class="control-label" for="Honorer_tmt_akhir_kontrak">Tanggal Pemberian</label>
                <div class="controls">
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'RiwayatHukuman[tanggal_pemberian]',
                            'options' => array('language' => 'id', 'format' => 'yyyy-mm-dd'),
                            'value' => $model->tanggal_pemberian,
                                )
                        );
                        ?>
                    </div>
                    S/D
                    <div class="input-prepend"><span class="add-on"><i class="icon-calendar"></i></span>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbDatePicker', array(
                            'name' => 'RiwayatHukuman[created]',
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
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/report/penerimaHukumanExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENERIMA HUKUMAN</h3>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'penerima-hukuman-grid',
        'dataProvider' => $model->search2(),
        'type' => 'striped bordered condensed',
        'template' => '{summary}{pager}{items}{pager}',
        'columns' => array(
            array(
                'name' => 'id',
                'type' => 'raw',
                'value' => '$data->id',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'hukuman',
            'nomor_register',
            array(
                'name' => 'NIP',
                'type' => 'raw',
                'value' => '$data->Pegawai->nip',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'Nama',
                'type' => 'raw',
                'value' => '$data->Pegawai->namaGelar',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'unitKerja',
                'type' => 'raw',
                'value' => '$data->Pegawai->unitKerja',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'Golongan',
                'type' => 'raw',
                'value' => '$data->Pegawai->golongan',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'Jabatan',
                'type' => 'raw',
                'value' => '$data->Pegawai->jabatan',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'tanggal_pemberian',
                'type' => 'raw',
                'value' => 'date("d F Y",strtotime($data->tanggal_pemberian))',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'alasan'
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