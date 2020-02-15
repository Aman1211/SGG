<?php
include('./db.php');
 $url='index.php?link=4&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from city";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 10; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "city"; //you have to pass your query over here table name
        $query = "SELECT * FROM city order by City_id DESC LIMIT  {$startpoint}, {$limit}";
        $result=mysqli_query($conn,$query);
?>


<html>
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
      <input type="text" placeholder="Search city " name="search">
      <button type="submit" name="submit">Search</button>
	  <button type="submit" name="showall">Showall</button>
    </form>
  </div>
 
  <div> 
   <table id="data">
    <tr>
      <td colspan="4" align="center">
        <h2>
          VIEW All CITY
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>CITY NAME</th>
      <th>EDIT </th>
      <th>DELETE</th>
    </tr>
    <?php

      
      if (isset($_POST['submit'])){
        $i=$startpoint;
        $i++;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from city where  City_name like '%$search%'";
        $result=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($result);
        $t_c=$queryresult;
        if($queryresult>0){
          while ($row=mysqli_fetch_assoc($result)) {
            $id=$row['City_id'];
            $name=$row['City_name'];
            echo "
              <tr align='center'>
              <td>".$i."</td>
              <td>".$row['City_name']. "</td>"?>
               <td><a href="?link=60&edit_city=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
             
              <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $id ?>'}"class="fas fa-fw fa-trash"></a></td>
              </tr>
              <?php
          $i++;}
        }
        else
        {
          echo "<script>alert ('no result found')</script>";
        }
      }
      else{
     /* $get_c="select * from city ";
      $get_c="";
      $run_c=mysqli_query($conn,$get_c);*/
      $i=$startpoint;
      $i++;
      while($row_c=mysqli_fetch_array($result)){
        $c_id=$row_c['City_id'];
        $c_NAME=$row_c['City_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $c_NAME; ?></td>
         <td><a href="?link=60&edit_city=<?php echo $c_id ?>"class="fas fa-fw fa-edit"></a></td>

        <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $c_id ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
<?php $i++;} ?>
<?php } ?>
  </table>
</div>
<?php
if (isset($_POST['showall'])) {
 echo "<script>window.open('./index.php?link=4','_self')</script>";
}
?>

    <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
mysqli_close($conn);
 ?>
</hr>
</body>
</html>
