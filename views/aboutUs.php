<?php
session_start();
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
?>
<?php
if (isset($_POST['submit'])) {
    $descriptionSQL=$_POST['description'];
    $AddressSQL=$_POST['Address'];
    $phoneNumberSQL=$_POST['phoneNumber'];
    $openHourSQL=$_POST['openHour']; 
    $result=$db_handle->insertRow("UPDATE companies SET description='$descriptionSQL',Address='$AddressSQL',phoneNumber='$phoneNumberSQL',openHour='$openHourSQL' WHERE CompanyID=1");
}
?>
<div>
    <div class="divAboutUs">
        <h2>About US</h2>
        <div>
            <?php
                $about_us = $db_handle->runQuery("SELECT * FROM companies");
                $description=$about_us[0]['description'];
                if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){
                    echo "<form action='' id='updateAboutUs' method='post'>";
                    echo "<input type='text' id='description' name='description' value='$description'><br>";
                }else{ 
                    echo $about_us[0]['description']; 
                }

            ?>
        </div>
        <br>
        <h2>Address</h2>
        <div>
            <?php
            $Address=$about_us[0]['Address'];
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){
                echo "<input type='text' id='Address' name='Address' value='$Address'><br>";
            }else{ 
                echo $about_us[0]['Address']; 
            }
                
            ?>
        </div>
        <br>
        <h2>Phone number</h2>
        <div>
            <?php
                $phoneNumber=$about_us[0]['phoneNumber'];
                if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){
                    echo "<input type='text' id='phoneNumber' name='phoneNumber' value='$phoneNumber'><br>";
                    
                }else{ 
                    echo $about_us[0]['phoneNumber']; 
                }
            
            ?>
        </div>
        <br>
        <h2>Open hour</h2>
        <div>
            <?php
                $openHour=$about_us[0]['openHour'];
                if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){
                    echo "<textarea rows='4' cols='50' name='openHour' form='updateAboutUs'>$openHour</textarea><br>";
                }else{ 
                    echo $about_us[0]['openHour']; 
                }
            ?>
        </div>
        <div>
            <?php
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin']==1  ){?>
            <input type="submit" name="submit" value="Update information about company">
            <?php echo "</form>";?>
            <?php }?>
        </div>
    </div>
    <div class="imgShop" >
        <img src="../img/duckShop.jpg"></img>
    </div>
</div>