<?php
  $s_name="";$s_p_id="";$sid="";$amo="";$date="";$p_t_id="";$c_no="";
      $b_name="";$t_id="";$credit_amount="";$fname="";$lname="";
include('./db.php');
 $url='index.php?link=36&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from sales_payment";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "sales_payment"; //you have to pass your query over here table name

$query = "SELECT * FROM sales_payment order by Sales_payment_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>




<html>
  <title>
        VIEW SALES_PAYMENT
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
          VIEW ALL SALES PAYMENT
        </h2>
      </td>
    </tr>
	 <tr>
      <th>SR NO.</th>
      <th>SALES PAYMENT ID</th>
      <th>CUSTOMER NAME</th>
	    <th>PAYMENT DATE</th>
      <th>PAYMENT TYPE</th>
      <th>BANK NAME</th>
      <th>CHEQUE NO</th>
	    <th>TRANSACTION ID</th>
      <th>GST</th>
      <th>AMOUNT</th>
    </tr>
    <?php
	 
	if(isset($_POST['submit'])){
     $i=$startpoint;
      $i+=1;
     
     $search=mysqli_real_escape_string($conn,$_POST['search']);
    $ge="SELECT * FROM `sales_payment` WHERE Sales_id like '%$search%'or `Amount` LIKE '%$search%' OR `GST` LIKE '%$search%' OR `Payment_date` LIKE '%$search%' OR `Cheque_no` LIKE '%$search%' OR `Bank_Name` LIKE '%$search%' OR `Transaction_id` LIKE '%$search%' OR `Payment_type_id` in(select Payment_type_id from payment_type where Payment_type_name like '%$search%') or Sales_id in(select Sales_id from sales where Request_id in(select Request_id from request where User_id in(select USER_ID from login where FirstName like '%$search%' or LastName like '%$search%')));" ;
    $ge_run=mysqli_query($conn,$ge);
    if($ge_run){
    $t_c=mysqli_num_rows($ge_run);
    while($row_ge=mysqli_fetch_array($ge_run))
    { 
       $s_p_id=$row_ge['Sales_payment_id'];
      $sid=$row_ge['Sales_id'];
      $amo=$row_ge['Amount'];
      $gst=$row_ge['GST'];
      $date=$row_ge['Payment_date'];
      $p_t_id=$row_ge['Payment_type_id'];
      $c_no=$row_ge['Cheque_no'];
      $b_name=$row_ge['Bank_Name'];
      $t_id=$row_ge['Transaction_id'];

      if($date=="")
        {
         $newDate="";
        }
        else{
          $newDate = date("d-m-Y", strtotime($date));
        }
        $q="select * from payment_type where Payment_type_id='$p_t_id'";
        $r_q=mysqli_query($conn,$q);
        while($r_q_row=mysqli_fetch_array($r_q))
        {
            $credit_amount=$r_q_row['Payment_type_name'];
        }
        $sql = "SELECT `FirstName`,`LastName` FROM `login` WHERE `USER_ID` in(select User_id from request where Request_id in(select Request_id from sales where Sales_id in(select sales_id from sales_detail where sales_id='$sid')))";
        $run=mysqli_query($conn,$sql);
        if($run)
        {
          while($row=mysqli_fetch_array($run)){
            $fname=$row['FirstName'];
            $lname=$row['LastName'];
          }
        }
        ?>
  
     <tr align="center">
      <td><?php echo $i; ?></td>
      <td><?php echo $sid; ?></td>
      <td><?php echo $fname; ?><?php echo $lname; ?></td>
      <td><?php echo $newDate;?></td>
      <td><?php echo $credit_amount; ?></td>
      
      <td><?php echo $b_name; ?></td>
     
      <td><?php echo $c_no; ?> </td>
      <td><?php echo $t_id; ?> </td>
      <td><?php echo $gst; ?></td>
      <td>₹ <?php echo $amo; ?></td>
       </tr>


       <?php 

        
 $i++; }
}
}
    
    else
    {
      $i=$startpoint;
      $i+=1;
    
	  while($row_c=mysqli_fetch_array($result))
	  {
      
      $s_p_id=$row_c['Sales_payment_id'];
      $sid=$row_c['Sales_id'];
      $amo=$row_c['Amount'];
      $gst=$row_c['GST'];
      $date=$row_c['Payment_date'];
      $p_t_id=$row_c['Payment_type_id'];
      $c_no=$row_c['Cheque_no'];
      $b_name=$row_c['Bank_Name'];
      $t_id=$row_c['Transaction_id'];
        
        if($date=="")
        {
         $newDate="";
        }
        else{
          $newDate = date("d-m-Y", strtotime($date));
        }
        $q="select * from payment_type where Payment_type_id='$p_t_id'";
        $r_q=mysqli_query($conn,$q);
        while($r_q_row=mysqli_fetch_array($r_q))
        {
            $credit_amount=$r_q_row['Payment_type_name'];
        }
        $sql = "SELECT `FirstName`,`LastName` FROM `login` WHERE `USER_ID` in(select User_id from request where Request_id in(select Request_id from sales where Sales_id in(select sales_id from sales_detail where sales_id='$sid')))";
        $run=mysqli_query($conn,$sql);
        if($run)
        {
          while($row=mysqli_fetch_array($run)){
            $fname=$row['FirstName'];
            $lname=$row['LastName'];
          }
        }
		   
	?>
	
     <tr align="center">
      <td><?php echo $i; ?></td>
      <td><?php echo $sid; ?></td>
      <td><?php echo $fname; ?><?php echo $lname; ?></td>
      <td><?php echo $newDate;?></td>
      <td><?php echo $credit_amount; ?></td>
      
	    <td><?php echo $b_name; ?></td>
	   
	    <td><?php echo $c_no; ?> </td>
      <td><?php echo $t_id; ?> </td>
      <td><?php echo $gst; ?></td>
      <td>₹ <?php echo $amo; ?></td>
       </tr>

  
  
	  <?php $i+=1; }}  ?>
  </table>

  <hr>
  <?php 
   if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=36','_self')</script>";

}

  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   mysqli_close($conn);?>
  <hr>

</body>
</html>
