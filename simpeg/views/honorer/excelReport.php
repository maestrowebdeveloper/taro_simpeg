<h2>LAPORAN PEGAWAI HONORER KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y'); ?></h4>
<?php if ($model !== null): ?>
    <table border="1">
        <tr>		 			
            <th width="80px">NAMA</th> 		
            <th width="80px">JENIS KELAMIN</th> 		
            <th width="80px">TTL</th> 		
            <th width="80px">AGAMA</th> 		 		 		 	
            <th width="80px">PENDIDIKAN</th> 		 		 		 	
            <th width="80px">TAHUN PENDIDIKAN</th> 		 		 		 	
            <th width="80px">ALAMAT</th> 		 		 		 	
            <th width="80px">KOTA</th> 		 		 		 	
            <th width="80px">KODE POS</th> 		 		 		 	
            <th width="80px">HP</th> 		 		 		 	
            <th width="80px">GOLONGAN DARAH</th> 		 		 		 	
            <th width="80px">STATUS PERNIKAHAN</th>
            <th width="80px">NOMOR REGISTER</th> 		 		 		 	
            <th width="80px">TANGGAL REGISTER</th> 		 		 		 	
            <th width="80px">UNIT KERJA</th> 		 		 		 	
            <th width="80px">STATUS</th> 	 		 		 	
            <th width="80px">JABATAN</th> 	 		 		 	
            <th width="80px">TMT JABATAN</th> 		 		 	
            <th width="80px">GAJI</th> 		 		 		 	
            <th width="80px">TMT KONTRAK</th>                             
            <th width="80px">TMT AKHIR KONTRAK</th> 		 		 		 	
            <th width="80px">MASA KERJA</th> 		 		 		 	 		
        </tr>
        <?php foreach ($model as $row): ?>
            <tr>        
                <td><?php echo $row->nama; ?></td>
                <td><?php echo $row->jenis_kelamin; ?></td>
                <td><?php echo $row->ttl; ?></td>
                <td><?php echo $row->agama; ?></td>
                <td><?php echo isset($row->pendidikan) ? $row->pendidikan : "-"; ?></td>
                <td><?php echo $row->tahun_pendidikan; ?></td>
                <td><?php echo $row->alamat; ?></td>
                <td><?php echo $row->kota; ?></td>
                <td><?php echo $row->kode_pos; ?></td>
                <td><?php echo "'" . $row->hp; ?></td>
                <td><?php echo $row->golongan_darah; ?></td>
                <td><?php echo $row->status_pernikahan; ?></td>
                <td><?php echo "'" . $row->nomor_register; ?></td>
                <td><?php echo $row->tanggal_register; ?></td>
                <td><?php echo $row->unitKerja; ?></td>
                <td><?php echo $row->st_peg; ?></td>
                <td><?php echo $row->jabatan; ?></td>
                <td><?php echo $row->tmt_jabatan; ?></td>
                <td><?php echo $row->gaji; ?></td>
                <td><?php echo $row->tmt_kontrak; ?></td>
                <td><?php echo $row->tmt_akhir_kontrak; ?></td>
                <td><?php echo $row->masaKerja; ?></td>        
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>
