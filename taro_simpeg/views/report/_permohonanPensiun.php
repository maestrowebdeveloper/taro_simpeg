<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';


//$data = PermohonanPensiun::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['PermohonanPensiun_records'] = $data;
$criteria2 = new CDbCriteria();
if (!empty($model->tanggal) && !empty($model->created))
    $criteria2->condition='tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';

$isi = new CActiveDataProvider('PermohonanPensiun', array(
    'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">

    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/permohonanPensiun/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PERMOHONAN PENSIUN PEGAWAI</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'daftar-pegawai-grid',
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