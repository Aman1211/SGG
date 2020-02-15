<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<script>
 function reset()
 {
	 	
	 document.getElementById("myform").reset();
 }
 	function abc() {
		var abc=$('.hp').val();
		
		$.ajax({	
					method:"POST",
					url:"./add/get_thick.php",
						
						data:"id="+abc,
						success:function(data){
							document.getElementById('rilex').value=data;
    						}
					});
	}
</script>
</head>
<body>

<form action="" method="post" id="myform">
  <div class="container">
    <h1>ADD PURCHASE DETAIL</h1>
<hr>
   <label for="name"><b>Select Product</b></label>
<select name="product" class="hp" onchange="abc();">
	  <option disabled="disabled" selected="selected">Product<option>
	<?php

include ("./db.php");$pid="";
$query="select *  from product";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$pid=$row['Product_id'];
	$var=$row["Product_name"];
	echo "<option value='$pid'>".$row["Product_name"]."</option>";
}	
?>
</select>
<label for="height"><b>Product THICKNESS</b></label>
 <input type="text" id="rilex" disabled>
<label for="height"><b>Product Height</b></label>
 <input type="number" placeholder="Enter Height" name="height" min="3" max="144">
	<label for="price"><b>Product Width</b></label>
    <input type="number" placeholder="Enter Width" name="width" min="3" max="144">
		<label for="price"><b>Qty</b></label>
    <input type="number" placeholder="Enter Quantity" name="qty" min="1" max="30">
		<label for="price"><b>Price</b></label>
    <input type="number" placeholder="Enter Price" name="price" min="1">
	<hr>
	 <input type="submit" class="registerbtn" name="submit2" value="ADD">
	 <button class="registerbtn" name="submit1" >VIEW</button>
	<button name="cancel" class="registerbtn" name="cancel">Cancel</button>	 
	</div>
</form>

<?php
$link=14;
if(isset($_POST['cancel']))
{
	echo "<script>window.open('./index.php?link=14','_self')</script>";
}
if(isset($_POST['submit2']))
{
$query="select MAX(Purchase_id) from purchase";
$execute=mysqli_query($conn,$query);
$pur_id="";
while($row=mysqli_fetch_array($execute))
{
	$pur_id=$row['MAX(Purchase_id)'];
}
if(isset($_POST['product']) and isset($_POST['height']) and isset($_POST['width']) and isset($_POST['qty']) and isset($_POST['price']))
$product=$_POST['product'];
$height=$_POST['height'];
$width=$_POST['width'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$pro_id="";

$query2="insert into purchase_detail (Purchase_id,Product_id,Size_Height,Size_Width,Qty,Price) values('$pur_id','$product','$height','$width','$qty','$price')";
$execute2=mysqli_query($conn,$query2);
if($execute2)
{
	echo "<script> reset(); </script>";
}
else
{
	echo "<script> alert('Fill All The Fields')</script>";
	
}
}
if(isset($_POST['submit1']))
{
	echo "<script>window.open('./index.php?link=$link','_self')</script>";
}mysqli_close($conn);
?>
</body>

</html>