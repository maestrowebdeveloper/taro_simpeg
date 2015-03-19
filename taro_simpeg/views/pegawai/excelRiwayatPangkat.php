<h2>DATA RIWAYAT PANGKAT PEGAWAI KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NIP</th> 		
 		<th width="80px">NAMA</th> 		
 		<th width="80px">GOLONGAN</th> 		
 		<th width="80px">NOMOR REGISTER</th> 		
 		<th width="80px">TMT</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo "'".$row->Pegawai->nip; ?></td>
        <td><?php echo $row->pegawai ?></td>
        <td><?php echo $row->nama_golongan; ?></td>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->tmt_pangkat; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
