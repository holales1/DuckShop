<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();

$ProductID=$_GET['ProductID'];
if (isset($_POST['submit'])){
    if(($_FILES['imgfile']['type']=="image/jpeg" ||
        $_FILES['imgfile']['type']=="image/pjpeg" ||
        $_FILES['imgfile']['type']=="image/gif" ||
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
                $db_handle->insertRow("UPDATE products SET description='{$_POST["description"]}',price='{$_POST["price"]}',image='{$_FILES["imgfile"]["name"]}' WHERE ProductID='$ProductID'");
            }
        }
    }
}

$product = $db_handle->runQuery("SELECT * FROM products WHERE ProductID='$ProductID'");

?>

<form action='' id='updateProduct' method='post' enctype="multipart/form-data">
    <input type='text' id='description' name='description' value='<?php echo $product[0]["description"]; ?>'><br>
    <input type='text' id='price' name='price' value='<?php echo $product[0]["price"]; ?>'><br>
    <img src="../img/<?php echo $product[0]["image"]; ?>">
    <input type="file" name="imgfile">
    <input type="submit" name="submit" value="Update">
</form>

<?php
