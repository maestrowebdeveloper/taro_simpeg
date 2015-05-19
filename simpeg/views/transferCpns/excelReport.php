<h2>LAPORAN TRANSFER CPNS</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">PEGAWAI</th> 		
 		<th width="80px">NOMOR KESEHATAN</th> 		 			 		 		 	 		
 		<th width="80px">TANGGAL KESEHATAN</th>   		 			 		 		 	
 		<th width="80px">NOMOR DIKLAT</th> 		 			 		 		 	
 		<th width="80px">STATUS TRANSFER</th>		 			 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->namaPegawai; ?></td>
        <td><?php echo $row->nomor_kesehatan; ?></td>        
        <td><?php echo $row->tanggal_kesehatan; ?></td>      
        <td><?php echo $row->nomor_diklat; ?></td>       
        <td><?php echo $row->statusname; ?></td>       
        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>