<?php
	include("./db.php");
	if(isset($_GET['edit_d'])){
		$edit_design_id=$_GET['edit_d'];
		$qu="select * from design where Design_id='$edit_design_id'";
		$run_query=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run_query);
		$update_id=$row_edit['Design_id'];
		$design_name=$row_edit['Design_name'];
		$design_image=$row_edit['Design_image'];
		$desgin_color=$row_edit['Design_color'];
		$design_price=$row_edit['Price'];
	}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>UPDATE DESIGN</h1>
<hr>
    <label for="name"><b>Design Name</b></label>
    <input type="text" placeholder="Design Name" name="d_name" required value="<?php echo $design_name;?>"><br>
	<label for="image"><b>Select Image</b></label><br>
	<input type="file" placeholder="Design  Image" name="d_img" required value="<?php echo $design_image;?>"><br>
	 <label for="color"><b>Design Color</b></label><br>
    <input type="color" placeholder="Design color" name="d_color" required value="<?php echo $desgin_color;?>"><br>
	 <label for="price"><b>Design Price</b></label>
    <input type="text" placeholder="Design Price" name="d_price" required value="<?php echo $design_price;?>"><br>

	<hr>
	 <input type="submit" class="registerbtn" name="submit" value="UPDATE">
  </div>
  </form>
  <?php
	$link=17;
include("./db.php");
if(isset($_POST['submit']))
{


	$d_name=$_POST['d_name'];
	$img=$_POST['d_img'];
	$color=$_POST['d_color'];
	$price=$_POST['d_price'];

	echo "<script>alert('$update_id')</script>";
		echo "<script>alert('$d_name')</script>";
		echo "<script>alert('$img')</script>";
		echo "<script>alert('$color')</script>";
		echo "<script>alert('$price')</script>";
	
	$query1="update design set Design_name='$d_name',Design_image='$img',Design_color='$color',Price='$price' where Design_id='$update_id'";
		$execute=mysqli_query($conn,$query1);
		if($execute)
		{
			echo "<script>alert('Design has been updated ')</script>";
			echo "<script>window.open('../index.php?link=$link','_self')</script>";
            
       	}
	}
	?>
  </body>
 
  </html>
  
	