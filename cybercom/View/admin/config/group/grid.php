<?php $groups = $this->getConfigGroups()->getData(); ?>
<?php //print_r($group); ?>
<table class="table table-bordered table-sm">
	<tr>
		<th>GroupId</th>
		<th>Name</th>
		<th>Actions</th>
	</tr>
	<?php if(!$groups): ?>
		<tr>
			<td colspan="1"><center><strong>No records Found</strong></center></td>
		</tr>
	<?php else: ?>
		<?php foreach($groups as $key => $value): ?>
			<tr>
				<td><?php echo $value->groupId; ?></td>
				<td><?php echo $value->name; ?></td>
				<td>
                    <button class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->groupId])?>').resetParams().load()">Delete</button> 
               
                   <button class="btn btn-info" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form',null,['id'=>$value->groupId])?>').resetParams().load()">Update</button>
				</td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
</table>

<div>
    <button type="button" href="javascript:void(0)" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form','Admin\Config\Group')?>').resetParams().load();" class="btn btn-success">Add Group</button>
</div>