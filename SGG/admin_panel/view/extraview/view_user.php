<html>
  <title>
        VIEW USER
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
<form action="" method="POST">
  <input type="text" name="search" placeholder="Search">
  <button type="submit" name="submit">Search</button>
  <button type="submit" name="showall">showall</button>
  </form>
  <table id="data">
    <tr>
      <td colspan="12" align="center">
        <h2>
          View All USER
        </h2>
       </td>
    </tr>
    <tr>
      <th>USERID</th>
      <th>USER_NAME</th>
      <th>USER_PASSWORD</th>
      <th>ADDRESS</th>
      <th>EMAIL_ID</th>
      <th>Contact_Number</th>
      <th>FIRST_NAME</th>
      <th>LAST_NAME</th>
      <th>AREA_NAME</th>
      

    </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from login WHERE USER_ID like'%$search%' or USER_NAME like '%$search%' or USER_PASSWORD like '%$search%' or USER_ADDRESS like '%$search%' or User_Email_id like '%$search%' or contact_no like '%$search%' or FirstName like '%$search%' or LastName like '%$search%'";
  $result=mysqli_query($conn,$sql);
  $queryresult=mysqli_num_rows($result);
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
         $id=$row['USER_ID'];
         echo "<script>alert('$id');</script>";
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
          echo "<script>alert('$id1');</script>";
          }
          $sql3="select Area_name from area where Area_id='$id1'";
          $result3=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($result3))
          {
            $id2=$row3['Area_name'];
            echo "<script>alert('$id2');</script>";
          }
          
          echo"
           <tr align='center'>
        <td>  ".$row['USER_ID']."</td>
        <td>  ".$row['USER_NAME']."</td>
        <td>  ".$row['USER_PASSWORD']."</td>
        <td>  ".$row['USER_ADDRESS']."</td>
        <td>  ".$row['User_Email_id']."</td>
        <td>  ".$row['contact_no']."</td>
        <td>  ".$row['FirstName']."</td>
        <td>  ".$row['LastName']."</td>
        <td> ".$id2."</td>"
 ?>
        </tr>
        <?php
           }
  }

  elseif($queryresult<1)
        {
          $sql3="select distinct(Area_id) from login where Area_id in(select Area_id from area where Area_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            
            $a_id=$row3['Area_id'];

            $sql4="select * from login where Area_id='$a_id'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
               $id=$row4['USER_ID'];
             $name=$row4['USER_NAME'];
             $pass=$row4['USER_PASSWORD'];
             $add=$row4['USER_ADDRESS'];
             $eid=$row4['User_Email_id'];
             $cont=$row4['contact_no'];
             $fn=$row4['FirstName'];
             $ln=$row4['LastName'];

              $sql5="select (Area_name) from area where  Area_id='$a_id'";
              $result5=mysqli_query($conn,$sql5);
              $area_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $area_name=$row5['Area_name'];
              }
              echo"
        <tr align='center'>
        <td>  ".$id."</td>
        <td>  ".$name."</td>
        <td>  ".$pass."</td>
        <td>  ".$add."</td>
        <td>  ".$eid."</td>
        <td>  ".$cont."</td>
        <td>  ".$fn."</td>
        <td>  ".$ln."</td>
        <td> ".$area_name."</td>"?>
        </tr>
        <?php
          }
            }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }


else{      $get_c="select * from login l,area a where a.Area_id=l.Area_id";
      $run_c=mysqli_query($conn,$get_c);
$i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $u_id=$row_c['USER_ID'];
        $u_NAME=$row_c['USER_NAME'];
        $C_password=$row_c['USER_PASSWORD'];
        $add=$row_c['USER_ADDRESS'];
        $EMAIL=$row_c['User_Email_id'];
        $c_no=$row_c['contact_no'];
        $f_name=$row_c['FirstName'];
        $l_name=$row_c['LastName'];
        $area_id=$row_c['Area_name'];
    $i++;
?>
     <tr align="center">
       <td><?php echo $u_id; ?></td>
       <td><?php echo $u_NAME; ?></td>
       <td><?php echo $C_password; ?></td>
       <td><?php echo $add; ?></td>
       <td><?php echo $EMAIL; ?></td>
       <td><?php echo $c_no; ?></td>
       <td><?php echo $f_name; ?></td>
       <td><?php echo $l_name; ?></td>
      
       <td><?php echo $area_id; ?></td>
       
     </tr>
<?php } ?>
  <?php } ?>
  </table>
</body>

</html>
