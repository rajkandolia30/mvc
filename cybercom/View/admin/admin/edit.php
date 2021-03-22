<?php  
$admin = $this->getAdmin();
$arrayOfStatus = $this->getStatusOption();
?>
<div>
   	<h2>Admins<h2>
    	<hr>
    </div>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\admin') ?>" method="post" id="adminForm">
	<table>
		<tr>
    		<th colspan="2">
        		<?php if($admin->adminId){?>
            		Update Admin
        		<?php } else { ?>
            		Add Admins
        		<?php } ?>
    		</th>
		</tr>

		<tr>
			<td>Name</td>
			<td><input type="text" name="admin[userName]" value="<?php echo $admin->userName;?>"></td>
		</tr>

		<tr>
			<td>Password</td>
			<td><input type="password" name="admin[password]" value="<?php echo $admin->password;?>"></td>
		</tr>

		<tr>
		    <td>Status</td>
		    <td>
		        <?php foreach ($arrayOfStatus as $key => $value) { ?>
		            <input type="radio" name="admin[status]" value="<?php echo $key; ?>" 
		                <?php if($admin->adminId && $admin->status == $key) { echo 'checked';} ?> required="">
		            <?php echo $value; ?>
		        <?php } ?>
		    </td>
		</tr>
		
		<tr>
			<td>
			    <button class="btn btn-success" type="button" onclick="object.setForm('#adminForm').load();">
					<?php if($admin->adminId){?>
		                Update 
		            <?php } else { ?>
		                Add 
		            <?php } ?>	            	
	            </button>
			</td>
		</tr>
	</table>
</form>