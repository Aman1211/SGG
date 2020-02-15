<html>
  <title>
        VIEW AREA
  </title>
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
      <td colspan="5" align="center">
        <h2>
          View All Area
        </h2>
      </td>
    </tr>
    <tr>
      <th>Area_ID</th>
      <th>Area_NAME</th>
      <th>Area_pincode</th>
      <th>City_Name</th>
      <th>Delete</th>

    </tr>
    <?php
      include("./db.php");
	  if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from area where Area_id like '%$search%' or  Area_name like '%$search%' or Pincode like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
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
					
				    <td> ".$row['Area_id']."</td>
					<td>".$row['Area_name']."</td>
					<td>".$row['Pincode']."</td>
					<td>".$id2."</td>"; ?>
			<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $id ?>'}">DELETE</a></td>
			</tr>
			<?php
					
		}
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
					
				    <td> ".$row1['Area_id']."</td>
					<td>".$row1['Area_name']."</td>
					<td>".$row1['Pincode']."</td>
					<td>".$row1['City_name']."</td>" ?>
			<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $id ?>'}">DELETE</a></td>
			</tr>
			<?php
		
		}
	}
	else{
		echo "<script> alert('No Result Found') </script>";
	}
	}
}
else
{
      $get_c="select * from area a , city c where a.city_id=c.City_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $a_id=$row_c['Area_id'];
        $a_NAME=$row_c['Area_name'];
        $pincode=$row_c['Pincode'];
        $city_name=$row_c['City_name'];

    $i++;
?>
     <tr align="center">
       <td><?php echo $a_id; ?></td>
       <td><?php echo $a_NAME; ?></td>
       <td><?php echo $pincode; ?></td>
       <td><?php echo $city_name; ?></td>
	   <?php 
	   try{
		   ?>
       <td><a href="javascript:if(confirm('Are you want to Deslete this record?')) {location.href='./delete/delete_a.php?delete_a=<?php echo $a_id; ?>'}">DELETE</a></td>
	   <?php 
	   }
	   catch(Exception $e)
	   {
		   echo "<script> alert('You cannot delete this record'); </script>";
	   }
	   ?>
     </tr>
	  <?php } ?>
<?php } ?>
<?php
if(isset($_POST['showall']))
{
}
?>
  </table>
</body>
</html>