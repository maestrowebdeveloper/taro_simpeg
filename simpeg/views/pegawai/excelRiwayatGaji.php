<h2>DATA RIWAYAT GAJI PEGAWAI KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NIP</th> 		
 		<th width="80px">NAMA</th> 		
 		<th width="80px">GAJI</th> 		
 		<th width="80px">NOMOR REGISTER</th> 		
        <th width="80px">DASAR PERUBAHAN</th>                                   
 		<th width="80px">TMT MULAI</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->Pegawai->nip."&nbsp;"; ?></td>
        <td><?php echo $row->pegawai ?></td>
        <td><?php echo $row->gaji; ?></td>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->dasar_perubahan; ?></td>        
        <td><?php echo $row->tmt_mulai; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
