<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'results',
    'enableAjaxValidation' => false,
    'method' => 'post',
    'type' => 'horizontal',
    'action' => url("report/mengikutiPelatihan?cari=1"),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
        ));
?>
<?php
$this->setPageTitle('Laporan Pegawai Yang Mengikuti Pelatihan');
$this->breadcrumbs = array(
    'Laporan Pegawai Yang Mengikuti Pelatihan',
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
            $data = array('0' => '- Semua Pelatihan -') + CHtml::listData(Pelatihan::model()->findAll(), 'id', 'nama');
            echo $form->select2Row($model, 'pelatihan_id', array(
                'asDropDownList' => true,
                'data' => $data,
                'options' => array(
                    "allowClear" => false,
                    'width' => '50%',
                ))
            );
            ?>
            <div class="control-group "><label class="control-label" for="Honorer_tmt_akhir_kontrak">Tahun</label>
                <div class="controls">
                    
                     <?php // echo $form->textFieldRow($model, 'tahun', array('class' => 'span5', 'maxlength' => 255)); ?>
                        <input class="angka span5" maxlength="255" name="RiwayatPelatihan[tahun]" id="RiwayatPelatihan_tahun" type="text">
                    
                    S/D
                    
                        <input class="angka span5" maxlength="255" name="RiwayatPelatihan[created]" id="RiwayatPelatihan_created" type="text">
                    

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
        <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENGIKKUTI PELATIHAN</h3><br>
        <h6 style="text-align: center"><?php echo date('d F Y'); ?></h6>
        <hr>
        <?php
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'mengikuti-pelatihan-grid',
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
                'pelatihan',
                 array(
                    'name' => 'nama',
                     'header'=>'Diklat',
                    'type' => 'raw',
                    'value' => '$data->nama',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'nomor_register',
                array(
                    'name' => 'Tahun',
                    'type' => 'raw',
                    'value' => '$data->tahun',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'lokasi',
                'penyelenggara',
                array(
                    'name' => 'NIP',
                    'type' => 'raw',
                    'value' => '$data->Pegawai->nip',
                    'htmlOptions' => array('style' => 'text-align:center'),
                ),
                'pegawai',
                array(
                    'name' => 'Unit Kerja',
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