<?php
$arhp="";$a_name="";$pin1="";$city_id="";$City_name="";$area_id="";
include("./db.php");
if(isset($_GET['edit_a'])){
	$area_id=$_GET['edit_a'];
	$get_edit="select * from area where Area_id='$area_id'";
	$run_edit=mysqli_query($conn,$get_edit);
	$row_edit=mysqli_fetch_array($run_edit);
				$arhp=$row_edit['Area_id'];
				  $a_name=$row_edit['Area_name'];
                  $pin1=$row_edit['Pincode'];
                  
                  $city_id=$row_edit['city_id'];
	$area_name="select City_name from city where City_id='$city_id'  ";
                  $run_cat1=mysqli_query($conn,$area_name);
				while($row=mysqli_fetch_array($run_cat1))
				{
					$City_name=$row['City_name'];
				}
            }
?>
<html>	
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#a_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_area_name.php",{a_name: brand_check},function(data)
				{
					if(data.status==true)
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#p_num').keyup(function(){
				var pin_check=$(this).val();
				$('#pin_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_area_pin.php",{p_num: pin_check},function(data)
				{
					if(data.status == true)
					{
						$('#pin_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#pin_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#pin_check').html(data.msg);
				},'json');
		});

	});
</script>

<title>UPDATE AREA</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>EDIT AREA</h1>
<hr>
    <label for="name"><b>Enter Area Name</b></label>
    <input type="text" placeholder="Enter Name" name="a_name" id="a_name" value="<?php echo $a_name ;?>" onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
    <span id='brand_check' class="help-block"></span><br>
	<label for="contact"><b>Enter Pincode </b></label><br>
	<input type="number" placeholder="PinCode" name="p_num" id="p_num" value="<?php echo $pin1;?>"><br>
	<span id='pin_check' class="help-block"></span><br>
	<label for="area"><b>Select City</b></label><br>
	<select name="ci">
	  <option disabled="disabled" selected="selected" value="<?php echo $city_id;?>" ><?php echo $City_name?></option>

<?php


$query="select * from city";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["City_name"];
	echo "<option value='$var'>".$row["City_name"]."</option>";
}	
?>
</select>

	<hr>
    <input type="submit" class="registerbtn" name="submit" value="UPDATE">
    <input type="submit" class="registerbtn" value="Cancel" name="cancel">
  </div>
  </form>
  <?php
   $link=1;
   $id5="";
if(isset($_POST['cancel']))
{
	echo "<script>window.open('./index.php?link=$link','_self')</script>";
}
if(isset($_POST['submit'])){
	
	if($_POST['a_name'])
	{
		$a_n=$_POST['a_name'];	
	}
	else
	{
		$a_n=$a_name;
	}
	if($_POST['p_num'])
	{
		$pin=$_POST['p_num'];
	}
	else
	{
		$pin=$pin1;
	}
	if($_POST['ci']){
		$c=$_POST['ci'];
	}
	else
	{
		$id5=$city_id;
	}
	
		
	$id1="";

	$qup="select * from area where Area_name='$a_n'";
			$dupquery=mysqli_query($conn,$qup);
			if(mysqli_num_rows($dupquery)>0)
			{
				echo "<script>alert('Area Name exists Please Enter the right Data.')</script>";
			}
	else{	
	
	$query="select * from city where City_name like '$c'";
		$execute=mysqli_query($conn,$query);
		while($row5=mysqli_fetch_array($execute))
		{
			$id5=$row5['City_id'];
			$na=$row5['City_name'];
		
		}
		$query2="update area set Area_name='$a_n', Pincode='$pin',city_id='$id5' where Area_id='$arhp'" ;
		$execute2=mysqli_query($conn,$query2);
		if($execute2)
		{
			echo "<script>alert('Area has been updated ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
	        
		}
       }
		
	}mysqli_close($conn);
?>
  </body>
  </html>