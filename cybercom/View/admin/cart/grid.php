<?php $cart = $this->getCart(); ?>
<?php $cartItem = $cart->getItems()->data;?>
<?php $customers = $this->getCustomer()->getData(); ?>

<form action="<?php echo $this->getUrl()->getUrl('update','Admin\Cart') ?>" method="post" id="cartForm">
	<!-- select customer -->
	<div style="padding:10px;">
		Customer:
		<select name="customer">
			<?php if($customers): ?>
				<option>SELECT CUSTOMER</option>
				<?php foreach($customers as $key => $customer): ?>
					<option value="<?php echo $customer->customerId; ?>" <?php if($customer->customerId && $cart->cartId){echo "selected";} ?>><?php echo $customer->firstName; ?></option>
				<?php endforeach; ?>
			<?php endif; ?>
		</select>
		<!-- <button type="button" class="btn btn-primary" onclick="object.setUrl('<?php //echo $this->getUrl()->getUrl('selectCustomer','Admin\Cart'); ?>').resetParams().setForm('#cartForm').load()">Go</button> -->
		<button type="button" class="btn btn-primary" onclick="selectCustomer();">GO</button>
	</div>

	<!-- Buttons -->
	<div style="padding:10px;">
		<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Product') ?>').resetParams().load()" class="btn btn-dark">Back to Items</button>
		<button type="button" onclick="object.setForm('#cartForm').load()" class="btn btn-success">Update</button>
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
				<td colspan="7"><center>No items Available</center></td>
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
					<td><?php echo ($value->price * $value->quantity - $value->discount * $value->quantity);  ?></td>
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
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>City</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>State</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>Zipcode</td>
					<td><input type="number"></td>
				</tr>

				<tr>
					<td>Country</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td><input type="checkbox" name="saveInAddressBook">Save in address book</td>
					<td><button type="button" class="btn btn-success">Save</button></td>
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
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>City</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>State</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td>Zipcode</td>
					<td><input type="number"></td>
				</tr>

				<tr>
					<td>Country</td>
					<td><input type="text"></td>
				</tr>

				<tr>
					<td><input type="checkbox">Same as billing<br>
						<input type="checkbox" name="saveInAddressBook">Save in address book
					</td>
					<td><button type="button" class="btn btn-success">Save</button></td>
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

				<tr>
					<td>
						CREDIT CARD<input type="radio" name="paymentMethod" value="creditCard"><br>		
						DEBIT CARD<input type="radio" name="paymentMethod" value="debitCard"><br>		
						PAYPAL<input type="radio" name="paymentMethod" value="paypal"><br>				
						COD<input type="radio" name="paymentMethod" value="cod"><br>
					</td>
				</tr>
						
				<tr>
					<td colspan="2"><button type="button" class="btn btn-success">Save</button></td>
				</tr>
			</table>
		</div>
		
		<div class="col-xs-6">
			<table class="table table-bordered">
				<tr>
					<th colspan="2">Shipping Method</th>
				</tr>
				
				<tr>
					<td>
						EXPRESS DELIVERY 1 DAY<input type="radio" name="shippingMethod" value="creditCard"><br>		
						PLATINUM DELIVERY 3 DAY<input type="radio" name="shippingMethod" value="debitCard"><br>		
						FREE DELIVERY 7 DAY<input type="radio" name="shippingMethod" value="paypal"><br><br>
					</td>
				</tr>

				<tr>
					<td colspan="2"><button type="button" class="btn btn-success">Save</button></td>
				</tr>
			</table>
		</div>
	</div>

	<!-- final billing -->
	<div style="margin-left: 800px">
			<table class="table">
				<tr><td>BASE TOTAL</td><td></td></tr>
				<tr><td>SHIPPING CHARGES</td><td></td></tr>
				<tr><td>COUPON</td></tr><td></td><br>
				<tr><td><strong>GRAND TOTAL</strong></td><td></td></tr>
			</table>
	</div>
</form>

<script type="text/javascript">
	function selectCustomer(){
		var form = document.getElementById('cartForm');
		form.setAttribute('Action', '<?php echo $this->getUrl()->getUrl('selectCustomer','Admin\Cart'); ?>')
		form.submit();
	}
</script>