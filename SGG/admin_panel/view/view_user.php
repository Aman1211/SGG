<?php
include('./db.php');
 $url='index.php?link=3&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from login";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 3; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "login"; //you have to pass your query over here table name
      
$query = "SELECT * FROM login order by USER_ID LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>


<html>
  <title>
        VIEW USER
  </title>
 <head>
<link rel="stylesheet" href="view_style.css" type="text/css"/>
<link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

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
      <td colspan="12" align="center">
        <h2>
          View All USER
        </h2>
       </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>USER NAME</th>
      <th>ADDRESS</th>
      <th>EMAIL ID</th>
      <th>CONTACT NUMBER</th>
      <th>FIRST NAME</th>
      <th>LAST NAME</th>
      <th>AREA NAME</th>
  

    </tr>
    <?php

      
      if(isset($_POST['submit']))
      {
        $i=$startpoint;
        $i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from login WHERE USER_ID like'%$search%' or USER_NAME like '%$search%'  or USER_ADDRESS like '%$search%' or User_Email_id like '%$search%' or contact_no like '%$search%' or FirstName like '%$search%' or LastName like '%$search%' or Area_id in(select Area_id from area where Area_name like '%$search%')";
  $result1=mysqli_query($conn,$sql);
  $t_c=mysqli_num_rows($result1);
  $queryresult=mysqli_num_rows($result1);
  
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result1)){
         $id=$row['USER_ID'];
      
         $name=$row['USER_NAME'];
         $pass=$row['USER_PASSWORD'];
         $add=$row['USER_ADDRESS'];
         $eid=$row['User_Email_id'];
         $cont=$row['contact_no'];
         $fn=$row['FirstName'];
         $ln=$row['LastName'];
         $sql2="select Area_id from login where USER_ID='$id' and USER_NAME='$name' and USER_ADDRESS='$add' and User_Email_id='$eid' and contact_no='$cont' and FirstName='$fn' and LastName='$ln'";
          $result2=mysqli_query($conn,$sql2);
          $id1="";
          while($row2=mysqli_fetch_array($result2))
          {
            $id1=$row2['Area_id'];
        
          }
          $sql3="select Area_name from area where Area_id='$id1'";
          $result3=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($result3))
          {
            $id2=$row3['Area_name'];
            
          }
          
          echo"
           <tr align='center'>
           
        <td>  ".$i."</td>
        <td>  ".$row['USER_NAME']."</td>
        
        <td>  ".$row['USER_ADDRESS']."</td>
        <td>  ".$row['User_Email_id']."</td>
        <td>  ".$row['contact_no']."</td>
        <td>  ".$row['FirstName']."</td>
        <td>  ".$row['LastName']."</td>
        <td> ".$id2."</td>"
 ?>

        <?php
          $i=$i+1; }
  }

   
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }


else{
    $i=$startpoint;
    $i+=1;
     
      while($row_c=mysqli_fetch_array($result)){


        $u_id=$row_c['USER_ID'];
        $u_NAME=$row_c['USER_NAME'];
        
        $add=$row_c['USER_ADDRESS'];
        $EMAIL=$row_c['User_Email_id'];
        $c_no=$row_c['contact_no'];
        $f_name=$row_c['FirstName'];
        $l_name=$row_c['LastName'];
        $a_id=$row_c['Area_id'];
        $are="select * from area where Area_id=$a_id";
        $ar_run=mysqli_query($conn,$are);
        while($ro=mysqli_fetch_array($ar_run))
        {
          $area_id=$ro['Area_name'];
        }
        
    
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $u_NAME; ?></td>
      
       <td><?php echo $add; ?></td>
       <td><?php echo $EMAIL; ?></td>
       <td><?php echo $c_no; ?></td>
       <td><?php echo $f_name; ?></td>
       <td><?php echo $l_name; ?></td>
      
       <td><?php echo $area_id; ?></td>
       
             
     </tr>
<?php $i+=1; } ?>
  <?php } ?>
  <?php
if(isset($_POST['showall']))
{
  echo "<script>window.open('./index.php?link=3','_self')</script>";

}
?>
</table>
<hr>
  <?php 
echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";

  ?>
 <?php  mysqli_close($conn);?>
  </hr>
</body>
</html>
