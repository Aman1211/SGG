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
	
	$query3="UPDATE `labour` SET `status`=0 WHERE Labour_id='$id'";
	mysqli_query($conn,$query3);
	}
	$d=date("Y/m/d");
	$query4="update sales_labour set dateofleave='$d' where Sales_id='$sales' and Labour_id='$id'";
	mysqli_query($conn,$query4);
	if($result2)
	{
		
	}
	
}

}
?>