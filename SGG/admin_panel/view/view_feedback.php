<?php
include('./db.php');
 $url='index.php?link=38&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from feedback";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "feedback"; //you have to pass your query over here table name
       
$query = "SELECT * FROM feedback order by Feedback_id DESC LIMIT {$startpoint},{$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <title>
        VIEW FEEDBACK
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>
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
      <td colspan="5" align="center">
        <h2>
          View All FEEDBACK
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>USER NAME</th>
      <th>PRODUCT NAME</th>
      <th>FEEDBACK DESCRIPTION</th>
      <th>FEEDBACK DATE</th>
    </tr>
    <?php
      $i=$startpoint;
      $i+=1;
      
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from Feedback where Feedback_id like '%$search%' or Feedback_desc like '%$search%' or Feedback_date like '%$search%' or Product_id in (select Product_id from product where Product_name like '%$search%')  or User_id in(select USER_ID from login where USER_NAME like '%$search%')";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        $t_c=$queryresult;
        if($queryresult>0)
        {
          while($row=mysqli_fetch_assoc($hardik)){
            $id=$row['Feedback_id'];
            $F_desc=$row['Feedback_desc'];
            $f_date=$row['Feedback_date'];
            $p_id=$row['Product_id'];
            $u_id=$row['User_id'];
            $originalDate = $f_date;
            $newDate = date("d-m-Y", strtotime($originalDate));

          $sql3="select USER_NAME from login where USER_ID='$u_id'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['USER_NAME'];
          }
       
          $sql4="select Product_name from product where Product_id='$p_id'";
          $hp6=mysqli_query($conn,$sql4);
          $id5="";
          while($row3=mysqli_fetch_array($hp6)){
            $id5=$row3['Product_name'];
          }
          
            echo"
          <tr align='center'>
          <td> ".$i."</td>
          <td>".$id2."</td>
          <td>".$id5."</td> 
          <td>".$row["Feedback_desc"]."</td>
          <td>".$newDate."</td>"
    ?>       
    </tr>
           <?php
         
           $i+=1;}
          }
        
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }
    
      else{
      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
            $id=$row_c['Feedback_id'];
            $F_desc=$row_c['Feedback_desc'];
            $f_date=$row_c['Feedback_date'];
            $originalDate = $f_date;
            $newDate = date("d-m-Y", strtotime($originalDate));

            $hp="select User_id from FEEDBACK  where Feedback_id='$id' and Feedback_desc='$F_desc' and Feedback_date='$f_date' ";
          $resulthp=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_array($resulthp)) {
            # code...
            $id1=$row2['User_id'];
          } 
          $sql3="select USER_NAME from login where USER_ID='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['USER_NAME'];
          }
           $hp3="select Product_id from FEEDBACK  where Feedback_id='$id' and Feedback_desc='$F_desc' and Feedback_date='$f_date' ";
           $result1=mysqli_query($conn,$hp3);
          $id3="";
          while ($rowpro=mysqli_fetch_array($result1)) {
            # code...
            $id3=$rowpro['Product_id'];
          } 
          $sql4="select Product_name from product where Product_id='$id3'";
          $hp6=mysqli_query($conn,$sql4);
          $id5="";
          while($rowna=mysqli_fetch_array($hp6)){
            $id5=$rowna['Product_name'];
          }
      
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $id2; ?></td>
       <td><?php echo $id5; ?></td>
       <td><?php echo $F_desc; ?></td>
       <td><?php echo $newDate; ?></td>
    </tr>
<?php $i+=1; } ?>
<?php } ?>
<?php
if(isset($_POST['showall'])){
  echo "<script>window.open('./index.php?link=38','_self')</script>";
}
?>

  </table>

  <hr>
  <?php
echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";

?>
   <?php 
mysqli_close($conn);
 ?>
  <hr>

</body>
</html>