<?php ?>
<div class="report" id="report" style="width: 100%">
    <h3 style="text-align:center">REKAPITULASI JABATAN FUNGSIONAL</h3><br>
    <h6  style="text-align:center">Tangga : <?php echo date('d F Y'); ?></h6>
    <hr>

    <table class="table table-bordered" border="1">
        <thead>
            <tr>
                <th style="width:10px">NO</th>
                <th class="span1">NAMA</th>
                <th class="span1">NIP</th>
                <th class="span1">GOL</th>					
                <th class="span1">JABATAN</th>					
                <th class="span1">JABATAN FUNGSIONAL</th>					
                <th class="span1">SATUAN KERJA</th>					
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($model as $value) {
                echo '	
		<tr>
			<td>' . $no . '</td>
			<td>' . $value->nama . '</td>
			<td>' . $value->nip . '</td>			
			<td>' . $value->golongan . '</td>			
			<td>' . $value->jabatanFu . '</td>			
			<td>' . $value->pangkat . '</td>			
			<td>' . $value->unitKerja . '</td>				
		</tr>';
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

