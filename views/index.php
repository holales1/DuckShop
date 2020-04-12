<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
?>

<div>
    <div class="productTitle">Daily special offer</div>
        <?php
            $dayOfWeek = date("l", strtotime(date("Y-m-d")));
            $offer = $db_handle->runQuery("SELECT percentage, ProductID FROM product_of_the_day WHERE dayOfWeek='$dayOfWeek'");
            $ProductID=$offer[0]["ProductID"];
            $product_of_day = $db_handle->runQuery("SELECT * FROM products WHERE ProductID= $ProductID");
        ?>
        <div >
            <form method="post" action="shopCar.php?action=add&ProductID=<?php echo $product_of_day[0]["ProductID"]; ?>">
                <div class="product-image">
                    <img src="../img/<?php echo $product_of_day[0]["image"]; ?>">
                </div>
                <div>
                    <strong><?php echo $product_of_day[0]["description"]; ?></strong>
                </div>
                <div class="product-price"><?php
                    $price=intval($product_of_day[0]["price"]);
                    $finalPrice=$price/100*(100-intval($offer[0]["percentage"]));
                    echo $finalPrice.".00 DKK"; 
                    ?>
                </div>
                <div>
                    <input type="text" name="quantity" value="1" size="2" />
                    <input type="submit" value="Add to cart" class="addBtn" />
                </div>
            </form>
        </div>
        
	<div class="productTitle">Products</div>
	<?php
        $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY ProductID ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $aNumber=> $value){
	?>
    <div class="product-item">
        <form method="post" action="shopCar.php?action=add&ProductID=<?php echo $product_array[$aNumber]["ProductID"]; ?>">
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