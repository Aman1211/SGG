<?php
include('./db.php');
 $url='index.php?link=21&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from price_size";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "price_size"; //you have to pass your query over here table name
      

$query = "SELECT * FROM price_size order by Price_Size_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <title>
        VIEW PRICE_SIZE
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
  <div class="table table-bordered" id="hptable">
  <table id="data">
    <tr>
      <td colspan="9" align="center">
        <h2>
          View All THICKNESS PRICE
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>THICKNESS</th>
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
        $sql= "select *  from price_size WHERE Price_Size_id like'%$search%' or Thickness like '%$search%' or Price like '%$search%' ";
        $result=mysqli_query($conn,$sql); 
        $queryresult=mysqli_num_rows($result);
        $t_c=$queryresult;
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['Price_Size_id'];
         $name=$row['Thickness'];
         $amount=$row['Price'];
          echo"
          <tr align='center'>
           <td> ".$i."</td>
          <td>".$row['Thickness']."</td> 
<td>₹ ".$row['Price']."</td>
          " ?>
         <td> <a href="?link=44&edit_p=<?php echo $id ?>" class="fas fa-fw fa-edit"></a></td>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_price_size.php?delete_p=<?php echo $id;?>'}" class="fas fa-fw fa-trash"></a></td>
          </tr> 
           
           <?php

    $i+=1;}
  }else{
     echo "<script>alert ('No Result Found')</script>";
  }
}


    else{
      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
		$p_id=$row_c['Price_Size_id'];
		$thik=$row_c['Thickness'];
		$amount=$row_c['Price'];
	
?>
<tr align="center">
	<td><?php echo $i; ?> </td>
	<td><?php echo $thik; ?> </td>
	<td>₹ <?php echo $amount; ?> </td> 
	
        <td> <a href="?link=44&edit_p=<?php echo $p_id ?>" class="fas fa-fw fa-edit"></a></td>
  
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_price_size.php?delete_p=<?php echo $p_id;?>'}" class="fas fa-fw fa-trash"></a></td>
        
</tr>
<?php  $i+=1;} ?><?php } ?>
  </table>
</div>
  <?php 
if(isset($_POST['showall'])){

  echo "<script>window.open('./index.php?link=21','_self')</script>";

}  ?>


  <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
?>
 <?php  mysqli_close($conn);?>
  <hr>


</body>

</html>
