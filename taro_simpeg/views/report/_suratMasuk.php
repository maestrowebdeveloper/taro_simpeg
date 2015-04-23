<?php
//$criteria = '';
//if (!empty($model->tanggal_terima) && !empty($model->tanggal_kirim))
//    $criteria .= ' and tanggal_terima between "' . $model->tanggal_terima . '" and "' . $model->tanggal_kirim . '"';
$criteria2 = new CDbCriteria();
if (!empty($model->tanggal_terima) && !empty($model->tanggal_kirim))
    $criteria2->condition = 'tanggal_terima between "' . $model->tanggal_terima . '" and "' . $model->tanggal_kirim . '"';

//$data = SuratMasuk::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['SuratMasuk_records'] = $data;
$isi = new CActiveDataProvider('SuratMasuk', array(
    'criteria' => $criteria2,
//            'sort' => array('defaultOrder' => 'name')
        ));
?>

<div style="text-align: right">

    <!--<button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>-->    
    <!--<a class="btn btn-info pull-right" href="<?php // echo url("/suratMasuk/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>-->
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA SURAT MASUK</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <?php
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'surat-masuk-grid',
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
                'name' => 'tanggal_terima',
                'type' => 'raw',
                'value' => 'date("d F Y",strtotime($data->tanggal_terima))',
                'htmlOptions' => array(),
            ),
            'pengirim',
            'sifat',
            'nomor_surat',
            'perihal',
        ),
    ));
    ?>
</div>