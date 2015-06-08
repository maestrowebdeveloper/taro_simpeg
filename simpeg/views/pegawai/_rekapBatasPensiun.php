<?php
$criteria = '1';
if (!empty($_POST['riwayat_jabatan_id'])) {
    $criteria = 'unit_kerja_id=' . $_POST['riwayat_jabatan_id'];
}
$data = JabatanStruktural::model()->findAll(array('condition' => $criteria, 'order' => 'nama'));
?>
<div class="report" id="report" style="width: 100%; margin-left: 10px; margin-right: 10px;">
    <h3 style="text-align:center">REKAP BATAS PENSIUN</h3>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">JABATAN</th>
                <th class="span1">ESELON</th>
                <th class="span1">BUP</th>				
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data)) {
                echo '<tr><td colspan="5">No Data Available</td></tr>';
            } else {
                $no = 1;
                foreach ($data as $value) {
                    $eselon = isset($value->Eselon->nama) ? $value->Eselon->nama : "-";
                    $tingkatEselon = substr($eselon, 0, 2);
                    $bup = '0 Tahun';
                    if ($tingkatEselon == "II") {
                        $bup = '60 Tahun';
                    } else if ($tingkatEselon == "III" or $tingkatEselon == "IV" or $tingkatEselon == "V") {
                        $bup = '58 Tahun';
                    }
                    echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nama . '</td>		
			<td>' . $eselon . '</td>
                        <td>' . $bup . '</td>
		</tr>';
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
