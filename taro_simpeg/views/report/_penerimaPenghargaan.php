<?php
$criteria = '';
if (!empty($model->penghargaan_id))//as pelatihan id
    $criteria .= ' and penghargaan_id=' . $model->penghargaan_id;

if (!empty($model->tanggal_pemberian) && !empty($model->created))
    $criteria .= ' and tanggal_pemberian between "' . $model->tanggal_pemberian . '" and "' . $model->created . '"';

$data = RiwayatPenghargaan::model()->findAll(array('condition' => 't.id>0 ' . $criteria));
//app()->session['RiwayatPenghargaan_records'] = $data;
$criteria2 = new CDbCriteria();
if (!empty($model->penghargaan_id))//as pelatihan id
    $criteria2->compare('penghargaan_id', $model->penghargaan_id);

if (!empty($model->tanggal_pemberian) && !empty($model->created))
    $criteria->condition = 'tanggal_pemberian between "' . $model->tanggal_pemberian . '" and "' . $model->created . '"';

$isi = new CActiveDataProvider('RiwayatPenghargaan', array(
    'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">
    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->
    <!--<a class="btn btn-info pull-right" href="<?php echo url("/report/penerimaPenghargaanExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENERIMA PENGHARGAAN</h3>
    <h6 style="text-align:center"><?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'penerima-penghargaan-grid',
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
            array(
                'name' => 'penghargaan',
                'type' => 'raw',
                'value' => '$data->penghargaan',
                'htmlOptions' => array('style' => 'width:17%'),
            ),
            array(
                'name' => 'nomor_register',
                'type' => 'raw',
                'value' => '$data->nomor_register',
                'htmlOptions' => array('style' => 'width:8%'),
            ),
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
            'keterangan'
        ),
    ));
    ?>
</div>