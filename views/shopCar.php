<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    //start the switch/case
switch($_GET["action"]) {
//adding items to cart
	case "add":

		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE ProductID='" . $_GET["ProductID"] . "'");
			$itemArray = array($productByCode[0]["ProductID"]=>array(
			    'description'=>$productByCode[0]["description"],
                'ProductID'=>$productByCode[0]["ProductID"],
                'image'=>$productByCode[0]["image"],
                'quantity'=>$_POST["quantity"],
                'price'=>$productByCode[0]["price"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["ProductID"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["ProductID"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
//Remove item from cart
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["ProductID"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
//Empty the entire cart
	case "empty":
        unset($_SESSION["cart_item"]);
	break;	
}
}

?>

<html>
    <head>
        <Title>PHP Shopping Cart</Title>
        <link href="style.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <div id="shopping-cart">
            <div class="heading">Shopping Cart <a id="emptyBtn" href="shopCar.php?action=empty">Empty Cart</a></div>
            <?php
            //Reset total cost to do recalc
            if(isset($_SESSION["cart_item"])){
                $item_total = 0;
            ?>	
            <table cellpadding="10" cellspacing="1">
                <tbody>
                    <tr>
                        <th><strong>Name  </strong></th>
                        <th><strong>Image  </strong></th>
                        <th><strong>Code  </strong></th>
                        <th><strong>Quantity  </strong></th>
                        <th><strong>Price  </strong></th>
                        <th><strong>Action  </strong></th>
                    </tr>	
                    <?php		
                        foreach ($_SESSION["cart_item"] as $item){
                            ?>
                                    <tr>
                                    <td><strong><?php echo $item["description"]; ?></strong></td>
                                    <td> <img src="../img/<?php echo $item["image"]; ?>"></td>
                                    <td><?php echo $item["ProductID"]; ?></td>
                                    <td><?php echo $item["quantity"]; ?></td>
                                    <td><?php echo $item["price"]." DKK"; ?></td>
                                    <td><a href="shopCar.php?action=remove&ProductID=<?php echo $item["ProductID"]; ?>" class="removeBtn">Remove</a></td>
                                    </tr>
                                    <?php
                            $item_total += ($item["price"]*$item["quantity"]);
                            
                            }
                            
                            ?>

                    <tr>
                        <td colspan="5" align=right><strong>Total:</strong> <?php echo $item_total." DKK"; ?></td>
                    </tr>
                </tbody>
            </table>
            <?php
                }
            ?>
        </div>
    </body>
</html>