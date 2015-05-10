<h2>LAPORAN MASTER USER KABUPATEN SAMPANG</h2>
<h4>Tanggal : <?php echo date('d F Y');?></h4>
<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">		      NAMA		</th>
 		<th width="80px">		      USERNAME		</th>
 		<th width="80px">		      EMAIL		</th> 		
 		<th width="80px">		      JENIS KELAMIN		</th>
 		<th width="80px">		      TANGGAL LAHIR		</th>
 		<th width="80px">		      GROUP		</th> 		
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
       		<td>			<?php echo $row->name; ?>		</td>
       		<td>			<?php echo $row->username; ?>		</td>
       		<td>			<?php echo $row->email; ?>		</td>
       		<td>			<?php echo $row->jenisKelamin; ?>		</td>
       		<td>			<?php echo $row->birth; ?>		</td>
       		<td>			<?php echo $row->Roles->name; ?>		</td>
       		
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
