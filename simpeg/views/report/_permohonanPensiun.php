<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';


$data = PermohonanPensiun::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PERMOHONAN PENSIUN PEGAWAI</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo landa()->date2Ind(date('d F Y')); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>			
                <th class="span1">NOMOR REGISTER</th>			
                <th class="span1">TANGGAL</th>							
                <th class="span1">PEGAWAI</th>									
                <th class="span1">GOLONGAN</th>			
                <th class="span1">UNIT KERJA</th>			
                <th class="span1">TIPE JABATAN</th>
                <th class="span1">JABATAN</th>
                <th class="span1">MASA KERJA</th>			
                <th class="span1">TMT</th>

            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nomor_register . '</td>
			<td>' .landa()->date2Ind( $value->tanggal) . '</td>						
			<td>' . $value->pegawai . '</td>			
			<td>' . $value->Pegawai->golongan . '</td>							
			<td>' . $value->Pegawai->unitKerja . '</td>			
			<td>' . $value->Pegawai->tipe . '</td>			
			<td>' . $value->Pegawai->jabatan . '</td>						
			<td>' . $value->masa_kerja . '</td>						
			<td>' . landa()->date2Ind($value->tmt) . '</td>									
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>