<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();

?>

<form method="post" action="sendmail.php">
Email:<input type="text" name="email"/><br/>
Subject:<input type="text" name="subject"/><br/>
Message:<br/>
<textarea name="message" rows="15" cols="40">
</textarea><br/>
<input name="submit" type="submit" value="Submit"/>

</form>

