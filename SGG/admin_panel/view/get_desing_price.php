<?php 
$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
	$id=$_POST['id'];
	$sql="SELECT Price FROM `design` WHERE `Design_id` like  $id";
	$q=mysqli_query($conn,$sql);
	if($q)
	{
		while($row=mysqli_fetch_array($q))
		{
			$price=$row[0];
		}
		echo $price;
	}

?>