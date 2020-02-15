<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_c'])){
        $delete_id=$_GET['delete_c'];
        $delete_c="delete from login where USER_ID='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_c);
        if($run_delete){
          echo "<script>alert('USER HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=$link','_self')</script>";
        }
  }
?>
