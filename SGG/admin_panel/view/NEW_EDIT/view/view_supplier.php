<html>
  <title>
        VIEW SUPPLIER
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
      <td colspan="11" align="center">
        <h2>
          VIEW All SUPPLIER
        </h2>
      </td>
    </tr>
    <tr>
      <th>SUPPLIER ID</th>
      <th>SUPPLIER NAME</th>
      <th>CONTACT NO</th>
      <th>ADDRESS1</th>
      <th>ADDRESS2</th>
      <th>EMAIL ID</th>
      <th>AREA NAME</th>
      <th>COMPANY NAME</th>
      <th>GST NO</th>
      <th>EDIT</th>
      <th>DELETE</th>
   </tr>
    <?php

      include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from supplier where Supplier_id like '%$search%' or Supplier_name like '%$search%' or Sup_contact like '%$search%' or Address1 like '%$search%' or Address2 like '%$search' or Sup_Email_id like '%$search' or GST_NO like '%$search'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        if($queryresult>0)
        {
          while($row=mysqli_fetch_assoc($hardik)){
            $id=$row['Supplier_id'];
            $s_name=$row['Supplier_name'];
            $s_cont=$row['Sup_contact'];
            $s_add1=$row['Address1'];
            $s_add2=$row['Address2'];
            $eid=$row['Sup_Email_id'];
            $gst=$row['GST_NO'];
             
           
          $hp="select Area_id from supplier where Supplier_id='$id' and Supplier_name='$s_name' and Sup_contact='$s_cont' and Address1='$s_add1' and Address2='$s_add2' and Sup_Email_id='$eid' and GST_NO='$gst' ";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_array($result)) {
            # code...
            $id1=$row2['Area_id'];
          } 
          $sql3="select Area_name from area  where Area_id='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['Area_name'];
          }

            $hp2="select Company_id from supplier where Supplier_id='$id' and Supplier_name='$s_name' and Sup_contact='$s_cont' and Address1='$s_add1' and Address2='$s_add2' and Sup_Email_id='$eid' and GST_NO='$gst' ";
          $result1=mysqli_query($conn,$hp2);
          $id4="";
          while ($row5=mysqli_fetch_array($result1)) {
            # code...
            $id4=$row5['Company_id'];
          } 
          $sql8="select Company_name from company  where company_id='$id4'";
          $hp4=mysqli_query($conn,$sql8);
          $id5="";
          $id6="";
          while($row6=mysqli_fetch_array($hp4)){
            $id6=$row6['Company_name'];
          }
        

            echo"
          <tr align='center'>
           <td> ".$id."</td>
          <td>".$s_name."</td> 
          <td>".$s_cont."</td>
          <td>".$s_add1."</td>
          <td>".$s_add2."</td>
          <td>".$eid."</td>
          <td>".$id2."</td>
          <td>".$id6."</td>
          <td>".$gst."</td>
          " ?>
          <td><a href="javascript:if(confirm('Are you want to edit this record?')){location.href='./edit_supplier.php?edit_s=<?php echo $id; ?>'}">EDIT</a></td>
           <!--<td><a href="../EDIT/edit_supplier.php?edit_s=<?php echo $id ?>">EDIT</a></td>-->
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_supplier.php?delete_s=<?php echo $id; ?>'}">DELETE</a></td>
             </tr>

           <?php
         
           }
          }
 elseif($queryresult<1)
        {
          $sql3="select DISTINCT Area_id,Company_id from supplier where Area_id in(select Area_id from area where Area_name like '%$search%') or Company_id in (select company_id from company where Company_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            $pro_id=$row3['Area_id'];
            $user=$row3['Company_id'];
             echo "<script> alert('$pro_id $user'); </script>";
            $sql4="select * from supplier where Area_id='$pro_id' and Company_id='$user'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $s_id=$row4['Supplier_id'];
              $s_name=$row4['Supplier_name'];
              $con=$row4['Sup_contact'];
              $add1=$row4['Address1'];
              $add2=$row4['Address2'];
              $eid=$row4['Sup_Email_id'];
              $gst=$row4['GST_NO'];
              echo "<script> alert('$pro_id $user'); </script>";
              $sql5="select Area_name from area where  Area_id='$pro_id'";
              $result5=mysqli_query($conn,$sql5);
              $a_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $a_name=$row5['Area_name'];
              }
              $sql6="select Company_name from company where Company_id='$user'";
              $result6=mysqli_query($conn,$sql6);
              $c_name="";
              while($row6=mysqli_fetch_array($result6))
              {
                $c_name=$row6['Company_name'];
              }
              echo"
          <tr align='center'>
          
          <td> ".$s_id."</td>
          <td>".$s_name."</td>
          <td>".$con."</td>
          <td>".$add1."</td>
          <td> ".$add2."</td>
          <td>".$eid."</td>
          <td>".$a_name."</td>
          <td>".$c_name."</td>
          <td>".$gst."</td>"?>
          <td><a href="javascript:if(confirm('Are you want to edit this record?')){location.href='./edit_supplier.php?edit_s=<?php echo $s_id; ?>'}">EDIT</a></td>
<!--<td><a href="../EDIT/edit_supplier.php?edit_s=<?php echo $s_id ?>">EDIT</a></td>-->
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_supplier.php?delete_s=<?php echo $s_id; ?>'}">DELETE</a></td>          
          </tr>
          <?php
 
          
          }
                     }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }

    else{  $get_c="select * from supplier s,area a,company c where a.Area_id=s.Area_id and c.company_id=s.Company_id";
      $run_c=mysqli_query($conn,$get_c);
      while($row_c=mysqli_fetch_array($run_c)){
        $s_id=$row_c['Supplier_id'];
        $s_NAME=$row_c['Supplier_name'];
        $con=$row_c['Sup_contact'];
        $add1=$row_c['Address1'];
        $add2=$row_c['Address2'];
        $e_id=$row_c['Sup_Email_id'];
        $a_n=$row_c['Area_name'];
        $c_n=$row_c['Company_name'];
        $g_no=$row_c['GST_NO'];
         
      ?>
     <tr align="center">
       <td><?php echo $s_id; ?></td>
       <td><?php echo $s_NAME; ?></td>
       <td><?php echo $con; ?></td>
       <td><?php echo $add1; ?></td>
       <td><?php echo $add2; ?></td>
       <td><?php echo $e_id; ?></td>
       <td><?php echo $a_n; ?></td>
       <td><?php echo $c_n; ?></td>
       <td><?php echo $g_no; ?></td>
       <td><a href="javascript:if(confirm('Are you want to edit this record?')){location.href='./edit_supplier.php?edit_s=<?php echo $s_id; ?>'}">EDIT</a></td>

       <!--<td><a href="?link=46&edit_s=<?php echo $s_id ?>">EDIT</a></td>-->
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_supplier.php?delete_s=<?php echo $s_id; ?>'}">DELETE</a></td>
     </tr>
<?php } ?>
<?php } ?>
  </table>
</body>
</html>