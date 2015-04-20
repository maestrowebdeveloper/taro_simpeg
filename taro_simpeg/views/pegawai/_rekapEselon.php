<?php

$criteria = '';
if (!empty($_POST['unit_kerja_id']))
    $criteria .= ' and unit_kerja_id="' . $_POST['unit_kerja_id'] . '"';

if (!empty($_POST['eselon_id'])) {
    $jbt_id = array();
//    $eselon = Eselon::model()->findByPk($_POST['eselon_id']);
    $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_POST['eselon_id']));
    foreach ($jbt as $a) {
        $jbt_id[] = $a->id;
    }
    $criteria .= ' and jabatan_struktural_id IN (' . implode(',', $jbt_id) . ') ';
}


$data = Pegawai::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
app()->session['SuratMasuk_records'] = $data;

//print_r($jbt_id);
//foreach ($data as $val) {
//    echo $val->nama;
//}
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/suratMasuk/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">REKAPITULASI DATA ESELON</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NAMA</th>
                <th class="span1">NIP</th>
                <th class="span1">GOL</th>					
                <th class="span1">JABATAN</th>					
                <th class="span1">ESELON</th>					
                <th class="span1">ALAMAT</th>					
            </tr>
        </thead>
        <tbody>
<?php
$no = 1;
foreach ($data as $value) {
    echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nama . '</td>
			<td>' . $value->nip . '</td>			
			<td>' . $value->Golongan->nama . '</td>			
			<td>' . $value->JabatanStruktural->nama . '</td>			
			<td>' . $value->JabatanStruktural->Eselon->nama . '</td>			
			<td>' . $value->JabatanStruktural->Eselon->nama . '</td>			
									
		</tr>';
    $no++;
}
?>
        </tbody>
    </table>
</div>

