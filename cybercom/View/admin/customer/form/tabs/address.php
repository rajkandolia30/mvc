<?php
$customerAddress = $this->getCustomerAddress();

$customerBilling = $customerAddress->data[0];
$customerShipping = $customerAddress->data[1];

?>
<form method="post" action="<?php echo $this->getUrl()->getUrl('saveAddress','Admin\Customer') ?>" id="addressForm">
	<table class="table">
		<tr>
			<th colspan="2">
				Billing address
			</th>
		</tr>

		<tr>
			<td>Address</td>
			<td><input type="text" name="customerBilling[0][address]" value="<?php echo $customerBilling->address;?>"></td>
		</tr>

		<tr>
			<td>City</td>
			<td><input type="text" name="customerBilling[0][city]" value="<?php echo $customerBilling->city;?>"></td>
		</tr>

		<tr>
			<td>State</td>
			<td><input type="text" name="customerBilling[0][state]" value="<?php echo $customerBilling->state;?>"></td>
		</tr>

		<tr>
			<td>Zipcode</td>
			<td><input type="number" name="customerBilling[0][zipcode]" value="<?php echo $customerBilling->zipcode;?>"></td>
		</tr>

		<tr>
			<td>Country</td>
			<td><input type="text" name="customerBilling[0][country]" value="<?php echo $customerBilling->country;?>"></td>
		</tr>

	</table>

	<table class="table">
		<tr>
			<th colspan="2">
				Shipping address
			</th>
		</tr>

		<tr>
			<td>Address</td>
			<td><input type="text" name="customerShipping[1][address]" value="<?php echo $customerShipping->address;?>"></td>
		</tr>

		<tr>
			<td>City</td>
			<td><input type="text" name="customerShipping[1][city]" value="<?php echo $customerShipping->city;?>"></td>
		</tr>

		<tr>
			<td>State</td>
			<td><input type="text" name="customerShipping[1][state]" value="<?php echo $customerShipping->state;?>"></td>
		</tr>

		<tr>
			<td>Zipcode</td>
			<td><input type="number" name="customerShipping[1][zipcode]" value="<?php echo $customerShipping->zipcode;?>"></td>
		</tr>

		<tr>
			<td>Country</td>
			<td><input type="text" name="customerShipping[1][country]" value="<?php echo $customerShipping->country;?>"></td>
		</tr>

		<tr>
			<td colspan="2"><button type="button" class="btn btn-success" onclick="object.setForm('#addressForm').load()">ADD</button></td>
		</tr>
	</table>
</form>
