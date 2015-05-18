<h2>LAPORAN PERMOHONAN IJIN BELAJAR KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NOMOR REGISTER</th> 		
 		<th width="80px">TANGGAL</th> 		 			 		 		 	
 		<th width="80px">NIP</th> 		 			 		 		 	
 		<th width="80px">NAMA PEGAWAI</th> 		 			 		 		 	
 		<th width="80px">GOLONGAN</th> 		 			 		 		 	
 		<th width="80px">JABATAN</th> 		 			 		 		 	
 		<th width="80px">UNIT KERJA</th> 		 			 		 		 	
 		<th width="80px">JENJANG PENDIDIKAN</th> 		 			 		 		 	
 		<th width="80px">JURUSAN UNIVERSITAS</th> 		 			 		 		 	
 		<th width="80px">UNIVERSITAS</th> 		 			 		 		 	
 		<th width="80px">JENJANG PENDIDIKAN</th> 		 			 		 		 	
 		<th width="80px">JURUSAN</th> 		 			 		 		 	
 		<th width="80px">NAMA SEKOLAH</th> 		 			 		 		 	
 		<th width="80px">ALAMAT SEKOLAH</th> 		 			 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->tanggal; ?></td>        
        <td><?php echo "'".$row->nip; ?></td>        
        <td><?php echo $row->nama; ?></td>        
        <td><?php echo $row->golongan; ?></td>        
        <td><?php echo $row->jabatan; ?></td>        
        <td><?php echo $row->unit_kerja; ?></td>        
        <td><?php echo $row->jenjang_pendidikan; ?></td>        
        <td><?php echo $row->jurusanUniv; ?></td>        
        <td><?php echo $row->univ; ?></td>        
        <td><?php echo $row->jenjang_pendidikan; ?></td>        
        <td><?php echo $row->jurusan; ?></td>        
        <td><?php echo $row->nama_sekolah; ?></td>        
        <td><?php echo $row->alamat; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>