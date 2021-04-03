<?php $cart = $this->getCart();?>
<?php $cartItem = $cart->getItems()->data;?>
<?php $cartShipping = $cart->getShipping(); ?>
<?php $cartPayment = $cart->getPayment(); ?>
<?php $customers = $this->getCustomer()->getData();?>
<?php $billing = $this->getBillingAddress();?>
<?php $shipping = $this->getShippingAddress();?>
<?php $paymentMethod = $this->getPayment()->getData(); ?>
<?php $shippingMethod = $this->getShipping()->getData(); ?>
<?php $basePrice = $this->getBasePrice(); ?>
<?php $shippingCharge = $this->getShippingCharge(); ?>
<?php 
	if($cart){
		$cartId = $cart->cartId;
	}
	if($shipping){
		$shippingAddressId = $shipping->addressId;
		$shippingCartAddressId = $shipping->cartAddressId;
	}
	if($billing){
		$billingAddressId = $billing->addressId;
		$billingCartAddressId = $billing->cartAddressId; 
	}
	$base = 0;
		foreach ($basePrice as $key => $value) {
			if($value->cartId == $cart->cartId){
				$base+= $value->basePrice;
			}
		}

	foreach ($shippingCharge as $key => $value) {
		if($value->amount == $cart->shippingAmount){
			$finalShippingcharge = $value->amount;
		}
	}
