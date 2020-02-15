<html>
  <title>
        VIEW COMPLAIN
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css">
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
      <td colspan="7" align="center">
        <h2>
          View All COMPLAIN
        </h2>
      </td>
    </tr>
    <tr>
      <th>COMPLAIN_ID</th>
      <th>USER_NAME</th>
      <th>COMPLAIN_DATE</th>
      <th>PRODUCT_NAME</th>
      <th>SALES_ID</th>
      <th>DESCRIPTION</th>
      <th>DELETE</th>
    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit'])){
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from complain where 
          Complain_id='%$search%' or  Complain_date like '%$search%' or  Description like '%$search%' or Sales_id like '%$search%' ";
          $result=mysqli_query($conn,$sql);
           $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
          $id=$row['Complain_id'];
          $c_date=$row['Complain_date'];
                  $originalDate = $c_date;
        $newDate = date("d-m-Y", strtotime($originalDate));
          $des=$row['Description'];
          $s_id=$row['Sales_id'];      
          $hp="select User_id from Complain  where Complain_id='$id' and Description='$des' and Complain_date='$c_date' and Sales_id='$s_id'";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_array($result)) {
            # code...
            $id1=$row2['User_id'];
          } 
          $sql3="select USER_NAME from login where USER_ID='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['USER_NAME'];
          }
           $hp3="select Product_id from Complain  where Complain_id='$id' and Description='$des' and Complain_date='$c_date' and Sales_id='$s_id'";
          $result1=mysqli_query($conn,$hp3);
          $id3="";
          while ($row2=mysqli_fetch_array($result1)) {
            # code...
            $id3=$row2['Product_id'];
          } 
          $sql4="select Product_name from product where Product_id='$id3'";
          $hp6=mysqli_query($conn,$sql4);
          $id5="";
          while($row4=mysqli_fetch_array($hp6)){
            $id5=$row4['Product_name'];
          }


          echo"
          <tr align='center'>
           <td> ".$row["Complain_id"]."</td>
          <td>".$id2."</td> 
          <td>".$newDate."</td>
          <td>".$id5."</td>
          <td>".$row["Sales_id"]."</td>
          <td>".$row["Description"]."</td>"?>
        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='../delete/delete_complain.php?delete_c=<?php echo $id;?>'}">DELETE </a></td>
          </tr> 
           
           <?php

    }
  }
  elseif($queryresult<1) {
          $sql3="select * from complain where User_id in(select USER_ID from login where USER_NAME like '%$search%') or  Product_id in (select Product_id from product where Product_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            $pro_id=$row3['Product_id'];
            $user=$row3['User_id'];
            $sql4="select * from complain where Product_id='$pro_id' and User_id='$user'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $c_id=$row4['Complain_id'];
              $date=$row4['Complain_date'];
              $originalDate = $date;
              $newDate1 = date("d-m-Y", strtotime($originalDate));
              $s_id=$row4['Sales_id'];
              $desc=$row4['Description'];

              $sql5="select Product_name from product where  Product_id='$pro_id'";
              $result5=mysqli_query($conn,$sql5);
              $pro_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $pro_name=$row5['Product_name'];
              }
              $sql6="select USER_NAME from login where USER_ID='$user'";
              $result6=mysqli_query($conn,$sql6);
              $user_name="";
              while($row6=mysqli_fetch_array($result6))
              {
                $user_name=$row6['USER_NAME'];
              }
              echo"
          <tr align='center'>
          <td>".$c_id."</td>          
          <td> ".$user_name."</td>
          <td>".$newDate1."</td>
          <td>".$pro_name."</td>
          <td>".$s_id."</td>
          <td>".$desc."</td>"?>
           <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_complain.php?delete_c=<?php echo $c_id;?>'}">DELETE </a></td>
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
      $get_c="select * from complain c,login l,sales s,product p where c.User_id=l.USER_ID and c.Sales_id=s.Sales_id and c.Product_id=p.Product_id;";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $c_id=$row_c['Complain_id'];
        $u_name=$row_c['USER_NAME'];
        $c_date=$row_c['Complain_date'];
        $p_name=$row_c['Product_name'];
        $s_id=$row_c['Sales_id'];
        $desc=$row_c['Description'];
        $originalDate = $c_date;
        $newDate = date("d-m-Y", strtotime($originalDate));
?>
       <tr align="center">
       <td><?php echo $c_id; ?></td>
       <td><?php echo $u_name; ?></td>
       <td><?php echo $newDate; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $s_id; ?></td>
       <td><?php echo $desc; ?></td>
       <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_complain.php?delete_c=<?php echo $c_id;?>'}">DELETE </a></td>
    </tr>
<?php } ?>
<?php } ?>
<?php 
if (isset($_POST['showall'])){}
?>
  </table>
</body>
</html>