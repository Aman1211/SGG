<?php
  
  session_start();
  $link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_d'])){
        $delete_id=$_GET['delete_d'];
        $delete_d="delete from design where Design_id ='$delete_id'";
        $run_delete=mysqli_query($conn,$delete_d);
        $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
          echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=27';</script>";
        }
        else
       {
          echo "<script>alert('DESIGN HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=27','_self')</script>";
        }
  }
?>
