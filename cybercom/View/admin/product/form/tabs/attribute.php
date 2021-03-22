<?php 
$attribute = $this->getAttribute();
$options = $this->getOptions();
?>
<form> 
    <table>
       <?php if(!$attribute):?>
       		<tr>
       			<td> no records</td>
       		</tr>
       	<?php else: ?>
       	
        <tr>

	        <?php foreach($attribute->data as $key => $attibute): ?>
       				<td><?php echo $attribute->Name; ?></td>
            
            <?php if($attribute->inputType == 'textarea'): ?>
                <td><textarea></textarea></td>
            <?php endif; ?>

            <?php if($attribute->inputType == 'text'): ?>
                <td><input type="<?php echo $attribute->inputType; ?>" placeholder="<?php echo $attribute->inputType; ?>" value="<?php echo $option->name; ?>">
                </td>
            <?php endif; ?>

            <?php if($attribute->inputType == 'select'): ?>
              <td><select>
                    <?php if($options): ?>
                        <option>no options</option>
                    <?php else: ?>
                      <option value="<?php echo $option->name ?>"><?php echo $option->name; ?></option>
                        </select></td>
                    <?php endif; ?>

            <?php if($attibute->inputType == 'checkbox'): ?>
                <?php if(!$options): ?>
                    <td>no options</td>
                <?php else: ?>
                    <?php foreach($options->data as $key =>$option): ?>
                        <?php foreach($option->data as $option): ?>
                            <td><input type="<?php echo $attribute->inputType ?>" value="<?php $attribute->inputType; ?>"></td>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif ;?>
            <?php endif; ?>
            
       		<?php endforeach; ?>
       	</tr>

        <?php endif; ?>
    </table>
</form>
