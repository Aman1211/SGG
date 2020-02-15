<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD SUBCATEGORY</h1>
<hr>
    <label for="email"><b>Enter Subcategory</b></label>
    <input type="text" placeholder="Enter Name" name="l_name" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)|| (event.charCode==32)"required>
	<label for="type"><b>Select Category</b></label>
<select name="type">
	  <option disabled="disabled" selected="selected">Category</option>
<?php
include ("./db.php");
$query="select *  from category";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Category_name"];
	echo "<option value='$var'>".$row["Category_name"]."</option>";
}	
?>
</select>
    
<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=11'">Cancel</button>
  </div>
  
 
</form>
<?php
$link=11;

if(isset($_POST['submit']))
{
	$l_name=$_POST['l_name'];
	$t_name=$_POST['type'];
		$qup="select * from subcategory where Subcategory_name='$l_name'";
		$dupquery=mysqli_query($conn,$qup);
		if(mysqli_num_rows($dupquery)>0)
		{
			echo "<script>alert('Subcategory  is already exists.')</script>";
		}
else
{
		$query="select * from category where Category_name like '$t_name'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Category_id'];
		}
		$query1="insert into subcategory (Category_id,Subcategory_name) values('$id1','$l_name')";
		$execute1=mysqli_query($conn,$query1);
		if($execute1)
		{
			echo "<script>alert('Subcategory has been Added ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        
		}
	}

}
mysqli_close($conn);
?>
</body>
</html>
