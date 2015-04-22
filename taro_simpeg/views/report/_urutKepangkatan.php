<?php
//$criteria = '';
//if (!empty($model->unit_kerja_id))
//    $criteria .= 'unit_kerja_id='.$model->unit_kerja_id;

$data = Pegawai::model()->with('Golongan')->findAll();
//app()->session['Pegawai_records'] = $data; 
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/pegawai/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI BERDASARKAN URUTAN KEPANGKATAN PEGAWAI</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NIP</th>
                <th class="span1">NAMA</th>			
                <th class="span1">UNIT KERJA</th>
                <th class="span1">GOLONGAN</th>			
                <th class="span1">TIPE JABATAN</th>
                <th class="span1">JABATAN</th>						
                <th class="span1">MASA KERJA</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nip . '</td>
			<td>' . $value->nama . '</td>			
			<td>' . $value->unitKerja . '</td>
			<td>' . $value->golongan . '</td>			
			<td>' . $value->tipe . '</td>
			<td>' . $value->jabatan . '</td>			
			<td>' . $value->masaKerja . '</td>
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>