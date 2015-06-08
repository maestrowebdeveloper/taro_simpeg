<?php
//$criteria = '';
//if (!empty($model->unit_kerja_id))
//    $criteria .= 'unit_kerja_id='.$model->unit_kerja_id;
//$data = Pegawai::model()->with('Golongan')->findAll();
//app()->session['Pegawai_records'] = $data; 
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI BERDASARKAN URUTAN KEPANGKATAN PEGAWAI</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:40px" colspan="2">NO</th>
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
            $tempGol = "";
            $noGol = 0;
            foreach ($model as $value) {
                if ($value->gol != $tempGol)
                    $noGol = 1;
                else
                    $noGol++;
                
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $noGol . '</td>
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
                $tempGol = $value->gol;
            }
            ?>
        </tbody>
    </table>
</div>