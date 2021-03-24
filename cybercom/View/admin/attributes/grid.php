<?php $attributes = $this->getAttributes();
// print_r($attributes);
?>
<h1>Attribute</h1>
<div style="padding: 10px">
	<button type="button" class="btn btn-success" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form') ?>').resetParams().load()">ADD</button>
</div>
	<table class="table">
		<tr>
			<td>Attribute Id</td>
			<td>Entity Id</td>
			<td>Name</td>
			<td>Code</td>
			<td>Input Type</td>
			<td>Backend Type</td>
			<td>Sort Order</td>
			<td>Backend Model</td>
			<td colspan="2">Actions</td>
		</tr>
		<?php if(!$attributes->data): ?>
			<tr>
				<td colspan="9">No Record Found</td>
			</tr>
		<?php else: ?>
			<?php foreach($attributes->data as $key => $attribute): ?>
				<tr>
					<td><?php echo $attribute->attributeId ?></td>
					<td><?php echo $attribute->entityTypeId ?></td>
					<td><?php echo $attribute->name ?></td>
					<td><?php echo $attribute->code ?></td>
					<td><?php echo $attribute->inputType ?></td>
					<td><?php echo $attribute->backendType ?></td>
					<td><?php echo $attribute->sortOrder ?></td>
					<td><?php echo $attribute->backendModel ?></td>
					<td>
						<button type="button" class="btn btn-light" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Attribute\Option',['id'=>$attribute->attributeId]); ?>').resetParams().load()">Show Option</button>
					</td>
					<td>
						<button type="button" class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$attribute->attributeId]); ?>').resetParams().load()">delete</button>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>