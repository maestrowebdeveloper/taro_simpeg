<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "'.$model->tanggal.'" and "'.$model->created.'"';


$data = PermohonanPensiun::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
app()->session['PermohonanPensiun_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/permohonanPensiun/generateExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA PERMOHONAN PENSIUN PEGAWAI</h3><br>
<h6  style="text-align:center">Tangga : <?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:10px">NO</th>			
			<th class="span1">NOMOR REGISTER</th>			
			<th class="span1">TANGGAL</th>							
			<th class="span1">PEGAWAI</th>									
			<th class="span1">GOLONGAN</th>			
			<th class="span1">UNIT KERJA</th>			
			<th class="span1">TIPE JABATAN</th>
			<th class="span1">JABATAN</th>
			<th class="span1">MASA KERJA</th>			
			<th class="span1">TMT</th>
			
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=1;
	foreach ($data as  $value) {
		echo '	
		<tr>
			<td>'.$no.'</td>
			<td>'.$value->nomor_register.'</td>
			<td>'.$value->tanggal.'</td>						
			<td>'.$value->pegawai.'</td>			
			<td>'.$value->Pegawai->golongan.'</td>							
			<td>'.$value->Pegawai->unitKerja.'</td>			
			<td>'.$value->Pegawai->tipe.'</td>			
			<td>'.$value->Pegawai->jabatan.'</td>						
			<td>'.$value->masa_kerja.'</td>						
			<td>'.$value->tmt.'</td>									
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>