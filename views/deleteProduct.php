<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
require_once('../db/functions.php');
$db_handle = new DBController();
$ProductID=$_GET['ProductID'];
$product = $db_handle->selectLogin("SELECT * FROM products WHERE ProductID='$ProductID'");
$fProduct=mysqli_fetch_array($product);
if($fProduct['isAvaliable']=="0"){
    $db_handle->insertRow("UPDATE products SET isAvaliable='1' WHERE ProductID='$ProductID'");
}else{
    $db_handle->insertRow("UPDATE products SET isAvaliable='0' WHERE ProductID='$ProductID'");
}

$_SESSION['message'] = "Product deleted.";
redirect_to("index.php");