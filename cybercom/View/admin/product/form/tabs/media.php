<?php 
$images = $this->getimages();
?>

<div>	
<form action="<?php echo $this->getUrl()->getUrl('save','Admin\ProductMedia');?>" method="post" id="imageForm" enctype="multipart/form-data">
	<div style="padding: 10px;">
		
		<button type="button" class="btn btn-success" onclick="object.setForm('#imageForm').setUrl('<?php echo $this->getUrl()->getUrl('update','ProductMedia');?>').load()">Update</button>
		
		<button type="button" class="btn btn-danger" onclick="object.setForm('#imageForm').setUrl('<?php echo $this->getUrl()->getUrl('remove','ProductMedia');?>').load()">Remove</button>
	</div>
	<table border="3" style="width: 1000px;" class="table">
		<tr>
			<td colspan="7">Media</td>
		</tr>
		<tr>
			<td>Image</td>
			<td>Label</td>
			<td>Small</td>
			<td>Thumb</td>
			<td>Base</td>
			<td>Gallery</td>
			<td>Remove</td>
		</tr>
		<?php if(!$images): ?>
			<tr>
				<td colspan="7"><center>No Images available</center></td>
			</tr>
		<?php else: ?>
			<tr>
				<?php foreach ($images as $key => $value):?>
					<td><img width="50px" height="50px" src="<?php echo 'Image/'.$value['image'] ?>"></td>

					<td><input type="text" name="productImage[label][<?php  echo $value['imageId'] ?>]" value="<?php echo $value['label'] ?>"></td>

					<td><input type="radio" name="productImage[small]" value="<?php echo $value['imageId'] ?>" <?php if($value['small'] == 'on'){ echo 'checked';} ?>></td>

					<td><input type="radio" name="productImage[thumb]" value="<?php echo $value['imageId']?>" 
					<?php if($value['thumb'] == 'on'){ echo 'checked';} ?>></td>

					<td><input type="radio" name="productImage[base]" value="<?php echo $value['imageId'] ?>"
					<?php if($value['base'] == 'on'){ echo 'checked';} ?>></td>

					<td><input type="checkbox" name="productImage[gallery][<?php  echo $value['imageId'] ?>]" value="<?php echo $value['imageId']?>" <?php if($value['gallery'] == 'on'){ echo 'checked';} ?>></td>

					<td><input type="checkbox" name="productImage[remove][<?php  echo $value['imageId'] ?>]" value="<?php echo $value['imageId']?>"></td>	
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>

	<div  style="padding: 10px;">
		<input type="file" name="file" id="file">
	</div>
		
	<div style="padding: 10px;">
		<button type="button" class="btn btn-primary" onclick="object.upload()">UPLOAD</button>
	</div>

</form>
</div>
