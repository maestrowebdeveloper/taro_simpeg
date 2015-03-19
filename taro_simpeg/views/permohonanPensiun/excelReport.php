<h2>LAPORAN PERMOHONAN PENSIUN</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">NOMOR REGISTER</th> 		
 		<th width="80px">TANGGAL</th> 		 			 		 		 	
 		<th width="80px">NIP</th> 		 			 		 		 	
        <th width="80px">NAMA PEGAWAI</th>                                      
        <th width="80px">UNIT KERJA</th>                                       
        <th width="80px">TIPE JABATAN</th>                                         
        <th width="80px">JABATAN</th>                                              
 		<th width="80px">MASA KERJA</th> 		 			 		 		 	 		
		<th width="80px">TMT</th> 
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->tanggal; ?></td>        
        <td><?php echo "'".$row->Pegawai->nip; ?></td>        
        <td><?php echo $row->Pegawai->namaGelar; ?></td>        
        <td><?php echo $row->Pegawai->unitKerja; ?></td>        
        <td><?php echo $row->Pegawai->tipe; ?></td>        
        <td><?php echo $row->Pegawai->jabatan; ?></td>        
        <td><?php echo $row->masa_kerja; ?></td>        
        <td><?php echo $row->tmt; ?></td>                
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>