<html>
  <title>
        VIEW SALES PAYMENT
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>
   <style>
 input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.search-container button {
 
  padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  border:solid 1px;
}
.search-container button:hover {
  background: #ccc;
}
@media screen and (max-width: 600px) {
   .search-container {
    float: none;
  }
     input[type=text], .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
   input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
<body>
<div class="search-container">
    <form action="" method="post">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit">Search</button>
	  <button type="submit" name="showall">Showall</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="11" align="center">
        <h2>
          View All SALES PAYMENT
        </h2>
      </td>
    </tr>
    <tr>
      <th>SALES_PAYMENT_ID</th>
      <th>SALES_ID</th>
      <th>SALES_DATE</th>
      <TH>AMOUNT</TH>
      <TH>GST</TH>
      <th>PAYMENT_DATE</th>
	  <th>PAYMENT_TYPE</th>
	  <th>CHEQUE_NO</th>
	  <th>BANK_NAME</th>
	  <th>TRANSACTION_DATE</th>
		<th>TRANSACTION_ID</th>
    </tr>
    <?php

      include("./db.php");
	   if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
				
				
				$sql1="select * from sales_payment where Sales_payment_id like '%$search%' or Sales_id like '%$search%' or Amount like '%$search%'  or GST like '%$search%' or cheque_no like '%$search%' or Payment_date like '%$search%' or Bank_name like '%$search%' or Transaction_date like '%$search%'  or Transaction_id like '%$search%'";
				$result1=mysqli_query($conn,$sql1);
				$queryresult=mysqli_num_rows($result1);
				if($queryresult>0)
				{
				while($row1=mysqli_fetch_array($result1))
				{
					$sp_id=$row1['Sales_payment_id'];
					$s_id=$row1['Sales_id'];
					$amt=$row1['Amount'];
					$gst=$row1['GST'];
					$date=$row1['Payment_date'];
					$p_id=$row1['Payment_type_id'];
					$c_no=$row1['Cheque_no'];
					$b_name=$row1['Bank_Name'];
					$t_date=$row1['Transaction_date'];
					$t_id=$row1['Transaction_id'];
					if($p_id==2)
					{
					$sql2="select * from sales_payment where Sales_payment_id='$sp_id' and Sales_id='$s_id' and Amount='$amt' and GST='$gst' and Payment_date='$date' and Payment_type_id='$p_id' and  Cheque_no is NULL and Bank_Name is NULL and Transaction_date is NULL and Transaction_id is NULL";
					$result2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_array($result2))
					{
						$sql3="Select Payment_type_name from payment_type where  Payment_type_id='$p_id'";
						$result3=mysqli_query($conn,$sql3);
						$p_name="";
	
						while($row3=mysqli_fetch_Array($result3))
						{
							$p_name=$row3['Payment_type_name'];
						}
						$sql4="Select Sales_date from sales where Sales_id='$s_id'";
						$result4=mysqli_query($conn,$sql4); 	
						$s_date="";
						while($row4=mysqli_fetch_Array($result4))
						{
							$s_date=$row4['Sales_date'];
						}
						 echo"
          <tr align='center'>
           <td> ".$sp_id."</td>
          <td>".$s_id."</td> 
          <td>".$s_date."</td>
          <td>".$amt."</td>
          <td>".$gst."</td>
          <td>".$date."</td>
		    <td>".$p_name."</td>
			  <td>".$c_no."</td>
			    <td>".$b_name."</td>
				  <td>".$t_date."</td>
				    <td>".$t_id."</td>
		  ";
						
					}
				}
				elseif($p_id==1)
				{
					$sql2="select * from sales_payment where Sales_payment_id='$sp_id' and Sales_id='$s_id' and Amount='$amt' and GST='$gst' and Payment_date='$date' and Payment_type_id='$p_id' and  Cheque_no='$c_no' and Bank_Name='$b_name' and Transaction_date is NULL and Transaction_id is NULL";
					$result2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_array($result2))
					{
						$sql3="Select Payment_type_name from payment_type where  Payment_type_id='$p_id'";
						$result3=mysqli_query($conn,$sql3);
						$p_name="";
						
						while($row3=mysqli_fetch_Array($result3))
						{
							$p_name=$row3['Payment_type_name'];
						}
						$sql4="Select Sales_date from sales where Sales_id='$s_id'";
						$result4=mysqli_query($conn,$sql4); 	
						$s_date="";
						while($row4=mysqli_fetch_Array($result4))
						{
							$s_date=$row4['Sales_date'];
						}
						 echo"
          <tr align='center'>
           <td> ".$sp_id."</td>
          <td>".$s_id."</td> 
          <td>".$s_date."</td>
          <td>".$amt."</td>
          <td>".$gst."</td>
          <td>".$date."</td>
		    <td>".$p_name."</td>
			  <td>".$c_no."</td>
			    <td>".$b_name."</td>
				  <td>".$t_date."</td>
				    <td>".$t_id."</td>
		  ";
						
					}
				}
				elseif($p_id==3)
				{
					$sql2="select * from sales_payment where Sales_payment_id='$sp_id' and Sales_id='$s_id' and Amount='$amt' and GST='$gst' and Payment_date='$date' and Payment_type_id='$p_id' and  Cheque_no is NULL and Bank_Name is NULL and Transaction_date='$t_date' and Transaction_id='$t_id'";
					$result2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_array($result2))
					{
						$sql3="Select Payment_type_name from payment_type where  Payment_type_id='$p_id'";
						$result3=mysqli_query($conn,$sql3);
						$p_name="";
						while($row3=mysqli_fetch_Array($result3))
						{
							$p_name=$row3['Payment_type_name'];
						}
						$sql4="Select Sales_date from sales where Sales_id='$s_id'";
						$result4=mysqli_query($conn,$sql4); 	
						$s_date="";
						while($row4=mysqli_fetch_Array($result4))
						{
							$s_date=$row4['Sales_date'];
						}
						 echo"
          <tr align='center'>
           <td> ".$sp_id."</td>
          <td>".$s_id."</td> 
          <td>".$s_date."</td>
          <td>".$amt."</td>
          <td>".$gst."</td>
          <td>".$date."</td>
		    <td>".$p_name."</td>
			  <td>".$c_no."</td>
			    <td>".$b_name."</td>
				  <td>".$t_date."</td>
				    <td>".$t_id."</td>
		  ";
						
					}
				}
				}
				}
				elseif($queryresult<1)
				{
					$sql1="Select * from sales_payment where Payment_type_id in(select Payment_type_id from payment_type where Payment_type_name like '%$search%')";
					$result1=mysqli_query($conn,$sql1);
					$num=mysqli_num_rows($result1);
					if($num>0)
						
						{
					while($row1=mysqli_fetch_Array($result1))
					{
						
						$sp_id=$row1['Sales_payment_id'];
						$sql2="Select * from sales_payment where Sales_Payment_id='$sp_id'";
						$result2=mysqli_query($conn,$sql2);
						while($row2=mysqli_fetch_array($result2))
						{
							$s_id=$row1['Sales_id'];
					$amt=$row2['Amount'];
					$gst=$row2['GST'];
					$date=$row2['Payment_date'];
					$p_id=$row2['Payment_type_id'];
					$c_no=$row2['Cheque_no'];
					$b_name=$row2['Bank_Name'];
					$t_date=$row2['Transaction_date'];
					$t_id=$row2['Transaction_id'];
					$sql3="select Payment_type_name from payment_type where  payment_type_id='$p_id'";
					$result3=mysqli_query($conn,$sql3);
					$p_name="";
					while($row3=mysqli_fetch_array($result3))
					{
						$p_name=$row3['Payment_type_name'];
					}
					$sql4="select Sales_date from sales where Sales_id='$s_id'";
					$result4=mysqli_query($conn,$sql4);
					$s_date="";
					while($row4=mysqli_fetch_array($result4))
					{
						$s_date=$row4['Sales_date'];
					}
						 echo"
          <tr align='center'>
           <td> ".$sp_id."</td>
          <td>".$s_id."</td> 
          <td>".$s_date."</td>
          <td>".$amt."</td>
          <td>".$gst."</td>
          <td>".$date."</td>
		    <td>".$p_name."</td>
			  <td>".$c_no."</td>
			    <td>".$b_name."</td>
				  <td>".$t_date."</td>
				    <td>".$t_id."</td>
		  ";
						
						}
					
					
					}
						}
						else
						{
							$sql1="Select * from sales_payment where Sales_id in(select Sales_id from sales where Sales_date like '%$search%')";
							$result1=mysqli_query($conn,$sql1);
							while($row1=mysqli_fetch_Array($result1))
							{
								$s_id=$row1['Sales_id'];
								$sql3="Select Sales_date from sales where Sales_id='$s_id'";
								$result3=mysqli_query($conn,$sql3);
								$s_date="";
					while($row3=mysqli_fetch_Array($result3))
					{
						$s_date=$row3['Sales_date'];
					}
					
								$sql2="select * from sales_payment where Sales_id='$s_id'";
								$result2=mysqli_query($conn,$sql2);
								while($row2=mysqli_fetch_array($result2))
								{
									$sp_id=$row2['Sales_payment_id'];
				
					$amt=$row1['Amount'];
					$gst=$row1['GST'];
					$date=$row1['Payment_date'];
					$p_id=$row1['Payment_type_id'];
					$c_no=$row1['Cheque_no'];
					$b_name=$row1['Bank_Name'];
					$t_date=$row1['Transaction_date'];
					$t_id=$row1['Transaction_id'];
					$sql5="select Payment_type_name from payment_type where Payment_type_id='$p_id'";
					$result5=mysqli_query($conn,$sql5);
					$p_name="";
					while($row5=mysqli_fetch_Array($result5))
					{
						$p_name=$row5['Payment_type_name'];
					}
					
					
								}
								 echo"
          <tr align='center'>
           <td> ".$sp_id."</td>
          <td>".$s_id."</td> 
          <td>".$s_date."</td>
          <td>".$amt."</td>
          <td>".$gst."</td>
          <td>".$date."</td>
		    <td>".$p_name."</td>
			  <td>".$c_no."</td>
			    <td>".$b_name."</td>
				  <td>".$t_date."</td>
				    <td>".$t_id."</td>
		  ";
							}
							
						}
				}
			
	else{
		echo "<script> alert('No Result Found') </script>";
	}
			}
			else
			{
	  
      $get_c="select sp.Sales_payment_id,sp.Sales_id,s.Sales_date,sp.Amount,sp.GST,sp.Payment_date,pt.Payment_type_name,sp.Cheque_no,sp.Bank_Name,sp.Transaction_date,Transaction_id from sales_payment sp,sales s,payment_type pt where sp.Sales_id=s.Sales_id and pt.Payment_type_id=sp.Payment_type_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $p_id=$row_c['Sales_payment_id'];
        $p_date=$row_c['Sales_id'];
        $pro_name=$row_c['Sales_date'];
        $s_h=$row_c['Amount'];
        $qty=$row_c['GST'];
        $price=$row_c['Payment_date'];
		$type=$row_c['Payment_type_name'];
		$cno=$row_c['Cheque_no'];
		$bname=$row_c['Bank_Name'];
		$td=$row_c['Transaction_date'];
		$t_id=$row_c['Transaction_id'];
	$i++;
?>
     <tr align="center">
       <td><?php echo $p_id; ?></td>
       <td><?php echo $p_date; ?></td>
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $qty; ?></td>
       <td><?php echo $price; ?></td>
	   <td><?php echo $type; ?></td>
	   <td><?php echo $cno; ?></td>
	   <td><?php echo $bname; ?></td>
	   <td><?php echo $td; ?></td>
	   <td><?php echo $t_id; ?></td>
       </tr>
<?php } ?>
			<?php } ?>
  </table>
</body>

</html>
