<?php
if (isset($_GET['lahir']))
    $judul = 'TANGGAL LAHIR';
if (isset($_GET['jk']))
    $judul = 'JENIS KELAMIN';
if (isset($_GET['agama']))
    $judul = 'AGAMA';
if (isset($_GET['pangkat']))
    $judul = 'PANGKAT / GOLONGAN';
if (isset($_GET['jabatan']))
    $judul = 'JABATAN';
if (isset($_GET['pendidikan']))
    $judul = 'PENDIDIKAN';

$judul = 'INFORMASI KESALAHAN DATA PEGAWAI PADA KOLOM ' . $judul;
?>

<h2><?php echo $judul; ?></h2>
<h4>Tanggal : <?php echo date('d F Y'); ?></h4>
<?php if ($model !== null): ?>
    <table border="1">
        <tr>		
            <th width="80px">NO</th> 		
            <th width="80px">NIP</th> 		
            <th width="80px">NAMA</th> 		
            <th width="80px">TEMPAT / TGL. LAHIR</th> 		
            <th width="80px">GOLONGAN</th> 		
            <th width="80px">JABATAN</th>                                  
            <th width="80px">UNIT KERJA</th>                                    
            <th width="80px">AGAMA</th>                                     
            <th width="80px">PENDIDIKAN TERAKHIR</th> 		 		 		 	 		
        </tr>
        <?php
        $no=0;
        foreach ($model as $row) {
            $no++;
            ?>
            <tr>        
                <td><?php echo $no ?></td>
                <td><?php echo $row->nip . '&nbsp;' ?></td>
                <td><?php echo $row->namaGelar ?></td>
                <td><?php echo $row->ttl; ?></td>
                <td><?php echo $row->golongan; ?></td>
                <td><?php echo $row->jabatan; ?></td>        
                <td><?php echo $row->unitKerja; ?></td>        
                <td><?php echo $row->agama; ?></td>        
                <td><?php echo $row->pendidikanTerakhir; ?></td>        
            </tr>
        <?php } ?>     
    </table>
<?php endif; ?>
