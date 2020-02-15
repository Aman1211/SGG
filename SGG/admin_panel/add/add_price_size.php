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
<input type="text" name="thick" placeholder="Enter Thickness" required><br>
<label for="l_name"><b>Price</b></label>
<input type="number" name="price" placeholder="Enter Price" required min="1"><br>
<hr>
<input type="submit" class="registerbtn" name="submit" value="Insert">
<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=21'">Cancel</button>
</div>
</form>
<?php 
$link=21;
include("./db.php");
if(isset($_POST['submit']))
{
	$thick=$_POST['thick'];
	$price=$_POST['price'];
	
		$query="insert into price_size (Thickness,Price) values ('$thick','$price')";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
			echo "<script>alert('Price Size has been Added')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        }
	}mysqli_close($conn);
?>
</body>
</html>
