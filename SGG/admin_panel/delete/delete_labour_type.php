<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_c'])){
        $delete_id=$_GET['delete_c'];
        $delete_c="delete from labour_type where Labour_type_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_c);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
          echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=4';</script>";
        }
        else
        {
          echo "<script>alert('LABOUR_TYPE HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=$link','_self')</script>";
        }
  }
?>