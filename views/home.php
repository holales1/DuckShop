<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
?>

<div>
	<div class="productTitle">Products</div>
	<?php
        $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY ProductID ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $aNumber=> $value){
	?>
    <div class="product-item">
        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$aNumber]["ProductID"]; ?>">
            <div class="product-image">
                <img src="../img/<?php echo $product_array[$aNumber]["image"]; ?>">
            </div>
            <div>
                <strong><?php echo $product_array[$aNumber]["description"]; ?></strong>
            </div>
            <div class="product-price"><?php echo $product_array[$aNumber]["price"]." DKK"; ?>
            </div>
            <div>
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="addBtn" />
            </div>
        </form>
    </div>
	<?php
			}
	}
	?>
</div>