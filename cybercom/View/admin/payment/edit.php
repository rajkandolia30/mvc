<?php 
$payment = $this->getPayment();
$arrayOfStatus = $this->getStatusOption();
?>
<div>
    <h2>Payments<h2>
    <hr>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Payment') ?>" method="POST" id="paymentForm">
    <table>
		<tr>
		    <th colspan="2"><?php if($payment->methodId){?>
		                    Update payment
		                    <?php } else { ?>
		                    Add payment
		                    <?php } ?>
		    </th>
		</tr>

		<tr>
		    <td>Name</td>
		    <td><input type="text" name="payment[name]" value="<?php echo $payment->name;?>"></td>
		</tr>

		<tr>
		    <td>Code</td>
		    <td><input type="number" name="payment[code]" value="<?php echo $payment->code;?>"></td>
		</tr>

		<tr>
		    <td>Description</td>
		    <td><textarea rows="5" cols="10" name="payment[description]"><?php echo $payment->description;?></textarea></td>
		</tr>

		<tr>
		    <td>Status</td>
		    <td>      
		        <?php foreach ($arrayOfStatus as $key => $value) { ?>
		            <input type="radio" name="payment[status]" value="<?php echo $key; ?>" 
		                <?php if($payment->methodId && $payment->status == $key) { echo 'checked';} ?> required="">
		                <?php echo $value; ?>
		                <?php } ?>
		    </td>        
		</tr>

		<tr>
		    <td>
		        <button type="button" class="btn btn-success" onclick="object.setForm('#paymentForm').load()">
		            <?php if($payment->methodId){ ?>
		                Update
		            <?php } else { ?>
		                Add
		            <?php } ?>
		        </button>
		    </td>
		</tr>
    </table>
</form>