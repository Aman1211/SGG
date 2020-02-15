<html>
  <title>
        VIEW LABOUR_TYPE
  </title>
 <link rel="stylesheet" href="view_style.css" type="text/css"/> 
<head>
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
      <td colspan="3" align="center">
        <h2>
          VIEW All LABOUR TYPE
        </h2>
      </td>
    </tr>
    <tr>
      <th>LABOUR_TYPE_ID</th>
      <th>LABOUR_TYPE_NAME</th>
      <th>Delete</th>
    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from labour_type WHERE Labour_type_id like'%$search%' or Labour_type_name like '%$search%' ";
  $result=mysqli_query($conn,$sql);
  $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['Labour_type_id'];
         $name=$row['Labour_type_name'];
          echo"
          <tr align='center'>
           <td> ".$row["Labour_type_id"]."</td>
          <td>".$row['Labour_type_name']."</td> " ?>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_labour_type.php?delete_c=<?php echo $id;?>'}">DELETE </a></td>
          </tr> 
           
           <?php

    }
  }else{
    echo "<script>alert ('No Result Found')</script>";
  }
}

      else{
      $get_c="select * from labour_type";
      $run_c=mysqli_query($conn,$get_c);
      //$i=0;
      while($row_c=mysqli_fetch_array($run_c)){
        $l_id=$row_c['Labour_type_id'];
        $l_type_NAME=$row_c['Labour_type_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $l_id; ?></td>
       <td><?php echo $l_type_NAME; ?></td>
       <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_labour_type.php?delete_c=<?php echo $l_id;?>'}">DELETE </a></td>
     </tr>
<?php } ?><?php } ?>
  </table>
  <?php
if(isset($_POST['showall'])){}
  ?>

</body>

</html>
