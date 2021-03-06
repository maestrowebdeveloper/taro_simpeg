<?php
$criteria = '';

if (!empty($model->pelatihan_id))//as pelatihan id
    $criteria .= ' and pelatihan_id=' . $model->pelatihan_id;


if (!empty($model->tahun) && !empty($model->created))
    $criteria .= 'tahun between "' . $model->tahun . '" and "' . $model->created . '"';

$data = RiwayatPelatihan::model()->findAll(array('condition' => 'id>0 ' . $criteria));
//app()->session['RiwayatPelatihan_records'] = $data; 
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENGIKKUTI PELATIHAN</h3><br>
    <h6 style="text-align:center"><?php echo landa()->date2Ind(date('d F Y')); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:20px">NO</th>
                <th class="span2">NIP</th>
                <th class="span2">NAMA</th>
                
                <th class="span1">PELATIHAN</th>
                <th class="span1">DIKLAT</th>
                <th class="span1">NOMOR REGISTER</th>
                <th class="span1">TAHUN</th>
                <th class="span1">LOKASI</th>			
                <th class="span1">PENYELENGGARA</th>			
                
                <th class="span2">UNIT KERJA</th>
                <th class="span1">GOLONGAN</th>
                <th class="span1">JABATAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
                            
			<td>' . $value->Pegawai->nip.'&nbsp;' . '</td>
			<td>' . $value->pegawai . '</td>
			<td>' . $value->pelatihan . '</td>			
			<td>' . $value->nama . '</td>			
			<td>' . $value->nomor_register . '</td>
			<td>' . $value->tahun . '</td>
			<td>' . $value->lokasi . '</td>
			<td>' . $value->penyelenggara . '</td>
			<td>' . $value->Pegawai->unitKerja . '</td>
			<td>' . $value->Pegawai->golongan . '</td>
			<td>' . $value->Pegawai->jabatan . '</td>
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
