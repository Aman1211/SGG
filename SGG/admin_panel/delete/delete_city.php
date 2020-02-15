<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_c'])){
        $delete_id=$_GET['delete_c'];
        $delete_c="delete from city where City_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_c);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
              echo "<script> alert('Cannot Delete this  Record'); </script>";
              echo "<script> location.href='../index.php?link=4'; </script>";
        }
        else{
          
          echo "<script>alert('CITY HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=4','_self')</script>";
        }
  }
?>