<?php
include('./db.php');
 $url='index.php?link=6&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from brand";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 10; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "brand"; //you have to pass your query over here table name
        $query="select * from brand LIMIT {$startpoint} , {$limit}";
        $result=mysqli_query($conn,$query);

?>


<html>
  <title>
        VIEW BRAND
  </title>
  <head>
<link rel="stylesheet" href="view_style.css" type="text/css"/>
<link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

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
      <input type="text" placeholder="Search Brand ..." name="search">
      <button type="submit" name="submit">Search</button>
	  <button type="submit" name="showall">Showall</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="4" align="center">
        <h2>
          VIEW All BRAND
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>BRAND NAME</th>
      <th>EDIT</th>
      <th>DELETE</th>
          </tr>
    <?php

      
      if(isset($_POST['submit']))
      { $i=$startpoint;
        $i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from Brand WHERE Brand_name like '%$search%' ";
  $result=mysqli_query($conn,$sql);
  $t_c=mysqli_num_rows($result);
  $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['Brand_id'];
         $name=$row['Brand_name'];
          echo"
          <tr align='center'>
           <td> ".$i."</td>
          <td>".$row['Brand_name']."</td> " ?>
        <td><a href="?link=57&edit_b=<?php echo $id;?>"class="fas fa-fw fa-edit"></a></td>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_brand.php?delete_b=<?php echo $id;?>'}" class="fas fa-fw fa-trash"> </a></td>
        
          </tr> 
           
           <?php

  $i+=1;  }
  }else{
     echo "<script>alert ('No Result Found')</script>";
  }
}


else{ 
  $i='1';
  
 /*     $get_c="select * from brand";
      $run_c=mysqli_query($conn,$get_c);
      $no_rec=mysqli_num_rows($run_c);
      //$i=0;*/
      while($row_c=mysqli_fetch_array($result)){
        $b_id=$row_c['Brand_id'];
        $b_NAME=$row_c['Brand_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $b_NAME; ?></td>
        <td><a href="?link=57&edit_b=<?php echo $b_id;?>"class="fas fa-fw fa-edit"></a></td>
        <td><a href="javascript:if(confirm('Are you sure, you want to delete this Record?')) {location.href='./delete/delete_brand.php?delete_b=<?php echo $b_id; ?>'}"class="fas fa-fw fa-trash"></a></td>
       
     </tr>
<?php $i++; } ?>
<?php } ?>

<?php 
  if(isset($_POST['Show_All']))
  {
  echo "<script>window.open('./index.php?link=6','_self')</script>";

  }
?>
  </table>

<?php

echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";



mysqli_close($conn);
 ?>


</body>

</html>