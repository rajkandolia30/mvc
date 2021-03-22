<?php 
$customer = $this->getCustomer();
$arrayOfStatus = $this->getStatusOption();
$customerGroup = $this->getCustomerGroups();
$data = $customerGroup->data;
?>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Customer') ?>" method="POST" id="customerForm">
    <table>
       
<tr>
    <th colspan="2">
        <?php if($customer->customerId){?>
            Update Customer
        <?php } else { ?>
            Add Customer
        <?php } ?>
    </th>
</tr>

<tr>
    <td>Group</td>
    <td><select  name="customer[groupId]">
        <option value=""></option>
        <?php foreach ($data as $key => $value) :?>
            <option value ="<?php echo $value->name?>"><?php echo $value->name?></option>
        <?php endforeach; ?>
        </select></td>
</tr>

<tr>
    <td>First Name</td>
    <td><input type="text" name="customer[firstName]" value="<?php echo $customer->firstName;?>"></td>
</tr>

<tr>
    <td>Last Name</td>
    <td><input type="text" name="customer[lastName]" value="<?php echo $customer->lastName;?>"></td>
</tr>

<tr>
    <td>Email</td>
    <td><input type="email" name="customer[email]" value="<?php echo $customer->email;?>"></td>
</tr>

<tr>
    <td>Password</td>
    <td><input type="password" name="customer[password]" value="<?php echo $customer->password;?>"></td>
</tr>

<tr>
    <td>Mobile</td>
    <td><input type="number" name="customer[mobile]" value="<?php echo $customer->mobile;?>"></td>
</tr>

<tr>
    <td>Status</td>
    <td>      <?php foreach ($arrayOfStatus as $key => $value) { ?>
                <input type="radio" name="customer[status]" value="<?php echo $key; ?>" 
                    <?php if($customer->customerId && $customer->status == $key) { echo 'checked';} ?> required="">
                    <?php echo $value; ?>
                    <?php } ?></td>    
</tr>

<tr>
    <td>
        <button type="button" class="btn btn-success" onclick="object.setForm('#customerForm').load()">
            <?php if($customer->customerId){ ?>
                Update
            <?php } else { ?>
                Add
            <?php } ?>
        </button>                                
    </td>
</tr>
    </table>
</form>