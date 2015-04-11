<?php
$criteria = '';
if (!empty($model->unit_kerja_id) && $model->unit_kerja_id>0 )
    $criteria .= ' and unit_kerja_id='.$model->unit_kerja_id;
if (!empty($model->golongan_id)  && $model->golongan_id>0)
    $criteria .= ' and golongan_id='.$model->golongan_id;
if (!empty($model->kedudukan_id)  && $model->kedudukan_id>0)
    $criteria .= ' and kedudukan_id='.$model->kedudukan_id;

if (!empty($model->tipe_jabatan))
    $criteria .= ' and tipe_jabatan='.$model->tipe_jabatan;

if (!empty($model->tmt_pns) && !empty($model->tmt_pensiun))
    $criteria .= ' and tmt_pensiun between "'.$model->tmt_pns.'" and "'.$model->tmt_pensiun.'"';

$data = Pegawai::model()->findAll(array('condition' => 'id > 0 '.$criteria));	
app()->session['Pegawai_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/pegawai/generateExcel");?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
<h3 style="text-align:center">LAPORAN DATA PEGAWAI NEGERI SIPIL</h3><br>
<h6  style="text-align:center">Tangga : <?php echo date('d F Y');?></h6>
<hr>
<table class="table table-bordered">
	<thead>
		<tr>
			<th style="width:10px">NO</th>
			<th class="span1">NIP</th>
			<th class="span1">NAMA</th>			
			<th class="span1">KEDUDUKAN</th>			
			<th class="span1">UNIT KERJA</th>
			<th class="span1">GOLONGAN</th>			
			<th class="span1">TIPE JABATAN</th>
			<th class="span1">JABATAN</th>						
			<th class="span1">MASA KERJA</th>
			<th class="span1">TMT PENSIUN</th>
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
			<td>'.$value->kedudukan.'</td>			
			<td>'.$value->unitKerja.'</td>
			<td>'.$value->golongan.'</td>			
			<td>'.$value->tipe.'</td>
			<td>'.$value->jabatan.'</td>			
			<td>'.$value->masaKerja.'</td>
			<td>'.$value->tmt_pensiun.'</td>
			
		</tr>';
	 $no++; }?>
	</tbody>
</table>
</div>