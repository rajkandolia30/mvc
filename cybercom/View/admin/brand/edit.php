<?php  
$brand = $this->getBrand();
$arrayOfStatus = $this->getStatusOption();
?>
<div>
   	<h2>Brand<h2>
    	<hr>
    </div>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Brand') ?>" method="post" id="brandForm">
	<table>
		<tr>
    		<th colspan="2">
        		<?php if($brand->brandId){?>
            		Update Admin
        		<?php } else { ?>
            		Add Admins
        		<?php } ?>
    		</th>
		</tr>

		<tr>
			<td>Name</td>
			<td><input type="text" name="brand[name]" value="<?php echo $brand->name;?>"></td>
		</tr>

		<tr>
			<td>Image</td>
			<td><input type="file" name="brand[image]" id="file" value="<?php echo $brand->image ?>"></td>
		</tr>

		<tr>
			<td>Sort Order</td>
			<td><input type="number" name="brand[sortOrder]" value="<?php echo $brand->sortOrder;?>"></td>
		</tr>

		<tr>
		    <td>Status</td>
		    <td>
		        <?php foreach ($arrayOfStatus as $key => $value) { ?>
		            <input type="radio" name="brand[status]" value="<?php echo $key; ?>" 
		                <?php if($brand->brandId && $brand->status == $key) { echo 'checked';} ?> required="">
		            <?php echo $value; ?>
		        <?php } ?>
		    </td>
		</tr>
		
		<tr>
			<td>
			    <button class="btn btn-success" type="button" onclick="object.setForm('#brandForm').load();">
					<?php if($brand->brandId){?>
		                Update 
		            <?php } else { ?>
		                Add 
		            <?php } ?>	            	
	            </button>
			</td>
		</tr>
	</table>
</form>