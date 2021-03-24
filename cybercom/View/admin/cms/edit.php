<?php 
$cms = $this->getCms();
$arrayOfStatus = $this->getStatusOption();
?>
<div>
    <h2>Cms<h2>
    <hr>
</div>

<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Cms');?>" method="POST" id="cmsForm">
    <table>
        <tr>
            <th colspan="2">
                <?php if($cms->pageId){?>
                    Update
                <?php } else { ?>
                    Add
                <?php } ?>
            </th>
        </tr>

        <tr>
            <td>Title</td>
            <td><input type="text" name="cms[title]" value="<?php echo $cms->title;?>"></td>
        </tr>

        <tr>
            <td>Content</td>
            <td><textarea name="cms[content]" id="cms"><?php echo $cms->content;?></textarea>
                <script>
                    CKEDITOR.replace('cms[content]');
                </script>
            </td>
        </tr>

        <tr>
            <td>Status</td>
            <td>      
                <?php foreach ($arrayOfStatus as $key => $value) { ?>
                    <input type="radio" name="cms[status]" value="<?php echo $key; ?>" 
                        <?php if($cms->pageId && $cms->status == $key) { echo 'checked';} ?> required="">
                            <?php echo $value; ?>
                <?php } ?></td>
        </tr>

        <tr>
            <td>
                <button class="btn btn-success" type="button" onclick="object.setForm('#cmsForm').load()">
                    <?php if($cms->pageId){ ?>
                        Update
                    <?php } else { ?>
                        Add
                    <?php } ?>
                </button>
            </td>
        </tr>
    </table>
</form>