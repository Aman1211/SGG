<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_s'])){
        $delete_id=$_GET['delete_s'];
        $delete_s="delete from labour where Labour_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_s);
        $counyt=mysqli_affected_rows($conn);
        if($count==-1)
        {
          echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=30';</script>";
        }
        else
        {
          echo "<script>alert('Labour HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=30','_self')</script>";
        }
  }
?>
