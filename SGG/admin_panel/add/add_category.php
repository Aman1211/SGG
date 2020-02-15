<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD CATEGORY</title>
</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>ADD CATEGORY</h1>
<hr>
<label for="l_name"><b>Enter Category</b></label>
<input type="text" name="cat_title" placeholder="Enter Category"  autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"required><br>
<hr>
<input type="submit" class="registerbtn" name="submit" value="Insert">
<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=8'">Cancel</button>
</div>
</form>
<?php
include("./db.php");
$link=8;
	if(isset($_POST['submit'])){
			$cat_title=$_POST['cat_title'];
			$qup="select * from category where Category_name='$cat_title'";
			$dupquery=mysqli_query($conn,$qup);
			if(mysqli_num_rows($dupquery)>0)
			{
				echo "<script>alert('Category is already exists.')</script>";
			}
			else
			{
			$insert_cat="insert into category (Category_name) values ('$cat_title')";
			$run_cat=mysqli_query($conn,$insert_cat);
			if($run_cat){
				echo "<script>alert ('New Category Has Been Inserted')</script>";
				echo "<script>window.open('./index.php?link=$link','_self')</script>";
				}
			}  
	}mysqli_close($conn);
?>
</body>
</html>