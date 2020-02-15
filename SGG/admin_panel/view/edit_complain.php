<?php
session_start();
$link=$_SESSION['link'];
  include("./db.php");
  if(isset($_GET['e_c'])){
        $delete_id=$_GET['e_c'];
        $delete_a="UPDATE `complain` SET `status`='1' WHERE `Complain_id` ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_a);
       if($run_delete)
       {
          echo "<script>alert('STATUS HAS BEEN UPDATE')</script>";
          echo "<script>window.open('../index.php?link=39','_self')</script>";
        }
  }
?>
