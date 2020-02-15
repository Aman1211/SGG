<html>
  <title>
        VIEW PURCHASE_RETURN
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
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="10" align="center">
        <h2>
          View All PURCHASE RETURN
        </h2>
      </td>
    </tr>
	 <tr>
      <th>PURCHASE RETURN ID</th>
      <th>PURCHASE ID</th>
	 <th>PURCHASE RETURN DATE</th>
      <TH>CREDIT NOTE ID</TH>
      <TH>CREDIT AMOUNT</TH>
      <th>DETAILS</th>
     
     
    </tr>
    <?php
include("./db.php");
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql1="select * from purchase_return where Purchase_return_id like '%$search%' or Purchase_id like '%$search%' or Purchase_return_date like '%$search%' or Credit_note_id like '%$search%' or Credit_amount like '%$search%'";
          
        $result1=mysqli_query($conn,$sql1);
          $queryresult=mysqli_num_rows($result1);
          if($queryresult>0)
          {
                while($row=mysqli_fetch_array($result1))

            {
                  $pr_id=$row['Purchase_return_id'];
                  $pur_id=$row['Purchase_id'];
                  $date=$row['Purchase_return_date'];
                  $c_id=$row['Credit_note_id'];
                  $c_amt=$row['Credit_amount'];
                  $sql2="select * from purchase_return where Purchase_return_id='$pr_id' and Purchase_id='$pur_id' and Purchase_return_date='$date' and Credit_note_id='$c_id' and Credit_amount='$c_amt'";
                  $result2=mysqli_query($conn,$sql2);
                  while($row2=mysqli_fetch_Array($result2))
                  {
                     echo"
          <tr align='center'>
          
            <td> ".$pr_id."</td>
          <td>".$pur_id."</td>
          <td>".$date."</td>
          <td>".$c_id."</td>
          <td>".$c_amt."</td>
          <td><a href='?link=55&edit_pur=".$pr_id."'>DETAILS</a></td>
               </tr>";
                  }
            }
          }
          else
          {
            echo "<script> alert('No Result Found') </script>";
          }
}
	 else
   {
	
      $get_c="select * from purchase_return";
	  $result1=mysqli_query($conn,$get_c);
	  while($row_c=mysqli_fetch_array($result1))
	  {
		  $pr_id=$row_c['Purchase_return_id'];
        $p_id=$row_c['Purchase_id'];
        $date=$row_c['Purchase_return_date'];
		    $credit_id=$row_c['Credit_note_id'];
        $credit_amount=$row_c['Credit_amount'];
        
		
		 

        
   	
?>
	
     <tr align="center">
       <td><?php echo $pr_id; ?></td>
       <td><?php echo $p_id; ?></td>
            <td><?php echo $date; ?></td>
       <td><?php echo $credit_id; ?></td>
       <td><?php echo $credit_amount; ?></td>
        <td><a href='?link=55&edit_pur=<?php echo $pr_id; ?>'>DETAILS</a></td>
	   
       </tr>

  
  
	  <?php }  ?>
  <?php } mysqli_close($conn);?>
  </table>
</body>

</html>
