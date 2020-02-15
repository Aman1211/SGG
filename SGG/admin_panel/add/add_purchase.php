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
    <h1>ADD PURCHASE</h1>
<hr>
   
	<label for="type"><b>Select Supplier</b></label>
<select name="supplier">
	  <option disabled="disabled" selected="selected">Supplier</option>
<?php

include ("./db.php");
$query="select *  from supplier";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Supplier_name"];
	echo "<option value='$var'>".$row["Supplier_name"]."</option>";
}	
?>
</select>
<label for="price"><b>Enter Date</b></label>
    <input type="date" placeholder="Enter Purchase Date" name="date" required><br>
	<label for="price"><b>Enter GST Percentage</b></label>
  
    <input type="text" placeholder="Enter GST" name="gst" required>
		<label for="price1"><b>Total</b></label>
    <input type="number" placeholder="Enter Total" name="total"  required >
   
<hr>
	 <input type="submit" class="registerbtn" name="submit1" value="Insert">
	<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=25'">Cancel</button>
	 
  </div>
  
 
</form>
<?php
		if(isset($_POST['submit1']))
		{$d="";
			$sup=$_POST['supplier'];
			$date=$_POST['date'];
			$gst=$_POST['gst'];
			$total=$_POST['total'];
			$d=date('Y-m-d');
			if($date>$d){
				echo "<script> alert('Invalid Date')</script>";
			}
			else{
			$query="select Supplier_id from supplier where Supplier_name='$sup'";
			$execute=mysqli_query($conn,$query);
			while($row=mysqli_fetch_array($execute))
			{
				$s_id=$row['Supplier_id'];
			}
			$query1="insert into purchase (Purchase_date,Supplier_id,GST,Amount) values('$date','$s_id','$gst','$total')";
			$execute1=mysqli_query($conn,$query1);
			if($execute1)
			{	
				echo "<script> location.href='./index.php?link=25'</script>";
			    
			}
		}
		}
		mysqli_close($conn);
		?>
</body>
</html>