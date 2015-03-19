<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      user_message_id		</th>
 		<th width="80px">
		      title		</th>
 		<th width="80px">
		      message		</th>
 		<th width="80px">
		      created		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->user_message_id; ?>
		</td>
       		<td>
			<?php echo $row->title; ?>
		</td>
       		<td>
			<?php echo $row->message; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
