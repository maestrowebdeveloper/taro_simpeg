<?php
$criteria = '';
if (!empty($_POST['tahun']) && !empty($_POST['bup'])) {
    $tgl_lahir = $_POST['tahun'] - $_POST['bup'];
    $criteria .= ' and year(tanggal_lahir)="' . $tgl_lahir . '"';
}

if (!empty($_POST['bulan'])) {
    $criteria .= ' and month(tanggal_lahir)="' . date("m", strtotime($_POST['bulan'])) . '"';
}

if (!empty($_POST['unit_kerja_id'])) {
    $criteria .= ' and unit_kerja_id="' . $_POST['unit_kerja_id'] . '"';
}

if (!empty($_POST['eselon_id'])) {
    $jbt_id = array();
    $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_POST['eselon_id']));
    if (!empty($jbt_id)) {
        foreach ($jbt as $a) {
            $jbt_id[] = $a->id;
        }
    }
    $criteria .= ' and RiwayatJabatan.jabatan_struktural_id IN ("' . implode(',', $jbt_id) . '") ';
}


$data = Pegawai::model()->with('RiwayatJabatan')->findAll(array('condition' => 't.id > 0 ' . $criteria));
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/suratMasuk/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%; margin-left: 10px; margin-right: 10px;">
    <h3 style="text-align:center">LAPORAN PENSIUN</h3>
    <h6  style="text-align:center">Bulan : <?php echo $_POST['bulan'] . ' Tahun : ' . $_POST['tahun'] ?></h6>
    <hr>
    <div style="float:right">Jumlah : <b><?php echo count($data) ?></b></div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NIP</th>
                <th class="span1">NAMA</th>
                <th class="span1">ESELON</th>
                <th class="span1">SATUAN KERJA</th>					
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data)) {
                echo '<tr><td colspan="5">No Data Available</td></tr>';
            } else {
                $no = 1;
                foreach ($data as $value) {
                    $satuan = isset($value->UnitKerja->nama) ? $value->UnitKerja->nama : "-";
                    $eselon = isset($value->RiwayatJabatan->JabatanStruktural->Eselon->nama) ? $value->RiwayatJabatan->JabatanStruktural->Eselon->nama : "-";
                    echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nama . '</td>
			<td>' . $value->nip . '</td>			
			<td>' . $eselon . '</td>
                        <td>' . $satuan . '</td>
		</tr>';
                    $no++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
