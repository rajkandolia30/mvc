<?php $configs = $this->getConfigGroup();?>
<?php $configs = $configs->getConfig()->getData(); ?>
<form action="" method="post" id='configForm'>
	<table id="existing" class="table">
		<tr>
			<td>
				<button type="button" onclick="object.setForm('#configForm').setUrl('<?php echo $this->getUrl()->getUrl('save','Admin\Config'); ?>').load()">Update</button>
				<button type="button" onclick="addRow();">Add Option</button>
			</td>
		</tr>

		<?php foreach($configs as $key => $config):?>
			<tr>
				<td><input type="text" name="exist[<?php echo $config->configId; ?>][title]" value="<?php echo $config->title;?>"></td>
				<td><input type="text" name="exist[<?php echo $config->configId; ?>][code]" value="<?php echo $config->code; ?>"></td>
				<td><input type="text" name="exist[<?php echo $config->configId; ?>][value]" value="<?php echo $config->value; ?>"></td>
				<td><button type="button" name="exist[<?php echo $config->configId; ?>][remove]" onclick="removeRow(this);" >Remove</button></td>
			</tr>
		<?php endforeach; ?>
	</table>	
</form>

<div style="display:none">
	<table id="new">
		<tr>
			<td><input type="text" name="new[title][]" placeholder="title"></td>
			<td><input type="text" name="new[code][]" placeholder="code"></td>
			<td><input type="text" name="new[value][]" placeholder="value"></td>
			<td><button type="button" onclick="removeRow(this);">Remove</button></td>
		</tr>
	</table>
</div>

<script type="text/javascript">
	function addRow(){
		var newOptionTable = document.getElementById('new');
		var existingOptionTable = document.getElementById('existing').children[0];
		existingOptionTable.prepend(newOptionTable.children[0].cloneNode(true));
	}

	function removeRow(button){
		var objectTableRow = button.parentElement.parentElement;
		objectTableRow.remove();
	}
</script>
