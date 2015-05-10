<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "'.$model->tanggal.'" and "'.$model->created.'"';

if (!empty($model->mutasi))
    $criteria .= ' and mutasi="'.$model->mutasi.'"';

if (!empty($model->status))
    $criteria .= ' and status='.$model->status.'';

$data = PermohonanMutasi::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
//app()->session['PermohonanMutasi_records'] = $data; 
?>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA MUTASI PEGAWAI</h3><br>
<h6  style="text-align:center">Tanggal : <?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:10px">NO</th>			
			<th class="span1">NOMOR REGISTER</th>			
			<th class="span1">TANGGAL</th>							
			<th class="span1">PEGAWAI</th>									
			<th class="span1">UNIT KERJA LAMA</th>			
			<th class="span1">UNIT KERJA BARU</th>			
			<th class="span1">TIPE JABATAN LAMA</th>
			<th class="span1">TIPE JABATAN BARU</th>
			<th class="span1">JABATAN LAMA</th>
			<th class="span1">JABATAN BARU</th>
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
			<td>'.$value->unit_kerja_lama.'</td>							
			<td>'.$value->unitKerja.'</td>			
			<td>'.$value->tipe_jabatan_lama.'</td>			
			<td>'.$value->tipeJabatan.'</td>						
			<td>'.$value->jabatan_lama.'</td>						
			<td>'.$value->jabatan.'</td>						
			<td>'.$value->tmt.'</td>						
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>