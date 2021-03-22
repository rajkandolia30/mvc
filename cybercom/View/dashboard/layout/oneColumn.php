<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="<?php echo $this->baseUrl('skin/admin/js/mage.js');?>"></script>
        <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
        <style>
            .size{
               font-size:20px;
            }
            .home{
                margin-left: 800px;
                padding:0px;
            }
            .option{
                text-align: right;
            }
            .align{
                vertical-align: top;
            }            
            .space{
                padding-left:10px;
            }
            .side{
                 width:10px; 
                 height:400px;
            }
            .top{
                text-align:top;
            }
            .hf{
                background-color:#00FFFF;
            }
            .text{
                text-align: top left;
            }
        </style>
    </head>
<table class="table">
    <tr>
        <td class="hf" colspan="2">
            <?php echo $this->getChild('header')->toHtml();?>
        </td>
    </tr>
    
    <tr>
        <td class="hf" colspan="2"><?php echo $this->getChild('menu')->toHtml();?></td>
    </tr>

    <tr class="text" style="height:400px;">       
        <td class="align "> 
            <?php echo $this->getChild('content')->toHtml();?>
        </td>
    </tr>

    <tr>
        <td class="hf" colspan="2">
            <?php echo $this->getChild('footer')->toHtml();?>
        </td>
    </tr> 
</table>
</html>