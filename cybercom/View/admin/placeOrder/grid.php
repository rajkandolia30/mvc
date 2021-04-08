<?php $order = $this->getData()->getData(); ?>
<table class="table">
	<tr>
		<th>Order Id</th>
		<th>Customer Id</th>
		<th>Name</th>
		<th>Email</th>
		<th>Contact no.</th>
		<th>Payment Method</th>
		<th>Shipping Method</th>
		<th>Total Amount</th>
		<th>Address</th>
	</tr>

	<?php if(!$order): ?>
		<tr>
			<td colspan="8"><center><strong>No order Placed</strong></center></td>
		</tr>
	<?php else: ?>
		<?php foreach($order as $key => $value): ?>
		<tr>
			<td><?php echo $value->orderId ?></td>
			<td><?php echo $value->customerId ?></td>
			<td><?php echo $value->firstName.' '.$value->lastName; ?></td>
			<td><?php echo $value->email; ?></td>
			<td><?php echo $value->mobile; ?></td>
			<td><?php echo $value->PaymentName; ?></td>
			<td><?php echo $value->ShippingName; ?></td>
			<td><?php echo $value->total; ?></td>
			<td><?php echo $value->address.','.$value->state.','.$value->country.', Pincode-'.$value->zipcode; ?></td>
		<?php endforeach; ?>
		</tr>
	<?php endif; ?>
</table>