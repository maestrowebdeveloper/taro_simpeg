<?php
//$criteria = '';
//
//if (!empty($model->pelatihan_id))//as pelatihan id
//    $criteria .= ' and pelatihan_id=' . $model->pelatihan_id;
//
//if (!empty($model->tanggal) && !empty($model->created))
//    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';
//
//$data = RiwayatPelatihan::model()->findAll(array('condition' => 'id>0 ' . $criteria));
//app()->session['RiwayatPelatihan_records'] = $data;

$criteria2 = new CDbCriteria();
if (!empty($model->pelatihan_id))//as pelatihan id
    $criteria->compare('pelatihan_id', $model->pelatihan_id);

if (!empty($model->tanggal) && !empty($model->created))
    $criteria->condition = 'tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';


$isi = new CActiveDataProvider('RiwayatPelatihan', array(
    'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">
    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/report/mengikutiPelatihanExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENGIKKUTI PELATIHAN</h3><br>
    <h6 style="text-align: center"><?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'mengikuti-pelatihan-grid',
        'dataProvider' => $isi,
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
            'nomor_register',
            array(
                'name' => 'tanggal',
                'type' => 'raw',
                'value' => 'date("d F Y",strtotime($data->tanggal))',
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