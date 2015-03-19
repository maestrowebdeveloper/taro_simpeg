<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      created_user_id		</th>
 		<th width="80px">
		      receiver_user_ids		</th>
 		<th width="80px">
		      last_date		</th>
 		<th width="80px">
		      last_message		</th>
 		<th width="80px">
		      count_messages		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->created_user_id; ?>
		</td>
       		<td>
			<?php echo $row->receiver_user_ids; ?>
		</td>
       		<td>
			<?php echo $row->last_date; ?>
		</td>
       		<td>
			<?php echo $row->last_message; ?>
		</td>
       		<td>
			<?php echo $row->count_messages; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
