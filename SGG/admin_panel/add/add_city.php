<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD CITY</title>
<!--script start for navigate the name is already exists or not-->

</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>ADD CITY</h1>
<hr>
<label for="l_name"><b>Enter City</b></label>
<input type="text" name="city_title" placeholder="Enter City" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" required><br>
 
<hr>
<input type="submit" class="registerbtn" name="submit" value="Insert">
<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=4'">Cancel</button>
</div>
</form>
<?php
include("./db.php");
$link=4;
	if(isset($_POST['submit']))
	{
			$cat_title=$_POST['city_title'];
			$qup="select * from city where City_name='$cat_title'";
			$dupquery=mysqli_query($conn,$qup);
			if(mysqli_num_rows($dupquery)>0)
			{
					echo "<script>alert('City Name is already exists.')</script>";
			}
			else
			{
				$insert_cat="insert into City (City_name) values ('$cat_title')";
				$run_cat=mysqli_query($conn,$insert_cat);
				if($run_cat)
				{
					echo "<script>alert ('New City Has Been Inserted')</script>";
					echo "<script>window.open('./index.php?link=$link','_self')</script>";
				}  
			}
	}mysqli_close($conn);		
?>
</body>
</html>