<?php
include './db.php';
if(!empty($_POST)) {
	$output='';
	$sales=$_POST['sale'];
	$labour=$_POST["la"];
	$amount=$_POST['total'];
		$id="";
	$query="select Labour_id from labour where Worker_name='$labour'";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result))
	{
			$id=$row['Labour_id'];
	}
	
	$query4="UPDATE `sales_labour` SET `amount`='$amount' WHERE Sales_id='$sales' and Labour_id='$id'";
	$result2=mysqli_query($conn,$query4);
	if($result2)
	{
		echo $id;
	}
	}
?>