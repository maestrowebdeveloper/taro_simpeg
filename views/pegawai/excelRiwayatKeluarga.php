<h2>DATA RIWAYAT KELUARGA PEGAWAI KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NIP</th> 		
 		<th width="80px">NAMA PEGAWAI</th> 		
 		<th width="80px">HUBUNGAN</th> 		
        <th width="80px">NAMA</th>      
 		<th width="80px">JENIS KELAMIN</th> 		
        <th width="80px">TTL</th>                                   
        <th width="80px">PENDIDIKAN TERAKHIR</th>                                   
        <th width="80px">PEKERJAAN</th>                                     
        <th width="80px">TANGGAL PERNIKAHAN</th>                                    
        <th width="80px">NO. KARSU</th>                                     
        <th width="80px">STATUS PERNIKAHAN</th>                                     
        <th width="80px">ANAK KE</th>                                   
 		<th width="80px">STATUS ANAK</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo "'".$row->Pegawai->nip; ?></td>
        <td><?php echo $row->pegawai ?></td>
        <td><?php echo $row->hubungan; ?></td>
        <td><?php echo $row->nama; ?></td>
        <td><?php echo $row->jenis_kelamin; ?></td>        
        <td><?php echo $row->ttl; ?></td>        
        <td><?php echo $row->pendidikan_terakhir; ?></td>        
        <td><?php echo $row->pekerjaan; ?></td>        
        <td><?php echo $row->tanggalPernikahan; ?></td>        
        <td><?php echo $row->nomor_karsu; ?></td>        
        <td><?php echo $row->status; ?></td>        
        <td><?php echo $row->anakKe; ?></td>        
        <td><?php echo $row->status_anak; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
