<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "'.$model->tanggal.'" and "'.$model->created.'"';


$data = PermohonanPerpanjanganHonorer::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
app()->session['PermohonanPerpanjanganHonorer_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/permohonanPerpanjanganHonorer/generateExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA PERPANJANGAN PEGAWAI HONORER</h3><br>
<h6  style="text-align:center">Tangga : <?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:10px">NO</th>			
			<th class="span1">NOMOR REGISTER</th>			
			<th class="span1">TANGGAL</th>							
			<th class="span1">PEGAWAI</th>									
			<th class="span1">UNIT KERJA</th>			
			<th class="span1">HONOR</th>
			<th class="span1">TMT MULAI</th>
			<th class="span1">TMT SELESAI</th>
			<th class="span1">MASA KERJA</th>
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
			<td>'.$value->honorer.'</td>			
			<td>'.$value->unitKerja.'</td>							
			<td>'.landa()->rp($value->honor_saat_ini).'</td>			
			<td>'.$value->tmt_mulai.'</td>			
			<td>'.$value->tmt_selesai.'</td>						
			<td>'.$value->masa_kerja.'</td>						
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>