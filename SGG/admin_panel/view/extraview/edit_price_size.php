<?php
	include("./db.php");
	if(isset($_GET['edit_p'])){
		$edit_price_id=$_GET['edit_p'];
		$qu="select * from price_size where Price_Size_id='$edit_price_id'";
		$run=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run);
		$update_id=$row_edit['Price_Size_id'];
		$thick1=$row_edit['Thickness'];
		$price=$row_edit['Price'];
	}
?>

<html>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD PRICE_SIZE</title>
</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>ADD PRICE_SIZE</h1>
<hr>
<label for="l_name"><b>Thickness</b></label>
<input type="text" name="thick" placeholder="Enter Thickness" required value="<?php echo $thick1;?>"><br>
<label for="l_name"><b>Price</b></label>
<input type="text" name="price" placeholder="Enter Price" required value="<?php echo $price;?>"><br>
<hr>
<input type="submit" class="registerbtn" name="submit" value="UPDATE">
</div>
</form>
<?php 
$link=18;
include("./db.php");
if(isset($_POST['submit']))
{
	$thick=$_POST['thick'];
	$price=$_POST['price'];
	
		$query="update price_size set Thickness='$thick',Price='$price' where Price_Size_id='$update_id'";
		$execute=mysqli_query($conn,$query); 
		if($execute)
		{
			echo "<script>alert('Price Size has been updated')</script>";
			echo "<script>window.open('../index.php?link=$link','_self')</script>";
       	}
	}
?>
</body>
</html>
