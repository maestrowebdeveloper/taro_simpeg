<?php
$criteria = '';
if (!empty($model->tanggal_terima) && !empty($model->tanggal_kirim))
    $criteria .= ' and tanggal_kirim between "' . $model->tanggal_terima . '" and "' . $model->tanggal_kirim . '"';

$data = SuratKeluar::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
//app()->session['SuratKeluar_records'] = $data; 
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA SURAT KELUAR</h3><br>
    <h6  style="text-align:center">Tanggal : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">TANGGAL KIRIM</th>
                <th class="span1">PENERIMA</th>			
                <th class="span1">SIFAT</th>
                <th class="span1">NOMOR SURAT</th>			
                <th class="span1">PERIHAL</th>						
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($data as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->tanggal_kirim . '</td>
			<td>' . $value->penerima . '</td>			
			<td>' . $value->sifat . '</td>
			<td>' . $value->nomor_surat . '</td>			
			<td>' . $value->perihal . '</td>						
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>