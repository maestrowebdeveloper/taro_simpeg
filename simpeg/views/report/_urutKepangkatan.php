<?php
//$criteria = '';
//if (!empty($model->unit_kerja_id))
//    $criteria .= 'unit_kerja_id='.$model->unit_kerja_id;

//$data = Pegawai::model()->with('Golongan')->findAll();
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
                <th class="span1">NAMA <br>NIP</th>
                <th class="span1">TEMPAT <br>TGL LAHIR</th>			
                <th class="span1">GOL <br> TMT</th>
                <th class="span1">Esl <br> TMT</th>			
                <th class="span1">JABATAN <br> TMT</th>
                <th class="span1">MK TAHUN</th>						
                <th class="span1">MK bULAN</th>
                <th class="span1">DIKLAT <br> TAHUN</th>
                <th class="span1">PENDIDIKAN <br> TAHUN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($model as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->NamaNip . '</td>
			<td>' . $value->TtlLahir . '</td>			
			<td>' . $value->GolTmt . '</td>
			<td>' . $value->EslonTmt . '</td>			
			<td>' . $value->JabatanTmt . '</td>
			<td>' . $value->MasaKerjaTahun . '</td>			
			<td>' . $value->MasaKerjaBulan . '</td>
			<td>' . $value->DiklatThn . '</td>
			<td>' . $value->PendidikanThn . '</td>
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>