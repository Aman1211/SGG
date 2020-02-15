<?php
include("./db.php");
$sql="select MAX(Purchase_return_id) from purchase_return";
$result=mysqli_query($conn,$sql);
$pr_id="";
while($row1=mysqli_fetch_array($result))
{
	$pr_id=$row1['MAX(Purchase_return_id)'];
}
$sql2="select Purchase_id from  purchase_return where Purchase_return_id='$pr_id'";
$result2=mysqli_query($conn,$sql2);
$pur_id="";
while($row2=mysqli_fetch_array($result2))
{
	$pur_id=$row2['Purchase_id'];
}

?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<script>
 function reset()
 {
	 document.getElementById("myform").reset();
 }
</script>
</head>
<body>

<form action="" method="post" id="myform">
  <div class="container">
    <h1>ADD PURCHASE_RETURN_DETAILS</h1>
<hr>
   
	<select name="product">
		<option disabled="disabled" selected="selected">product</option>
		<?php
		include("./db.php");
		$query="select * from product where Product_id in(select Product_id  from purchase_detail where Purchase_id='$pur_id')";
		$result=mysqli_query($conn,$query);
		$var2="";
		while($row=mysqli_fetch_array($result))
		{
			$var=$row["Product_name"];
			echo "<option value='$var'>" .$row["Product_name"]. "</option>";
		}
		?>
	</select>


 
		<label for="qty"><b>QTY</b></label>
    <input type="text" placeholder="Enter Qty" name="qty"  >
 
    	
<hr>
	 <input type="submit" class="registerbtn" name="submit1" value="Insert Product">
	 <button class="registerbtn" name="submit2" >VIEW</button>
  </div>
  
 
</form>
<?php
		$pro_id="";

     
      		if(isset($_POST['submit1']))
      		{
      			$var3=$_POST['product'];
      			$sql3="select Product_id from product where Product_name='$var3'";
      			$result3=mysqli_query($conn,$sql3);
      			while($row3=mysqli_fetch_array($result3))
      			{
      				$pro_id=$row3['Product_id'];
      			}
      			 $sql2="Select * from purchase_detail where Product_id='$pro_id' and Purchase_id='$pur_id'";
      $result2=mysqli_query($conn,$sql2);
      $s_w="";
      $s_h="";
      while($row2=mysqli_fetch_array($result2))
      {
      	$s_w=$row2['Size_Height'];
      	$s_h=$row2['Size_Width'];
      }
      			$var4=$_POST['qty'];
      			if(isset($_POST['product']) and isset($_POST['qty']))
      			{
      				$query5="insert into purchase_return_details (purchase_return_id,Product_id,Size_Height,Size_Width,qty) values('$pr_id','$pro_id','$s_w','$s_h','$var4')";
      			
			$execute5=mysqli_query($conn,$query5);
			echo "<script> alert('Detail  has been added'); </script>";
			echo "<script> reset(); </script>";
      		}
      	}
      		if(isset($_POST['submit2']))
{
	echo "<script>window.open('./index.php?link=48','_self')</script>";
}mysqli_close($conn);

?>
</body>
</html>