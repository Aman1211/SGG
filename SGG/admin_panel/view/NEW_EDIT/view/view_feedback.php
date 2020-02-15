<html>
  <title>
        VIEW FEEDBACK
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
      <td colspan="5" align="center">
        <h2>
          View All FEEDBACK
        </h2>
      </td>
    </tr>
    <tr>
      <th>FEEDBACK_ID</th>
      <th>PRODUCT_NAME</th>
      <th>FEEDBACK_DESCRIPTION</th>
     
      <th>USER_NAME</th>
     <th>FEEDBACK_DATE</th>
    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from Feedback where Feedback_id like '%$search%' or Feedback_desc like '%$search%' or Feedback_date like '%$search%'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        if($queryresult>0)
        {
          while($row=mysqli_fetch_assoc($hardik)){
            $id=$row['Feedback_id'];
            $F_desc=$row['Feedback_desc'];
            $f_date=$row['Feedback_desc'];
            $originalDate = $f_date;
            $newDate = date("d-m-Y", strtotime($originalDate));

            $hp="select User_id from FEEDBACK  where Feedback_id='$id' and Feedback_desc='$F_desc' and Feedback_date='$f_date' ";
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
            $id2=$row['USER_NAME'];
          }
           $hp3="select Product_id from FEEDBACK  where Feedback_id='$id' and Feedback_desc='$F_desc' and Feedback_date='$f_date' ";
           $result1=mysqli_query($conn,$hp3);
          $id3="";
          while ($row2=mysqli_fetch_array($result1)) {
            # code...
            $id3=$row2['Product_id'];
          } 
          $sql4="select Product_name from product where Product_id='$id3'";
          $hp6=mysqli_query($conn,$sql4);
          $id5="";
          while($row3=mysqli_fetch_array($hp6)){
            $id5=$row['Product_name'];
          }
          
            echo"
          <tr align='center'>
           <td> ".$row["Feedback_id"]."</td>
          <td>".$id3."</td> 
          <td>".$row["Feedback_desc"]."</td>
          <td>".$id2."</td>
          <td>".$newDate."</td>"
    ?>       </tr>
           <?php
         
           }
          }
        elseif($queryresult<1)
        {
          $sql3="select * from feedback where Product_id in(select Product_id from product where Product_name like '%$search%') or User_id in (select USER_ID from login where USER_NAME like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            $pro_id=$row3['Product_id'];
            $user=$row3['User_id'];
            $sql4="select * from feedback where Product_id='$pro_id' and user_id='$user'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $feed_id=$row4['Feedback_id'];
              $desc=$row4['Feedback_desc'];
              $date=$row4['Feedback_date'];$originalDate = $date;
            $newDate1 = date("d-m-Y", strtotime($originalDate));

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
         <td>".$feed_id."</td> 
          <td>".$pro_name."</td>
           <td> ".$desc."</td>
           <td>".$user_name."</td>
          <td>".$newDate1."</td>
          
          </tr>";
          }
            }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }
    
      else{
      $get_c="select * from Feedback f,Product p,login l where f.User_id=l.USER_ID and p.Product_id=f.Product_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $f_id=$row_c['Feedback_id'];
        $p_name=$row_c['Product_name'];
        $f_desc=$row_c['Feedback_desc'];
        $f_date=$row_c['Feedback_date'];
        $u_name=$row_c['USER_NAME'];
        $originalDate = $f_date;
        $newDate = date("d-m-Y", strtotime($originalDate));
      $i++;
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $f_desc; ?></td>
       <td><?php echo $u_name; ?></td>
       <td><?php echo $newDate; ?></td>
    </tr>
<?php } ?>
<?php } ?>
<?php
if(isset($_POST['showall'])){}
?>
  </table>
</body>
</html>