<h4>REKAPITULASI PEGAWAI NEGERI SIPIL (PNS) KABUPATEN SAMPANG</h4>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php
    $total = 0;
if ($model !== null):?>
<table border="1">
	<tr>		
 		<th width="80px">UNIT KERJA</th>
 		<?php
        foreach ($model as $key => $value) {
            echo '<th width="80px">'.strtoupper($key).'</th>';
        }
        ?>		 		 		 	
        <th width="80px">JUMLAH</th>        
 	</tr>
	<tr>
        <td><?php echo $unit_kerja; ?></td>                  
        <?php foreach($model as $row): ?>
            <td><?php echo $row; $total+=$row;?></td>                      
     <?php endforeach; ?>
      <td><?php echo $total;?></td> 
 </tr>
</table>
<?php endif; ?>
