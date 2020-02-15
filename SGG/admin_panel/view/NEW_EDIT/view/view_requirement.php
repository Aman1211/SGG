<html>
  <title>
        VIEW RRQUIREMENTS
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
      <td colspan="10" align="center">
        <h2>
          View All REQUIREMENTS
        </h2>
      </td>
    </tr>
    <tr>
      <th>REQUEST_ID</th>
      <th>PRODUCT_NAME</th>
	  <th>USER_NAME</th>
      <th>HEIGHT</th>
      <TH>WIDTH</TH>
      <TH>DESIGN</TH>
      <th>THICKNESS</th>
	  <th>QTY</th>
      <th>SITE</th>
	  <th>DATE</th>
     
    </tr>
    <?php

      include("./db.php");
	   if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from customer_requirement where Customer_req_id like '%$search%' or Size_Height like '%$search%' or Size_Width like '%$search%' or qty like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
	if($queryresult>0){
		while($row=mysqli_fetch_Array($result))
		{
			$req=$row['Customer_req_id'];
			$pro=$row['Product_id'];
			$thick=$row['price_size_id'];
			$design=$row['design_id'];
			$sql1="select  * from customer_requirement where Customer_req_id='$req' and Product_id='$pro' and price_size_id='$thick' and design_id='$design'";
			$result1=mysqli_query($conn,$sql1);
			while($row1=mysqli_fetch_array($result1))
			{
				$h=$row1['Size_Height'];
				$w=$row1['Size_Width'];
				$qty=$row1['qty'];
				$sql2="select * from request where Request_id='$req'";
				$result2=mysqli_query($conn,$sql2);
				$user_id="";
				$add="";
				$date="";
				
				while($row2=mysqli_fetch_array($result2))
				{
					$user_id=$row2['User_id'];
					$add=$row2['Site_address'];
					$date=$row2['Request_date'];
					$sql3="select FirstName,LastName from login where USER_ID='$user_id'";
					$result3=mysqli_query($conn,$sql3);
					$fname="";
					$lname="";
					while($row3=mysqli_fetch_array($result3))
					{
						$fname=$row3['FirstName'];
						$lname=$row3['LastName'];
					}
					
				}
				$sql4="select Product_name from product where Product_id='$pro'";
				$result4=mysqli_query($conn,$sql4);
				$pro_name="";
				while($row4=mysqli_fetch_array($result4))
				{
					$pro_name=$row4['Product_name'];
				}
				$sql5="select Design_name  from design where Design_id='$design'";
				$result5=mysqli_query($conn,$sql5);
				$d_name="";
				while($row5=mysqli_fetch_array($result5))
				{
					$dname=$row5['Design_name'];
				}
				$sql6="select Thickness from  price_size where Price_Size_id='$thick'";
				$result6=mysqli_query($conn,$sql6);
				$t_name="";
				while($row6=mysqli_fetch_Array($result6))
				{
					$t_name=$row6['Thickness'];
				}
				
					echo"
					<tr align='center'>
					
				    <td> ".$req."</td>
					<td>".$pro_name."</td>
					<td>".$fname.$lname."</td>
					<td>".$h."</td>
						<td>".$w."</td>
							<td>".$dname."</td>
								<td>".$t_name."</td>
									<td>".$qty."</td>
										<td>".$add."</td>
											<td>".$date."</td>
					</tr>";
			}
		}
			}
			elseif($queryresult<1)
			{
				$sql5="select * from customer_requirement where design_id in(select Design_id from design where Design_name like '%$search%') or Product_id in(select Product_id from product where Product_name like '%$search%') or price_size_id in (select Price_Size_id from price_size where Thickness like '%$search%')";
				$result5=mysqli_query($conn,$sql5);
				$count=mysqli_num_rows($result5);
				while($row5=mysqli_fetch_array($result5))
				{
								$req_id=$row5['Customer_req_id'];
								$pro_id=$row5['Product_id'];
								$design_id=$row5['design_id'];
								$thick_id=$row5['price_size_id'];
								$h=$row5['Size_Height'];
								$w=$row5['Size_Width'];
								$qty=$row5['qty'];
								$sql6="select * from customer_requirement where Customer_req_id='$req_id' and Product_id='$pro_id' and design_id='$design_id' and price_size_id='$thick_id'
								and Size_Height='$h' and Size_Width='$w' and qty='$qty'";
								$result6=mysqli_query($conn,$sql6);
								while($row6=mysqli_fetch_array($result6))
								{
									$sql7="Select Product_name from product where Product_id='$pro_id'";
									$result7=mysqli_query($conn,$sql7);
									$pro_name="";
									while($row7=mysqli_fetch_array($result7))
									{
										$pro_name=$row7['Product_name'];
									}
									$sql8="select Design_name from design where Design_id='$design_id'";
									$result8=mysqli_query($conn,$sql8);
									$d_name="";
									while($row8=mysqli_fetch_array($result8))
									{
										$d_name=$row8['Design_name'];
									}
									$sql9="select Thickness from price_size  where Price_Size_id='$thick_id'";
									$result9=mysqli_query($conn,$sql9);
									$thickness="";
									while($row9=mysqli_fetch_array($result9))
									{
										$thickness=$row9['Thickness'];
									}
									$sql10="select * from request where Request_id='$req_id'";
									$result10=mysqli_query($conn,$sql10);
									$user="";
									$site="";
									$date="";
									while($row10=mysqli_fetch_array($result10))
									{
										$user=$row10['User_id'];
										$site=$row10['Site_address'];
										$date=$row10['Request_date'];
										$sql11="select FirstName ,LastName from login where USER_ID='$user'";
										$result11=mysqli_query($conn,$sql11);
										$fname="";
										$lname="";
										while($row11=mysqli_fetch_array($result11))
										{
											$fname=$row11['FirstName'];
											$lname=$row11['LastName'];
										}
									}
									
									 echo"
					<tr align='center'>
					
				    <td> ".$req_id."</td>
					<td>".$pro_name."</td>
					<td>".$fname.$lname."</td>
					<td>".$h."</td>
					<td>".$w."</td>
					<td>".$d_name."</td>
					<td>".$thickness."</td>
					<td>".$qty."</td>
					<td>".$site."</td>
					<td>".$date."</td>
					</tr>";
					   
								}
					  
					   
				}
				if($count<1)
				{
				
					$sql12="select * from request where Site_address like '%$search%' or Request_date like '%$search%'";
					$result12=mysqli_query($conn,$sql12);
					while($row12=mysqli_fetch_array($result12))
					{
						$req_id=$row12['Request_id'];
						$site=$row12['Site_address'];
						$date=$row12['Request_date'];
						$user=$row12['User_id'];
						$sql7="select * from customer_requirement where Customer_req_id='$req_id'";
						$result7=mysqli_query($conn,$sql7);
						while($row7=mysqli_fetch_array($result7))
						{
									$pro_id=$row7['Product_id'];
									$design_id=$row7['design_id'];
									$thick_id=$row7['price_size_id'];
									$h=$row7['Size_Height'];
									$w=$row7['Size_Width'];
									$qty=$row7['qty'];
									$sql8="Select Product_name from product where Product_id='$pro_id'";
									$result8=mysqli_query($conn,$sql8);
									$pro_name="";
									while($row8=mysqli_fetch_array($result8))
									{
										$pro_name=$row8['Product_name'];
									}
									$sql9="select Design_name from design where Design_id='$design_id'";
									$result9=mysqli_query($conn,$sql9);
									$d_name="";
									while($row9=mysqli_fetch_array($result9))
									{
										$d_name=$row9['Design_name'];
									}
									$sql10="select Thickness from price_size  where Price_Size_id='$thick_id'";
									$result10=mysqli_query($conn,$sql10);
									$thickness="";
									while($row10=mysqli_fetch_array($result10))
									{
										$thickness=$row10['Thickness'];
									}
$sql11="select FirstName ,LastName from login where USER_ID='$user'";
										$result11=mysqli_query($conn,$sql11);
										$fname="";
										$lname="";
										while($row11=mysqli_fetch_array($result11))
										{
											$fname=$row11['FirstName'];
											$lname=$row11['LastName'];
										}
										 echo"
					<tr align='center'>
					
				    <td> ".$req_id."</td>
					<td>".$pro_name."</td>
					<td>".$fname.$lname."</td>
					<td>".$h."</td>
					<td>".$w."</td>
					<td>".$d_name."</td>
					<td>".$thickness."</td>
					<td>".$qty."</td>
					<td>".$site."</td>
					<td>".$date."</td>
					</tr>";
									
						}
					}
				}
				}	
					
					 else
        {
          echo "<script>alert ('no result found')</script>";
        }
					
				}
	
			else
			{
      $get_c="select * from product p,request r,customer_requirement cr,design d,price_size ps,login l where cr.Customer_req_id=r.request_id and cr.Product_id=p.Product_id and cr.price_size_id=ps.Price_Size_id and cr.design_id=d.Design_id and r.User_id=l.USER_ID ";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $r_id=$row_c['Customer_req_id'];
        $p_name=$row_c['Product_name'];
        $c_name=$row_c['FirstName'];
		$c_name1=$row_c['LastName'];
        $s_h=$row_c['Size_Height'];
		    $s_w=$row_c['Size_Width'];
        $d_name=$row_c['Design_name'];
        $thick=$row_c['Thickness'];
		$qty=$row_c['qty'];
        $s_a=$row_c['Site_address'];
		$d_r=$row_c['Request_date'];
	$i++;
?>
     <tr align="center">
       <td><?php echo $r_id; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $c_name; echo $c_name1;?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $s_w; ?></td>
       <td><?php echo $d_name; ?></td>
       <td><?php echo $thick; ?></td>
	   <td><?php echo $qty; ?></td>
	    <td><?php echo $s_a; ?></td>
		 <td><?php echo $d_r; ?></td>
       </tr> 
<?php } ?>
			<?php } ?>
  </table>
</body>

</html>
