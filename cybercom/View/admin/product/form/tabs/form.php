<?php 
$product = $this->getProduct();
$arrayOfStatus = $this->getStatusOption();
?>
<form action="<?php echo $this->getUrl()->getUrl('save','Admin\Product');?>" method="post" id="productForm"> 
    <table>
        <tr>
            <th colspan="2">
                <?php if($product->productId){?>
                    Update product
                <?php } else { ?>
                    Add Product
                <?php } ?>
            </th>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type="text" name="product[name]" value="<?php echo $product->name;?>"></td>
        </tr>

        <tr>
                <td>Price</td>
                <td><input type="number" name="product[price]" value="<?php echo $product->price;?>"></td>
        </tr>

        <tr>
                <td>Discount</td>
                <td><input type="number" name="product[discount]" value="<?php echo $product->discount;?>"></td>
        </tr>

        <tr>
            <td>Quantitiy</td>
            <td><input type="number" name="product[quantity]" value="<?php echo $product->quantity;?>"></td>
        </tr>

        <tr>
                <td>Status</td>
                <td>      
                    <?php foreach ($arrayOfStatus as $key => $value) { ?>
        		          <input type="radio" name="product[status]" value="<?php echo $key; ?>" 
        			     <?php if($product->productId && $product->status == $key) { echo 'checked';} ?> required="">
        			     <?php echo $value; ?>
        			<?php } ?>
                </td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea rows="5" cols="10" name="product[description]">
                <?php echo $product->description;?>
                </textarea>
            </td>
        </tr>

        <tr>
            <td>
                <button type="button" class="btn btn-success" onclick="object.setForm('#productForm').load();">
                    <?php 
                        if($product->productId){ ?>
                            Update
                    <?php } else { ?>
                            Add
                    <?php } ?>
                </button>
                                            
            </td>
        </tr> 
    </table>
</form>