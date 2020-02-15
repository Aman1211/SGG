
<html>
  <head>

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
  </head>
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
          View All SALES
        </h2>
      </td>
    </tr>
    <tr>
      <th>SALES_ID</th>
      <th>SALES_DATE</th>
      <th>REQUEST_ID</th>
      <TH>PRODUCT_NAME</TH>
      <TH>QTY</TH>
      <th>PRICE</th>
    </tr>
    <?php

      include("./db.php");
	   if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from sales where Sales_id like '%$search%' or Sales_date like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
					$date=$row['Sales_date'];
					$rq=$row['Request_id'];
					$sql2="select Sales_id from sales where Sales_date='$date' and Request_id='$rq'";
					$result2=mysqli_query($conn,$sql2);
					$id="";
					while($row2=mysqli_fetch_Array($result2))
					{
						$id=$row2['Sales_id'];
					}
					$sql3="select * from sales_detail where sales_id='$id'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						$id2=$row3['Product_id'];
						$sql4="select Product_name from product where Product_id='$id2'";
						$result4=mysqli_query($conn,$sql4);
						$pro_name="";
						while($row4=mysqli_fetch_array($result4))
						{
							$pro_name=$row4['Product_name'];
						}
					echo"
					<tr align='center'>
					
				    <td> ".$id."</td>
					<td>".$date."</td>
					<td>".$rq."</td>
					<td>".$pro_name."</td>
					<td>".$row3['Qty']."</td>
					<td>".$row3['Price']."</td>
					
					</tr>";
		}
		}
	}
	elseif($queryresult<1)
	{
		$sql6="select * from sales_detail where Qty like '%$search%' or Price like '%$search%' or Product_id in(select Product_id from Product where Product_name like '%$search%')";
		$result6=mysqli_query($conn,$sql6);
		while($row6=mysqli_fetch_array($result6))
		{
						$pro_id=$row6['Product_id'];
						$qty=$row6['Qty'];
						$price=$row6['Price'];
						
						$sql7="select Product_name from product where Product_id='$pro_id'";
						$result7=mysqli_query($conn,$sql7);
						$pro1="";
						while($row7=mysqli_fetch_array($result7))
						{
							$pro1=$row7['Product_name'];
						}
					$sql8="select sales_id from sales_detail where Qty='$qty' and Price='$price'";
					$query8=mysqli_query($conn,$sql8);
					$s_id="";
						while($row8=mysqli_fetch_array($query8))
						{
							
						
							$s_id=$row8['sales_id'];
						$sql9="select * from sales where Sales_id='$s_id'";
						$result9=mysqli_query($conn,$sql9);
						$r_id="";
						$date="";
						
						while($row9=mysqli_fetch_array($result9))
						{
							$r_id=$row9['Request_id'];
							$date=$row9['Sales_date'];
						}
		
				echo"
					<tr align='center'>
					
				    <td> ".$s_id."</td>
					<td>".$date."</td>
					<td>".$r_id."</td>
					<td>".$pro1."</td>
					<td>".$row6['Qty']."</td>
					<td>".$row6['Price']."</td>
					
					</tr>";
			}
		}
	}
		
	else{
		echo "<script> alert('No Result Found') </script>";
	}
			}
	  else{
		  
      $get_c="select sd.Sales_id,s.Sales_date,s.Request_id,p.Product_name,sd.Qty,sd.Price from sales s,sales_detail sd,request r ,product p where s.Sales_id=sd.Sales_id and s.Request_id=r.Request_id and p.Product_id=sd.Product_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $p_id=$row_c['Sales_id'];
        $p_date=$row_c['Sales_date'];
        $pro_name=$row_c['Request_id'];
        $s_h=$row_c['Product_name'];
        $qty=$row_c['Qty'];
        $price=$row_c['Price'];
	$i++;
?>
     <tr align="center">
       <td><?php echo $p_id; ?></td>
       <td><?php echo $p_date; ?></td>
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $qty; ?></td>
       <td><?php echo $price; ?></td>
       </tr>
<?php } ?>
	  <?php } ?>
  </table>
</body>

</html>
