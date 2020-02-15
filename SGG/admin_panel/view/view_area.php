<?php
if (!isset($_SERVER['HTTP_REFERER'])){ 

echo "<script> location.href='./index.php' </script>";
 }
include('./db.php');
 $url='index.php?link=1&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from area";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 6; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "area"; //you have to pass your query over here table name
    $query = "SELECT * FROM area order by Area_id DESC LIMIT {$startpoint}, {$limit}";

        $result=mysqli_query($conn,$query);



?>
<html>
  <title>
        VIEW AREA
  </title>
 <head>
<link rel="stylesheet" href="view_style.css" type="text/css"/>
<link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />
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
      <td colspan="6" align="center">
        <h2>
          View All Area
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>AREA NAME</th>
      <th>AREA PINCODE</th>
      <th>CITY NAME</th>
      <th>EDIT</th>
      <th>DELETE</th>

    </tr>
    <?php

      
	  if(isset($_POST['submit']))
			{
        
        $i=1;
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from area where Area_id like '%$search%' or  Area_name like '%$search%' or Pincode like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
	$t_c=mysqli_num_rows($result);
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){		
			
					$id=$row['Area_id'];
					$name=$row['Area_name'];
					$pin=$row['Pincode'];
					$sql2="select city_id from area where Area_id='$id' and Area_name='$name' and Pincode='$pin'";
					$result2=mysqli_query($conn,$sql2);
					$id1="";
					while($row2=mysqli_fetch_array($result2))
					{
						$id1=$row2['city_id'];
					}
					$sql3="select City_name from city where City_id='$id1'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						$id2=$row3['City_name'];
					}
					
					echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$row['Area_name']."</td>
					<td>".$row['Pincode']."</td>
					<td>".$id2."</td>"; ?>
			<td><a href="?link=56&edit_a=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
			<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $id ?>'}"class="fas fa-fw fa-trash"></a></td>
			</tr>
			<?php
					
		$i=$i+1;}
	}
	if($queryresult<1)
	{
	$sql1="select * from area a,city c WHERE c.City_name like'%$search%' and a.city_id=c.City_id";
	$result1=mysqli_query($conn,$sql1);
	$queryresult1=mysqli_num_rows($result1);

	if($queryresult1>0){
		while($row1=mysqli_fetch_assoc($result1))
		{
			$id=$row1['Area_id'];
			echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$row1['Area_name']."</td>
					<td>".$row1['Pincode']."</td>
					<td>".$row1['City_name']."</td>" ?>
					<td><a href="?link=56&edit_a=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
			
			<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $id ?>'}"class="fas fa-fw fa-trash"></a></td>
			</tr>
			<?php
		
		$i=$i+1;}
	}
	else{	
		echo "<script> alert('No Result Found') </script>";
	}
	}
}
else
{ 
  $i=$startpoint;
  $i+=1;
     
      $city_name="";$id1="";
      while($row_c=mysqli_fetch_array($result)){
      	
        $a_id=$row_c['Area_id'];
        $name=$row_c['Area_name'];
        $pin=$row_c['Pincode'];
        

        $sql2="select city_id from area where Area_id='$a_id' and Area_name='$name' and Pincode='$pin'";
          $result2=mysqli_query($conn,$sql2);
          $id1="";
          while($row2=mysqli_fetch_array($result2))
          {
            $id1=$row2['city_id'];
          }

        $qu="select * from city where City_id='$id1'";
        $re=mysqli_query($conn,$qu);
        while($ro=mysqli_fetch_array($re))
        {
               $city_name=$ro['City_name'];
        }
        $a_NAME=$row_c['Area_name'];
        $pincode=$row_c['Pincode'];
        //$city_name=$row_c['City_name'];

    
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $a_NAME; ?></td>
       <td><?php echo $pincode; ?></td>
       <td><?php echo $city_name; ?></td>
       <td><a href="?link=56&edit_a=<?php echo $a_id ?>" class="fas fa-fw fa-edit"></a></td>
		<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $a_id; ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
	  <?php $i+=1;} ?>
<?php } ?>

<?php
if(isset($_POST['showall']))
{
  echo "<script>window.open('./index.php?link=1','_self')</script>";

}
?>

  </table>
  
  <hr>
 
 <?php 
 echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";

mysqli_close($conn);
 ?>
  <hr>

</body>
</html>