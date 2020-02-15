<html>
  <title>
        VIEW PRICE_SIZE
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
          View All THICKNESS PRICE
        </h2>
      </td>
    </tr>
    <tr>
      <th>PRICE SIZE ID</th>
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
        $sql= "select *  from price_size WHERE Price_Size_id like'%$search%' or Thickness like '%$search%' or Price like '%$search%' ";
        $result=mysqli_query($conn,$sql); 
        $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['Price_Size_id'];
         $name=$row['Thickness'];
         $amount=$row['Price'];
          echo"
          <tr align='center'>
           <td> ".$row["Price_Size_id"]."</td>
          <td>".$row['Thickness']."</td> 
<td>".$row['Price']."</td>
          " ?>
         <td> <a href="javascript:if(confirm('Are you want to edit this record?')) {location.href='./edit_price_size.php?edit_p=<?php echo $id;?>'}">EDIT </a></td>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_price_size.php?delete_p=<?php echo $id;?>'}">DELETE </a></td>
          </tr> 
           
           <?php

    }
  }else{
     echo "<script>alert ('No Result Found')</script>";
  }
}


    else{
      $get_c="select *  from price_size";

      $run_c=mysqli_query($conn,$get_c);
      while($row_c=mysqli_fetch_array($run_c)){
		$p_id=$row_c['Price_Size_id'];
		$thik=$row_c['Thickness'];
		$amount=$row_c['Price'];
	
?>
<tr align="center">
	<td><?php echo $p_id; ?> </td>
	<td><?php echo $thik; ?> </td>
	<td><?php echo $amount; ?> </td> 
	
        <td> <a href="javascript:if(confirm('Are you want to edit this record?')) {location.href='./edit_price_size.php?edit_p=<?php echo $p_id;?>'}">EDIT </a></td>
  
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_price_size.php?delete_p=<?php echo $p_id;?>'}">DELETE </a></td>
        
</tr>
<?php } ?><?php } ?>
  </table>
  <?php 
if(isset($_POST['showall'])){
}  ?>

</body>

</html>
