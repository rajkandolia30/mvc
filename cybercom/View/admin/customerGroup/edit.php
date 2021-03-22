<?php 
$customerGroup = $this->getCustomerGroup();
$arrayOfStatus = $this->getStatusOption();
?>
<div>
    <h2>Customer Groups<h2>
    <hr>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\CustomerGroup') ?>" method="POST" id="customerGroupForm">
    <table>
		<tr>
		    <th colspan="2">
		        <?php if($customerGroup->customerGroupId){?>
		            Update 
		        <?php } else { ?>
		            Add
		        <?php } ?>
		    </th>
		</tr>

		<tr>
		    <td>Name</td>
		    <td><input type="text" name="customerGroup[name]" value="<?php echo $customerGroup->name;?>"></td>
		</tr>

		<tr>
		        <td>Status</td>
		        <td>      
		            <?php foreach ($arrayOfStatus as $key => $value) { ?>
		                <input type="radio" name="customerGroup[status]" value="<?php echo $key; ?>" 
		                    <?php if($customerGroup->customerGroupId && $customerGroup->status == $key) { echo 'checked';} ?> required="">
		                    <?php echo $value; ?>
		                    <?php } ?>
		        </td>    
		</tr>

		<tr>
		    <td>
		        <button class="btn btn-success" type="button" onclick="object.setForm('#customerGroupForm').load()"> 
		            <?php if($customerGroup->customerGroupId){ ?>
		                Update
		            <?php } else { ?>
		                Add
		            <?php } ?>
		        </button>                                
		    </td>
		</tr>
    </table>
</form>