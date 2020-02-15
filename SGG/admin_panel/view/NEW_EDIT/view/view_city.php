<html>
  <title>
        VIEW CITY
  </title><head>
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
          VIEW All CITY
        </h2>
      </td>
    </tr>
    <tr>
      <th>CITY ID</th>
      <th>CITY NAME</th>
      <th>EDIT </th>
      <th>DELTE</th>
    </tr>
    <?php

      include("./db.php");
      if (isset($_POST['submit'])){
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from city where City_id like '%$search%' or City_name like '%$search%'";
        $result=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($result);
        if($queryresult>0){
          while ($row=mysqli_fetch_assoc($result)) {
            $id=$row['City_id'];
            $name=$row['City_name'];
            echo "
              <tr align='center'>
              <td>".$row['City_id']."</td>
              <td>".$row['City_name']. "</td>"?>
               <td><a href="javascript:if(confirm('Are you sure do you want to edit this record?')){location.href='./EDIT/edit_city.php?edit_city=<?php echo $id ?>'}">EDIT</a></td>
             
              <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $id ?>'}">DELETE</a></td>
              </tr>
              <?php
          }
        }
        else
        {
          echo "<script>alert ('no result found')</script>";
        }
      }
      else{
      $get_c="select * from city";
      $run_c=mysqli_query($conn,$get_c);
      while($row_c=mysqli_fetch_array($run_c)){
        $c_id=$row_c['City_id'];
        $c_NAME=$row_c['City_name'];
          //$i++;
      ?>
     <tr align="center">
       <td><?php echo $c_id; ?></td>
       <td><?php echo $c_NAME; ?></td>
         <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./EDIT/edit_city.php?edit_city=<?php echo $c_id ?>'}">EDIT</a></td>

        <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_city.php?delete_c=<?php echo $c_id ?>'}">DELETE</a></td>
     </tr>
<?php } ?>
<?php } ?>
  </table>
<?php
if (isset($_POST['showall'])) {
  # code...
}
?>
</body>
</html>
