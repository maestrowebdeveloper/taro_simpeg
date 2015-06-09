<?php
Yii::app()->clientScript->registerScript('search', "
        $('.search-form form').submit(function(){
            $.fn.yiiGridView.update('daftar-pegawai-grid', {
                data: $(this).serialize()
            });
            return false;
        });
");
?>
<div class="search-form">
    <?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'search-pegawai-form',
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>
    <?php
    $this->setPageTitle('Laporan Daftar Urutan Kepangkatan Pegawai');
    $this->breadcrumbs = array(
        'Laporan Daftar Urutan Kepangkatan Pegawai',
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
            <?php
            echo $form->radioButtonListRow($model, 'tipe_jabatan', Pegawai::model()->ArrTypeJabatan());
            ?>
        </div>
        <div><?php if (!empty($model->jabatan_ft_id) && !empty($model->jabatan_fu_id)) { ?>
                <a onclick="hide()" class="btn btn-small view" title="Remove Form" rel="tooltip"><i class=" icon-remove-circle"></i></a>
            <?php } ?>
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
            <a class="btn excelReport" onclick="exportExcel();"><i class="icomoon-icon-file-excel icon-white"></i> Export Excel</a>
        </div>

    </div>
    <?php $this->endWidget(); ?>
</div>
<h3 style="text-align:center">LAPORAN PEGAWAI BERDASARKAN URUTAN KEPANGKATAN PEGAWAI</h3><br>
<h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'daftar-pegawai-grid',
    'dataProvider' => $model->searchUrutKepangkatan(),
    'type' => 'striped bordered condensed',
    'template' => '{items}{pager}{summary}',
    'columns' => array(
        array(
            'header' => 'Nama <br>Nip',
            'name' => 'nama',
            'type' => 'raw',
            'value' => '$data->NamaNip',
            'htmlOptions' => array('style' => 'text-align:left'),
        ),
        array(
            'header' => 'Tempat <br>Tgl Lahir',
            'name' => 'tanggal_lahir',
            'type' => 'raw',
            'value' => '$data->TtlLahir',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
//       'karpeg',
        array(
            'header' => 'Gol <br> Tmt',
            'name' => 'riwayat_pangkat_id',
            'type' => 'raw',
            'value' => '$data->GolTmt',
            'htmlOptions' => array('style' => 'text-align: center;')
        ),
        array(
            'header' => 'Esl <br> TMT',
            'name' => 'jabatan_struktural_id',
            'type' => 'raw',
            'value' => '$data->EslonTmt',
            'htmlOptions' => array('style' => 'text-align: center;')
        ),
        array(
            'header' => 'Jabatan <br> TMT',
            'name' => 'jabatan_struktural_id',
            'type' => 'raw',
            'value' => '$data->JabatanTmt',
            'htmlOptions' => array('style' => 'text-align:left'),
        ),
        array(
            'name' => 'MK Thn',
            'type' => 'raw',
            'value' => '$data->MasaKerjaTahun',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'name' => 'MK Bulan',
            'value' => '$data->MasaKerjaBulan',
            'htmlOptions' => array('style' => 'text-align:center'),
        ),
        array(
            'header' => 'Diklat <br> Tahun',
//            'name' => 'jabatan_struktural_id',
            'type' => 'raw',
            'value' => '$data->DiklatThn',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
        array(
            'header' => 'Pendidikan <br> Tahun',
//            'name' => 'jabatan_struktural_id',
            'type' => 'raw',
            'value' => '$data->PendidikanThn',
            'htmlOptions' => array('style' => 'text-align: left;')
        ),
    ////
    ),
));
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
    function exportExcel() {
       if (document.getElementById('Pegawai_tipe_jabatan_0').checked) {
            var tipe_jabatan = document.getElementById('Pegawai_tipe_jabatan_0').value;
        } else if (document.getElementById('Pegawai_tipe_jabatan_1').checked) {
            var tipe_jabatan = document.getElementById('Pegawai_tipe_jabatan_1').value;
        } else{
            var tipe_jabatan = '';
        }
        if (tipe_jabatan != '') {
            window.open('<?php echo url('report/excelKepangkatan') ?>?tipe_jabatan=' + tipe_jabatan);
        } else {
            alert('Pilih Tipe Jabatan terlebih dahulu!');
        }
    }
</script>
<style>
    .form-horizontal .control-group{
        margin-bottom: 5px !important;
    }
</style>