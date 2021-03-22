<?php
$customerGroup = $this->getPrice()->data;
?>
<form method="post" action="<?php echo $this->getUrl()->getUrl('save','Admin\Product\GroupPrice'); ?>" id="customerGroup">	
	<div style="padding: 10px;"> 
		<button type="button" class="btn btn-success" onclick="object.setForm('#customerGroup').load()">Update</button>		
	</div>
		<table border="1" class="table">
			<tr>
				<td>Group Id</td>
				<td>Group Name</td>
				<td>price</td>
				<td>Group Price</td>
			</tr>
				
				<?php if(!$customerGroup): ?>
					<tr>
						<td colspan="4"><center>No record found</center></td>
					</tr>
				<?php else : ?>
					<?php foreach ($customerGroup as $key => $value):?>
					<?php $rowStatus = ($value->entityId)?'exist':'new'?> 
							<tr>
								<td><?php echo $value->customerGroupId ?></td>
								<td><?php echo $value->name ?></td>
								<td><?php echo $value->price ?></td>
								<td>
									<input type="text" name="productGroupPrice[<?php echo $rowStatus; ?>][<?php echo $value->customerGroupId ?>]" value="<?php echo $value->groupPrice ?>">
								</td>
							</tr>	
					<?php endforeach; ?>
				<?php endif; ?>
		</table>
</form>
