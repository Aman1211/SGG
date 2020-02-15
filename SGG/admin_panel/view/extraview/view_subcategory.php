<html>
  <title>
        VIEW SUBCATEGORY
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
      <td colspan="5" align="center">
        <h2>
          VIEW All SUB_CATEGORY
        </h2>
      </td>
    </tr>
    <tr>
      <th>SUB_CATEGORY_ID</th>
      <th>SUB_CATEGORY_NAME</th>
      <th>CATEGORY_NAME</th>
      <th>Delete</th>

    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from subcategory where Subcategory_id like '%$search%' or Subcategory_name like '%$search%'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        if($queryresult>0)
        {
          while($row=mysqli_fetch_array($hardik)){
            $id=$row['Subcategory_id'];
            $s_name=$row['Subcategory_name'];
            
            $hp="select Category_id from subcategory where Subcategory_id='$id' and Subcategory_name='$s_name'";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_assoc($result)) {
            $id1=$row2['Category_id'];
          echo "<script>alert('$id1');</script>";
          
          } 
          $sql3="select Category_name from Category where Category_id='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['Category_name'];
          }
            echo"
          <tr align='center'>
           <td> ".$row["Subcategory_id"]."</td>
           <td>".$row["Subcategory_name"]."</td> 
           <td>".$id2."</td>
          " ?>
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_subcategory.php?delete_s=<?php echo $id; ?>'}">DELETE</a></td>
             </tr>

           <?php
         
           }
          }
   elseif($queryresult<1)
        {
          $sql3="select * from subcategory where Category_id in(select Category_id from Category where Category_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            $lid=$row3['Category_id'];
            
            $sql4="select * from subcategory where Category_id='$lid'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $l_id=$row4['Subcategory_id'];
              $SB_name=$row4['Subcategory_name'];
              
              $sql5="select Category_name from category where Category_id='$lid'";
              $result5=mysqli_query($conn,$sql5);
              $pro_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $l_name=$row5['Category_name'];
              }
              echo"
          <tr align='center'>
          <td> ".$l_id."</td>
          <td>".$SB_name."</td>
          <td>".$l_name."</td>"?>
       <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_subcategory.php?delete_s=<?php echo $l_id; ?>'}">DELETE</a></td>
          
          </tr>
          <?php
          }
            }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }
else{
      $get_c="select * from Category a , subcategory c where a.Category_id=c.Category_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $s_id=$row_c['Subcategory_id'];
        $s_NAME=$row_c['Subcategory_name'];
        $c_name=$row_c['Category_name'];

    $i++;
?>
     <tr align="center">
       <td><?php echo $s_id; ?></td>
       <td><?php echo $s_NAME; ?></td>
       <td><?php echo $c_name; ?></td>
       <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_subcategory.php?delete_s=<?php echo $s_id; ?>'}">DELETE</a></td>
     </tr>
<?php } ?>
<?php } ?>
<?php
if(isset($_POST['showall'])){}
?>
  </table>
</body>

</html>
