<h2>DATA RIWAYAT PENDIDIKAN PEGAWAI KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NIP</th> 		
 		<th width="80px">NAMA</th> 		
 		<th width="80px">JENJANG PENDIDIKAN</th> 		
 		<th width="80px">JURUSAN</th> 		
        <th width="80px">NAMA SEKOLAH</th>                                  
        <th width="80px">ALAMAT SEKOLAH</th>                                    
 		<th width="80px">TAHUN</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->Pegawai->nip."&nbsp;"; ?></td>
        <td><?php echo $row->pegawai ?></td>
        <td><?php echo $row->jenjang_pendidikan; ?></td>
        <td><?php echo $row->jurusan; ?></td>
        <td><?php echo $row->nama_sekolah; ?></td>        
        <td><?php echo $row->alamat_sekolah; ?></td>        
        <td><?php echo $row->tahun; ?></td>        
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
