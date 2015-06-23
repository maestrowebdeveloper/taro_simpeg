<?php
//$criteria = '';
//if (!empty($_POST['tahun']) && !empty($_POST['bup'])) {
//    $tgl_lahir = $_POST['tahun'] - $_POST['bup'];
//    $criteria .= ' and year(tanggal_lahir)="' . $tgl_lahir . '"';
//}
//
//if (!empty($_POST['bulan']))
//    $criteria .= ' and month(tanggal_lahir)="' . $_POST['bulan'] . '"';
//
//if (!empty($_POST['unit_kerja_id']))
//    $criteria .= ' and unit_kerja_id="' . $_POST['unit_kerja_id'] . '"';
//
//if (!empty($_POST['eselon_id'])) {
//    $jbt_id = array();
////    $eselon = Eselon::model()->findByPk($_POST['eselon_id']);
//    $jbt = JabatanStruktural::model()->findAll(array('condition' => 'eselon_id=' . $_POST['eselon_id']));
//    foreach ($jbt as $a) {
//        $jbt_id[] = $a->id;
//    }
//    $criteria .= ' and jabatan_struktural_id IN ("' . implode(',', $jbt_id) . '") ';
//}
//
//
//$data = Pegawai::model()->findAll(array('condition' => 'id > 0 ' . $criteria));
?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN PENSIUN</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>

    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">BUP</th>
                <th class="span1">PPROYEKSI PENSIUN</th>
                <th class="span1">STATUS</th>					
                <th class="span1">NIP</th>					
                <th class="span1">NAMA</th>					
                <th class="span1">KEDUDUKAN</th>					
                <th class="span1">GOLONGAN</th>					
                <th class="span1">JABATAN</th>					
                <th class="span1">ESELON</th>					
                <th class="span1">UNIT KERJA</th>					
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($model as $value) {
                 $status='';
                $status=(date('Y-m-d') < $value->tmt_pensiun) ? "Aktif" : "Pensiun";
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->bup . '</td>
			<td>' . landa()->date2Ind($value->tmt_pensiun) . '</td>
			<td>' . $status . '</td>
			<td>' . $value->nip.'&nbsp' . '</td>			
			<td>' . $value->nama. '</td>			
			<td>' . $value->Kedudukan->nama . '</td>			
			<td>' . $value->golongan . '</td>			
			<td>' . $value->jabatan . '</td>			
			<td>' . $value->eselon . '</td>			
			<td>' . $value->unitKerja . '</td>			
									
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>
