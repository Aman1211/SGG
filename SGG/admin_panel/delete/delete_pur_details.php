<?php

session_start();
$link=$_SESSION['link'];
  include("../db.php");
  if(isset($_GET['delete_p']) and isset($_GET['delete_pro'])){
        $delete_pru_id=$_GET['delete_p'];
         $delete_pro_id=$_GET['delete_pro'];
        $delete_a="DELETE FROM `purchase_detail` WHERE `Purchase_id` LIKE $delete_pru_id and `Product_id` LIKE $delete_pro_id ";
        $run_delete=mysqli_query($conn,$delete_a);
      /*  $count=mysqli_affected_rows($conn);
        if($count==-1)
        {
           echo "<script> alert('cannot delete this record'); </script>";
          echo "<script> location.href='../index.php?link=52&edit_pur=$delete_pru_id'; </script>";
        }
        else{*/
          echo "<script>alert('PURCHASE DETAIL HAS BEEN DELETED')</script>";
          echo "<script>window.open('../index.php?link=52&edit_pur=$delete_pru_id','_self')</script>";
       // }
  }

?>
