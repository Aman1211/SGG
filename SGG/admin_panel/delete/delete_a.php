<?php
session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_a'])){
        $delete_id=$_GET['delete_a'];
        $delete_a="delete from area where Area_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_a);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
           echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=1'; </script>";
        }
        else{
          echo "<script>alert('AREA HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=1','_self')</script>";
        }
  }
?>
