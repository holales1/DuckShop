<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
require_once('../db/functions.php');
$db_handle = new DBController();
$order = $db_handle->selectLogin("SELECT MAX(OrderID) FROM orders");
$fOrder=mysqli_fetch_array($order);

if($fOrder[0]==null){
    $fOrder[0]=1;
}else{
    $fOrder[0]=$fOrder[0] + 1;
}

$date=date("Y-m-d");

$db_handle->insertRow("INSERT INTO orders (OrderID, orderDate,UserID) VALUES ('{$fOrder[0]}', '{$date}', '{$_SESSION["UserID"]}')");
foreach ($_SESSION["cart_item"] as $item){
    $db_handle->insertRow("INSERT INTO orderProduct (ProductID, OrderID,quantity) VALUES ('{$item["ProductID"]}', '{$fOrder[0]}', '{$item["quantity"]}')");
}

unset($_SESSION["cart_item"]);
$_SESSION['message'] = "Order accepted.";
redirect_to("index.php");