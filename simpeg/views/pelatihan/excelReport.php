<h2>LAPORAN MASTER PELATIHAN KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">
    <tr>        
        <th width="80px">PELATIHAN</th>                                          
    </tr>
    <?php foreach($model as $row): ?>
    <tr>
        <td><?php echo $row->nama; ?></td>                 
        </tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
