<?php
    require 'db.php';
    //require 'header.php';
    session_start();
   	$p_id=$_REQUEST['p_id'];
  	$h=$_REQUEST['height'];
  	$w=$_REQUEST['width'];
  	$q=$_REQUEST['qty'];
    $user_name=$_SESSION['username'];
    $u_id="";
   
    $query="select * from login where USER_NAME='$user_name'";
    $run=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($run))
    {   
    	$u_id=$row['USER_ID'];
    }
   
   $d=date("Y/m/d");
                    
        if($_SESSION['count']==0)
    {
            echo "<script> alert(); </script>";
    	$_SESSION['count']=$_SESSION['count']+1;
    	
    $query_1="INSERT INTO `request`(`User_id`, `Request_date`,`status`) VALUES ('$u_id','$d',0)";
    $run_1=mysqli_query($conn,$query_1);

    if($run_1)
    {
        $p="";
            $abc="select Price from Product where Product_id='$p_id'";
            $q1=mysqli_query($conn,$abc);
            while($q3=mysqli_fetch_array($q1))
            {
                $p=$q3['Price'];
            }
    	$r_id="";
    	$sql_3="select max(Request_id) from request";
    	$run_3=mysqli_query($conn,$sql_3);
    	while($row_3=mysqli_fetch_array($run_3))
    	{
    		$r_id=$row_3[0];
		}
    	$_SESSION['r_id']=$r_id;
    	
    	$sql_2="INSERT INTO `customer_requirement`(`Customer_req_id`, `Product_id`, `Size_Height`, `Size_Width`, `qty`,`rate`) VALUES ($r_id,$p_id,$h,$w,$q,$p)";
    	$run_2=mysqli_query($conn,$sql_2);
    	if($run_2)
    	{
    	
    		 header("location:single.php?id=$p_id");
    	}
    }
}
 else{
        $p="";
            $abc="select Price from Product where Product_id='$p_id'";
            $q1=mysqli_query($conn,$abc);
            while($q3=mysqli_fetch_array($q1))
            {
                $p=$q3['Price'];
            }
 	$re_id="";
 	$qty="";
 	$query4="select * from customer_requirement where Product_id=$p_id and Size_Height=$h and Size_Width=$w";
	$result=mysqli_query($conn,$query4);
	while($row=mysqli_fetch_array($result))
	{
		$re_id=$row['requirement_id'];
		$qty=$row['qty'];
	}
	$no_of=mysqli_num_rows($result);
	if($no_of==0)
	{

		$r_id=$_SESSION['r_id'];
		 
    	$sql_2="INSERT INTO `customer_requirement`(`Customer_req_id`, `Product_id`, `Size_Height`, `Size_Width`, `qty`,`rate`) VALUES ($r_id,$p_id,$h,$w,$q,$p)";
 		$run_2=mysqli_query($conn,$sql_2);
		if($run_2)
    		{

    		header("location: single.php?id=$p_id");
    		}
 	}
 	else{
 		
 		$q=$q+$qty;
 		$r_id=$_SESSION['r_id'];
 		$sql5="UPDATE `customer_requirement` SET `requirement_id`=$re_id,`Customer_req_id`=$r_id,`Product_id`=$p_id,`Size_Height`=$h,`Size_Width`=$w,`qty`=$q WHERE `requirement_id`=$re_id";
 		$run5=mysqli_query($conn,$sql5);
 		header("location: single.php?id=$p_id");
 	}
 }   
    /*header('location: products.php');*/
?>