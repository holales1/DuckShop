<?php
if(session_status() == PHP_SESSION_NONE)
{
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Header</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="../style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<header id="main-header">
		<div id="logo-header" href="#">
			<h2 class="site-name">Duck Shop</h2>
			
		</div> <!-- / #logo-header -->
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="aboutUs.php">About Us</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="login.php" class="material-icons shopCar">account_circle</a></li>
				<li><a href="shopCar.php" class="material-icons shopCar" >shopping_cart</a></li>
			</ul>
		</nav><!-- / nav -->
	</header><!-- / #main-header -->
</body>
</html>