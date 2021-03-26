<?php 
$cartItem = $this->getCart();
print_r($cartItem);
?>

<div style="padding:10px;">
<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('grid','Admin\Product') ?>').resetParams().load()" class="btn btn-light">Back to Items</button>
<button type="button" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('update','Admin\Cart') ?>').resetParams().load()" class="btn btn-success">Update</button>
</div>

<div style="padding:10px;">
<table class="table">
	<tr>
		<th>Cart Id</th>
		<th>Product Id</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Row Total</th>
		<th>Discount</th>
		<th>Final</th>
		<th>Action</th>
	</tr>
</table>
</div>