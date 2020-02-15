<html>
  <title>
        VIEW SALES_LABOUR
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
          View All SALES_LABOUR
        </h2>
      </td>
    </tr>
    <tr>
      <th>SALES_ID</th>
      <th>DATE_OF_WORK</th>
      <th>LABOUR_NAME</th>
      <TH>SIZE_HEIGHT</TH>
      <TH>SIZE_WIDTH</TH>
      <th>AMOUNT</th>
    </tr>
    <?php

      include("./db.php");
	   if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
				$sql1="select * from sales_labour where Sales_id like '%$search%' or Date_of_work like '%$search%' or Size_Height like '%$search%' or  Size_Width like '%$search%' or Amount like '%$search%'";
				$query1=mysqli_query($conn,$sql1);
				$queryresult=mysqli_num_rows($query1);
				if($queryresult>0)
				{
				while($row1=mysqli_fetch_array($query1))
				{
				   $sales_id=$row1['Sales_id'];
					$labour=$row1['Labour_id'];
					$date=$row1['Date_of_work'];
					$h=$row1['Size_Height'];
					$w=$row1['Size_Width'];
					$amt=$row1['Amount'];
					$sql2="select * from sales_labour where Sales_id='$sales_id' and Labour_id='$labour' and Date_of_work='$date' and Size_Height='$h' and Size_Width='$w'  and 
					Amount='$amt'";
					$query2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_Array($query2))
					{
						$sql3="select Worker_name from labour where Labour_id='$labour'";
						$result3=mysqli_query($conn,$sql3);
						$l_name="";
						while($row3=mysqli_fetch_array($result3))
						{
								$l_name=$row3['Worker_name'];
						}
						echo "
						<tr align='center'>
						 <td> ".$sales_id."</td>
					<td>".$date."</td>
					<td>".$l_name."</td>
					<td>".$h."</td>
					<td>".$w."</td>
					<td>".$amt."</td>
					</tr>";
					}
				}
			}

			elseif($queryresult<1)
			{
					$sql4="select * from sales_labour where Labour_id in(select Labour_id from labour where Worker_name like '%$search%')";
					$result4=mysqli_query($conn,$sql4);
					while($row4=mysqli_fetch_array($result4))
					{	
						$lab_id=$row4['Labour_id'];
						$sql5="select Worker_name from labour where Labour_id='$lab_id'";
						$result5=mysqli_query($conn,$sql5);
						$name="";
						while($row5=mysqli_fetch_array($result5))
						{
							$name=$row5['Worker_name'];
						}
						$sql6="Select * from sales_labour where Labour_id='$lab_id'";
						$result6=mysqli_query($conn,$sql6);
						$sales_id="";
						$date="";
						$h="";
						$w="";
						$amt="";
						while($row6=mysqli_fetch_array($result6))
						{
							$sales_id=$row6['Sales_id'];
							$date=$row6['Date_of_work'];
							$h=$row6['Size_Height'];
							$w=$row6['Size_Width'];
							$amt=$row6['Amount'];
						}
						echo "
						<tr align='center'>
						 <td> ".$sales_id."</td>
					<td>".$date."</td>
					<td>".$name."</td>
					<td>".$h."</td>
					<td>".$w."</td>
					<td>".$amt."</td>
					</tr>";
					}
			}
	    else{
		echo "<script> alert('No Result Found') </script>";
	}
	}
	  else{
      $get_c="select sl.Sales_id,Date_of_work,Worker_name,sl.Amount,sl.Size_Height,sl.Size_Width from sales_labour sl,sales s,labour l where s.Sales_id=sl.Sales_id and l.Labour_id=sl.Labour_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $p_id=$row_c['Sales_id'];
        $p_date=$row_c['Date_of_work'];
        $pro_name=$row_c['Worker_name'];
        $s_h=$row_c['Size_Height'];
		    $s_w=$row_c['Size_Width'];
        $qty=$row_c['Amount'];
       	$i++;
?>
     <tr align="center">
       <td><?php echo $p_id; ?></td>
       <td><?php echo $p_date; ?></td>
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $s_w; ?></td>
       <td><?php echo $qty; ?></td>
       </tr>
<?php } ?>
	  <?php } mysqli_close($conn); ?>
  </table>
</body>

</html>
