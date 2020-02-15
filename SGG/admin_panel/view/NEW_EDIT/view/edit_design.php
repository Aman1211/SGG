<?php
	include("./db.php");
	if(isset($_GET['edit_design'])){
		$edit_design_id=$_GET['edit_design'];
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#d_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_design.php",{brand_name: brand_check},function(data)
				{
					if(data.status == true)
					{
						$('#brand_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#brand_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#brand_check').html(data.msg);
				},'json');
		});

	});

</script>
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>UPDATE DESIGN</h1>
<hr>
    <label for="name"><b>Design Name</b></label>
    <input type="text" placeholder="Design Name" name="d_name" id="d_name" required value="<?php echo $design_name;?>" onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/><br>
     <span id='brand_check' class="help-block"></span>
	<label for="image"><b>Select Image</b></label><br>
	<input type="file" placeholder="Design  Image" name="d_img" required value="<?php echo $design_image;?>"><br>
	 <label for="color"><b>Design Color</b></label><br>
    <input type="color" placeholder="Design color" name="d_color" required value="<?php echo $desgin_color;?>"><br>
	 <label for="price"><b>Design Price</b></label>
    <input type="number" placeholder="Design Price" name="d_price" required value="<?php echo $design_price;?>"><br>
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

	$qup="select * from design where Design_name='$d_name'";
	$dupquery=mysqli_query($conn,$qup);
	if(mysqli_num_rows($dupquery)>0)
	{
		echo "<script>alert('Design_name is already exists.')</script>";
	
	}
	else
		{
	
		$query1="update design set Design_name='$d_name',Design_image='$img',Design_color='$color',Price='$price' where Design_id='$update_id'";
		$execute=mysqli_query($conn,$query1);
		if($execute)
		{
			echo "<script>alert('Design has been updated ')</script>";
			echo "<script>window.open('../index.php?link=$link','_self')</script>";
        }
       }
	
	}
	?>
  </body>
 
  </html>
  
	