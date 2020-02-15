<html>
  <title>
        VIEW DESIGN
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
      <td colspan="7" align="center">
        <h2>
          View All DESIGN
        </h2>
      </td>
    </tr>
    <tr>
      <th>DESIGN_ID</th>
      <th>DESIGN_NAME</th>
      <th>DESIGN_IMAGE</th>
      <th>DESGIN_COLOR</th>
      <th>PRICE</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
	<?php
	include("./db.php");
			if(isset($_POST['submit']))
			{
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from design WHERE Design_id like'%$search%' or Design_name like '%$search%' or Design_image like '%$search%' or Design_color like '%$search%' or Price like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
			$id=$row['Design_id'];
					echo"
					<tr align='center'>
					
				    <td> ".$row['Design_id']."</td>
					<td>".$row['Design_name']."</td>
					<td><image src=".$row['Design_image']." height=100 width=100/></td>
					<td>".$row['Design_color']."</td>
					<td>".$row['Price']."</td>
					<td><a href='?link=37&edit_d=".$row['Design_id']."'>EDIT</a></td>"; ?>
					  <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_design.php?delete_c=<?php echo $id ?>'}">DELETE</a></td>
					</tr>
					<?php
		}
	}else{
		echo "<script> alert('No Result Found') </script>";
	}
}

else 
{
      $get_c="select * from  Design";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $d_id=$row_c['Design_id'];
        $d_name=$row_c['Design_name'];
        $d_image=$row_c['Design_image'];
        $d_color=$row_c['Design_color'];
        $price=$row_c['Price'];
    //    $originalDate = $c_date;
     //   $newDate = date("d-m-Y", strtotime($originalDate));
?>
     <tr align="center">
       <td><?php echo $d_id; ?></td>
       <td><?php echo $d_name; ?></td>
       <td><img src="../../<?php echo $d_image; ?>" width="130" height="80"/></td>
       <td><?php echo $d_color; ?></td>
       <td><?php echo $price; ?></td>
       <td><a href="?link=42&edit_d=<?php echo $d_id; ?>">EDIT</a></td>
        <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_design.php?delete_c=<?php echo $d_id ?>'}">DELETE</a></td>
    </tr>
<?php } ?>
<?php } ?>
  </table>
</body>

</html>
