<?php $customer = $this->getCustomer(); ?>
<?php $placeOrder = $this->getPlaceOrder()->getData(); ?>
<?php $placeOrderAddress = $this->getPlaceOrderAddress()->getData();?>
<strong><?php echo $customer->firstName;?></strong>
<table class="table">
	<?php if($customer): ?>
		<tr>
			<td>Customer Name:</td>
			<td><?php echo $customer->firstName;?></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo $customer->lastName;?></td>
		</tr>	
		<tr>
			<td>Email:</td>
			<td><?php echo $customer->email;?></td>
		</tr>
		<tr>
			<td>Contact:</td>
			<td><?php echo $customer->mobile;?></td>
		</tr>
	<?php endif; ?>

	<?php if($placeOrder): ?>
		<?php foreach($placeOrder as $key => $value): ?>
			<tr>
				<td>Order Id:</td>
				<td><?php echo $value->orderId; ?></td>
			</tr>
			<tr>
				<td>Total Amount to be paid:</td>
				<td><?php echo $value->total ?></td>
			</tr>
			<tr>
				<td>Discount</td>
				<td><?php echo $value->discount; ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if($placeOrderAddress): ?>
		<?php foreach($placeOrderAddress as $key => $value): ?>
			<tr>
				<td>Address</td>
				<td><?php echo '<pre>';
				print_r($value); ?></td>
			</tr>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php die(); ?>
</table> 



