<!DOCTYPE html>
<html>
<head>
	<title>ADD AREA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<script type="text/javascript">
function check()

{
	alert("kjvj");
	var id=document.createTextNode("Field id Mandatory");
	if(var.value.length()==0)
	{
			document.getElementById("abc").innerhtml()=id;

	}
}
</script>
</head>
<body>
		<form action="" method="post" name="form1" >
		<div class="container">
    <h1>ADD AREA</h1>
<hr>
    <label for="email"><b>Enter Area Name</b></label>
    <input type="text" placeholder="Enter Name" name="area_title" autocomplete="off"  onBlur="check()"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" id="name" required>
    <div id="abc"></div><br>
	 <label for="pincode"><b>Enter Pincode</b></label>
    <input type="number" placeholder="Enter Pincode" name="pincode_title" required min="0000000" max="999999" id="code">
    <div id="xyz"></div><br>
	<label for="type"><b>Select City</b></label>
		<select name="city" required>
		<option disabled="disabled" selected="selected">Select City</option>
		<?php
		include("./db.php");
		$query="select City_name from city";
		$result=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($result))
		{
			$var=$row["City_name"];
			echo "<option value='$var'>" .$row["City_name"]. "</option>";
		}
		?>
	</select>
		<input type="submit" name="insert_area" class="registerbtn" value="Insert">
		<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=1'">Cancel</button>
		</div>
		</form>
<?php

$link=1;

	if(isset($_POST['insert_area']))
	{
		
			$cat_title=$_POST['area_title'];
			$pin_title=$_POST['pincode_title'];
			$city=$_POST['city'];
			$qup="select * from area where Area_name='$cat_title'";
			$dupquery=mysqli_query($conn,$qup);
			if(mysqli_num_rows($dupquery)>0)
			{
				echo "<script>alert('Area Name is already exists Please Enter the right Data.')</script>";
			}
			else{
					$cityid="select City_id from city where City_name like '$city'";
					$run_cat1=mysqli_query($conn,$cityid);
					while($row=mysqli_fetch_array($run_cat1))
					{
						$c_id=$row['City_id'];
					}
					if(strlen($pin_title)==6)
					{
					$insert_cat="insert into area (Area_name,Pincode,city_id) values ('$cat_title','$pin_title','$c_id')";
						$run_cat=mysqli_query($conn,$insert_cat);
						if($run_cat)
						{
							echo "<script>alert ('New Area Has Been Inserted')</script>";
							echo "<script>window.open('./index.php?link=$link','_self')</script>";
						} 		
					}
					else
					{
						echo "<script>alert('Enter Valid Pincode Number')</script>";
					}
					}
				}mysqli_close($conn);
?>
</body>
</html>