<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD LABOUR</h1>
<hr>
    <label for="email"><b>Enter Labour Name</b></label>
    <input type="text" placeholder="Enter Name" name="l_name" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)|| (event.charCode==32)"required>

    <label for="psw"><b>Enter Contact Number</b></label>
    <input type="number" placeholder="Enter Contact" name="contact" required min="0000000000" max="9999999999">
	<label for="type"><b>Select Labour Type</b></label>
<select name="type" required="">
	  <option disabled="disabled" selected="selected">Labour Type</option>
<?php
include ("./db.php");
$query="select *  from labour_type";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Labour_type_name"];
	echo "<option value='$var'>".$row["Labour_type_name"]."</option>";
}	
?>
</select>
    
<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=30'">Cancel</button>
  </div>
  
 
</form>
<?php
$link=30;

if(isset($_POST['submit']))
{
	function val_con()
{
	$contact1=$_POST['contact'];
	if(is_numeric($contact1) and strlen($contact1)<=10 and strlen($contact1)>=8)
	{
		return 1;
}
else{
	 echo "<script type='text/javascript'>alert('Invalid contact number')</script>";
}
}
$num=val_con();
if($num==1)
{
	$l_name=$_POST['l_name'];
	$con=$_POST['contact'];
	$t_name=$_POST['type'];
	

		$query="select * from labour_type where Labour_type_name like '$t_name'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Labour_type_id'];
		}

		$query1="insert into labour (Labour_type_id,Worker_name,Worker_contact) values('$id1','$l_name','$con')";
		$execute1=mysqli_query($conn,$query1);
		if($execute1)
		{
			echo "<script>alert('Labour has been Added ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        }
	}
}mysqli_close($conn);
?>
</body>
</html>
