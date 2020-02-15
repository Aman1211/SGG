<?php
session_start();

  include("../db.php");
  if(isset($_GET['delete_s'])){
        $delete_id=$_GET['delete_s'];
        $delete_s="delete from supplier where Supplier_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_s);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
           echo "<script> alert('cannot delete this record'); </script>";
           echo "<script> location.href='../index.php?link=19';</script>";
        }
        else
        {
          echo "<script>alert('SUPPLIER HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=19','_self')</script>";
        }
  }
?>
