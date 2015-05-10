<?php
if (isset($_GET['today']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI HARI INI';
if (isset($_GET['week']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI MINGGU INI';
if (isset($_GET['month']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI BULAN INI';
if (isset($_GET['nextmonth']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI BULAN DEPAN';
if (isset($_GET['nextweek']))
    $judul = 'INFORMASI ULANG TAHUN PEGAWAI MINGGU DEPAN';
?>

<h2><?php echo $judul;?></h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">STATUS</th> 		
 		<th width="80px">NAMA</th> 		
 		<th width="80px">TEMPAT / TGL. LAHIR</th> 		
 		<th width="80px">GOLONGAN</th> 		
        <th width="80px">UNIT KERJA</th>                                  
        <th width="80px">JABATAN</th>                                    
 		<th width="80px">USIA</th> 		 		 		 	 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        <td><?php echo "PNS" ?></td>
        <td><?php echo $row->namaGelar ?></td>
        <td><?php echo $row->ttl; ?></td>
        <td><?php echo $row->golongan; ?></td>
        <td><?php echo $row->unitKerja; ?></td>        
        <td><?php echo $row->jabatan; ?></td>        
        <td><?php echo $row->usia; ?></td>        
       	</tr>
     <?php endforeach; ?>
     <?php foreach($honorer as $row): ?>
        <tr>
        <td><?php echo "HONORER" ?></td>
        <td><?php echo $row->nama ?></td>
        <td><?php echo $row->ttl; ?></td>
        <td><?php echo "-"; ?></td>
        <td><?php echo $row->unitKerja; ?></td>        
        <td><?php echo $row->jabatan; ?></td>        
        <td><?php echo $row->usia; ?></td>        
        </tr>
        <?php endforeach; ?>
</table>
<?php endif; ?>
