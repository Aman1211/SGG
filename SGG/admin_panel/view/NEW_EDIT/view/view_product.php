<html>
  <title>
        VIEW PRODUCT
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
          View All PRODUCTS
        </h2>
      </td>
    </tr>
	 <tr>
      <th>PRODUCT_ID</th>
      <th>PRODUCT_NAME</th>
	 <th>DESIGN_NAME</th>
      <TH>SUB_CATEGORY</TH>
      <TH>BRAND</TH>
      <th>THICKNESS</th>
      <th>PRICE</th>
	  <th>EDIT</th>
	  <th>DELETE</th>
     
    </tr>
    <?php
	 include("./db.php");
	if(isset($_POST['submit']))
	{
		$search=mysqli_real_escape_string($conn,$_POST['search']);
		$sql="select * from product WHERE Product_id like'%$search%' or Product_name like '%$search%' or Price like '%$search%'";
		$result=mysqli_query($conn,$sql);
		$queryresult=mysqli_num_rows($result);
						
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
						$pro_id=$row['Product_id'];
						$pro_name=$row['Product_name'];
						$price=$row['Price'];
						$sql2="select Brand_id,Price_size_id,Subcategory_id,Design_id from product WHERE Product_id='$pro_id' and Product_name='$pro_name' and Price='$price'";
						$result2=mysqli_query($conn,$sql2);
						$b_id="";
						$p_id="";
						$s_id="";
						$d_id="";
						while($row2=mysqli_fetch_array($result2))
						{
							$b_id=$row2['Brand_id'];
							$p_id=$row2['Price_size_id'];
							$s_id=$row2['Subcategory_id'];
							$d_id=$row2['Design_id'];
						}
							$sql3="select Design_name from design where Design_id='$d_id'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						$id2=$row3['Design_name'];
					}
					$sql4="select Brand_name from brand where Brand_id='$b_id'";
					$result4=mysqli_query($conn,$sql4);
					$id3="";
					while($row4=mysqli_fetch_array($result4))
					{
						$id3=$row4['Brand_name'];
					}
						$sql5="select Thickness from price_size where Price_size_id='$p_id'";
					$result5=mysqli_query($conn,$sql5);
					$id4="";
					while($row5=mysqli_fetch_array($result5))
					{
						$id4=$row5['Thickness'];
					}
						$sql6="select Subcategory_name from subcategory where Subcategory_id ='$s_id'";
					$result6=mysqli_query($conn,$sql6);
					$id5="";
					while($row6=mysqli_fetch_array($result6))
					{
						$id5=$row6['Subcategory_name'];
					}
					echo"
					<tr align='center'>
					
				    <td> ".$row['Product_id']."</td>
					<td>".$row['Product_name']."</td>
					<td>".$id2."</td>
					<td>".$id5."</td>
					<td>".$id3."</td>
					<td>".$id4."</td>
					<td>".$row['Price']."</td>
					<td><a href='?link=37&edit_d=".$row['Product_id']."'>EDIT</a></td>"; ?>
						<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product.php?delete_p=<?php echo $pro_id ?>'}">DELETE</a></td>
			</tr>
			<?php
		}
	}
	if($queryresult<1)
	{
	$sql1="select * from product p1,design d,price_size p,subcategory s,brand b WHERE d.Design_name like'%$search%' or p.Thickness like '%$search%' or s.Subcategory_name like '%$search%' or b.Brand_name like '%$search%' and p1.Design_id=d.Design_id and p.Price_size_id=p1.Price_size_id and p1.Subcategory_id=s.Subcategory_id and p1.Brand_id=b.Brand_id";
	$result1=mysqli_query($conn,$sql1);
	$queryresult1=mysqli_num_rows($result1);
	if($queryresult1>0){
		while($row1=mysqli_fetch_assoc($result1))
		{
			$pro=$row1['Product_id'];
			echo"
					<tr align='center'>
					
				    <td> ".$row1['Product_id']."</td>
					<td>".$row1['Product_name']."</td>
					<td>".$row1['Design_name']."</td>
					<td>".$row1['Subcategory_name']."</td>
					<td>".$row1['Brand_name']."</td>
					<td>".$row1['Thickness']."</td>
					<td>".$row1['Price']."</td>
					<td><a href='?link=37&edit_d=".$row1['Product_id']."'>EDIT</a></td>";
					 ?>
			<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product.php?delete_p=<?php echo $pro ?>'}">DELETE</a></td>
			</tr>
			<?php

		}
	}
	else{
		echo "<script> alert('No Result Found') </script>";
	}
	}
			}
else{			
      $get_c="select p.Product_id,p.Product_name,d.Design_name,s.Subcategory_name,b.Brand_name,p2.Thickness,p.Price from product p,design d,price_size p2,subcategory s,brand b where 
	           p.Design_id=d.Design_id and p.Price_size_id=p2.Price_Size_id and p.Subcategory_id=s.Subcategory_id and p.Brand_id=b.Brand_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $p_id=$row_c['Product_id'];
        $p_name=$row_c['Product_name'];
        $p_d=$row_c['Design_name'];
		    $p_c=$row_c['Subcategory_name'];
        $p_b=$row_c['Brand_name'];
        $p_t=$row_c['Thickness'];
        $p_p=$row_c['Price'];
		 
   	
?>
	
     <tr align="center">
       <td><?php echo $p_id; ?></td>
       <td><?php echo $p_name; ?></td>
            <td><?php echo $p_d; ?></td>
       <td><?php echo $p_c; ?></td>
       <td><?php echo $p_b; ?></td>
       <td><?php echo $p_t; ?></td>
       <td><?php echo $p_p; ?></td>
	    <td> <a href="?link=45&edit_product=<?php echo $p_id; ?>">EDIT</a></td>
       <td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product.php?delete_p=<?php echo $p_id ?>'}">DELETE</a></t
       </tr>

  
  
	  <?php }  ?>
	  <?php } ?>
  </table>
</body>

</html>
