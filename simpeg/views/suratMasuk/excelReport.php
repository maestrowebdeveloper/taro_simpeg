<h2>LAPORAN SURAT MASUK KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo landa()->date2Ind(date('d F Y'));?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NO REGISTER</th> 		
 		<th width="80px">PENGIRIM</th> 		
 		<th width="80px">TANGGAL TERIMA</th> 		 			 		 		 	
 		<th width="80px">SIFAT</th> 		 			 		 		 	
 		<th width="80px">NOMOR SURAT</th> 		 			 		 		 	
 		<th width="80px">PERIHAL</th> 		 			 		 		 	
 		<th width="80px">DI TERUSKAN KE</th> 		 			 		 		 	
 		<th width="80px">ISI</th> 		 			 		 		 	
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->no_reg; ?></td>
        <td><?php echo $row->pengirim; ?></td>
        <td><?php echo landa()->date2Ind($row->tanggal_terima); ?></td>        
        <td><?php echo $row->sifat; ?></td>        
        <td><?php echo $row->nomor_surat; ?></td>        
        <td><?php echo $row->perihal; ?></td>        
        <td><?php echo $row->terusan; ?></td>        
        <td><?php echo $row->isi; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>