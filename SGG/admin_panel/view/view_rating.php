<?php
include('./db.php');
 $url='index.php?link=37&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from ratings";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "ratings"; //you have to pass your query over here table name
      

$query = "SELECT * FROM ratings order by user_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>



<html>
  <title>
        VIEW RATINGS
  </title>
 <link rel="stylesheet" href="view_Style.css" type="text/css">
  <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

<head>
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
      <td colspan="5" align="center">
        <h2>
          View All RATINGS
        </h2>
      </td>
    </tr>
    <tr>
      <th> SR NO. </th>
      <th>USER NAME</th>
      <th>PRODUCT NAME</th>
      <th>RATING</th>
      <th>DATE</th>
      
    </tr>
    <?php

      
	   if(isset($_POST['submit']))
			{
				$i=$startpoint;
        		$i+=1;
				$search=mysqli_real_escape_string($conn,$_POST['search']);
				$sql1="select * from  ratings where Rating like '%$search%' or Rating_date like '%$search%'";
				$result1=mysqli_query($conn,$sql1);
				$queryresult=mysqli_num_rows($result1);
				$t_c=$queryresult;
				if($queryresult>0){
				while($row1=mysqli_fetch_array($result1))
				{
					$pro_id=$row1['Product_id'];
					$user=$row1['user_id'];
					
					$sql2="select  * from ratings where Product_id='$pro_id' and user_id='$user'";
					$result2=mysqli_query($conn,$sql2);
					while($row2=mysqli_fetch_array($result2))
					{
						$rating=$row2['Rating'];
						$date=$row2['Rating_date'];
						$sql3="select Product_name from product where Product_id='$pro_id'";
						$result3=mysqli_query($conn,$sql3);
						$pro_name="";
						while($row3=mysqli_fetch_array($result3))
						{
							$pro_name=$row3['Product_name'];
						}
						$sql4="select USER_NAME from login where USER_ID='$user'";
						$result4=mysqli_query($conn,$sql4);
						$user_name="";
						while($row4=mysqli_fetch_array($result4))
						{
							$user_name=$row4['USER_NAME'];
						}
						
				echo"
					<tr align='center'>
					<td> ".$i."</td>
				    <td> ".$user_name."</td>
					<td>".$pro_name."</td>
					<td>".$rating."</td>
					<td>".$date."</td>
					
					</tr>";
					}
					$i+=1;
				}
				}
				elseif($queryresult<1)
				{
					$i=$startpoint;
					$i+=1;
					$sql3="select * from ratings where Product_id in(select Product_id from product where Product_name like '%$search%') or user_id in (select USER_ID from login where USER_NAME like '%$search%')";
					$result3=mysqli_query($conn,$sql3);
					$t_c=mysqli_num_rows($result3);
					while($row3=mysqli_fetch_array($result3))
					{
						$pro_id=$row3['Product_id'];
						$user=$row3['user_id'];
						$sql4="select * from ratings where Product_id='$pro_id' and user_id='$user'";
						$result4=mysqli_query($conn,$sql4);
						while($row4=mysqli_fetch_array($result4))
						{
							$rating=$row4['Rating'];
							$date=$row4['Rating_date'];
							$originalDate = $date;
            				$newDate1 = date("d-m-Y", strtotime($originalDate));
							$sql5="select Product_name from product where  Product_id='$pro_id'";
							$result5=mysqli_query($conn,$sql5);
							$pro_name="";
							while($row5=mysqli_fetch_array($result5))
							{
								$pro_name=$row5['Product_name'];
							}
							$sql6="select USER_NAME from login where USER_ID='$user'";
							$result6=mysqli_query($conn,$sql6);
							$user_name="";
							while($row6=mysqli_fetch_array($result6))
							{
								$user_name=$row6['USER_NAME'];
							}
							echo"
					<tr align='center'>
					<td> ".$i."</td>
				    <td> ".$user_name."</td>
					<td>".$pro_name."</td>
					<td>".$rating."</td>
					<td>".$newDate1."</td>
					
					</tr>";
					}
					$i+=1;
						}
					}
					else{
		echo "<script> alert('No Result Found') </script>";
	}
		
				}
			
			else
			{
      //$get_c="select * from Ratings r,login l,product p where r.user_id=l.USER_ID and r.Product_id=p.Product_id";
      //$run_c=mysqli_query($conn,$get_c);
      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
      						$user=$row_c['user_id'];
							$pro_id=$row_c['Product_id'];
      						$sql5="select Product_name from product where  Product_id='$pro_id'";
							$result5=mysqli_query($conn,$sql5);
							$pro_name="";
							while($row5=mysqli_fetch_array($result5))
							{
								$p_name=$row5['Product_name'];
							}
							$sql6="select USER_NAME from login where USER_ID='$user'";
							$result6=mysqli_query($conn,$sql6);
							$user_name="";
							while($row6=mysqli_fetch_array($result6))
							{
								$u_name=$row6['USER_NAME'];
							}



        $Rating=$row_c['Rating'];
        $r_date=$row_c['Rating_date'];
        $originalDate = $r_date;
        $newDate = date("d-m-Y", strtotime($originalDate));

    
?>
     <tr align="center">
  
       <td><?php echo $i; ?></td>
       <td><?php echo $u_name; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $Rating; ?></td>
       <td><?php echo $newDate; ?></td>
    </tr>
<?php $i+=1;} 

?>
			<?php } ?>
  </table>

  <hr>
  <?php 

echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
?>
 <?php
if (isset($_POST['showall'])) {
 echo "<script>window.open('./index.php?link=37','_self')</script>";
}
   mysqli_close($conn);?>
  <hr>

</body>
</html>
