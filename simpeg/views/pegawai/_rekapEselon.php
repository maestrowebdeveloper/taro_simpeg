<?php
$criteria = '';
if (!empty($_GET['riwayat_jabatan_id']))
    $criteria .= ' AND JabatanStruktural.unit_kerja_id=' . $_GET['riwayat_jabatan_id'];

if (!empty($_GET['eselon_id'])) {
    $criteria .= ' AND JabatanStruktural.eselon_id=' . $_GET['eselon_id'];
}

$data = Pegawai::model()->findAll(array(
    'with' => array('RiwayatJabatan', 'JabatanStruktural'),
    'condition' => 'kedudukan_id=1'.$criteria
    ));
?>

<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">REKAPITULASI DATA ESELON</h3>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>

    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NIP</th>
                <th class="span1">NAMA</th>
                <th class="span1">GOL</th>					
                <th class="span1">JABATAN</th>					
                <th class="span1">ESELON</th>					
                <th class="span1">ALAMAT</th>					
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (!empty($data)) {
                foreach ($data as $value) {
                    $eselon = isset($value->JabatanStruktural->Eselon->nama) ? $value->JabatanStruktural->Eselon->nama : "-";
                    echo '	
		<tr>
			<td>' . $no . '</td>
                        <td>' . $value->nip . '</td>	
			<td>' . $value->nama . '</td>		
			<td>' . $value->pangkat . '</td>			
			<td>' . $value->jabatan . '</td>			
			<td>' . $eselon . '</td>			
			<td>' . $value->alamat . '</td>			
									
		</tr>';
                    $no++;
                }
            } else {
                echo '<tr><td colspan="7">No data results</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

