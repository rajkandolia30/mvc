<?php 
$shipping = $this->getShipping();
$arrayOfStatus = $this->getStatusOption();?>
<div>
    <h2>Shipping<h2>
    <hr>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Shipping') ?>" method="POST" id="shippingForm">
    <table>
		<tr>
		    <th colspan="2">
		        <?php if($shipping->methodId){?>
		            Update Shipping
		        <?php } else { ?>
		            Add Shipping
		        <?php } ?>
		    </th>
		</tr>

		<tr>                                                                
		    <td>Name</td>               
		    <td><input type="text" name="shipping[name]" value="<?php echo $shipping->name;?>"></td>
		</tr>

		<tr>
		    <td>code</td>
		    <td><input type="number" name="shipping[code]" value="<?php echo $shipping->code;?>"></td>
		</tr>

		<tr>
		    <td>Amount</td>
		    <td><input type="number" name="shipping[amount]" value="<?php echo $shipping->amount;?>"></td>
		</tr>

		<tr>
		    <td>Description</td>
		    <td><textarea rows="5" cols="10" name="shipping[description]"><?php echo $shipping->description;?></textarea></td>
		</tr>

		<tr>
		    <td>Status</td>
		    <td>      
		        <?php foreach ($arrayOfStatus as $key => $value) { ?>
		            <input type="radio" name="shipping[status]" value="<?php echo $key; ?>" 
		            <?php if($shipping->methodId && $shipping->status == $key) { echo 'checked';} ?> required="">
		            <?php echo $value; ?>
		            <?php } ?>
		    </td>
		</tr>

		<tr>
		    <td>
		        <button type="button" class="btn btn-success" onclick="object.setForm('#shippingForm').load();">
		            <?php if($shipping->methodId){ ?>
		                Update
		            <?php } else { ?>
		                Add
		            <?php } ?>
		        </button>                                
		    </td>
		</tr>
    </table>
</form>