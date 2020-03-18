<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
?>
<div>
    <div class="divAboutUs">
        <h2>About US</h2>
        <div>
            <?php
                $about_us = $db_handle->runQuery("SELECT * FROM company");
                echo $about_us[0]['description']; 
            ?>
        </div>
        <br>
        <h2>Address</h2>
        <div>
            <?php
                $about_us = $db_handle->runQuery("SELECT * FROM company");
                echo $about_us[0]['Address']; 
            ?>
        </div>
        <br>
        <h2>Phone number</h2>
        <div>
            <?php
                $about_us = $db_handle->runQuery("SELECT * FROM company");
                echo $about_us[0]['phoneNumber']; 
            ?>
        </div>
    </div>
    <div class="imgShop" >
        <img src="../img/duckShop.jpg"></img>
    </div>
</div>