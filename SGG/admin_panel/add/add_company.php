<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<title>ADD COMPANY</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD COMPANY</h1>
<hr>
    <label for="name"><b>Enter Company Name</b></label>
    <input type="text" placeholder="Enter Name" name="c_name" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"required>
	<label for="contact"><b>Enter Contact </b></label>
	<input type="number" placeholder="Contact Number" name="c_num" required min="0000000000" max="9999999999">
	<label for="address"><b>Address </b></label><br>
	<textarea name="add" rows="5" required></textarea><br>
	<label for="email"><b>Email</b></label>
	<input type="email" placeholder="Email" name="email">
	<label for="area"><b>Select Area</b></label>
	<select name="area" required>
	  <option disabled="disabled" selected="selected">Area</option>
<?php
include ("./db.php");
$query="select *  from area";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Area_name"];
	echo "<option value='$var'>".$row["Area_name"]."</option>";
}	
?>
</select>
<label for="gst"><b>GST_NO</b></label>
	<input type="text" placeholder="GST Number" name="gst" required>
	<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=12'">Cancel</button>
  </div>
  </form>
  <?php
   $link=12;

if(isset($_POST['submit']))
{
	function val_email()
{
	$email1=$_POST['email'];
	if(!filter_var($email1, FILTER_VALIDATE_EMAIL)) { 
	 echo "<script type='text/javascript'>alert('Invalid Email')</script>";
	}
	else
	{
		return 1;
	}	
}
function val_con()
{
	$contact1=$_POST['c_num'];
	if(is_numeric($contact1) and strlen($contact1)<=10 and strlen($contact1)>=8)
	{
		return 1;
}
else{
	 echo "<script type='text/javascript'>alert('Invalid contact number')</script>";
}
}
	$num2=val_email();
	$num3=val_con();
	function val_gst()
{
	$gst=$_POST['gst'];
	if(strlen($gst)==15)
	{
		return 1;
}
else{
	 echo "<script type='text/javascript'>alert('Invalid GST Number')</script>";
}
}
$num=val_gst();
if($num==1 and $num2==1 and $num3==1)
{
	
	$c_name=$_POST['c_name'];
	$con=$_POST['c_num'];
	$add=$_POST['add'];
	$email=$_POST['email'];
	$area=$_POST['area'];
	$gst=$_POST['gst'];
	
		$qup="select * from Company where Contact='$con' and Address='$add";
		$dupquery=mysqli_query($conn,$qup);
		if(mysqli_num_rows($dupquery)>0)
		{
			echo "<script>alert('Company is already exists.')</script>";
		}
		else
		{
			$query="select * from area where Area_name like '$area'";
			$execute=mysqli_query($conn,$query);
			while($row=mysqli_fetch_array($execute))
			{
				$id1=$row['Area_id'];
			}
			$query2="insert into company (Company_name,Contact,Address,Email_id,Area_id,GST_NO) values('$c_name','$con','$add','$email','$id1','$gst')";
			$execute2=mysqli_query($conn,$query2);
			if($execute2)
			{
				echo "<script>alert('Company has been Added ')</script>";
				echo "<script>window.open('./index.php?link=12','_self')</script>";
      		}
      	}
	}
}mysqli_close($conn);
  ?>
  </body>
  </html>
  