<?php
	session_start();
	include "db.php";
	$u_id="";
	$u_name=$SESSION['username'];
	$sql="select * from login where USER_NAME=$u_name";
	$sql_run=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($sql_run))
	{
		$u_id=$row['USER_ID'];
	}
	if(isset($_POST["index"],$_POST["business_id"]))
	{
		$r=$_POST['index'];
		$p_id=$_POST['business_id'];
		
		
		$sql_1="select * from ratings where user_id=$u_id and Product_id=$p_id";
		$run_1=mysqli_query($conn,$sql_1);
		$row_count=mysqli_num_rows($run_1);
		if($row_count>=1)
		{
			$query_1="update ratings set user_id='$u_id',Product_id='$p_id',Rating='$r',Rating_date='date("Y/m/d")' where user_id='$u_id' and Product_id='$p_id'";
			$run_2=mysqli_query($conn,$query_1);
			if(isset($run_2))
			{
				echo 'done';
			}
		}	
		else
		{
			$query="INSERT INTO `ratings`(`user_id`, `Product_id`, `Rating`, `Rating_date`) VALUES ($u_id,$p_id,$r,date('Y/m/d'))";
			$run=mysqli_query($conn,$query);
			if(isset($run))
			{
				echo 'done';
			}
		}
	}
?>