<?php
require_once('header.php');
require_once('../db/connection.php');
require_once('../db/functions.php');
$db_handle = new DBController();
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>

<?php
// START FORM PROCESSING
if (isset($_POST['submit'])) { // Form has been submitted.
	$errors = array();

	// perform validations on the form data
	$email = $db_handle->escapeSql($_POST['email']);
	$password = $db_handle->escapeSql($_POST['pass']);
    $iterations = ['cost' => 15];
    $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

	$result=$db_handle->insertRow("INSERT INTO users (email, pass) VALUES ('{$email}', '{$hashed_password}')");
		if ($result) {
            $message = "User Created.";
            redirect_to("login.php");
		} else {
			$message = "User could not be created.";
		}
}

if (!empty($message)) {echo "<p>" . $message . "</p>";}
?>
<h2>Create New User</h2>

<form action="" method="post">
Email:
<input type="text" name="email" maxlength="30" value="" />
Password:
<input type="password" name="pass" maxlength="30" value="" />
<input type="submit" name="submit" value="Create" />
</form>

</body>
</html>
<?php
if (isset($connection)){mysqli_close($connection);}
?>