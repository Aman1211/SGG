
<?php
	include("./db.php");
	$labour_id="";
	if(isset($_GET['edit_l'])){
		$edit_labour_id=$_GET['edit_l'];
		$qu="select * from labour where Labour_id='$edit_labour_id'";
		$run=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run);
		$update_id=$row_edit['Labour_id'];
		$labour_id=$row_edit['Labour_type_id'];
		$qu1="select Labour_type_name from labour_type where Labour_type_id='$labour_id'";
		$run_qu2=mysqli_query($conn,$qu1);
		while ($row=mysqli_fetch_array($run_qu2)) {
			$type_name=$row['Labour_type_name'];
		}
		$w_name=$row_edit['Worker_name'];
		$w_contact=$row_edit['Worker_contact'];
	}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form method="post">
  <div class="container">


    <h1>UPDATE LABOUR</h1>
	<hr>
    <label for="email"><b>Enter Labour Name</b></label>
    <input type="text" placeholder="Enter Name" name="l_name"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" value="<?php echo $w_name;?>">

    <label for="psw"><b>Enter Contact Number</b></label>
    <input type="number" placeholder="Enter Contact" name="contact" required  min="0000000000" max="9999999999" value="<?php echo $w_contact;?>">
	<label for="type"><b>Select Labour Type</b></label>
	<select name="type" required="">
	  <option disabled="disabled" selected="selected" value="<?php echo $labour_id;?>"><?php echo $type_name ?></option>
	<?php
	
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
    <input type="submit" class="registerbtn" name="submit" value="UPDATE">
    <input type="submit" class="registerbtn" value="Cancel" name="cancel">
  </div>
 </form>
<?php
$link=30;
if(isset($_POST['cancel'])){echo "<script>window.open('./index.php?link=$link','_self')</script>";}
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
	 echo "<script>alert('Invalid contact number')</script>";
	}
}
$num=val_con();
if($num==1)
{	$id1="";
	$l_name=$_POST['l_name'];
	$con=$_POST['contact'];
	if(isset($_POST['type'])){$t_name=$_POST['type'];}else{$id1=$labour_id;}
	
		$query="select * from labour_type where Labour_type_name like '$t_name'";
		$execute=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($execute))
		{
			$id1=$row['Labour_type_id'];
		}
		$query1="update labour set 	Labour_type_id='$id1',Worker_name='$l_name',Worker_contact='$con' where Labour_id='$update_id'";
		$execute1=mysqli_query($conn,$query1);
		if($execute1)
		{
			echo "<script>alert('Labour has been updeted ')</script>";
			echo "<script>window.open('./index.php?link=$link','_self')</script>";
        
		}
	}
}
mysqli_close($conn);
?>
</body>
</html>
