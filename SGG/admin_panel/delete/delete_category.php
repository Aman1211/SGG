<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_b'])){
        $delete_id=$_GET['delete_b'];
        $delete_b="delete from category where category_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_b);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
          echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=8'; </script>";
        }
        else
        {
          echo "<script>alert('CATEGORY HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=8','_self')</script>";
        }
  }
?>
