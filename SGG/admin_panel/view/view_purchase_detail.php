<?php
if(isset($_GET['edit_pur']))
{
  $pur=$_GET['edit_pur'];
  
}
include('./db.php');
 $url="index.php?link=52&edit_pur=$pur&";
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from purchase_detail where Purchase_id='$pur'";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit=6; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "purchase_detail"; //you have to pass your query over here table name
$query = "SELECT * FROM purchase_detail where Purchase_id='$pur' order by Purchase_id LIMIT  {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>
<html>

  <title>
        VIEW PURCHASE DETAIL
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>
  <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

  <style>
    input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}.search-container button {
 
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
    <button name="add"> Add Detail</button>
    <button name="back">Back</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="9" align="center">
        <h2>
          View All PURCHASE DETAIL
        </h2>
      </td>
    </tr>
    <tr>
      <th>PURCHASE ID</th>
      
      <th>PRODUCT NAME</th>
      <TH>SIZE HEIGHT</TH>
      <TH>SIZE WIDTH</TH>
      <th>QTY</th>
      <th>PRICE</th> 
      <th>DELETE</th>    
    </tr>
    <?php
  if(isset($_POST['back']))
  
  {
    echo "<script> location.href='./index.php?link=14' </script>";  
  }
  if(isset($_POST['add']))
  {
    echo "<script> location.href='./index.php?link=62&id=$pur' </script>";
  }
      if(isset($_POST['submit']))
      {
        $i=$startpoint;
        $i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql1="select  * from purchase_detail where   Product_id in (select Product_id from product where Product_name like '%$search%') and Purchase_id='$pur'  or Size_Height like '%$search%' and Purchase_id='$pur' or Size_Width like '%$search%' and Purchase_id='$pur'  or Qty like '%$search%' and Purchase_id='$pur'   or  Price like '%$search%' and Purchase_id='$pur' ";
          
        $result1=mysqli_query($conn,$sql1);
          $queryresult=mysqli_num_rows($result1);
          $t_c=$queryresult;
  if($queryresult>0){
        while($row1=mysqli_fetch_array($result1))
        {
          $pur_id=$row1['Purchase_id'];
              $pro_id=$row1['Product_id'];
              $s_w=$row1['Size_Width'];
              $s_h=$row1['Size_Height'];
              $qty=$row1['Qty'];
              $price=$row1['Price'];
          
              $sql2="select * from purchase_detail where Product_id=$pro_id and  Size_Height=$s_h and Size_Width=$s_w and Qty=$qty and Price=$price";
              $result2=mysqli_query($conn,$sql2);
              $pro_name="";
              while($row2=mysqli_fetch_array($result2))
              {
                
                $sql3="select Product_name from product where Product_id=$pro_id";
                $result3=mysqli_query($conn,$sql3);
                
                while($row3=mysqli_fetch_array($result3))
                {
                  $pro_name=$row3['Product_name'];
                  
                }
              
                                    echo"
          <tr align='center'>
          
            <td> ".$i."</td>
    
          <td>".$pro_name."</td>
          <td>".$s_h."</td>
          <td>".$s_w."</td>
          
          <td>".$qty."</td>
          <td>₹ ".$price."</td>"?>
 <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_pur_details.php?delete_p=<?php echo $pur_id ?>&delete_pro=<?php echo $pro_id;?>'}"class="fas fa-fw fa-trash"></a></td>
               </tr>
                  <?php  $i+=1;}
                  
                }
                  
              }
               
        
      
      elseif($queryresult<=0){
    echo "<script> alert('No Result Found') </script>";
  }
      }
      else
      {
      
        
      
      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
      

        $p_id=$row_c['Purchase_id'];
        $pro_id=$row_c['Product_id'];
       
        $s_h=$row_c['Size_Height'];
        $s_w=$row_c['Size_Width'];
        $qty=$row_c['Qty'];
        $price=$row_c['Price'];


        $sql2="select * from purchase_detail where Product_id=$pro_id and  Size_Height=$s_h and Size_Width=$s_w and Qty=$qty and Price=$price";
              $result2=mysqli_query($conn,$sql2);
              $pro_name="";
              while($row2=mysqli_fetch_array($result2))
              {
                
                $sql3="select Product_name from product where Product_id=$pro_id";
                $result3=mysqli_query($conn,$sql3);
                
                while($row3=mysqli_fetch_array($result3))
                {
                  $pro_name=$row3['Product_name'];
                  
                }
              }
        
  
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
     
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $s_h; ?></td>
       <td><?php echo $s_w; ?></td>
       <td><?php echo $qty; ?></td>
       <td>₹ <?php echo $price; ?></td>
       <td><a href="javascript:if(confirm('Are you sure do you want to delete this record?')){location.href='./delete/delete_pur_details.php?delete_p=<?php echo $p_id ?>&delete_pro=<?php echo $pro_id;?>'}"class="fas fa-fw fa-trash"></a></td>
       
       </tr>
<?php $i++; } ?>
      <?php }?>
  </table>
<?php
if (isset($_POST['showall'])) {
  # code...
   echo "<script>window.open('./index.php?link=52&edit_pur=$pur','_self')</script>";

}
?>

    <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   mysqli_close($conn);?>
</body>

</html>
