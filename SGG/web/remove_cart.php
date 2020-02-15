<?php
    require 'db.php';
    session_start();
    $requ_id=$_GET['id'];
     $user_name=$_SESSION['username'];
     $re_id=$_SESSION['r_id'];
    $query="select * from login where USER_NAME='$user_name'";
    $run=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($run))
    {
    	$u_id=$row['USER_ID'];
    }
   
	

    $delete_query="DELETE FROM `customer_requirement` WHERE requirement_id=$requ_id";
    $delete_query_result=mysqli_query($conn,$delete_query) or die(mysqli_error($conn));
    header('location: cart.php');
?>