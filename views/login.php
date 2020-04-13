<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
require_once('../db/functions.php');
$db_handle = new DBController();


?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>

 <?php
	if(isset($_SESSION['UserID'])){
		$message = "You are already log in";
	}else{
	// START FORM PROCESSING
		if (isset($_POST['submit'])) { // Form has been submitted.
			$email = $db_handle->escapeSql($_POST['email']);
			$password = $db_handle->escapeSql($_POST['pass']);


			$query=("SELECT UserID, email, pass,isAdmin FROM users WHERE email = '{$email}' LIMIT 1");
			$result = $db_handle->selectLogin($query);
				if (mysqli_num_rows($result) == 1) {
					// username/password authenticated
					// and only 1 match
					$found_user = mysqli_fetch_array($result);
					if(password_verify($password, $found_user['pass'])){
						$_SESSION['UserID'] = $found_user['UserID'];
						$_SESSION['email'] = $found_user['email'];
						$_SESSION['isAdmin'] = $found_user['isAdmin'];
						$_SESSION['message'] = "You are now log in.";
						redirect_to("index.php");
				} else {
					// username/password combo was not found in the database
					$message = "Username/password combination incorrect.<br />
						Please make sure your caps lock key is off and try again.";
				}}
		} else { // Form has not been submitted.
			if (isset($_GET['logout']) && $_GET['logout'] == 1) {
				$message = "You are now logged out.";
			} 
		}
	}
if (!empty($message)) {echo "<p>" . $message . "</p>";} ?>

<h2>Please login</h2>
<form action="" method="post">
Email:
<input type="text" name="email" maxlength="30" value="" />
Password:
<input type="password" name="pass" maxlength="30" value="" />
<input type="submit" name="submit" value="Login" />
</form>
<a href="newuser.php">Register</a>
<a href="logout.php">Log out</a>

</body>
</html>
<?php
if (isset($connection)){mysqli_close($connection);}
?>