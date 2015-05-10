<?php
$criteria = '';
if (!empty($model->penghargaan_id))//as pelatihan id
    $criteria .= ' and penghargaan_id=' . $model->penghargaan_id;

if (!empty($model->tanggal_pemberian) && !empty($model->created))
    $criteria .= ' and tanggal_pemberian between "' . $model->tanggal_pemberian . '" and "' . $model->created . '"';

$data = RiwayatPenghargaan::model()->findAll(array('condition' => 't.id>0 ' . $criteria));
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PEGAWAI YANG MENERIMA PENGHARGAAN</h3>
    <h6 style="text-align:center"><?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:20px">NO</th>
                <th class="span1">PENGHARGAAN</th>
                <th class="span1">NOMOR REGISTER</th>
                <th class="span1">NIP</th>
                <th class="span1">NAMA</th>
                <th class="span1">UNIT KERJA</th>
                <th class="span1">GOLONGAN</th>
                <th class="span1">JABATAN</th>
                <th class="span2">TANGGAL PEMBERIAN</th>
                <th class="span2">KETERANGAN</th>			
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->penghargaan . '</td>
			<td>' . $value->nomor_register . '</td>
			<td>' . $value->Pegawai->nip . '</td>
			<td>' . $value->Pegawai->namaGelar . '</td>
			<td>' . $value->Pegawai->unitKerja . '</td>
			<td>' . $value->Pegawai->golongan . '</td>
			<td>' . $value->Pegawai->jabatan . '</td>
			<td>' . $value->tanggal_pemberian . '</td>
			<td>' . $value->keterangan . '</td>			
			
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>