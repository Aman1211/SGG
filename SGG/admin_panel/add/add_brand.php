<html>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD BRAND</title>
</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>ADD BRAND</h1>
<hr>
<label for="l_name"><b>Enter Brand</b></label>
<input type="text" name="B_name" placeholder="Enter Brand" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123 )|| (event.charCode==32)" required><br>
<hr>
<input type="submit" class="registerbtn" name="submit" value="Insert">
<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=6'">Cancel</button>
</div>
</form>
<?php 
$link=6;
include("./db.php");
if(isset($_POST['submit']))
{
	$B_name=$_POST['B_name'];
	$qup="select * from brand where Brand_name='$B_name'";
	$dupquery=mysqli_query($conn,$qup);
	if(mysqli_num_rows($dupquery)>0)
	{
		echo "<script>alert('Brand is already exists.')</script>";
	
	}
	else{
		$query="insert into Brand (Brand_name) values ('$B_name')";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
			echo "<script>alert('Brand Name has been Added ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        
		}
	}
}mysqli_close($conn);
?>
</body>
</html>
