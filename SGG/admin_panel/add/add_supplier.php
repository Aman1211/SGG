<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD SUPPLIER</h1>
<hr>
    <label for="name"><b>Enter Supplier Name</b></label>
    <input type="text" placeholder="Enter Name" name="s_name" required onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">

	<label for="contact"><b>Enter Contact </b></label>
	<input type="number" placeholder="Contact Number" name="c_num" min="0000000000" max="9999999999" required>
	
	<label for="address"><b>Address </b></label><br>
	<textarea name="add" rows="5" required></textarea><br>
	
	<label for="add2"><b>Address1 </b></label><br>
	<textarea name="add1"  rows="5"></textarea><br>
	
	<label for="email"><b>Email</b></label>
	<input type="email" placeholder="Email" name="email" required>
	
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
<label for="company"><b>Select Company</b></label>
	<select name="company" required>
	  <option disabled="disabled" selected="selected">Company</option>
<?php

$query="select *  from company";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Company_name"];
	echo "<option value='$var'>".$row["Company_name"]."</option>";
}	
?>
</select>
<label for="gst"><b>GST_NO</b></label>
	<input type="text" placeholder="GST Number" name="gst" required>
	<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=19'">Cancel</button>
  </div>
  </form>
  <?php
  $link=19;

if(isset($_POST['submit']))
{
	function val_gst()
{
	$gst=$_POST['gst'];

	if(strlen($gst)==16)
	{
		return 1;
	}
	else{
	 echo "<script type='text/javascript'>alert('Invalid GST Number')</script>";
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
$num2=val_email();
$num=val_gst();
$num1=val_con();
if($num==1 and $num1==1 and $num2==1)
{
	$s_name=$_POST['s_name'];
	$con=$_POST['c_num'];
	$add=$_POST['add'];
	$add1=$_POST['add1'];
	$email=$_POST['email'];
	$area=$_POST['area'];
	$company=$_POST['company'];
	$gst=$_POST['gst'];
	$id1="";
	$id2="";
		$query="select * from area where Area_name like '$area'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Area_id'];
		}
		$query1="select * from company where Company_name like '$company'";
		$execute1=mysqli_query($conn,$query1);
		while($row1=mysqli_fetch_array($execute1))
		{
			$id2=$row1['company_id'];
		}
		$sn="SELECT `Supplier_name` FROM `supplier` WHERE `Supplier_name` = '$s_name'";
		$snrun=mysqli_query($conn,$sn);
		$sc=mysqli_num_rows($snrun);
		if($sc>0){
			echo "<script>alert('Supplier Name is Already Exists')</script>";
		}
		else
		{

		$query2="insert into supplier (Supplier_name,Sup_contact,Address1,Address2,Sup_Email_id,Area_id,Company_id,GST_NO) values('$s_name',$con,'$add','$add1','$email',$id1,$id2,'$gst')";
		$execute2=mysqli_query($conn,$query2);
		if($execute2)
		{
			echo "<script>alert('Supplier has been Added ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        }
    }
	}
}mysqli_close($conn);
?>
</body>
</html>

  </body>
  </html>