<html>
 <title>         VIEW PRODUCT IMAGE   </title>
<link rel="stylesheet" href="view_style.css" type="text/css"/> <body> <form action="" method="POST">
<input type="text" name="search" placeholder="Search">     
<button
type="submit" name="submit">Search</button>     </form>   <table id="data">
<tr>       <td colspan="5" align="center">         <h2>           View All
PRODUCTS IMAGES         </h2>       </td>     </tr>      <tr>
<th>PRODUCT_ID</th>       <th>PRODUCT_NAME</th>      <th>IMAGE1</th>
<th>IMAGE2</th>        <th>IMAGE2</th>       </tr>       <?php
$path=array();       include("./db.php");        if(isset($_POST['submit']))
{                 $search=mysqli_real_escape_string($conn,$_POST['search']);
}       $query="select distinct(Product_id) from product_image";
$execute=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($execute))       {
array_push($path,$row['Product_id']);       }        ?>       <?php
	 
	  $len=sizeof($path);
	  for($i=0;$i<$len;$i++)
	  {
		   $path1=array();
				$p_id=$path[$i];
				$query_name="select Product_name from product where Product_id=$p_id";
				$execute_name=mysqli_query($conn,$query_name);
				while($row_name=mysqli_fetch_array($execute_name))
				{
					$pro_name=$row_name['Product_name'];
				}
				$query3="select Image_path from product_image where Product_id=$p_id";
				$execute3=mysqli_query($conn,$query3);
				while($row3=mysqli_fetch_array($execute3))
				{
					array_push($path1,$row3['Image_path']);
				}
				$size=sizeof($path1);	
	
?>		
<?php if($size==1) {?>
	  <tr align="center">
	  <td> <?php echo $p_id; ?></td>
	  <td> <?php echo $pro_name;?></td>
	  <td><img src="view/product_image/<?php echo $path1[0]; ?>" width="130" height="80"/></td>
	  </tr>
	  
<?php unset($path1); } ?>
<?php if($size==2) {?>
	  <tr align="center">
	  <td> <?php echo $p_id; ?></td>
	  <td> <?php echo $pro_name;?></td>
	  <td><img src="view/product_image/<?php echo $path1[0]; ?>" width="130" height="80"/></td>
	   <td><img src="view/product_image/<?php echo $path1[1]; ?>" width="130" height="80"/></td>
	  </tr>
<?php unset($path1);} ?>
<?php if($size==3) {?>
	  <tr align="center">
	  <td> <?php echo $p_id; ?></td>
	  <td> <?php echo $pro_name;?></td>
	  <td><img src="view/product_image/<?php echo $path1[0]; ?>" width="130" height="80"/></td>
	   <td><img src="view/product_image/<?php echo $path1[1]; ?>" width="130" height="80"/></td>
	    <td><img src="view/product_image/<?php echo $path1[2]; ?>" width="130" height="80"/></td>
	  </tr>
<?php unset($path1);} ?>
	<?php }
mysqli_close($conn);

	?>	
	</table>
	</body>
	</html>