<?php
require_once('header.php');
require_once('../db/connection.php');
$db_handle = new DBController();
?>

<?php
if (isset($_POST['submit'])) {
  $dayOfWeekSQL=$_POST['dayOfWeek'];
  $percentageSQL=$_POST['percentage'];
  $ProductIDSQL=$_POST['ProductID'];
  $result=$db_handle->insertRow("UPDATE product_of_the_day SET percentage='$percentageSQL',ProductID='$ProductIDSQL' WHERE dayOfWeek='$dayOfWeekSQL'");
}
?>

<table style="width:100%">
  <tr>
    <th>Day</th>
    <th>Percentage</th>
    <th>ProductID</th>
  </tr>
  
  <?php
        $daysOfWeek=$db_handle->runQuery("SELECT * FROM product_of_the_day");
        if (!empty($daysOfWeek)) { 
            foreach($daysOfWeek as $aNumber=> $value){
    ?>
    <tr>
        <form action="" method="post">
          <td><input type="text" id="dayOfWeek" name="dayOfWeek" readonly="readonly" value="<?php echo $daysOfWeek[$aNumber]["dayOfWeek"]; ?>"></td>
          <td><input type="text" id="percentage" name="percentage" value="<?php echo $daysOfWeek[$aNumber]["percentage"]; ?>"></td>
          <td><input type="text" id="ProductID" name="ProductID" value="<?php echo $daysOfWeek[$aNumber]["ProductID"]; ?>"></td>
          <td><input type="submit" name="submit" value="Submit"></td>
        </form>
    </tr>
    <?php }}?>
  
  
</table>