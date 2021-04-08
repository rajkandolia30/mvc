<?php $group = $this->getConfigGroup(); ?>
<div>
    <h2>Groups<h2>
        <hr>
    </div>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Config\Group') ?>" method="post" id="configGroupForm">
    <table>
        <tr>
            <th colspan="2">
                <?php if($group->groupId):?>
                    Update
                <?php  else : ?>
                    Add 
                <?php endif; ?>
            </th>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type="text" name="group[name]" value="<?php echo $group->name;?>"></td>
        </tr>   
        
        <tr>
            <td>
                <button class="btn btn-success" type="button" onclick="object.setForm('#configGroupForm').load();">
                    <?php if($group->groupId){?>
                        Update 
                    <?php } else { ?>
                        Add 
                    <?php } ?>                  
                </button>
            </td>
        </tr>
    </table>
</form>