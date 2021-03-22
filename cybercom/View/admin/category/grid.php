<?php
$categories = $this->getCategories();
$data = $categories->data;
?>
<div>
    <h2>Category</h2>
    <hr>
</div>

<div>
<table class="table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Parent Id</th>
        <th>Path</th>
        <th>Status</th>
        <th>Description</th>
        <th colspan="2">Actions</th>
    </tr>

        <?php foreach ($data as $key => $value):?>
            <tr>
                <td><?php echo $value->categoryId ?></td>
                <td><?php echo $this->getName($value); ?></td>
                <th><?php echo $value->parentId ?></th>
                <th><?php echo $value->pathId;?></th>
                <td><?php echo $value->status ?></td>
                <td><?php echo $value->description ?></td>
                <td>
                    <button class="btn btn-danger" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('delete',null,['id'=>$value->categoryId])?>').resetParams().load()">Delete</button> 
                </td>
                <td>
                   <button class="btn btn-info" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form',null,['id'=>$value->categoryId])?>').resetParams().load()">Update</button>
                </td>
            </tr> 
        <?php endforeach; ?>
</table>
</div>

<div>
    <button type="button" href="javascript:void(0)" onclick="object.setUrl('<?php echo $this->getUrl()->getUrl('form','Admin\Category')?>').resetParams().load();" class="btn btn-success">Add category</button>
</div>
