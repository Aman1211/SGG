<?php
include('./db.php');
 $url='index.php?link=8&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from category";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "category"; //you have to pass your query over here table name
      
$query = "SELECT * FROM category order by Category_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>


<?php $no_rec="";$i=1;?>
<html>
  <title>
        VIEW CATEGORY
  </title>
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
  <head>

<link rel="stylesheet" href="view_style.css" type="text/css"/>
 <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

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
      <td colspan="4" align="center">
        <h2>
          VIEW All CATEGORY
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>CATEGORY NAME</th>
      <th>EDIT</th>
      <th>DELETE</th>
    </tr>
    <?php
$i=$startpoint;
$i+=1;
      
      if(isset($_POST['search'])){
          $search=mysqli_real_escape_string($conn,$_POST['search']);
          $sql= "select * from Category WHERE Category_id like'%$search%' or Category_name like '%$search%'";
         $result=mysqli_query($conn,$sql);
         $t_c=mysqli_num_rows($result);

        $queryresult=mysqli_num_rows($result);
      if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
      $id=$row['Category_id'];
      $name=$row['Category_name'];
          echo"
          <tr align='center'>
          <td> ".$i."</td>
          <td>".$row['Category_name']."</td>"?>
          <td><a href="?link=58&edit_c=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
          <td><a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_category.php?delete_b=<?php echo $id ?>'}"class="fas fa-fw fa-trash"></a></td>
          </tr>
<?php
          $i+=1;}
  }
  else{
      echo "<script> alert('No Result Found') </script>";
  }
}else{
      $i=$startpoint;
      $i+=1;
      
      

      while($row_c=mysqli_fetch_array($result)){
        $b_id=$row_c['Category_id'];
        $b_NAME=$row_c['Category_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $b_NAME; ?></td>
        <td><a href="?link=58&edit_c=<?php echo $b_id; ?>"class="fas fa-fw fa-edit"></a></td>
     
       <td><a href="javascript:if(confirm('Are you sure, you want to delete this Record?')) {location.href='./delete/delete_category.php?delete_b=<?php echo $b_id; ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
<?php $i+=1;} ?>
  
  <?php } ?>
  <?php 
  if(isset($_POST['Show_All']))
  {
  echo "<script>window.open('./index.php?link=8','_self')</script>";

  }
?>
</table>

  <hr>
  <?php echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";

mysqli_close($conn);
 ?>
  </hr>

</body>
</html>
