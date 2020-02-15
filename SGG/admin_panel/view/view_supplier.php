<?php
include('./db.php');
 $url='index.php?link=19&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from supplier";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 2; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "supplier"; //you have to pass your query over here table name
        
$query = "SELECT * FROM supplier order by Supplier_id DESC LIMIT {$startpoint},{$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <title>
        VIEW SUPPLIER
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
      <td colspan="11" align="center">
        <h2>
          VIEW All SUPPLIER
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
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

      
      if(isset($_POST['submit']))
      {
        $i=$startpoint;
        $i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from supplier where Supplier_id like '%$search%' or Supplier_name like '%$search%' or Sup_contact like '%$search%' or Address1 like '%$search%' or Address2 like '%$search' or Sup_Email_id like '%$search' or GST_NO like '%$search'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        $t_c=$queryresult;
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
           <td> ".$i."</td>
          <td>".$s_name."</td> 
          <td>".$s_cont."</td>
          <td>".$s_add1."</td>
          <td>".$s_add2."</td>
          <td>".$eid."</td>
          <td>".$id2."</td>
          <td>".$id6."</td>
          <td>".$gst."</td>
          " ?>
          <td><a href="?link=46&edit_s=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
           
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_supplier.php?delete_s=<?php echo $id; ?>'}" class="fas fa-fw fa-trash"></a></td>
             </tr>

           <?php
         
           $i+=1;}
          }
 elseif($queryresult<1)
        {
          $i=$startpoint;
          $i+=1;
          $sql3="select DISTINCT Area_id,Company_id from supplier where Area_id in(select Area_id from area where Area_name like '%$search%') or Company_id in (select company_id from company where Company_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
         $t_c=mysqli_num_rows($result3);
          while($row3=mysqli_fetch_array($result3))
          {
            $pro_id=$row3['Area_id'];
            $user=$row3['Company_id'];
           
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
          
          <td> ".$i."</td>
          <td>".$s_name."</td>
          <td>".$con."</td>
          <td>".$add1."</td>
          <td> ".$add2."</td>
          <td>".$eid."</td>
          <td>".$a_name."</td>
          <td>".$c_name."</td>
          <td>".$gst."</td>"?>
          <td><a href="?link=46&edit_s=<?php echo $s_id ?>'}" class="fas fa-fw fa-edit"></a></td>

           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_supplier.php?delete_s=<?php echo $s_id; ?>'}"class="fas fa-fw fa-trash"
></a></td>          
          </tr>
          <?php
 
          $i+=1;
          }
                     }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }

    else{ 
          $i=$startpoint;
          $i+=1;
      while($row_c=mysqli_fetch_array($result)){
        $s_id=$row_c['Supplier_id'];
        $s_NAME=$row_c['Supplier_name'];
        $con=$row_c['Sup_contact'];
        $add1=$row_c['Address1'];
        $add2=$row_c['Address2'];
        $e_id=$row_c['Sup_Email_id'];
        $a_id=$row_c['Area_id'];
        $c_id=$row_c['Company_id'];
        
        $hr="select * from area where Area_id='$a_id'";
        $hr_run=mysqli_query($conn,$hr);
        while($hr_row=mysqli_fetch_array($hr_run)){
          $a_n=$hr_row['Area_name'];
        }
        
        $hr1="select * from company where company_id='$c_id'";
        $hr_run1=mysqli_query($conn,$hr1);
        while($hr_row1=mysqli_fetch_array($hr_run1)){
          $c_n=$hr_row1['Company_name'];
        }
         $g_no=$row_c['GST_NO'];
         
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $s_NAME; ?></td>
       <td><?php echo $con; ?></td>
       <td><?php echo $add1; ?></td>
       <td><?php echo $add2; ?></td>
       <td><?php echo $e_id; ?></td>
       <td><?php echo $a_n; ?></td>
       <td><?php echo $c_n; ?></td>
       <td><?php echo $g_no; ?></td>
       <td><a href="?link=46&edit_s=<?php echo $s_id ?>" class="fas fa-fw fa-edit"></a></td>

       
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_supplier.php?delete_s=<?php echo $s_id; ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
<?php $i+=1; } ?>
<?php } ?>
  </table>
  <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";

  ?>
 <?php 
if(isset($_POST['showall'])){
  echo "<script>window.open('./index.php?link=19','_self')</script>";
}
  mysqli_close($conn);?>
  <hr>
</body>
</html>