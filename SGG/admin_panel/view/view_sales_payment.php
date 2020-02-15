<html>
  <title>
        VIEW SALES PAYMENT
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
.hp {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
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
<!--      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit">Search</button>
	  <button type="submit" name="showall">Showall</button>-->
	  <button type="submit" name="back">Back</button>
	  <button type="submit" name="add">ADD PAYMENT</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="8" align="center">
        <h2>
          VIEW SALES PAYMENT
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>PAYMENT DATE</th>
      <th>PAYMENT TYPE</th>
      <th>CHEQUE NO</th>
      <th>BANK NAME</th>
      <th>TRANSACTION ID</th>
      <TH>GST</TH>
      <TH>AMOUNT</TH>
    </tr>
    <?php
    
      include("./db.php");
      $s_id="";
      $s_id=$_REQUEST['s_id'];
      if(isset($_POST['back']))
	     {
	        echo "<script> location.href='./index.php?link=34' </script>";	
	     }
	    if(isset($_POST['add']))
    	{
	       echo "<script> location.href='./index.php?link=67&s_id=$s_id' </script>";	
	    }
	    $get_c="select * from sales_payment where Sales_id='$s_id'";
      $run_co=mysqli_query($conn,$get_c);
      $i=1;
      
      while($row_c=mysqli_fetch_array($run_co)){

        $amo=$row_c['Amount'];
        $gst=$row_c['GST'];
        $Payment_date=$row_c['Payment_date'];
        $newDate1=date("d-m-Y", strtotime($Payment_date));
        $type_id=$row_c['Payment_type_id'];
        $cno=$row_c['Cheque_no'];
		    $bname=$row_c['Bank_Name'];
	      $t_id=$row_c['Transaction_id'];	
        $type_name="";
		    $sql="SELECT `Payment_type_name` FROM `payment_type` WHERE `Payment_type_id` like '$type_id'";
        $run=mysqli_query($conn,$sql);
        if($run){
            while($row=mysqli_fetch_array($run)){
              $type_name=$row[0];
            }
        }
	
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $newDate1; ?></td>
       <td><?php echo $type_name; ?></td>
       <td><?php echo $cno; ?></td>
       <td><?php echo $bname; ?></td>
       <td><?php echo $t_id; ?></td>
	   <td><?php echo $gst; ?></td>
	   <td>₹ <?php echo $amo; ?></td>
       </tr>
<?php $i++;} ?>
		
  </table>
</body>

</html>
