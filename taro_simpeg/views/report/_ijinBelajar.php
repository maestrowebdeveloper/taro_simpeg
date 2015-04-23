<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';
$criteria2 = new CDbCriteria();
if (!empty($model->tanggal) && !empty($model->created))
    $criteria->condition = 'tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';

$data = PermohonanIjinBelajar::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['PermohonanIjinBelajar_records'] = $data;
$isi = new CActiveDataProvider('PermohonanIjinBelajar', array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'id')
        ));
?>

<div style="text-align: right">

    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/permohonanIjinBelajar/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA IJIN BELAJAR PEGAWAI</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'honorer-grid',
        'dataProvider' => $isi,
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
            'jurusan',
            array(
                'name' => 'nama_sekolah',
                'type' => 'raw',
                'value' => '$data->nama_sekolah',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
        ),
    ));
    ?>
</div>