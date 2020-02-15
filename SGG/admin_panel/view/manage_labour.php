<?php
include './db.php';
if(!empty($_POST)) {
	$output='';
	$sales=$_POST['sal'];
	$labour=$_POST["labour"];

	if(isset($labour)) {

for($i=0;$i<count($labour);$i++)
{

	$lab=$labour[$i];
	$id="";
	$query="select Labour_id from labour where Worker_name='$lab'";
	$result=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($result))
	{
			$id=$row['Labour_id'];
	}
	$val=1;
	$d=date("Y/m/d");
	$query2="INSERT INTO `sales_labour`(`Sales_id`, `Labour_id`,`dateofjoin`) VALUES ('$sales','$id','$d')";
	$result2=mysqli_query($conn,$query2);
	$query3="UPDATE `labour` SET `status`=1 WHERE Labour_id='$id'";
	mysqli_query($conn,$query3);
	}
	if($result2)
	{
		
	}
	
}

}
?>