 <?php 
$category = $this->getCategory();
$arrayOfStatus = $this->getStatusOption();
$categoryOptions = $this->getCategoryOptions();
?>
<div>
    <h2>Category<h2>
        <hr>
    </div>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save') ?>" method="post" id="categoryForm">
    <table>
        <tr>
            <th colspan="2">
                <?php if($category->categoryId){?>
                    Update Category
                <?php } else { ?>
                    Add Category
                <?php } ?>
            </th>
        </tr>

        <tr>
            <td>Parent</td>
            <td>
                <select  name="category[parentId]">
                    <?php if($categoryOptions): ?>
                    <?php  foreach ($categoryOptions as $categoryId => $name):?>
                        <option value="<?php echo $categoryId;?>" 
                            <?php if($categoryId == $category->parentId): ?> selected <?php endif; ?>>
                            <?php echo  $name; ?></option>
                    <?php endforeach; ?>
                    <?php endif;?>
                </select>
            </td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type="text" name="category[name]" value="<?php echo $category->name;?>"></td>
        </tr>

        <tr>
            <td>Status</td>
            <td>      
                <?php foreach ($arrayOfStatus as $key => $value) { ?>
                    <input type="radio" name="category[status]" value="<?php echo $key; ?>" 
                        <?php if($category->categoryId && $category->status == $key) { echo 'checked';} ?> required="">
                            <?php echo $value; ?>
                        <?php } ?>
            </td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea rows="5" cols="10" name="category[description]"><?php echo $category->description;?></textarea></td>
        </tr>

        <tr>
            <td>
                <button class="btn btn-success" type="button" onclick="object.setForm('#categoryForm').load()">
                    <?php if($category->categoryId){ ?>
                        Update
                    <?php } else { ?>
                        Add
                    <?php } ?>
                </button>                                
            </td>
        </tr>
    </table>
</form>