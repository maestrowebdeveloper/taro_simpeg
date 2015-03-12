<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      nama		</th>
 		<th width="80px">
		      keterangan		</th>
 		<th width="80px">
		      level		</th>
 		<th width="80px">
		      lft		</th>
 		<th width="80px">
		      rgt		</th>
 		<th width="80px">
		      root		</th>
 		<th width="80px">
		      parent_id		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      created_user_id		</th>
 		<th width="80px">
		      modified		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->nama; ?>
		</td>
       		<td>
			<?php echo $row->keterangan; ?>
		</td>
       		<td>
			<?php echo $row->level; ?>
		</td>
       		<td>
			<?php echo $row->lft; ?>
		</td>
       		<td>
			<?php echo $row->rgt; ?>
		</td>
       		<td>
			<?php echo $row->root; ?>
		</td>
       		<td>
			<?php echo $row->parent_id; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
