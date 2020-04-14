<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
$ProductID=$_GET['ProductID'];
$product = $db_handle->runQuery("SELECT * FROM products WHERE ProductID='$ProductID'");

?>

<form action='' id='updateProduct' method='post' enctype="multipart/form-data">
    <input type='text' id='description' name='description' value='<?php echo $product[0]["description"]; ?>'><br>
    <input type='text' id='price' name='price' value='<?php echo $product[0]["price"]; ?>'><br>
    <img src="../img/<?php echo $product[0]["image"]; ?>">
    <input type="file" name="imgfile">
    <input type="submit" name="submit" value="Update">
</form>