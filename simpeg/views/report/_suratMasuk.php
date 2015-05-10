<?php
$criteria = '';
if (!empty($model->tanggal_terima) && !empty($model->tanggal_kirim))
    $criteria .= ' and tanggal_terima between "' . $model->tanggal_terima . '" and "' . $model->tanggal_kirim . '"';

$data = SuratMasuk::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA SURAT MASUK</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">TANGGAL TERIMA</th>
                <th class="span1">PENGIRIM</th>			
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
			<td>' . $value->tanggal_terima . '</td>
			<td>' . $value->pengirim . '</td>			
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