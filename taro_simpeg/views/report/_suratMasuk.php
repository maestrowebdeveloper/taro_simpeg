<?php
$criteria = '';
if (!empty($model->tanggal_terima) && !empty($model->tanggal_kirim))
    $criteria .= ' and tanggal_terima between "'.$model->tanggal_terima.'" and "'.$model->tanggal_kirim.'"';

$data = SuratMasuk::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
app()->session['SuratMasuk_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/suratMasuk/generateExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA SURAT MASUK</h3><br>
<h6  style="text-align:center">Tangga : <?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:10px">NO</th>
			<th class="span1">TANGGAL TERIMA</th>
			<th class="span1">PENGIRIM</th>			
			<th class="span1">SIFAT</th>
			<th class="span1">NOMOR SURAT</th>			
			<th class="span1">PERIHAL</th>						
		</tr>
	</thead>
	<tbody>
	<?php 
	$no=1;
	foreach ($data as  $value) {
		echo '	
		<tr>
			<td>'.$no.'</td>
			<td>'.$value->tanggal_terima.'</td>
			<td>'.$value->pengirim.'</td>			
			<td>'.$value->sifat.'</td>
			<td>'.$value->nomor_surat.'</td>			
			<td>'.$value->perihal.'</td>						
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>