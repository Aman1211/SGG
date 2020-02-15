<?php
include("./db.php");
$co_name="";$co_add="";$co_e_id="";$area="";$con="";$gst_no="";
if(isset($_GET['edit_c'])){
	$company_id=$_GET['edit_c'];
	$get_edit="select * from company where company_id='$company_id'";
	$run_edit=mysqli_query($conn,$get_edit);
	$row_edit=mysqli_fetch_array($run_edit);
				  $co_name=$row_edit['Company_name'];
                  $co_add=$row_edit['Address'];
                  $co_e_id=$row_edit['Email_id'];
                  $area=$row_edit['Area_id'];
	$area_name="select Area_name from area where Area_id='$area'  ";
                  $run_cat1=mysqli_query($conn,$area_name);
				while($row=mysqli_fetch_array($run_cat1))
				{
					$Area_name1=$row['Area_name'];
				}
                
                  $con=$row_edit['Contact'];
                   $gst_no=$row_edit['GST_no'];

        
}
?>
<html>	
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#add').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_company_add.php",{brand_name: brand_check},function(data)
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#c_num').keyup(function(){
				var con_check=$(this).val();
				$('#con_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_company_contact.php",{brand_name: con_check},function(data)
				{
					if(data.status == true)
					{
						$('#con_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#con_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#con_check').html(data.msg);
				},'json');
		});
	});
</script>
<title>UPDATE COMPANY</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>EDIT COMPANY</h1>
<hr>
    <label for="name"><b>Enter Company Name</b></label>
    <input type="text" placeholder="Enter Name" name="c_name" value="<?php echo $co_name ;?>"  required onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/>
	<label for="contact"><b>Enter Contact </b></label>
	<input type="number" placeholder="Contact Number" name="c_num" id="c_num" value="<?php echo $con;?>"  required>
	<span id='con_check' class="help-block"></span><br/>
	<label for="address"><b>Address </b></label><br>
    <input type="text" placeholder="Address" name="add" id="add" value="<?php echo $co_add;?>"  required>
	<span id='brand_check' class="help-block"></span><br/>
	<label for="email"><b>Email</b></label>
	<input type="text" placeholder="Email" name="email" value="<?php echo $co_e_id;?>">
	<label for="area"><b>Select Area</b></label>
	<select name="area" required>
	 <option disabled="disabled" selected="selected" value="<?php echo $area;?>" ><?php echo $Area_name1;?></option>
<?php


$query="select Area_name  from area";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Area_name"];
	echo "<option value='$var'>".$row["Area_name"]."</option>";
}	
?>
</select>
<label for="gst"><b>GST_NO</b></label>
	<input type="text" placeholder="GST Number" name="gst" required value="<?php echo $gst_no;?> ">
	<hr>
    <input type="submit" class="registerbtn" name="UPDATE_COMPANY" value="UPDATE">
     <input type="submit" class="registerbtn" value="Cancel" name="cancel">
  </div>
  </form>
  <?php
   $link=12;
if(isset($_POST['cancel'])) {
	echo "<script>window.open('./index.php?link=$link','_self')</script>";
}
if(isset($_POST['UPDATE_COMPANY']))
{
	function val_gst()
	{
	$gst=$_POST['gst'];
	$con=$_POST['c_num'];
	
	$num=strlen($gst);
	
	if(strlen($gst)==16 and strlen($con)==10)
	{
		return 1;
	}
	else{
		 echo "<script type='text/javascript'>alert('Invalid GST Number or Invalid Contact Number')</script>";
		}
	}
$num=val_gst();
if($num==1)
{
	if(isset($_POST['c_name']))
	{
		$c_name=$_POST['c_name'];	
	}	
	else
	{
		$c_name=$co_name;
	}
	if(isset($_POST['c_num']))
	{
		$con=$_POST['c_num'];	
	}
	else
	{
		$con=$con;
	}
	if(isset($_POST['add']))
	{
		$add=$_POST['add'];	
	}
	else
	{
		$add=$co_add;
	}
	if(isset($_POST['email']))
	{
	$email=$_POST['email'];	
	}
	else
	{
		$email=$co_e_id;
	}
	
	if(isset($_POST['area']))
	{
	$area=$_POST['area'];
		$query="select * from area where Area_name like '$area'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Area_id'];
		}
	}
	else
	{
		$id1=$area;
		
	}
	if(isset($_POST['gst']))
	{
		$gst=$_POST['gst'];
	}
	else
	{
		$gst=$gst_no;
	}
	$qup="select * from Company where Contact='$con' and Address='$add";
		$dupquery=mysqli_query($conn,$qup);
		if(mysqli_num_rows($dupquery)>0)
		{
			echo "<script>alert('Company is already exists.')</script>";
		}else{
	

	
		$query2="update company set Company_name='$c_name', Address='$add', Email_id='$email',Area_id='$id1',Contact='$con' ,GST_no='$gst'  where Company_id='$company_id'" ;
		$execute2=mysqli_query($conn,$query2);
		if($execute2)
		{
			echo "<script>alert('Company has been updated ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        
		}
       	
       }
   }
   }mysqli_close($conn);
?>
  </body>
  </html>