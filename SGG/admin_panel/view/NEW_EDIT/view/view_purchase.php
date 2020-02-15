<html>
  <title>
        VIEW PURCHASE
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
      <td colspan="9" align="center">
        <h2>
          View All PURCHASE
        </h2>
      </td>
    </tr>
    <tr>
      <th>PURCHASE_ID</th>
      <th>PURCHASE_DATE</th>
      <th>PRODUCT_NAME</th>
      <TH>SIZE_Height</TH>
      <TH>SIZE_Width</TH>
      <th>QTY</th>
      <th>PRICE</th>
      <TH>SUPPLIER_NAME</TH>
      <TH>SUPPLIER_CONTACT</TH>
     
    </tr>
    <?php
			if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
				$sql1="select  * from purchase where Purchase_id like '%$search%' or Purchase_date like '%$search%' or Supplier_id  in(select Supplier_id from supplier where Supplier_name like '%$search%')";
					
				$result1=mysqli_query($conn,$sql1);
					$queryresult=mysqli_num_rows($result1);
	if($queryresult>0){
				while($row1=mysqli_fetch_array($result1))
				{
				          $date=$row1['Purchase_date'];
						  $sup_id=$row1['Supplier_id'];
						  $sql2="select Purchase_id from purchase where Purchase_date='$date' and Supplier_id='$sup_id'";
						  $result2=mysqli_query($conn,$sql2);
						  $pur_id="";
						  while($row2=mysqli_fetch_array($result2))
						  {
							  $pur_id=$row2['Purchase_id'];
							  $sql3="select Supplier_id from  purchase where Purchase_id='$pur_id'";
							  $result3=mysqli_query($conn,$sql3);
							  $sup_id="";
							  while($row3=mysqli_fetch_array($result3))
							  {
								  $sup_id=$row3['Supplier_id'];
								  
							  }
							
							  $sql4="select Supplier_name,Sup_contact from supplier where Supplier_id='$sup_id'";
							  $result4=mysqli_query($conn,$sql4);
							  $sup_name="";
							  $sup_contact="";
							  while($row4=mysqli_fetch_array($result4))
							  {
								  $sup_name=$row4['Supplier_name'];
								  $sup_contact=$row4['Sup_contact'];
								   echo "<script> alert('$sup_name $sup_contact'); </script>";
							  }
							  
							  $sql5="select * from purchase_detail where  Purchase_id='$pur_id'";
							  $result5=mysqli_query($conn,$sql5);
							  while($row5=mysqli_fetch_array($result5))
							  {
								  $pro_id=$row5['Product_id'];
								  $sql6="select Product_name from Product where Product_id='$pro_id'";
								  $result6=mysqli_query($conn,$sql6);
								  $pro_name="";
								  while($row6=mysqli_fetch_array($result6))
								  {
									  $pro_name=$row6['Product_name'];
						
									  echo"
					<tr align='center'>
					
				    <td> ".$pur_id."</td>
					<td>".$date."</td>
					<td>".$pro_name."</td>
					<td>".$row5['Size_Height']."</td>
					<td>".$row5['Size_Width']."</td>
					<td>".$row5['Qty']."</td>
					<td>".$row5['Price']."</td>
					<td>".$sup_name."</td>
					<td>".$sup_contact."</td>
						   </tr>";
								  }
								  
							  }
							  	
						  }
						   
				}
			}
			elseif($queryresult<1)
	{
						$sql7="select * from purchase_detail p where p.Size_Height like '%$search%' or p.Size_Width like '%$search%' or p.Qty like '%$search%' or p.Price like '%$search%'  or p.Product_id in(select Product_id from product where Product_name like '%$search%')";
						$result7=mysqli_query($conn,$sql7);
						while($row7=mysqli_fetch_Array($result7))
						{
							
							$pur_id=$row7['Purchase_id'];
							$qty=$row7['Qty'];
							$pro_id=$row7['Product_id'];
							$price=$row7['Price'];
							$sh=$row7['Size_Height'];
							$sw=$row7['Size_Width'];
							$sql13="select Purchase_id from purchase_detail where Product_id='$pro_id' and Qty='$qty' and Price='$price' and Size_Height='$sh' and Size_Width='$sw'";
							$result13=mysqli_query($conn,$sql13);
							while($row13=mysqli_fetch_array($result13))
							{
								$sql14="select Product_name from product where Product_id='$pro_id'";
								$result14=mysqli_query($conn,$sql14);
								$pro_name="";
								while($row14=mysqli_fetch_array($result14))
								{
									$pro_name=$row14['Product_name'];
								}
								$pur=$row13['Purchase_id'];
								$sql15="select * from purchase where Purchase_id='$pur'";
								$result15=mysqli_query($conn,$sql15);
								while($row15=mysqli_fetch_array($result15))
								{
									$date=$row15['Purchase_date'];
									$id=$row15['Supplier_id'];
									$sql14="select * from supplier where Supplier_id='$id'";
									$result14=mysqli_query($conn,$sql14);
									$sup_name="";
									$sup_contact="";
									while($row14=mysqli_fetch_array($result14))
									{
										$sup_name=$row14['Supplier_name'];
										$sup_contact=$row14['Sup_contact'];
										
							
									}
									
								}
							
										
								
								
							}
							echo"
					<tr align='center'>
					
				    <td> ".$pur."</td>
					<td>".$date."</td>
					<td>".$pro_name."</td>
					<td>".$sh."</td>
					<td>".$sw."</td>
					<td>".$qty."</td>
					<td>".$price."</td>
					<td>".$sup_name."</td>
					<td>".$sup_contact."</td>
					</tr>";
								
						}
	}
			else{
		echo "<script> alert('No Result Found') </script>";
	}
			}
			else
			{
      include("./db.php");
	   	  
      $get_c="select p.Purchase_id,p.Purchase_date,p2.Product_name,p1.Size_Height,p1.Size_Width,p1.Qty,p1.Price,s.Supplier_name,s.Sup_contact from purchase p,supplier s,purchase_detail p1,product p2 
where s.Supplier_id=p.Supplier_id
and p.Purchase_id=p1.Purchase_id
and p1.Product_id=p2.Product_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $p_id=$row_c['Purchase_id'];
        $p_date=$row_c['Purchase_date'];
        $pro_name=$row_c['Product_name'];
        $s_h=$row_c['Size_Height'];
		    $s_w=$row_c['Size_Width'];
        $qty=$row_c['Qty'];
        $price=$row_c['Price'];
        $s_n=$row_c['Supplier_name'];
        $con=$row_c['Sup_contact'];
        
	$i++;
?>
     <tr align="center">
       <td><?php echo $p_id; ?></td>
       <td><?php echo $p_date; ?></td>
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $s_w; ?></td>
       <td><?php echo $qty; ?></td>
       <td><?php echo $price; ?></td>
       <td><?php echo $s_n; ?></td>
       <td><?php echo $con; ?></td>
       </tr>
<?php } ?>
			<?php } ?>
  </table>
</body>

</html>
