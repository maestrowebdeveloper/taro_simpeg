<h2>DATA PEGAWAI YANG MENGIKUTI PELATIHAN KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
    <tr>                
        <th width="80px">PELATIHAN</th>      
        <th width="80px">NOMOR REGISTER</th>      
        <th width="80px">TANGGAL</th>      
        <th width="80px">LOKASI</th>      
        <th width="80px">PENYELENGGARA</th>      
        <th width="80px">NIP</th>      
        <th width="80px">NAMA</th>      
        <th width="80px">UNIT KERJA</th>      
        <th width="80px">GOLONGAN</th>      
        <th width="80px">JABATAN</th>      
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?php echo $row->pelatihan; ?></td>
        <td><?php echo $row->nomor_register; ?></td>
        <td><?php echo $row->tanggal; ?></td>
        <td><?php echo $row->lokasi; ?></td>
        <td><?php echo $row->penyelenggara; ?></td>
        <td><?php echo "'".$row->Pegawai->nip; ?></td>
        <td><?php echo $row->Pegawai->namaGelar; ?></td>        
        <td><?php echo $row->Pegawai->unitKerja; ?></td>        
        <td><?php echo $row->Pegawai->golongan; ?></td>        
        <td><?php echo $row->Pegawai->jabatan; ?></td>        
        </tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
