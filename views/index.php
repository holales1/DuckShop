<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();

?>

<div>
    <div>
        <?php
        if(isset($_SESSION['message'])){
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <?php
        $dayOfWeek = date("l", strtotime(date("Y-m-d")));
        $offer = $db_handle->runQuery("SELECT percentage, ProductID FROM product_of_the_day WHERE dayOfWeek='$dayOfWeek'");
        if($offer!=null){  
    ?>
    <div class="productTitle">Daily special offer</div>
        <?php    
            $ProductID=$offer[0]["ProductID"];
            $product_of_day = $db_handle->runQuery("SELECT * FROM products WHERE ProductID= $ProductID");
        ?>
        <div>
            <?php
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){
            ?>
            
            <form method="post" action="updateProductDay.php">
                <div class="product-image">
                    <img src="../img/<?php echo $product_of_day[0]["image"]; ?>">
                </div>
                <div>
                    <strong><?php echo $product_of_day[0]["description"]; ?></strong>
                </div>
                <div class="product-price">
                <?php
                    $price=intval($product_of_day[0]["price"]);
                    $finalPrice=$price/100*(100-intval($offer[0]["percentage"]));
                    echo $finalPrice.".00 DKK"; 
                    ?>
                </div>
                <div>
                    <input type="submit" value="Update" class="addBtn" />
                </div>
            </form>
            <?php
            }else{
            ?>
            <form method="post" action="shopCar.php?action=add&ProductID=<?php echo $product_of_day[0]["ProductID"]; ?>">
                <div class="product-image">
                    <img src="../img/<?php echo $product_of_day[0]["image"]; ?>">
                </div>
                <div>
                    <strong><?php echo $product_of_day[0]["description"]; ?></strong>
                </div>
                <div class="product-price">
                <?php
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
            <?php
            }
            ?>
        </div>
        <?php

            }else{

            }
        ?>
        
	<div class="productTitle">Products</div>
	<?php
        if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin']==0  ){
        $product_array = $db_handle->runQuery("SELECT * FROM products WHERE isAvaliable=0 ORDER BY ProductID ASC ");
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
            
                <input type="number" name="quantity" value="1" size="2" max="10"/>
                <input type="submit" value="Add to cart" class="addBtn" />
            </div>
        </form>
    </div>
    <?php
            }
			}
	}else{
        $product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY ProductID ASC");
        if (!empty($product_array)) { 
            foreach($product_array as $aNumber=> $value){
    ?>
    <div class="product-item">
        <form method="post" action="updateProduct.php?ProductID=<?php echo $product_array[$aNumber]["ProductID"]; ?>">
            <div class="product-image">
                <img src="../img/<?php echo $product_array[$aNumber]["image"]; ?>">
            </div>
            <div>
                <strong><?php echo $product_array[$aNumber]["description"]; ?></strong>
            </div>
            <div class="product-price"><?php echo $product_array[$aNumber]["price"]." DKK"; ?>
            </div>
            <div>
                <input type="submit" value="Update" class="addBtn" />
            </div>
        </form>
        <div>
            <form method="post" action="deleteProduct.php?ProductID=<?php echo $product_array[$aNumber]["ProductID"]; ?>">
                <?php
                    if($product_array[$aNumber]["isAvaliable"]=="0"){
                ?>
                        <input type="submit" value="Delete" class="addBtn" />
                <?php
                    }else{
                ?>
                        <input type="submit" value="Add" class="addBtn" />
                <?php
                    }
                ?>
            </form>
        </div>
    </div>
    <?php
            }
        }
    ?>
    <div>
        <form method="post" action="newProduct.php">
            <input type="submit" value="Add new product" class="addBtn" />
        </form>
    </div>
    
    <?php
    }
	?>
</div>
