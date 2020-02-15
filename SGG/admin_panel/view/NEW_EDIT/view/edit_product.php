<?php
	include("./db.php");
	if(isset($_GET['edit_product'])){
		$edit_product=$_GET['edit_product'];
		echo "<script>alert('$edit_product')</script>";
	 	$qu="select * from product where Product_id='$edit_product'";
		$run=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run);
		$update_id=$row_edit['Product_id'];
		$p_name=$row_edit['Product_name'];
		$d_id=$row_edit['Design_id'];
		
		$qu1="select * from design where Design_id='$d_id'";
		$run_cat1=mysqli_query($conn,$qu1);
				while($row=mysqli_fetch_array($run_cat1))
				{
					$design_name=$row['Design_name'];
				}
		$s_id=$row_edit['Subcategory_id'];
		$qu2="select * from subcategory where Subcategory_id='$s_id'";
		$run2=mysqli_query($conn,$qu2);
		while ($rowh=mysqli_fetch_array($run2)) {
			$sub_name=$rowh['Subcategory_name'];
		}
		$b_id=$row_edit['Brand_id']; 
		$qu3="select * from brand where Brand_id='$b_id'";
		$run3=mysqli_query($conn,$qu3);
		while ($rowh=mysqli_fetch_array($run3)) {
			$b_name=$rowh['Brand_name'];
		}
		$p_s_id=$row_edit['Price_size_id'];
		$qu4="select * from price_size where Price_Size_id='$p_s_id'";
		$run4=mysqli_query($conn,$qu4);
		while ($rowp=mysqli_fetch_array($run4)) {
			$thic=$rowp['Thickness'];
		}
		$price=$row_edit['Price'];
	}

?>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>
<form action="" method="post">
  <div class="container">
    <h1>EDIT PRODUCT</h1>
<hr>
    <label for="name"><b>Product Name</b></label>
    <input type="text" placeholder="Enter Product Name" name="p_name" value="<?php echo $p_name;?>" required>
	<label for="type"><b>Select Design</b></label>
<select name="design" onchange="dname()" id="aman">
	  <option disabled="disabled" selected="selected" value="<?php echo $d_id;?>" ><?php echo $design_name;?></option>
<?php

include ("../db.php");
$query="select *  from design";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Design_name"];
	echo "<option value='$var' >".$row["Design_name"]."</option>";
	
}

?>

</select>

    <label for="type"><b>Select Subcategory</b></label>

<select name="sub">
	  <option disabled="disabled" selected="selected" value="<?php echo $s_id;?>" ><?php echo $sub_name;?></option>
<?php
include ("./db.php");
$query="select *  from subcategory";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Subcategory_name"];
	echo "<option value='$var'>".$row["Subcategory_name"]."</option>";
}	
?>
</select>
<label for="type"><b>Select Brand</b></label>
<select name="brand">
	  <option disabled="disabled" selected="selected" value="<?php echo $b_id;?>" ><?php echo $b_name;?> </option>
<?php
include ("../db.php");
$query="select *  from brand";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Brand_name"];
	echo "<option value='$var'>".$row["Brand_name"]."</option>";
}	
?>
</select>
<label for="type"><b>Select Thickness</b></label>
<select name="thick">
	  <option disabled="disabled" selected="selected" value="<?php echo $p_s_id;?>" ><?php echo $thic;?></option>
<?php

include ("./db.php");
$query="select *  from price_size";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Thickness"];
	echo "<option value='$var'>".$row["Thickness"]."</option>";
}	
?>
</select>
<hr>
    <input type="submit" class="registerbtn" name="submit" value="Update">
	
  </div>
  
 
</form>
<?php
include("./db.php");
$link=23;
		if(isset($_POST['submit']))
		{
			$name=$_POST['p_name'];
			$design=$_POST['design'];
			
			$sub=$_POST['sub'];
			$brand=$_POST['brand'];
			$thick=$_POST['thick'];
			$query="select Design_id from design where Design_name like '$design'";
			$execute=mysqli_query($conn,$query);
			while($row=mysqli_fetch_array($execute))
			{
				$d_id=$row['Design_id'];
			}
			$query8="select Price from design where Design_name like '$design'";
			$execute8=mysqli_query($conn,$query8);
			while($row8=mysqli_fetch_array($execute8))
			{
				$price=$row8['Price'];
			}
			$query1="select Subcategory_id from subcategory where Subcategory_name like '$sub'";
			$execute1=mysqli_query($conn,$query1);
			while($row1=mysqli_fetch_array($execute1))
			{
				$s_id=$row1['Subcategory_id'];
			}
			$query2="select Brand_id from brand where Brand_name like '$brand'";
			$execute2=mysqli_query($conn,$query2);
			while($row2=mysqli_fetch_array($execute2))
			{
				$b_id=$row2['Brand_id'];
			}
			$query3="select Price_Size_id from price_size where Thickness like '$thick'";
			$execute3=mysqli_query($conn,$query3);
			while($row3=mysqli_fetch_array($execute3))
			{
				$t_id=$row3['Price_Size_id'];
			}
			$query9="select Price from price_size where Thickness like '$thick'";
			$execute9=mysqli_query($conn,$query9);
			while($row9=mysqli_fetch_array($execute9))
			{
				$tprice=$row9['Price'];
			}
			$total=$price+$tprice;
		$query4="update product set Product_name='$name',Design_id='$d_id',Subcategory_id='$s_id' ,Brand_id='$b_id',Price_size_id='$t_id',Price='$total' where Product_id='$update_id'";
			$execute4=mysqli_query($conn,$query4);
			if($execute4)
			{
				echo "<script>alert('Product has been updated')</script>";
			 	echo "<script> location.href='./index.php?link=$link'</script>";
			
			}
		}
		
?>
</body>
</html>