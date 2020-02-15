<?php
include("./db.php");
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
<title>ADD COMPANY</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>EDIT COMPANY</h1>
<hr>
    <label for="name"><b>Enter Company Name</b></label>
    <input type="text" placeholder="Enter Name" name="c_name" value="<?php echo $co_name ;?>"  required>
	<label for="contact"><b>Enter Contact </b></label>
	<input type="text" placeholder="Contact Number" name="c_num" value="<?php echo $con;?>"  required>
	<label for="address"><b>Address </b></label><br>
                  <input type="text" placeholder="Address" name="add" value="<?php echo $co_add;?>"  required>
	 

	<label for="email"><b>Email</b></label>
	<input type="text" placeholder="Email" name="email" value="<?php echo $co_e_id;?>">
	<label for="area"><b>Select Area</b></label>
	<select name="area" required>
	  <option disabled="disabled" selected="selected" value="<?php echo $area;?>" >"<?php echo $Area_name1;?>" </option>
<?php

include ("./db.php");
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
  </div>
  </form>
  <?php
   $link=7;
include("./db.php");
if(isset($_POST['UPDATE_COMPANY']))
{
	function val_gst()
{
	$gst=$_POST['gst'];
	echo "<script>  alert('$gst') </script>";
	$num=strlen($gst);
	echo "$num";
	if(strlen($gst)==16)
	{
		return 1;
}
else{
	 echo "<script type='text/javascript'>alert('Invalid GST Number')</script>";
}
}
$num=val_gst();
if($num==1)
{$c_name=$_POST['c_name'];
	$con=$_POST['c_num'];
	$add=$_POST['add'];
	$email=$_POST['email'];
	$area=$_POST['area'];
	$gst=$_POST['gst'];
	
		$query="select * from area where Area_name like '$area'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Area_id'];
		}
		$query2="update company set Company_name='$c_name', Address='$add', Email_id='$email'  ,Area_id='$id1',Contact='$con' ,GST_no='$gst'  where Company_id='$company_id'" ;
		$execute2=mysqli_query($conn,$query2);
		if($execute2)
		{
			echo "<script>alert('Company has been updated ')</script>";
			echo "<script>window.open('../index.php?link=$link','_self')</script>";
        
		}
	}
}
  ?>
  </body>
  </html>