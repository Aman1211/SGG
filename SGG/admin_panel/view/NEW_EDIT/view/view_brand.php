<html>
  <title>
        VIEW BRAND
  </title>
  <head>
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
          VIEW All BRAND
        </h2>
      </td>
    </tr>
    <tr>
      <th>BRAND ID</th>
      <th>BRAND NAME</th>
      <th>DELETE</th>
      <th>EDIT</th>
    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from Brand WHERE Brand_id like'%$search%' or Brand_name like '%$search%' ";
  $result=mysqli_query($conn,$sql);
  $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['Brand_id'];
         $name=$row['Brand_name'];
          echo"
          <tr align='center'>
           <td> ".$row["Brand_id"]."</td>
          <td>".$row['Brand_name']."</td> " ?>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_brand.php?delete_b=<?php echo $id;?>'}">DELETE </a></td>
        <td><a href="javascript:if(confirm('Are You Want to update this record')) {location.href='./EDIT/edit_breand.php?edit_b=<?php echo $id;?>'}">EDIT</a></td>
          </tr> 
           
           <?php

    }
  }else{
     echo "<script>alert ('No Result Found')</script>";
  }
}


else{
      $get_c="select * from brand";
      $run_c=mysqli_query($conn,$get_c);
      //$i=0;
      while($row_c=mysqli_fetch_array($run_c)){
        $b_id=$row_c['Brand_id'];
        $b_NAME=$row_c['Brand_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $b_id; ?></td>
       <td><?php echo $b_NAME; ?></td>
       <td><a href="javascript:if(confirm('Are you sure, you want to delete this Record?')) {location.href='./delete/delete_brand.php?delete_b=<?php echo $b_id; ?>'}">DELETE</a></td>
        <td><a href="javascript:if(confirm('Are You Want to update this record')) {location.href='./EDIT/edit_brand.php?edit_b=<?php echo $b_id;?>'}">EDIT</a></td>
     </tr>
<?php } ?>
<?php } ?>

<?php 
  if(isset($_POST['Show_All']))
  {}
?>
  </table>
</body>

</html>