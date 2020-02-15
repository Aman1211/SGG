<?php
include('./db.php');
 $url='index.php?link=39&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";$sta="";
        
        $query="select * from complain";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 1; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "complain"; //you have to pass your query over here table name

$query = "SELECT * FROM complain order by Complain_id DESC LIMIT {$startpoint},{$limit}";
$result1 = mysqli_query($conn, $query);

?>
<html>
  <title>
        VIEW COMPLAIN
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css">

 <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />
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
      <td colspan="8" align="center">
        <h2>
          View All COMPLAIN
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>USER NAME</th>
      <th>CONTACT NO</th>
      <th>COMPLAIN DATE</th>
      <th>PRODUCT NAME</th>

      <th>SALES ID</th>
      <th>DESCRIPTION</th>
      <th>STATUS</th>
    </tr>
    <?php
    $i=$startpoint;
    $i++;
      
      if(isset($_POST['submit'])){
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from complain where 
          Complain_id='%$search%' or  Complain_date like '%$search%' or  Description like '%$search%' or Sales_id like '%$search%' ";
          $result_r=mysqli_query($conn,$sql);
           $queryresult=mysqli_num_rows($result_r);
        $t_c=$queryresult;
  if($queryresult>0){
     $i=$startpoint;
    $i++;
    while($row=mysqli_fetch_assoc($result_r)){
          $id=$row['Complain_id'];
          $sta=$row['status'];
          $c_date=$row['Complain_date'];
                  $originalDate = $c_date;
        $newDate = date("d-m-Y", strtotime($originalDate));
          $des=$row['Description'];
          $s_id=$row['Sales_id'];      
          $hp="select User_id from complain  where Complain_id='$id' and Description='$des' and Complain_date='$c_date' and Sales_id='$s_id'";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_array($result)) {
            # code...
            $id1=$row2['User_id'];
          } 
          $sql3="select USER_NAME,contact_no from login where USER_ID='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['USER_NAME'];
            $c_no=$row3['contact_no'];
          }
           $hp3="select Product_id from complain  where Complain_id='$id' and Description='$des' and Complain_date='$c_date' and Sales_id='$s_id'";
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
           <td> ".$i."</td>
          <td>".$id2."</td> 
          <td>".$c_no."</td>
          <td>".$newDate."</td>
          <td>".$id5."</td>
          <td>".$row["Sales_id"]."</td>
          <td>".$row["Description"]."</td>";
          if($sta==''){?>
             <td><a href="./view/edit_complain.php?e_c=<?php echo $id ?>">Pending</a></td>
         <?php  }
         else{?>
             <td>Solved</a></td>
         <?php }



            ?>
<!--        <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='../delete/delete_complain.php?delete_c=<?php echo $id;?>'}">DELETE </a></td>-->
          </tr> 
           
           <?php

  $i++;  }
  }
  elseif($queryresult<1) {
    $i=$startpoint;
    $i++;
          $sql3="select * from complain where User_id in(select USER_ID from login where USER_NAME like '%$search%') or User_id in(select USER_ID from login where contact_no like '%$search%') or  Product_id in (select Product_id from product where Product_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          $t_c=mysqli_num_rows($result3);
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
              $sta=$row4['status'];
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
              $sql6="select USER_NAME,contact_no from login where USER_ID='$user'";
              $result6=mysqli_query($conn,$sql6);
              $user_name="";
              while($row6=mysqli_fetch_array($result6))
              {
                $user_name=$row6['USER_NAME'];
                $c_n=$row6['contact_no'];
              }
              echo"
          <tr align='center'>
          <td>".$i."</td>          
          <td> ".$user_name."</td>
          <td> ".$c_n."</td>
          <td>".$newDate1."</td>
          <td>".$pro_name."</td>
          <td>".$s_id."</td>
          <td>".$desc."</td>";
          if($sta==''){?>
             <td><a href="./view/edit_complain.php?e_c=<?php echo $c_id ?>">Pending</a></td>
         <?php  }
         else{?>
             <td>Solved</a></td>
         <?php }
         ?>
          
<!--           <td> <a href="javascript:if(confirm('Are you want to delete this record?')) {location.href='./delete/delete_complain.php?delete_c=<?php echo $c_id;?>'}">DELETE </a></td>-->
          </tr>
          <?php
          }
        $i++;    }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
}

   else{
     $i=$startpoint;
    $i++;
      while($row_c=mysqli_fetch_array($result1)){
            $p_id=$row_c['Product_id'];
            $u_id=$row_c['User_id'];
            $sta=$row_c['status'];
            $sql4="select * from complain where Product_id='$p_id' and User_id='$u_id'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $c_id=$row4['Complain_id'];
              $date=$row4['Complain_date'];
              $originalDate = $date;
              $newDate= date("d-m-Y", strtotime($originalDate));
              $s_id=$row4['Sales_id'];
              $desc=$row4['Description'];

              $sql5="select Product_name from product where  Product_id='$p_id'";
              $result5=mysqli_query($conn,$sql5);
              $pro_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $p_name=$row5['Product_name'];
              }
              $sql6="select USER_NAME,contact_no from login where USER_ID='$u_id'";
              $result6=mysqli_query($conn,$sql6);
              $user_name="";
              while($row6=mysqli_fetch_array($result6))
              {
                $u_name=$row6['USER_NAME'];
                $c_n=$row6['contact_no'];
              }
            }

          
?>
       <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $u_name; ?></td>
       <td><?php echo $c_n; ?></td>
       <td><?php echo $newDate; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $s_id; ?></td>
       <td><?php echo $desc; ?></td>

       <?php
          if($sta==''){?>
              <td><a href="./view/edit_complain.php?e_c=<?php echo $c_id ?>">Pending</a></td>
         <?php  }
         else{?>
             <td>Solved</a></td>
         <?php }
?>

  
    </tr>
<?php $i++;} ?>
<?php } ?>
<?php 
if (isset($_POST['showall'])){
   echo "<script>window.open('./index.php?link=39','_self')</script>";
}
?>
  </table>
  <hr>
  <?php
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";  
 
mysqli_close($conn);
 ?>
  <hr>
</body>
</html>