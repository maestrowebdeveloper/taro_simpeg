<h2>LAPORAN PERMOHONAN IJIN BELAJAR KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo landa()->date2Ind(date('d F Y'));?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NOMOR REGISTER</th> 		
 		<th width="80px">NO USUL</th> 		
 		<th width="80px">TANGGAL USUL</th> 		 			 		 		 	
 		<th width="80px">NIP</th> 		 			 		 		 	
 		<th width="80px">NAMA PEGAWAI</th> 		 			 		 		 	
 		<th width="80px">GOLONGAN</th> 		 			 		 		 	
 		<th width="80px">JABATAN</th> 		 			 		 		 	
 		<th width="80px">UNIT KERJA</th> 		 			 		 		 	
 		<th width="80px">SATUAN KERJA</th> 		 			 		 		 	
 		<th width="80px">JURUSAN UNIVERSITAS</th> 		 			 		 		 	
 		<th width="80px">UNIVERSITAS</th> 		 			 		 		 	
 		<th width="80px">JENJANG PENDIDIKAN</th>		 			 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->nomor_register."&nbsp;"; ?></td>
        <td><?php echo $row->no_usul; ?></td>
        <td><?php echo landa()->date2Ind($row->tanggal); ?></td>        
        <td><?php echo $row->nip."&nbsp;"; ?></td>        
        <td><?php echo $row->nama; ?></td>        
        <td><?php echo $row->golongan; ?></td>        
        <td><?php echo $row->jabatan; ?></td>        
        <td><?php echo $row->unit_kerja; ?></td>       
        <td><?php echo $row->satuanKerja; ?></td>       
        <td><?php echo $row->jurusanUniv; ?></td>        
        <td><?php echo $row->univ; ?></td>        
        <td><?php echo $row->jenjang_pendidikan; ?></td>      
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>