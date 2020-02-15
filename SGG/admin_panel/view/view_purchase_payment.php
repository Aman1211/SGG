<?php
include('./db.php');
 $url='index.php?link=49&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from purchase_payment";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "purchase_payment"; //you have to pass your query over here table name

$query = "SELECT * FROM purchase_payment order by Purchase_pay_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>




<html>
  <title>
        VIEW PURCHASE_PAYMENT
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
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="12" align="center">
        <h2>
          View All PURCHASE PAYMENT
        </h2>
      </td>
    </tr>
	 <tr>
      <th>SR NO.</th>
      <th>SUPPLIER NAME</th>
	 <th>PAYMENT DATE</th>
      <th>PAYMENT TYPE</th>
      <th>CHEQUE NO</th>
	 
	  <th>BANK NAME</th>
	
	  <th>TRANSACTION ID </th>
     <th>GST</th>
      <th>AMOUNT</th>
    </tr>
    <?php
	 
	if(isset($_POST['submit'])){
     $i=$startpoint;
      $i+=1;
     
     $search=mysqli_real_escape_string($conn,$_POST['search']);
    $ge="select * from purchase_payment where Purchase_pay_id like '%$search%' or
             Payment_date like '%$search%' or 
             Cheque_no like '%$search%' or 
             paymnet_amount like '%$search%' or
              Bank_Name like '%$search%' or 
             
              Transaction_id like '%$search%' or
               Payment_type_id in(select Payment_type_id from payment_type where Payment_type_name like '%$search%') or Purchase_id in(select Purchase_id from purchase where Supplier_id in(select Supplier_id from supplier where Supplier_name like '%$search%'))" ;
    $ge_run=mysqli_query($conn,$ge);
    if($ge_run){
    $t_c=mysqli_num_rows($ge_run);
    while($row_ge=mysqli_fetch_array($ge_run))
    { $credit_amount="";$sup_name="";
        $pr_id=$row_ge['Purchase_pay_id'];
        $p_id=$row_ge['Purchase_id'];
        
        $s_name= "select Supplier_name from supplier where Supplier_id in(select Supplier_id from purchase where Purchase_id='$p_id')";
        $s_run=mysqli_query($conn,$s_name);
        if($s_run){
          while($s_n_row=mysqli_fetch_array($s_run)){

            $sup_name=$s_n_row['Supplier_name'];
          }
        }
        else

        echo "<script>alert('$sup_name')</script>";
        $date=$row_ge['Payment_date'];
        if($date=="")
        {
         $newDate="";
        }
        else{
          $newDate = date("d-m-Y", strtotime($date));
        }
        $p=$row_ge['Payment_type_id'];
        $gst=$row_ge['gst'];
        $q="select * from payment_type where Payment_type_id='$p'";
        $r_q=mysqli_query($conn,$q);
        while($r_q_row=mysqli_fetch_array($r_q))
        {
            $credit_amount=$r_q_row['Payment_type_name'];
        }
        
        $pro_name=$row_ge['Cheque_no'];
        $h=$row_ge['paymnet_amount'];
        
        $w=$row_ge['Bank_Name'];
        
        $id=$row_ge['Transaction_id'];
        ?>
      <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $sup_name; ?></td>
            <td><?php echo $newDate; ?></td>
       <td><?php echo $credit_amount; ?></td>
       <td><?php echo $pro_name; ?></td>
       
     <td><?php echo $w; ?></td>
   
     <td><?php echo $id; ?> </td>
      <td><?php echo $gst; ?> </td>
      <td>₹ <?php echo $h; ?></td>
       </tr>
    
  <?php  $i+=1;  }
  }
}
    
    else
    {
      $i=$startpoint;
      $i+=1;
      $s_name="";
	  while($row_c=mysqli_fetch_array($result))
	  {
		  $pr_id=$row_c['Purchase_pay_id'];
        $p_id=$row_c['Purchase_id'];
        $date=$row_c['Payment_date'];
        if($date=="")
        {
         $newDate="";
        }
        else{
          $newDate = date("d-m-Y", strtotime($date));
        }
        $p=$row_c['Payment_type_id'];
        $gst=$row_c['gst'];
        $q="select * from payment_type where Payment_type_id='$p'";
        $r_q=mysqli_query($conn,$q);
        while($r_q_row=mysqli_fetch_array($r_q))
        {
            $credit_amount=$r_q_row['Payment_type_name'];
        }
        $sql = "select Supplier_name from supplier where Supplier_id in(select Supplier_id from purchase where Purchase_id in(select Purchase_id from purchase_payment where Purchase_id like '$p_id'))";
        $run=mysqli_query($conn,$sql);
        if($run)
        {
          while($row=mysqli_fetch_array($run)){
            $s_name=$row['Supplier_name'];
          }
        }
		   
        $pro_name=$row_c['Cheque_no'];
        $h=$row_c['paymnet_amount'];
		    $w=$row_c['Bank_Name'];
		    
		    $id=$row_c['Transaction_id'];
	?>
	
     <tr align="center">
      <td><?php echo $i; ?></td>
      <td><?php echo $s_name; ?></td>
      <td><?php echo $newDate; ?></td>
      <td><?php echo $credit_amount; ?></td>
      <td><?php echo $pro_name; ?></td>
      
	    <td><?php echo $w; ?></td>
	   
	    <td><?php echo $id; ?> </td>
      <td><?php echo $gst; ?> </td>
      <td>₹ <?php echo $h; ?></td>
       </tr>

  
  
	  <?php $i+=1; }}  ?>
  </table>

  <hr>
  <?php 
   if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=49','_self')</script>";

}

  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   mysqli_close($conn);?>
  <hr>

</body>
</html>
