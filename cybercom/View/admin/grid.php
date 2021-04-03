<?php
$collections = $this->getCollection();
$collection = $collections->data;
$columns = $this->getColumns();
$actions = $this->getAction();
$button = $this->getButton();
$title = $this->getTitle();
//$filter = $this->prepareFilter();
?>
<div>
    <h2><?php echo $title; ?></h2>
    <hr>
</div>
<form action="<?php echo $this->getUrl()->getUrl('filter'); ?>" id="gridForm" method="POST">
    <table class="table table-bordered table-sm">
        <tr>
            <?php if($columns): ?>
                <?php foreach($columns as $key => $column): ?>
                    <th>
                        <?php echo $column['field']; ?>
                    </th>
                <?php endforeach; ?>
            <?php endif; ?>
            <th colspan="2">Actions</th>
        </tr>

        <tr>
            <?php if($columns): ?>
                <?php foreach($columns as $key => $column): ?>
                    <td>
                        <input type="text" name="filter[<?php echo $column['type'];?>][<?php echo $column['field'] ?>]" value="<?php //echo $this->getFilter()->getFilterValue($column['type'],$column['field']); ?>">
                    </td>
                <?php endforeach; ?>
            <?php endif; ?>
        </tr>

        <?php if($collection): ?>
            <?php foreach ($collection as $key => $row):?>
                    <tr>
                        <?php foreach ($columns as $key => $column): ?>
                            <td>
                                <?php echo $this->getFieldValue($row, $column['field']); ?>
                            </td>
                        <?php endforeach; ?>

                        <td> 
                            <?php if($actions): ?>
                                <?php foreach($actions as $key => $action): ?>
                                    <button type="button" class="btn btn-light" onclick="<?php  echo $this->getMethodUrl($row, $action['method']);?> ">
                                        <?php echo $action['label']; ?>
                                    </button>
                                <?php endforeach; ;?>
                            <?php endif; ?>
                        </td>

                    </tr>            
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</form>
<div>
    <?php if($button): ?>
        <?php foreach ($button as $key => $button): ?>
            <button href="javascript:void(0)" onclick="<?php echo $this->getButtonUrl($button['method']); ?>" type="button" class="btn btn-success"><?php echo $button['label'] ?></button>
        <?php endforeach; ?>    
    <?php endif; ?>
</div>