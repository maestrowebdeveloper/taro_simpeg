<h2>LAPORAN MASTER PANGKAT/GORRU KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">GOLONGAN</th> 		
 		<th width="80px">PANGKAT</th> 		 			 		 		 	
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->nestedName; ?></td>
        <td><?php echo $row->keterangan; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
