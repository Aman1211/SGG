<?php
		$sal="";
		if(isset($_REQUEST['s_id']))
		{
				$sal=$_REQUEST['s_id'];
		}
		
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<script>
	
	function abc(val)
	{
			
				var a=document.getElementsByName("cno");
				var b=document.getElementsByName("bname");

		if(val=="Cheque")
		{
				document.getElementById("c").disabled=false;
				document.getElementById("b").disabled=false;
				document.getElementById("e").disabled=true;
			
		}
		else if(val=="Online")
		{
			document.getElementById("e").disabled=false;
			
			document.getElementById("c").disabled=true;
				document.getElementById("b").disabled=true;
		}
		else if(val=="Cash")
		{
			document.getElementById("e").disabled=true;
			
			document.getElementById("c").disabled=true;
			document.getElementById("b").disabled=true;
		}

	}
	</script>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD SALES PAYMENT</h1>
<hr>
   

	<label for="price"><b>Enter Payment Date</b></label>
    <input type="date" placeholder="Enter Payment Date" name="date" required><br>
    
 	<label for="price"><b>Select Payment Type</b></label>
    <select name="type" onchange="abc(this.value);" required>
	  <option disabled="disabled" selected="selected">Payment Type</option>
		<?php
		$query2="select  Payment_type_name from payment_type";
		$result2=mysqli_query($conn,$query2);
		while($row2=mysqli_fetch_assoc($result2))
		{
			$var=$row2["Payment_type_name"];
			echo "<option value='$var'>".$row2["Payment_type_name"]."</option>";
		}	
		?>
	</select>
 	
 	<label for="price"><b>Enter Bank Name</b></label>
    <input type="text" placeholder="Bank Name" name="bname" id="b" disabled><br>
	
	<label for="price"><b>Enter Cheque No</b></label>
    <input type="text" placeholder="Cheque Number [First 6 Digit] if Payment type is Cheque" name="cno" id="c" min="000000" max="999999"disabled><br>
   
    <label for="price"><b>Enter Transaction Id</b></label>
    <input type="text" placeholder="Transaction Id" name="tra_id" id="e" disabled><br>

	
    
    <label for="gst"><b>Enter Gst</b></label>
    <input type="number" placeholder="Enter The Gst Precenteage" name="gst" required min="5" max="18"><br>

    <label for="price"><b>Enter Amount</b></label>
    <input type="number" placeholder="Amount" name="amount" min="1"><br>

	<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
   <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=34'">Cancel</button>
  </div>
  
 
</form>
<?php
$link=34;
include("./db.php");
$ty="";
	if(isset($_POST['submit'])){
		$date=$_POST['date'];
		$p_type=$_POST['type'];
		$q="SELECT * FROM `payment_type` WHERE `Payment_type_name` ='$p_type'";
		$qr=mysqli_query($conn,$q);
		while($qr_row=mysqli_fetch_array($qr)){$ty=$qr_row['Payment_type_id'];}
		
		
		
		$amo=$_POST['amount'];
		$gst=$_POST['gst'];
		$d=date('Y-m-d');
		if($date>$d){
				echo "<script>alert('Invalid Date please Select Proper Date')</script>";
		}else{
		if($p_type=='Cash')
		{
			$query="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`) VALUES ('$sal','$amo','$gst','$date','$ty')";
		}
		else if($p_type=='Cheque')
		{
			$bank_name=$_POST['bname'];
			$cheque_no=$_POST['cno'];
				$query="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`, `Cheque_no`, `Bank_Name`) VALUES ('$sal','$amo','$gst','$date','$ty','$cheque_no','$bank_name')";
		}
		if($p_type=='Online')
		{
			$tra_id=$_POST['tra_id'];
					$query="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`,`Transaction_id`) VALUES ('$sal','$amo','$gst','$date','$ty','$tra_id')";
		}
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
				echo "<script>alert('Sales Payment has been Added ')</script>";
				echo "<script>window.open('./index.php?link=35&s_id=$sal','_self')</script>";
		}
		else
		{
				echo "<script>alert('Purchase Payment has Not been Added plz try again')</script>";
		}
		}
	}
?>
</body>
</html>
