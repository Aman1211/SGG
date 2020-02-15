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
      <td colspan="3" align="center">
        <h2>
          VIEW All CATEGORY
        </h2>
      </td>
    </tr>
    <tr>
      <th>CATEGORY_ID</th>
      <th>CATEGORY_NAME</th>
      <th>Delete</th>
    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['search'])){
          $search=mysqli_real_escape_string($conn,$_POST['search']);
          $sql= "select * from Category WHERE Category_id like'%$search%' or Category_name like '%$search%'";
         $result=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($result);
      if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
      $id=$row['Category_id'];
      $name=$row['Category_name'];
          echo"
          <tr align='center'>
          <td> ".$row['Category_id']."</td>
          <td>".$row['Category_name']."</td>"?>
          <td><a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_category.php?delete_b=<?php echo $id ?>'}">DELETE</a></td>
          </tr>
<?php
          }
  }
  else{
      echo "<script> alert('No Result Found') </script>";
  }
}else{
      
      $get_c="select * from category";
      $run_c=mysqli_query($conn,$get_c);
      //$i=0;
      while($row_c=mysqli_fetch_array($run_c)){
        $b_id=$row_c['Category_id'];
        $b_NAME=$row_c['Category_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $b_id; ?></td>
       <td><?php echo $b_NAME; ?></td>
       <td><a href="javascript:if(confirm('Are you sure, you want to delete this Record?')) {location.href='./delete/delete_category.php?delete_b=<?php echo $b_id; ?>'}">DELETE</a></td>
     </tr>
<?php } ?>
  
  <?php } ?>
  <? php 
  if(isset($_POST['Show_All']))
  {}
?>
</table>
</body>
</html>
