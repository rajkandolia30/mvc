<?php 
$attribute = $this->getAttribute();
$input = $this->getInputTypeOption();
$backend = $this->getBackendTypeOption();
?>
<h1>Attribute</h1>
	<form action="<?php echo $this->getUrl()->getUrl('save','attribute'); ?>" method="post" id="attributeForm">
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="attribute[name]" value="<?php echo $this->attribute->name ?>"></td>
			</tr>
			<tr>
				<td>Code</td>
				<td><input type="text" name="attribute[code]" value="<?php echo $this->attribute->code ?>"></td>
			</tr>
			<tr>
				<td>Input Type</td>
				<td>
					<select name="$attribute->[inputType]">
							<?php foreach ($input as $key => $value):?>
								<option value="<?php echo $key; ?>"><?php echo $value ?></option>
							<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Backend Type</td>
				<td>
					<select name="$attribute->[backendType]">
							<?php foreach ($backend as $key => $value):?>
								<option value="<?php echo $key; ?>"><?php echo $value ?></option>
							<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Sort Order</td>
				<td><input type="text" name="attribute[sortOrder]"></td>
			</tr>
			<tr>
				<td>Backend Model</td>
				<td><input type="text" name="attribute[backendModel]"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="button" class="btn btn-success" onclick="object.setForm('#attributeForm').load()">Save</button></td>
			</tr>
		</table>		
	</form>