<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<button name="submit">hardik</button>
			<input type="button" name="hp" id="submit" value="id">
	</form>
</body>
</html>
<?php
/*$host = "localhost";
$user ="root";
$pass ="";
$dbname ="sgg1";
$conn = mysqli_connect($host,$user,$pass,$dbname);
if(!$conn){
die('Could not connect: '.mysqli_connect_error());
}*/
include '../db.php';

if(isset($_POST['submit'])){
echo "<script>alert('hardik');</script>";
	$query="SELECT MAX(Request_id) FROM request";
	$row=mysqli_query($conn,$query);
	while($r=mysqli_fetch_array($row)){
		$i=$r[0];
	}
	echo "<script>alert('$i');</script>"; 
	}
	
?>