<?php
	include("../db.php");
	if(isset($_GET['edit_c'])){
		$edit_brand=$_GET['edit_c'];
		$qu="select * from category where Category_id='$edit_brand'";
		$run_query=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run_query);
		$update_id=$row_edit['Category_id'];
		$Brand_name=$row_edit['Category_name'];
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
		$('#b_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_category.php",{brand_name: brand_check},function(data)
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

  </head>
<body>

<form action="" method="post">
  <div class="from-group">
    <h1>UPDATE CATEGORY</h1>
<hr>
    <label for="exampleInputEmail1"><b>Category Name</b></label>
    <input type="text" placeholder="Enter Category Name" name="b_name" id="b_name" required value="<?php echo $Brand_name;?>" onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/><br>
    <span id='brand_check' class="help-block"></span>

	<hr>
	 <input type="submit" class="registerbtn" name="submit" value="UPDATE">
  </div>
  </form>
  <?php
	$link=17;
include("../db.php");
if(isset($_POST['submit']))
{


	$b_name=$_POST['b_name'];
	
	echo "<script>alert('$update_id')</script>";
	$qup="select * from category where Category_name='$b_name'";
	$dupquery=mysqli_query($conn,$qup);
	if(mysqli_num_rows($dupquery)>0)
	{
		echo "<script>alert('Category is already exists.')</script>";
	
	}
	else
		{

	$query1="update category set Category_name='$b_name' where Category_id='$edit_brand'";
		$execute=mysqli_query($conn,$query1);
		if($execute)
		{
			echo "<script>alert('Category has been updated ')</script>";
			//echo "<script>window.open('../index.php?link=$link','_self')</script>";
      echo"<script>window.open('../view_category.php','_self')</script>"  ;    
       	}
       }
	}
	?>
  </body>
  </html>
  
	