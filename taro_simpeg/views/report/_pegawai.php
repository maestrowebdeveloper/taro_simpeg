<?php
$criteria2 = new CDbCriteria();
if (!empty($model->unit_kerja_id) && $model->unit_kerja_id > 0)
    $criteria2->compare('unit_kerja_id', $model->unit_kerja_id);
if (!empty($model->golongan_id) && $model->golongan_id > 0)
    $criteria2->compare('golongan_id=', $model->golongan_id);
if (!empty($model->kedudukan_id) && $model->kedudukan_id > 0)
    $criteria2->compare('kedudukan_id', $model->kedudukan_id);

if (!empty($model->tipe_jabatan))
    $criteria2->compare('tipe_jabatan', $model->tipe_jabatan);

if (!empty($model->tmt_pns) && !empty($model->tmt_pensiun))
    $criteria2->addInCondition('tmt_pensiun between "' . $model->tmt_pns . '" and "' . $model->tmt_pensiun . '"');

//$data = Pegawai::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['Pegawai_records'] = $data;
$isi = new CActiveDataProvider('Pegawai', array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PEGAWAI NEGERI SIPIL</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'daftar-pegawai-grid',
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
                'name' => 'nip',
                'type' => 'raw',
                'value' => '$data->nip',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'nama',
            'kedudukan',
            array(
                'name' => 'unitKerja',
                'type' => 'raw',
                'value' => '$data->unitKerja',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'golongan',
                'type' => 'raw',
                'value' => '$data->golongan',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'tipe',
                'type' => 'raw',
                'value' => '$data->tipe',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'jabatan',
            'masaKerja',
            'tmt_pensiun'
        ),
    ));
    ?>
</div>