<?php
//$criteria = '';
//if (!empty($model->unit_kerja_id))
//    $criteria .= ' and unit_kerja_id=' . $model->unit_kerja_id;
//if (!empty($model->tmt_kontrak) && !empty($model->tmt_akhir_kontrak))
//    $criteria .= ' and tmt_akhir_kontrak between "' . $model->tmt_kontrak . '" and "' . $model->tmt_akhir_kontrak . '"';
$criteria2 = new CDbCriteria();
if (!empty($model->unit_kerja_id))
    $criteria2->compare ('unit_kerja_id', $model->unit_kerja_id);
if (!empty($model->tmt_kontrak) && !empty($model->tmt_akhir_kontrak))
    $criteria2->condition='tmt_akhir_kontrak between "' . $model->tmt_kontrak . '" and "' . $model->tmt_akhir_kontrak . '"';

//$data = Honorer::model()->findAll($criteria2);
//app()->session['Honorer_records'] = $data;
$isi = new CActiveDataProvider('Honorer', array(
            'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/honorer/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PEGAWAI HONORER</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'honorer-grid',
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
            'nama',
            array(
                'name' => 'unitKerja',
                'type' => 'raw',
                'value' => '$data->unitKerja',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'jabatan',
            array(
                'name' => 'tmt_kontrak',
                'type' => 'raw',
                'value' => 'date("d m Y",strtotime($data->tmt_kontrak))',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'tmt_akhir_kontrak',
                'type' => 'raw',
                'value' => 'date("d m Y",strtotime($data->tmt_kontrak))',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'masaKerja',
        ),
    ));
    ?>
</div>