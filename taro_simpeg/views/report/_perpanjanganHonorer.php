<?php
//$criteria = '';
//if (!empty($model->tanggal) && !empty($model->created))
//    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';

$criteria2 = new CDbCriteria();

//$data = PermohonanPerpanjanganHonorer::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['PermohonanPerpanjanganHonorer_records'] = $data;

if (!empty($model->tanggal) && !empty($model->created))
    $criteria2->condition = 'tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';

$isi = new CActiveDataProvider('PermohonanPerpanjanganHonorer', array(
    'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">

    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/permohonanPerpanjanganHonorer/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PERPANJANGAN PEGAWAI HONORER</h3><br>
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
                'name' => 'Pegawai',
                'type' => 'raw',
                'value' => '$data->honorer',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'unitKerja',
            array(
                'name' => 'Honor',
                'type' => 'raw',
                'value' => 'landa()->rp($data->honor_saat_ini)',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'TMT Mulai',
                'type' => 'raw',
                'value' => 'date("d m Y",strtotime($data->tmt_mulai))',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            array(
                'name' => 'TMT Selesai',
                'type' => 'raw',
                'value' => 'date("d m Y",strtotime($data->tmt_selesai))',
                'htmlOptions' => array('style' => 'text-align:center'),
            ),
            'masa_kerja'
        ),
    ));
    ?>
</div>