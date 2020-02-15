<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_b'])){
        $delete_id=$_GET['delete_b'];
        $delete_b="delete from brand where Brand_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_b);
         $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
              echo "<script> alert('Cannot Delete this  Record'); </script>";
              echo "<script> location.href='../index.php?link=6'; </script>";
        }
        else{
          
          echo "<script>alert('CITY HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=6','_self')</script>";
        }
  }
?>
