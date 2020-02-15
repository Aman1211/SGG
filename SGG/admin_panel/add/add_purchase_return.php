<?php
include "./db.php";
if(isset($_GET['add_pur']))
{
	$pur_id=$_GET['add_pur'];
	$sql5="select Supplier_id from purchase where Purchase_id='$pur_id'";
	$result5=mysqli_query($conn,$sql5);
	$sup_name="";
	while($row5=mysqli_fetch_Array($result5))
	{
		$sup_id=$row5['Supplier_id'];
		$sql6="select Supplier_name from supplier where Supplier_id='$sup_id'";
		$result6=mysqli_query($conn,$sql6);
		while($row6=mysqli_fetch_Array($result6))
		{
			$sup_name=$row6['Supplier_name'];
		}
	}
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
    <h1>ADD PURCHASE_RETURN</h1>
<hr>
   
	
<label for="price"><b>Supplier</b></label>
    <input type="text" name="supplier" value="<?php echo $sup_name; ?>" required><br>
<label for="price"><b>Enter Date</b></label>
    <input type="date" placeholder="Enter Purchase Return Date" name="date" required><br>
	<label for="price"><b>Enter Credit Note id</b></label>
  
    <input type="text" placeholder="Credit Note ID" name="cn">
		<label for="price1"><b>Credit Amount</b></label>
    <input type="text" placeholder="Credit Amount" name="credit" >
    	
<hr>
	 <input type="submit" class="registerbtn" name="submit1" value="Insert">
  </div>
  
 
</form>
<?php


$link=47;
		if(isset($_POST['submit1']))
		{
	
			$date=$_POST['date'];
			$credit_id=$_POST['cn'];
			$credit_amount=$_POST['credit'];
			
				if($credit_id)
				{
				$query1="insert into purchase_return (Purchase_id,Purchase_return_date,Credit_note_id,Credit_amount) values('$pur_id','$date','$credit_id','$credit_amount')";
			$execute1=mysqli_query($conn,$query1);
				}
				else
				{
					echo "<script> alert('Aman'); </script>";
					$query1="insert into purchase_return (Purchase_id,Purchase_return_date) values('$pur_id','$date')";
			$execute1=mysqli_query($conn,$query1);
				}   
					
			if($execute1)
			{
				echo "<script> alert('Purchase Return has been added')</script>";
				echo "<script> location.href='./index.php?link=54'</script>";
			    
			}
		}mysqli_close($conn);
		?>

</body>
</html>