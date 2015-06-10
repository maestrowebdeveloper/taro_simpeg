<h2>DATA RIWAYAT JABATAN PEGAWAI KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NIP</th> 		
 		<th width="80px">NAMA</th> 		
 		<th width="80px">TIPE JABATAN</th> 		
 		<th width="80px">JABATAN STRUKTURAL</th> 		
 		<th width="80px">JABATAN FUNGSIONAL UMUM</th> 		 		 		 	
 		<th width="80px">JABATAN FUNGSIONAL TERTENTU</th> 		 		 		 	
 		<th width="80px">TMT</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->Pegawai->nip."&nbsp;"; ?></td>
        <td><?php echo $row->pegawai ?></td>
        <td><?php echo $row->tipe; ?></td>
        <td><?php echo $row->jabatanStruktural; ?></td>
        <td><?php echo $row->jabatanFu; ?></td>
        <td><?php echo $row->jabatanFt; ?></td>
        <td><?php echo $row->tmt_mulai; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
