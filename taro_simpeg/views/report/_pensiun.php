<?php
$criteria = '';
if (!empty($_POST['tahun']) && !empty($_POST['bup']))
    $tgl_lahir = $_POST['tahun'] - $_POST['bup'];
$criteria .= ' and year(tanggal_lahir)="' . $tgl_lahir . '"';

if (!empty($_POST['bulan']))
    $criteria .= ' and month(tanggal_lahir)="' . $_POST['bulan'] . '"';

if (!empty($_POST['unit_kerja_id']))
    $criteria .= ' and unit_kerja_id="' . $_POST['unit_kerja_id'] . '"';

if (!empty($_POST['eselon_id'])) {
    $jbt_id = array();

    $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_POST['eselon_id']));
    if (!empty($jbt)) {
        foreach ($jbt as $a) {
            $jbt_id[] = $a->id;
        }
        $criteria .= ' and jabatan_struktural_id IN ("' . implode(',', $jbt_id) . '") ';
    }
}

$data = Pegawai::model()->with('RiwayatJabatan')->findAll(array('condition' => 't.id > 0 ' . $criteria));
?>

<div style="text-align: right">

    <button class="print entypo-icon-printer button" onclick="printDiv('report')" type="button">&nbsp;&nbsp;Print Report</button>    
    <a class="btn btn-info pull-right" href="<?php echo url("/suratMasuk/generateExcel"); ?>" target="_blank"><span class="icon16 icomoon-icon-file-excel  white"></span>Export to Excel</a>
</div>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PENSIUN</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">BUP</th>
                <th>PROYEKSI PENSIUN</th>
                <th>STATUS</th>
                <th>NIP</th>
                <th>NAMA</th>
                <th>GOL</th>
                <th>JABATAN</th>
                <th>UNIT KERJA</th>					
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($data)) {
                foreach ($data as $value) {
                    $satuan = isset($value->UnitKerja->nama) ? $value->UnitKerja->nama : "-";
                    $eselon = isset($value->RiwayatJabatan->JabatanStruktural->Eselon->nama) ? $value->RiwayatJabatan->JabatanStruktural->Eselon->nama : "-";
                    
                    $status = 'Aktif';
                    if(date("Y-m-d") > $value->tmt_pensiun){
                        $status = 'Pensiun';
                    }
                    echo '	
		<tr>
			<td>' . $_POST['bup'] . '</td>
                        <td>' . date("d-m-Y",  strtotime($value->tmt_pensiun)) . '</td>
                        <td>' . $status .'</td>
			<td>' . $value->nip . '</td>
                        <td>' . $value->nama . '</td>
			<td>' . $eselon . '</td>
                        <td>' . $value->jabatan . '</td>
                        <td>' . $satuan . '</td>
		</tr>';
                }
            } else {
                echo '<tr><td colspan="5">No data available</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
