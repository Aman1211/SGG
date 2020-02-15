<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_s'])){
        $delete_id=$_GET['delete_s'];
        $delete_s="delete from subcategory where subcategory_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_s);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
           echo "<script> alert('cannot delete this record'); </script>";
           echo "<script> location.href='../index.php?link=11';</script>";
        }
        else
        {
          echo "<script>alert('Subcategory HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=11','_self')</script>";
        }
  }
?>
