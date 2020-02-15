<?php
  if(isset($_GET['edit_pur']))
  {
    $var=$_GET['edit_pur'];
  }    
?>
<html>
  <title>
        VIEW PURCHASE RETURN DETAILS
  </title>
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
<body>
<div class="search-container">
    <form action="" method="post">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit">Search</button>
    <button type="submit" name="showall">Showall</button>
    <button name="back" >back</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="10" align="center">
        <h2>
          View All PURCHASE RETURN DETAILS
        </h2>
      </td>
    </tr>
   <tr>
      <th>PURCHASE RETURN ID</th>
      <th>PRODUCT NAME</th>
   <th>HEIGHT</th>
      <TH>WIDTH</TH>
      <TH>QTY</TH>
     
     
    </tr>
    <?php
    if(isset($_POST['back']))
  
  {
    echo "<script> location.href='./index.php?link=16' </script>";  
  }
include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql1="select * from purchase_return_details where purchase_return_id like '%$search%' or Product_id in(select Product_id from product where Product_name like '%$search%') or Size_Height like '%$search%' or Size_Width like '%$search%' or qty like '%$search%'";
          
        $result1=mysqli_query($conn,$sql1);
          $queryresult=mysqli_num_rows($result1);
          if($queryresult>0)
          {
                while($row=mysqli_fetch_array($result1))

            {
                  $pr_id=$row['purchase_return_id'];
                  $pro_id=$row['Product_id'];
                  $s_h=$row['Size_Height'];
                  $s_w=$row['Size_Width'];
                   $qty=$row['qty'];
                  $sql2="select * from purchase_return_details where purchase_return_id='$pr_id' and Product_id='$pro_id' and Size_Height='$s_h' and Size_Width='$s_w' and qty='$qty'";
                  $result2=mysqli_query($conn,$sql2);
                  while($row2=mysqli_fetch_Array($result2))
                  {
                    $sql3="Select Product_name from product where Product_id='$pro_id'";
                    $result3=mysqli_query($conn,$sql3);
                    $pro_name="";
                    while($row3=mysqli_fetch_array($result3))
                    {
                      $pro_name=$row3['Product_name'];
                    }
                    }
                     echo"

          <tr align='center'>
          
            <td> ".$pr_id."</td>
          <td>".$pro_name."</td>
          <td>".$s_h."</td>
          <td>".$s_w."</td>
          <td>".$qty."</td>
        
               </tr>";
                  }
            }
          
          else
          {
            echo "<script> alert('No Result Found') </script>";
          }
}
   else
   {
  
      $get_c="select * from purchase_return_details p1,product p where p1.purchase_return_id='$var' and p.Product_id=p1.Product_id";
    $result1=mysqli_query($conn,$get_c);
    while($row_c=mysqli_fetch_array($result1))
    {
      $pr_id=$row_c['purchase_return_id'];
        $p_id=$row_c['Product_name'];
        $date=$row_c['Size_Height'];
        $credit_id=$row_c['Size_Width'];
        $credit_amount=$row_c['qty'];
        
    
     

        
    
?>
  
     <tr align="center">
       <td><?php echo $pr_id; ?></td>
       <td><?php echo $p_id; ?></td>
            <td><?php echo $date; ?></td>
       <td><?php echo $credit_id; ?></td>
       <td><?php echo $credit_amount; ?></td>
     
       </tr>

  
  
    <?php }  ?>
  <?php } ?>
  </table>
</body>

</html>
