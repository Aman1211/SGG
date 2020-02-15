<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_p'])){
        $delete_id=$_GET['delete_p'];
        $delete_b="delete from price_size where Price_Size_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_b);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
          echo "<script> alert('cannot delete this record'); </script>";
           echo "<script> location.href='../index.php?link=21';</script>";
        }
        else
        {
          echo "<script>alert('PRICE_SIZE HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=21','_self')</script>";
        }
  }
?>
