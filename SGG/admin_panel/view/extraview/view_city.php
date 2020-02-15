<?php
include('./db.php');
$record_per_page = 6;
$page = '';
if(isset($_GET["page"]))
{
 $page = $_GET["page"];
}
else
{
 $page = 1;
}

$start_from = ($page-1)*$record_per_page;

$query = "SELECT * FROM city order by City_id LIMIT $start_from, $record_per_page";
$result = mysqli_query($conn, $query);

?>


<html>
  <title>
        VIEW CITY
  </title><head>
<link rel="stylesheet" href="view_style.css" type="text/css"/>
  <link href="css/dataTables.bootstrap.css" rel="stylesheet">
        <link href="css/dataTables.responsive.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
 
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
 .hp {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
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
      <td colspan="4" align="center">
        <h2>
          VIEW All CITY
        </h2>
      </td>
    </tr>
    <tr>
      <th>Sr No.</th>
      <th>CITY NAME</th>
      <th>EDIT </th>
      <th>DELETE</th>
    </tr>
    <?php
$i=$start_from;
$i+=1;

      include("./db.php");
      if (isset($_POST['submit'])){
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from city where City_id like '%$search%' or City_name like '%$search%'";
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
               <td><a href="javascript:if(confirm('Are you sure do you want to edit this record?')){location.href='./EDIT/edit_city.php?edit_city=<?php echo $id ?>'}"class="fas fa-fw fa-edit"></a></td>
             
              <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $id ?>'}"class="fas fa-fw fa-trash"></a></td>
              </tr>
              <?php
      $i+=1;
          }
        }
        else
        {
          echo "<script>alert ('no result found')</script>";
        }
      }
      else{
         $i=$start_from;
  $i+=1;
     /* $get_c="select * from city ";
      $get_c="";
      $run_c=mysqli_query($conn,$get_c);*/
      while($row_c=mysqli_fetch_array($result)){
        $c_id=$row_c['City_id'];
        $c_NAME=$row_c['City_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $c_NAME; ?></td>
         <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./EDIT/edit_city.php?edit_city=<?php echo $c_id ?>'}"class="fas fa-fw fa-edit"></a></td>

        <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $c_id ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>

<?php $i+=1; } ?>
<?php  } ?>
  </table>
  </div>
  
      <div align="center">
    <br />
    <?php
    $page_query = "SELECT * FROM city ORDER BY City_id";
    $page_result = mysqli_query($conn, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$record_per_page);
    $start_loop = $page;
    $difference = $total_pages - $page;
      if($difference >= 5)
    {
     $start_loop = $total_pages - 5;
    }
    else
    {
      $start_loop=1;
    }
    if($total_records>6){
    $end_loop = $start_loop+2;
    if($page > 1)
    {
     echo "<a class='hp' href='index.php?link=4&page=1'>First</a>";
     echo "<a class='hp' href='index.php?link=4&page=".($page - 1)."'><<</a>";
    }
 
    for($i=$start_loop; $i<$end_loop; $i++)
    {     
     echo "<a class='hp' href='index.php?link=4&page=".$i."'>".$i."</a>";
    }
    if($page <= $end_loop)
    {
     echo "<a class='hp' href='index.php?link=4&page=".($page + 1)."'>>></a>";
     echo "<a class='hp' href='index.php?link=4&page=".$total_pages."'>Last</a>";
    }
}
 
    ?>
    </div>
<?php
if (isset($_POST['showall'])) {
  # code...
}
?>
 <hr>
  <?php if(isset($_POST['submit'])){?>
  <h2 style="margin-top:13px;">No Of Records :- <?php echo $t_c;?></h2>
  <?php }else {?>
   <h2 style="margin-top:13px;">No Of Records :- <?php echo $total_records;?></h2>
 <?php }?>
  <hr>
</body>
</html>
