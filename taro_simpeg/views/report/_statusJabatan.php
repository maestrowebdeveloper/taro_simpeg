<?php
$criteria = '';


if (!empty($model->pendidikan_id))
    $criteria .= ' and Jabatan.status_jabatan_id="'.$model->pendidikan_id.'"';

if (!empty($model->status_pegawai))
    $criteria .= ' and status_pegawai="'.$model->status_pegawai.'"';


if (!empty($model->pangkat_id))
    $criteria .= ' and Jabatan.unit_kerja_id='.$model->pangkat_id;


if (!empty($model->jabatan_id))
    $criteria .= ' and Jabatan.satuan_kerja_id='.$model->jabatan_id;
$data = Pegawai::model()->with('Jabatan')->findAll(array('condition' => 't.id>0 '.$criteria));	
?>

<div style="text-align: right">
    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN PEGAWAI BERDASARKAN URUTAN KEPANGKATAN PEGAWAI</h3>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:20px">NO</th>
			<th class="span1">NIP</th>
			<th class="span2">NAMA</th>			
			<th class="span2">TTL</th>
			<th class="span1">GENDER</th>
			<th class="span1">AGAMA</th>
			<th class="span1">USIA</th>
			<th class="span2">STATUS JABATAN</th>
			<th class="span2">JABATAN</th>
			<th class="span2">UNIT KERJA</th>
			<th class="span2">SATUAN KERJA</th>
			<th class="span1">GOLONGAN</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=1;
	foreach ($data as  $value) {
		echo '	
		<tr>
			<td>'.$no.'</td>
			<td>'.$value->nip.'</td>
			<td>'.$value->nama.'</td>
			<td>'.$value->ttl.'</td>
			<td>'.$value->jenis_kelamin.'</td>
			<td>'.$value->agama.'</td>
			<td>'.$value->usia.'</td>
			<td>'.$value->Jabatan->statusJabatan.'</td>
			<td>'.$value->jabatan.'</td>
			<td>'.$value->unitKerja.'</td>
			<td>'.$value->satuanKerja.'</td>
			<td>'.$value->golongan.'</td>
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>