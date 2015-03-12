<?php if ($model !== null):?>
<table border="1">

	<tr>
		<th width="80px">
		      id		</th>
 		<th width="80px">
		      ticket_category_id		</th>
 		<th width="80px">
		      subject		</th>
 		<th width="80px">
		      status		</th>
 		<th width="80px">
		      created		</th>
 		<th width="80px">
		      created_user_name		</th>
 		<th width="80px">
		      modified		</th>
 	</tr>
	<?php foreach($model as $row): ?>
	<tr>
        		<td>
			<?php echo $row->id; ?>
		</td>
       		<td>
			<?php echo $row->ticket_category_id; ?>
		</td>
       		<td>
			<?php echo $row->subject; ?>
		</td>
       		<td>
			<?php echo $row->status; ?>
		</td>
       		<td>
			<?php echo $row->created; ?>
		</td>
       		<td>
			<?php echo $row->created_user_name; ?>
		</td>
       		<td>
			<?php echo $row->modified; ?>
		</td>
       	</tr>
     <?php endforeach; ?>
</table>
<?php endif; ?>
