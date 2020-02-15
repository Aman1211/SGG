<?php
function aman(){
	echo "<script>alert('Aman')</script>";
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../add_style.css" type="text/css">
<title>ADD COMPANY</title>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD COMPANY</h1>
<hr>
    <label for="name"><b>Enter Company Name</b></label>
    <input type="text" placeholder="Enter Name" name="c_name" required>
	<label for="contact"><b>Enter Contact </b></label>
	<input type="text" placeholder="Contact Number" name="c_num" required>
	<label for="address"><b>Address </b></label><br>
	<textarea name="add" rows="5" required></textarea><br>
	<label for="email"><b>Email</b></label>
	<input type="text" placeholder="Email" name="email">
	<label for="area"><b>Select Area</b></label>
	<select name="area" onchange='<?php aman();?>' required>
	  <option disabled="disabled" selected="selected">Area</option>
<?php
include ("../db.php");
$query="select *  from area";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Area_name"];
	echo "<option value='$var'>".$row["Area_name"]."</option>";
}	
mysqli_close($conn);?>
</select>
</div>
</form>
</body>
</html>
