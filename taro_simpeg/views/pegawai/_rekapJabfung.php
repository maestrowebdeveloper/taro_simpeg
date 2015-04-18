<?php

$criteria = '';
if (!empty($_POST['unit_kerja_id']))
    $criteria .= ' and unit_kerja_id="' . $_POST['unit_kerja_id'] . '"';

if (!empty($_POST['type'])) {
    if($_POST['type'] == 'ft'){
        $ft = array();
        $tertentu = JabatanFt::model()->findAll();
        foreach($tertentu as $data){
            $ft[] = $data->id;
        }
        $criteria .= ' and jabatan_ft_id IN (' . implode(',', $ft) . ') ';
    }
    
    if($_POST['type'] == 'fu'){
        $fu = array();
        $umum = JabatanFu::model()->findAll();
        foreach($umum as $data){
            $fu[] = $data->id;
        }
        $criteria .= ' and jabatan_fu_id IN (' . implode(',', $fu) . ') ';
    }
    
    if($_POST['type'] == 'guru'){
        $guru = array();
        $sGuru = JabatanFt::model()->findAll(array('condition'=>'type=guru'));
        foreach($sGuru as $data){
            $guru[] = $data->id;
        }
        $criteria .= ' and jabatan_ft_id IN (' . implode(',', $guru) . ') ';
    }
    
    if($_POST['type'] == 'kesehatan'){
        $kesehatan = array();
        $sKesehatan = JabatanFt::model()->findAll(array('condition'=>'type=kesehatan'));
        foreach($sKesehatan as $data){
            $kesehatan[] = $data->id;
        }
        $criteria .= ' and jabatan_ft_id IN (' . implode(',', $kesehatan) . ') ';
    }
   
}


$data = Pegawai::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
app()->session['SuratMasuk_records'] = $data;
//print_r($ft);
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
                <th class="span1">JABATAN FUNGSIONAL</th>					
                <th class="span1">SATUAN KERJA</th>					
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
			<td>' . $value->JabatanFu->nama . '</td>			
			<td>' . $value->JabatanFu->nama . '</td>			
			<td>' . $value->Unitkerja->nama . '</td>			
									
		</tr>';
    $no++;
}
?>
        </tbody>
    </table>
</div>

