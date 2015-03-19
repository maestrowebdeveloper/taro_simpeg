<?php
$criteria = '';

if (!empty($model->pelatihan_id))//as pelatihan id
    $criteria .= ' and pelatihan_id='.$model->pelatihan_id;

if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "'.$model->tanggal.'" and "'.$model->created.'"';

$data = RiwayatPelatihan::model()->findAll(array('condition' => 'id>0 '.$criteria));	
app()->session['RiwayatPelatihan_records'] = $data; 
?>

<div style="text-align: right">
    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>
    <a class="btn btn-info pull-right" href="<?php echo url("/report/mengikutiPelatihanExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN PEGAWAI YANG MENGIKKUTI PELATIHAN</h3><br>
<h6><?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:20px">NO</th>
			<th class="span1">PELATIHAN</th>
			<th class="span1">NOMOR REGISTER</th>
			<th class="span1">TANGGAL</th>
			<th class="span1">LOKASI</th>			
			<th class="span1">PENYELENGGARA</th>			
			<th class="span2">NIP</th>
			<th class="span2">NAMA</th>
			<th class="span2">UNIT KERJA</th>
			<th class="span1">GOLONGAN</th>
			<th class="span1">JABATAN</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=1;
	foreach ($data as  $value) {
		echo '	
		<tr>
			<td>'.$no.'</td>
			<td>'.$value->pelatihan.'</td>			
			<td>'.$value->nomor_register.'</td>
			<td>'.$value->tanggal.'</td>
			<td>'.$value->lokasi.'</td>
			<td>'.$value->penyelenggara.'</td>
			<td>'.$value->Pegawai->nip.'</td>
			<td>'.$value->pegawai.'</td>
			<td>'.$value->Pegawai->unitKerja.'</td>
			<td>'.$value->Pegawai->golongan.'</td>
			<td>'.$value->Pegawai->jabatan.'</td>
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>