?>
<form action="" method="post" id="cartForm">

	<!-- select customer -->
	<div style="padding:10px;">
		Customer:
		<select name="customer">
			<?php if($customers): ?>
				<option>SELECT CUSTOMER</option>
				<?php foreach($customers as $key => $customer):?>
					<option value="<?php echo $customer->customerId; ?>" <?php if($cart->customerId == $customer->customerId){echo "selected";} ?>><?php echo $customer->firstName; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<button type="button" class="btn btn-primary" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('selectCustomer'); ?>').load()">Go</button>
	</div>
		
	<!-- Buttons -->
	<div style="padding:10px;">
		<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Product') ?>').resetParams().load()" class="btn btn-dark">Back to Items</button>
		<button type="button" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('update','Admin\Cart') ?>').load()" class="btn btn-success">Update</button>
	</div>

	<!-- cart table -->
	<table class="table table-bordered">
		<tr>
			<th>Cart Id</th>
			<th>Product Id</th>
			<th>Quantity</th>
			<th>Price</th>
			<th>Row Total</th>
			<th>Discount</th>
			<th>Final Total</th>
			<th>Action</th>
		</tr>
		<?php if(!$cartItem): ?>
			<tr>
				<td colspan="8"><center>No items Available</center></td>
			</tr>
		<?php else: ?>
			<?php foreach($cartItem as $key => $value):  ?>
				<tr>
					<td><?php echo $value->cartId; ?></td>
					<td><?php echo $value->productId; ?></td>
					<td><input type="number" name="quantity[<?php echo $value->cartItemId; ?>]" value="<?php echo $value->quantity; ?>"></td>
					<td><?php echo $value->price; ?></td>
					<td><?php echo $value->price * $value->quantity ?></td>
					<td><?php echo $value->discount * $value->quantity; ?></td>
					<td><?php echo ($value->price * $value->quantity - $value->discount * $value->quantity);?></td>
					<td><button class="btn btn-danger" type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id' => $value->cartItemId]); ?>').resetParams().load()">Delete</button></td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</table>

	<!-- address table -->
	<div class="row-fluid">
   		<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<th colspan="2">Billing address</th>
				</tr>

				<tr>
					<td>Address</td>
					<td><input type="text" name="billing[address]" <?php if($billing): ?> value="<?php echo $billing->address ?>" <?php endif; ?>></td>
				</tr>

				<tr>
					<td>City</td>
					<td><input type="text" name="billing[city]" <?php if($billing): ?>value="<?php echo $billing->city ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>State</td>
					<td><input type="text" name="billing[state]" <?php if($billing): ?>value="<?php echo $billing->state ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>Zipcode</td>
					<td><input type="number" name="billing[zipcode]" <?php if($billing): ?>value="<?php echo $billing->zipcode ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>Country</td>
					<td><input type="text" name="billing[country]" <?php if($billing): ?>value="<?php echo $billing->country ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td><input type="checkbox" name="billing[saveInAddressBook]">Save in address book</td>
					<td><button type="button" class="btn btn-success" name="billing" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('saveBillingAddress',null,['addressId'=>$billingAddressId, 'cartId'=>$cartId, 'billingCartAddressId'=>$billingCartAddressId]); ?>').load()">Save</button></td>
				</tr>
			</table>
		</div>
		
		<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<th colspan="2">Shipping address</th>
				</tr>

				<tr>
					<td>Address</td>
					<td><input type="text" name="shipping[address]" <?php if($shipping): ?>value="<?php echo $shipping->address ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>City</td>
					<td><input type="text" name="shipping[city]" <?php if($shipping): ?>value="<?php echo $shipping->city ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>State</td>
					<td><input type="text" name="shipping[state]" <?php if($shipping): ?>value="<?php echo $shipping->state ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>Zipcode</td>
					<td><input type="number" name="shipping[zipcode]" <?php if($shipping): ?>value="<?php echo $shipping->zipcode ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td>Country</td>
					<td><input type="text" name="shipping[country]" <?php if($shipping): ?>value="<?php echo $shipping->country ?>"<?php endif; ?>></td>
				</tr>

				<tr>
					<td><input type="checkbox" name="sameAsBilling">Same as billing<br>
						<input type="checkbox" name="shipping[saveInAddressBook]">Save in address book
					</td>
					<td><button type="button" class="btn btn-success" name="shipping" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('saveShippingAddress',null,['addressId'=>$shippingAddressId, 'cartId'=>$cartId, 'shippingCartAddressId'=>$shippingCartAddressId]);?>').load()">Save</button></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- method Table -->
	<div class="row-fluid">
   		<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<th colspan="2">Payment Method</th>
				</tr>

				<?php foreach ($paymentMethod as $key => $value):?>
					<tr>
						<td>
							<?php echo $value->name;?><input type="radio" name="paymentMethod" value="<?php echo $value->methodId;?>" <?php echo $cartPayment->paymentMethodId == $value->methodId? 'checked':'';?>><br>		
						</td>
					</tr>
				<?php endforeach; ?>
						
				<tr>
					<td colspan="2"><button type="button" class="btn btn-success" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('paymentMethod'); ?>').load()">Save</button></td>
				</tr>
			</table>
		</div>
		
		<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<th colspan="2">Shipping Method</th>
				</tr>
				
				<?php foreach ($shippingMethod as $key => $value):?>
					<tr>
						<td>
							<?php echo $value->name;?><input type="radio" name="shippingMethod" value="<?php echo $value->methodId;?>" <?php echo $cartShipping->shippingMethodId == $value->methodId? 'checked':'';?>><br>		
						</td>
						<td>
							<?php echo $value->amount ?>
						</td>
					</tr>
				<?php endforeach; ?>

				<tr>
					<td colspan="2"><button type="button" class="btn btn-success" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('shippingMethod'); ?>').load()">Save</button></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- final billing -->
	<div style="margin-left: 800px">
			<table class="table">
				<tr>
					<td>BASE TOTAL</td>
					<td><input type="number" name="bill[base]" value="<?php echo $base; ?>"></td>
				</tr>

				<tr>
					<td>SHIPPING CHARGES</td>
					<td><input type="number" name="bill[shippingCharge]" value="<?php echo $finalShippingcharge; ?>"></td>
				</tr>

				<tr>
					<td>Final Discount</td>
					<td><input type="number" name="bill[finalDiscount]" value=""></td>
				</tr>

				<tr>
					<td>COUPON</td>
					<td><input type="number" name="bill[coupon]"></td>
				</tr><br>

				<tr>
					<td><strong>GRAND TOTAL</strong></td>
					<td><input type="number" name="bill[grandTotal]" value="<?php echo $base+$finalShippingcharge; ?>"></td>
				</tr>

				<tr>
					<td>
						<button type="button" class="btn btn-success" onclick="object.setForm('#cartForm').setUrl('<?php echo $this->getUrl()->getUrl('saveBill'); ?>').load()">Save</button>
					</td>
				</tr>
			</table>
	</div>
</form>