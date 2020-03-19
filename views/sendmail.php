<?php

require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();


$mymail="alejandrovaltor.x2@gmail.com";
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$regexp="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$";

$body="$message\n\nE-mail: $email";
mail($mymail,$subject,$body,"From: $email\n");
echo "Thanks for your E-mail";