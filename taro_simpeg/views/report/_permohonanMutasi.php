<?php
//$criteria = '';
//if (!empty($model->tanggal) && !empty($model->created))
//    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';
//
//if (!empty($model->mutasi))
//    $criteria .= ' and mutasi="' . $model->mutasi . '"';
//
//if (!empty($model->status))
//    $criteria .= ' and status=' . $model->status . '';

$criteria2 = new CDbCriteria();
if (!empty($model->tanggal) && !empty($model->created))
    $criteria2->condition = 'tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';

if (!empty($model->mutasi))
    $criteria2->compare ('mutasi', $model->mutasi);

if (!empty($model->status))
    $criteria2->compare('status',$model->status);

//$data = PermohonanMutasi::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['PermohonanMutasi_records'] = $data;
$isi = new CActiveDataProvider('PermohonanMutasi', array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));

?>

<div style="text-align: right">

    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/permohonanMutasi/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA MUTASI PEGAWAI</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'permohonan-mutasi-grid',
        'dataProvider' => $isi,
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