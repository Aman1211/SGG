
<?php
include('./db.php');
 $url='index.php?link=27&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from design";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "design"; //you have to pass your query over here table name
        $query="select * from brand LIMIT  , ";
        $result=mysqli_query($conn,$query);

$query = "SELECT * FROM design order by Design_id DESC  LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);
?>

<html>
  <title>
        VIEW DESIGN
  </title>
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
      <th>SR NO.</th>
      <th>DESIGN NAME</th>
      <th>DESIGN IMAGE</th>
      <th>PRICE</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
	<?php
	
			if(isset($_POST['submit']))
			{
        $i=$startpoint;
        $i+=1;
				$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from design WHERE Design_id like'%$search%' or Design_name like '%$search%' or Design_image like '%$search%' or  Price like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
  $t_c=$queryresult;
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
			$id=$row['Design_id'];
					echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$row['Design_name']."</td>
					<td><image src='../image/".$row['Design_image']."' height=100 width=100/></td>
			
					<td>₹ ".$row['Price']."</td>
				"; ?>
            <td><a href="?link=42&edit_design=<?php echo $id ?>" class="fas fa-fw fa-edit"></a></td>
					  <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_design.php?delete_d=<?php echo $id ?>'}" class="fas fa-fw fa-trash"></a></td>
					</tr>
					<?php
		$i+=1;}
	}else{
		echo "<script> alert('No Result Found') </script>";
	}
}

else 
{
    $i=$startpoint;
    $i+=1;
      
      while($row_c=mysqli_fetch_array($result)){


        $d_id=$row_c['Design_id'];
        $d_name=$row_c['Design_name'];
        $d_image=$row_c['Design_image'];
        $price=$row_c['Price'];
    
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $d_name; ?></td>
       <td><img src="../image/<?php echo $d_image; ?>" width="130" height="80"/></td>
       <td>₹ <?php echo $price; ?></td>
     
        <td><a href="?link=42&edit_design=<?php echo $d_id ?>" class="fas fa-fw fa-edit"></a></td>
        <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_design.php?delete_d=<?php echo $d_id ?>'}" class="fas fa-fw fa-trash"></a></td>
    </tr>
<?php $i+=1;} ?>
<?php } ?>
  </table>

   <hr>
  <?php 
  echo "<div id='pagingg's>";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
?>
 <?php 
 if(isset($_POST['showall']))
 {
   echo "<script>window.open('./index.php?link=27','_self')</script>";

 }
mysqli_close($conn);
 ?>
  <hr>
</body>

</html>
