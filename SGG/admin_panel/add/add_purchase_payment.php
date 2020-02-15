<?php
		$pur="";
		if(isset($_GET['s_id']))
		{
				$pur=$_GET['s_id'];
		}
		$sup="";
		$query="select Supplier_id from purchase where Purchase_id='$pur'";
		$result=mysqli_query($conn,$query);
		while($row=mysqli_fetch_Array($result))
		{
			$sup=$row['Supplier_id'];
		}
		$purchase_amount="";$g_amount="";
		$pamount="SELECT `Amount` FROM `purchase` WHERE `Purchase_id` like '$pur'";
		$parun=mysqli_query($conn,$pamount);
		if($parun){
				while($roa=mysqli_fetch_array($parun))
				{
					$purchase_amount=$roa['Amount'];
				}
			}
		 $sum="";
      	$sql1 = "SELECT sum(`paymnet_amount`) FROM `purchase_payment` WHERE `Purchase_id` like '$pur'";
 		$prun=mysqli_query($conn,$sql1);
       	if($prun){
       	 while($rowp=mysqli_fetch_array($prun)){
       	     $sum=$rowp[0];
       	 }
      	}
      	
      	$g_amount=$purchase_amount-$sum;
      	

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
				document.getElementById("d").disabled=true;				
		}
		else if(val=="Online")
		{
			document.getElementById("e").disabled=false;
				document.getElementById("d").disabled=false;
			document.getElementById("c").disabled=false;
				document.getElementById("b").disabled=false;
		}
		else if(val=="Cash")
		{
			document.getElementById("e").disabled=false;
			document.getElementById("d").disabled=false;
			document.getElementById("c").disabled=false;
			document.getElementById("b").disabled=false;
		}

	}
	</script>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD PURCHASE PAYMENT</h1>
<hr>
   

	<label for="price"><b>Enter Payment Date</b></label>
    <input type="date" placeholder="Enter Payment Date" name="date" required><br>
    
 	<label for="price"><b>Select Payment Type</b></label>
    <select name="type" onchange="abc(this.value);">
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
    <input type="text"  placeholder="Cheque Number [First 6 Digit] if Payment type is Cheque" name="cno" id="c" disabled><br>
   
    <label for="price"><b>Enter Transaction Id</b></label>
    <input type="number" min="000000" max="999999" placeholder="Transaction Id" name="tra_id" id="e" disabled><br>

	
    <label for="gst"><b>Enter Gst Percentage</b></label>
    <input type="number" placeholder="Enter The Gst Precentage" name="gst" min="5" max="18" required><br>

    <label for="price"><b>Enter Amount</b></label>
    <input type="number" placeholder="Amount" name="amount" required min="1"><br>

	<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
   <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=14'">Cancel</button>
  </div>
  
 
</form>
<?php
$link=49;
include("./db.php");
$bname="";$cno="";$tra_id="";$tra_date="";
	if(isset($_POST['submit'])){
		$date=$_POST['date'];
		
		$d=date('Y-m-d');
		
		$p_type=$_POST['type'];
		$q="SELECT * FROM `payment_type` WHERE `Payment_type_name` ='$p_type'";
		$qr=mysqli_query($conn,$q);
		while($qr_row=mysqli_fetch_array($qr)){$ty=$qr_row['Payment_type_id'];}
		
		
		$amo=$_POST['amount'];
		$gst=$_POST['gst'];
		$c=0;
		if($date>$d)
		{
		echo "<script>alert('Invalid Date.')</script>";
		$c+=1;	
		}
      	if($amo>$g_amount)
      	{
      		echo "<script>alert('REMAINING AMOUNT $g_amount')</script>";
      		$c+=1;
      	}
      if($c==0){
		if($p_type=='Cash')
		{
		$query="INSERT INTO `purchase_payment`(`Purchase_id`, `Payment_date`, `Payment_type_id`,  `paymnet_amount`, `gst`) VALUES ('$pur','$date','$ty','$amo','$gst')";
		}
		else if($p_type=='Cheque')
		{
			if($_POST['bname']){
			$bank_name=$_POST['bname'];	
			}
			if($_POST['cno']){
			$cheque_no=$_POST['cno'];
			}
			$query="INSERT INTO `purchase_payment`(`Purchase_id`, `Payment_date`, `Payment_type_id`, `Cheque_no`, `paymnet_amount`, `Bank_Name`, `gst`) VALUES ('$pur','$date','$ty','$cheque_no','$amo','$bank_name','$gst')";
		}
		else if($p_type=='Online')
		{
			if($_POST['tra_id'])
			{
				$tra_id=$_POST['tra_id'];	
			}
	

		$query="INSERT INTO `purchase_payment`(`Purchase_id`, `Payment_date`, `Payment_type_id`, `paymnet_amount`,`Transaction_id`, `gst`) VALUES ('$pur','$date','$ty','$amo','$tra_id','$gst')";
		}
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
				echo "<script>alert('Purchase Payment has been Added ')</script>";
				echo "<script>location.href='./index.php?link=69&add_pur=$pur'</script>";
		}
		else
		{
				echo "<script>alert('Purchase Payment has Not been Added plz try again')</script>";
				//echo "<script>window.open('./index.php?link=69','_self')</script>";
		}
		}
	}
?>
</body>
</html>
