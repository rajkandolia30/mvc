<?php  
$attribute = $this->getAttributeOption()->data;
?>
<form action="<?php echo $this->getUrl()->getUrl('save'); ?>" method="post" id='optionForm'>
	<table id="existingOption">
		<tr>
			<td>
				<button type="button" onclick="object.setForm('#optionForm').load()">Update</button>
				<button type="button" onclick="addRow();">Add Option</button>
			</td>
		</tr>

		<?php foreach($attribute as $key => $option):?>
			<tr>
				<td><input type="text" name="exist[<?php echo $option->optionId; ?>][name]" value="<?php echo $option->name; ?>" ></td>
				<td><input type="text" name="exist[<?php echo $option->optionId; ?>][sortOrder]" value="<?php echo $option->sortOrder; ?>"></td>
				<td><input type="text" name="exist[<?php echo $option->optionId; ?>][remove]" onclick="removeRow(this);" value="Remove Option"></td>
			</tr>
		<?php endforeach; ?>
	</table>	
</form>

<div style="display:none">
	<table id="newOption">
		<tr>
			<td><input type="text" name="new[name][]"></td>
			<td><input type="text" name="new[sortOrder][]"></td>
			<td><button type="button" onclick="removeRow(this);">Remove Option</button></td>
		</tr>
	</table>
</div>

<script type="text/javascript">
	function addRow(){
		var newOptionTable = document.getElementById('newOption');
		var existingOptionTable = document.getElementById('existingOption').children[0];
		existingOptionTable.prepend(newOptionTable.children[0].cloneNode(true));
	}

	function removeRow(button){
		var objectTableRow = button.parentElement.parentElement;
		objectTableRow.remove();
	}
</script>