<h2>LAPORAN PERMOHONAN IJIN BELAJAR KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NOMOR REGISTER</th> 		
 		<th width="80px">TANGGAL</th> 		 			 		 		 	 		
 		<th width="80px">NAMA PEGAWAI HONORER</th>   		 			 		 		 	
 		<th width="80px">MASA KERJA</th> 		 			 		 		 	
 		<th width="80px">BESAR HONOR</th> 		 			 		 		 	
 		<th width="80px">TMT MULAI</th> 		 			 		 		 	
 		<th width="80px">TMT SELESAI</th> 		 			 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->tanggal; ?></td>        
        <td><?php echo $row->honorer; ?></td>      
        <td><?php echo $row->masa_kerja; ?></td>        
        <td><?php echo landa()->rp($row->honor_saat_ini); ?></td>        
        <td><?php echo $row->tmt_mulai; ?></td>        
        <td><?php echo $row->tmt_selesai; ?></td>        
        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>