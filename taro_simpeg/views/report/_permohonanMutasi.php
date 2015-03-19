<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "'.$model->tanggal.'" and "'.$model->created.'"';


$data = PermohonanMutasi::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
app()->session['PermohonanMutasi_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/permohonanMutasi/generateExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA MUTASI PEGAWAI</h3><br>
<h6  style="text-align:center">Tangga : <?php echo date('d F Y');?></h6>
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