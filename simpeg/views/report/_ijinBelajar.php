<?php
$criteria = '';
if (!empty($model->tanggal) && !empty($model->created))
    $criteria .= ' and tanggal between "' . $model->tanggal . '" and "' . $model->created . '"';


$data = PermohonanIjinBelajar::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['PermohonanIjinBelajar_records'] = $data;
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA IJIN BELAJAR PEGAWAI</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>			
                <th class="span1">NOMOR REGISTER</th>			
                <th class="span1">TANGGAL</th>
                <th class="span1">NIP</th>						
                <th class="span1">PEGAWAI</th>									
                <th class="span1">UNIT KERJA</th>
                <th class="span1">JABATAN</th>
                <th class="span1">JENJANG PENDIDIKAN</th>
                <th class="span1">JURUSAN</th>
                <th class="span1">SEKOLAH</th>
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
			<td>' . $value->tanggal . '</td>			
			<td>' . $value->Pegawai->nip . '</td>
			<td>' . $value->Pegawai->namaGelar . '</td>			
			<td>' . $value->Pegawai->unitKerja . '</td>			
			<td>' . $value->Pegawai->jabatan . '</td>			
			<td>' . $value->jenjang_pendidikan . '</td>			
			<td>' . $value->jurusan . '</td>			
			<td>' . $value->nama_sekolah . '</td>						
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>