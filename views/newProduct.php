<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();

$product = $db_handle->insertRow("SELECT MAX(ProductID) FROM products");
$fProduct=$fOrder=mysqli_fetch_array($product);
$fProduct[0]=$fProduct[0] + 1;
if (isset($_POST['submit'])){
    if(($_FILES['imgfile']['type']=="image/jpeg" ||
        $_FILES['imgfile']['type']=="image/pjpeg" ||
        $_FILES['imgfile']['type']=="image/gif" ||
        $_FILES['imgfile']['type']=="image/png" ||
        $_FILES['imgfile']['type']=="image/jpg")&& (
         $_FILES['imgfile']['size']< 3000000
        )){
        if ($_FILES['imgfile']['error']>0){
            echo "Error: ". $_FILES['imgfile']['error'];
        }else{
            if (file_exists("upload/".$_FILES['imgfile']['name'])){
                echo "can't upload: ". $_FILES['imgfile']['name']. " Exists";
            }else{
                move_uploaded_file($_FILES['imgfile']['tmp_name'],
                    "../img/".$_FILES['imgfile']['name']);
                $db_handle->insertRow("INSERT INTO products (price, description, image)
                 VALUES ('{$_POST["price"]}', '{$_POST["description"]}', '{$_FILES["imgfile"]["name"]}')");
            }
        }
    }
}



?>

<form action='' id='updateProduct' method='post' enctype="multipart/form-data">
    <label for="fname">Description</label><br>
    <input type='text' id='description' name='description' ><br>
    <label for="fname">Price</label><br>
    <input type='number' id='price' name='price' ><br>
    <label for="fname">Image</label><br>
    <input type="file" name="imgfile">
    <input type="submit" name="submit" value="Add new product">
</form>

<?php
