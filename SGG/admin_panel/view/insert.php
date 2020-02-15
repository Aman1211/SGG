<?php
include "db.php";
if(isset($_POST["Area_name"], $_POST["Pincode"]))
{
 $first_name = mysqli_real_escape_string($conn, $_POST["Area_name"]);
 $last_name = mysqli_real_escape_string($conn, $_POST["Pincode"]);
 $query = "INSERT INTO area(Area_name, Pincode) VALUES('$first_name', '$last_name')";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Inserted';
 }
}
?>