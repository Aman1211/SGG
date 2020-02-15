<?php
session_start();
include '../db.php';
if(!empty($_POST)) {
	$output='';
	$pro=$_POST['product'];
	$desp=$_POST['complain'];
	$user_name=$_SESSION['username'];
	$u_id="";
	$pro_id="";
	$sales_id="";
	$d=date("Y-m-d");
	$add=mysqli_real_escape_string($conn,$_POST['complain']);
	
	$query="select * from login where USER_NAME='$user_name'";
    $run=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($run))
    {
    	$u_id=$row['USER_ID'];
    }
    $query2="select Product_id from product where Product_name='$pro'";
    $result2=mysqli_query($conn,$query2);
    while($row2=mysqli_fetch_array($result2))
    {
    		$pro_id=$row2['Product_id'];
    }
    $sql = "select sales_id from sales_detail where Product_id='$pro_id' and sales_id in(select Sales_id from sales where Request_id in(select Request_id from  request where User_id='$u_id'))";
    $result3=mysqli_query($conn,$sql);
    while($row3=mysqli_fetch_array($result3))
    {
    		$sales_id=$row3['sales_id'];
    }
    $qu="INSERT INTO `complain`( `User_id`, `Complain_date`, `Product_id`, `Sales_id`, `Description`) VALUES ('$u_id','$d','$pro_id','$sales_id','$add')";
	/*$qu="INSERT INTO request(User_id,Request_date,Site_address)VALUES ('$i','$d','$add')";*/
	if(mysqli_query($conn,$qu)){
		$output .='<label class="text-success">Data Insertded</label>';
	
	}
	echo $output;
}

?>