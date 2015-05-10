<?php
$criteria = '';

if (!empty($model->hukuman_id))//as pelatihan id
    $criteria .= ' and hukuman_id=' . $model->hukuman_id;

if (!empty($model->tanggal_pemberian) && !empty($model->created))
    $criteria .= ' and tanggal_pemberian between "' . $model->tanggal_pemberian . '" and "' . $model->created . '"';

$data = RiwayatHukuman::model()->findAll(array('condition' => 't.id>0 ' . $criteria));
//app()->session['RiwayatHukuman_records'] = $data;
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENERIMA HUKUMAN</h3>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:20px">NO</th>
                <th class="span1">HUKUMAN</th>			
                <th class="span1">NOMOR REGISTER</th>			
                <th class="span1">NIP</th>
                <th class="span2">NAMA</th>
                <th class="span2">UNIT KERJA</th>			
                <th class="span1">GOLONGAN</th>
                <th class="span1">JABATAN</th>
                <th class="span1">TANGGAL PEMBERIAN</th>
                <th class="span1">ALASAN</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->hukuman . '</td>
			<td>' . $value->nomor_register . '</td>
			<td>' . $value->Pegawai->nip . '</td>
			<td>' . $value->Pegawai->namaGelar . '</td>
			<td>' . $value->Pegawai->unitKerja . '</td>
			<td>' . $value->Pegawai->golongan . '</td>
			<td>' . $value->Pegawai->jabatan . '</td>
			<td>' . $value->tanggal_pemberian . '</td>
			<td>' . $value->alasan . '</td>			
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>