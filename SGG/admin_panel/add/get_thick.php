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
$price="";
	$sql1="SELECT Price_size_id  from product  WHERE `Product_id`= '$id'";
	$q1=mysqli_query($conn,$sql1);
	if($q1)
	{
		while($row=mysqli_fetch_array($q1))
		{
			$price=$row[0];
		}
		
	}

	$sql="SELECT Thickness FROM `price_size` WHERE `Price_Size_id`='$price'";
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