<html>
<head>
<meta http-equiv="Content-Type" content="text/html;  charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD LABOUR_TYPE</title>

</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>ADD LABOUR</h1>
<hr>
<label for="l_name"><b>Enter Labour Type</b></label>
<input type="text" name="l_name" placeholder="Enter Labour Type" required><br>

<hr>
<input type="submit" class="registerbtn" name="submit" value="Insert">
<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=32'">Cancel</button>
</div>
</form>
<?php 
$link=32;
include("./db.php");
if(isset($_POST['submit']))
{
	$l_name=$_POST['l_name'];
	
		$query="insert into labour_type (Labour_type_name) values ('$l_name')";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
			echo "<script>alert('Labour Type has been Added ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        
		}
	}
mysqli_close($conn);
?>
</body>
</html>
