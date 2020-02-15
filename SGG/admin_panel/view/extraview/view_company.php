<html>
  <title>
        VIEW COMPANY
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
      <td colspan="9" align="center">
        <h2>
          View All COMPANY
        </h2>
      </td>
    </tr>
    <tr>
      <th>COMPANY_ID</th>
      <th>COMPANY_NAME</th>
      <th>ADDRESS</th>
      <th>EMAIL_ID</th>
      <th>AREA_NAME</th>
      <TH>CONTACT</TH>
      <TH>GST_NO</TH>
      <TH>EDIT</TH>
      <TH>DELETE</TH>
    </tr>
    <?php

      include("./db.php");
      if (isset($_POST['submit'])){
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from company where company_id like '%$search%' or Company_name like '%$search%' or Address like '%$search%' or Email_id like '%$search%' or Contact like '%$search%' or GST_no like '%$search%'";
        $result=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($result);
        if($queryresult>0){
          while ($row=mysqli_fetch_assoc($result)) {
           $id=$row['company_id'];
           $name=$row['Company_name'];
           $add=$row['Address'];
           $e_id=$row['Email_id'];
           $con=$row['Contact'];
           $gst_no=$row['GST_no'];
           $sqlh="select Area_id from company where company_id='$id' and Company_name='$name' and Address='$add' and Email_id='$e_id' and Contact='$con' and GST_no='$gst_no'";
           $resulth=mysqli_query($conn,$sqlh);
           $idh="";
           while($row2=mysqli_fetch_assoc($resulth)){
            $idh=$row2['Area_id'];
           }
           echo "<script>alert ('$idh');</script>";
           $sqlhp="select Area_name from area where Area_id='$idh'";
           $hp=mysqli_query($conn,$sqlhp);
           while($row3=mysqli_fetch_array($hp)){
            $aname=$row3['Area_name'];
           }
            echo "
            <tr align='center'>
            <td>".$row['company_id']."</td>
            <td>".$row['Company_name']."  </td>
            <td>".$row['Address']." </td>
            <td> ".$row['Email_id']."</td>
            <td> ".$aname."</td>
            <td> ".$row['Contact']."</td>
            <td> ".$row['GST_no']."</td>" ?>

            <td><a href="../EDIT/edit_company.php?edit_company=<?php echo $company_id ?>">EDIT</a></td>

       <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_company.php?delete_c=<?php echo $id; ?>'}">DELETE</a></td>
             </tr><?php
          }
        }
        if($queryresult<1){
        $sql1="select * from Company c ,AREA a where a.Area_name like '%$search%' and a.Area_id=c.Area_id";
        $resu=mysqli_query($conn,$sql1);
        $queryresult1=mysqli_num_rows($resu);
        if($queryresult1>0){
          while($row1=mysqli_fetch_assoc($resu)){
            $id1=$row1['company_id'];
            echo "
                <tr align='center'>
            <td>".$row1['company_id']."</td>
            <td>".$row1['Company_name']."  </td>
            <td>".$row1['Address']." </td>
            <td> ".$row1['Email_id']."</td>
            <td> ".$row1['Area_name']."</td>
            <td> ".$row1['Contact']."</td>
            <td> ".$row1['GST_no']."</td>" ?>

            <td><a href="?link=41&edit_company=<?php echo $id1 ?>">EDIT</a></td>

       <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_company.php?delete_c=<?php echo $id1; ?>'}">DELETE</a></td>
             </tr>
            <?php
          }
        }
        else
        {
          echo "<script>alert ('No Result Found')</script>";
        }

      }
    }
    else{
      $get_c="select * from area a , company c where a.Area_id=c.Area_id";
      $run_c=mysqli_query($conn,$get_c);
      $i=0;
      while($row_c=mysqli_fetch_array($run_c)){


        $c_id=$row_c['company_id'];
        $c_NAME=$row_c['Company_name'];
        $address=$row_c['Address'];
        $e_id=$row_c['Email_id'];
		    $a_NAME=$row_c['Area_name'];
        $contact=$row_c['Contact'];
        $gst_no=$row_c['GST_no'];
	$i++;
?>
     <tr align="center">
       <td><?php echo $c_id; ?></td>
       <td><?php echo $c_NAME; ?></td>
       <td><?php echo $address;?></td>
       <td><?php echo $e_id; ?></td>
       <td><?php echo $a_NAME; ?></td>
       <td><?php echo $contact; ?></td>
       <td><?php echo $gst_no; ?></td>
       <td><a href="?link=41&edit_c=<?php echo $c_id ?>">EDIT</a></td>
      <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_company.php?delete_c=<?php echo $c_id; ?>'}">DELETE</a></td>
       
     </tr>
     <?php } ?>
<?php } ?>
<?php 
if(isset($_POST['showall'])){
}
?>
  </table>

</body>

</html>
