<?php
$criteria = '';
if (!empty($_POST['Pegawai']['unit_kerja_id']))
    $criteria .= ' and unit_kerja_id="' . $_POST['Pegawai']['unit_kerja_id'] . '"';

if (!empty($_POST['eselon_id'])) {
    $jbt_id = array();
    $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_POST['eselon_id']));
    if (!empty($jbt)) {
        foreach ($jbt as $a) {
            $jbt_id[] = $a->id;
        }
        $criteria .= ' and jabatan_struktural_id IN (' . implode(',', $jbt_id) . ') ';
    }
}


$data = Pegawai::model()->findAll(array('condition' => 'tmt_pensiun > "' . date("Y-m-d") . '" ' . $criteria, 'limit' => 10));
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">REKAPITULASI DATA ESELON</h3>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>

    <table class="table table-bordered">
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
            }else{
                echo '<tr><td colspan="7">No data results</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

