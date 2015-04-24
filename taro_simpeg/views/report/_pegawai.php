<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">LAPORAN DATA PEGAWAI NEGERI SIPIL</h3><br>
    <h6  style="text-align:center">Tangga : <?php // echo date('d F Y'); ?></h6>
    <hr>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NIP</th>
                <th class="span1">NAMA</th>			
                <th class="span1">KEDUDUKAN</th>			
                <th class="span1">UNIT KERJA</th>
                <th class="span1">GOLONGAN</th>			
                <th class="span1">TIPE JABATAN</th>
                <th class="span1">JABATAN</th>						
                <th class="span1">MASA KERJA</th>
                <th class="span1">TMT PENSIUN</th>
            </tr>
        </thead>
        <tbody>
            $no = 1;
//            foreach ($data as $value) {
//                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nip . '</td>
			<td>' . $value->nama . '</td>			
			<td>' . $value->kedudukan . '</td>			
			<td>' . $value->unitKerja . '</td>
			<td>' . $value->golongan . '</td>			
			<td>' . $value->tipe . '</td>
			<td>' . $value->jabatan . '</td>			
			<td>' . $value->masaKerja . '</td>
			<td>' . $value->tmt_pensiun . '</td>
			
		</tr>';
//                $no++;
//            }
        </tbody>
    </table>
</div>