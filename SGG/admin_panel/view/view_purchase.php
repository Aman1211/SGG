 <?php
include('./db.php');
 $url='index.php?link=14&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from purchase";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "purchase"; //you have to pass your query over here table name
$query = "SELECT * FROM purchase order by Purchase_id DESC LIMIT  {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <title>
        VIEW PURCHASE
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
      <td colspan="9" align="center">
        <h2>
          View All PURCHASE
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>PURCHASE DATE</th>
      <TH>SUPPLIER NAME</TH>
      <TH>SUPPLIER CONTACT</TH>
	  <th>AMOUNT </th>
     <th> DETAILS </th>

   <th> PAYMENT</th>
    </tr>
    <?php
			if(isset($_POST['submit']))
			{
        $i=$startpoint;
        $i+=1;
				$search=mysqli_real_escape_string($conn,$_POST['search']);
				$sql1="select  * from purchase where Purchase_id like '%$search%' or Amount like '%$search%' or Purchase_date like '%$search%' or Supplier_id  in(select Supplier_id from supplier where Supplier_name like '%$search%') or Supplier_id in(select Supplier_id from supplier where Sup_contact like '%$search%')";
					
				$result1=mysqli_query($conn,$sql1);
					$queryresult=mysqli_num_rows($result1);
          $t_c=$queryresult;
	if($queryresult>0){
				while($row1=mysqli_fetch_array($result1))
				{
				          $date=$row1['Purchase_date'];
                    $originalDate = $date;
       $newDate = date("d-m-Y", strtotime($originalDate));
						  $sup_id=$row1['Supplier_id'];
						  $sql2="select * from purchase where Purchase_date='$date' and Supplier_id='$sup_id'";
						  $result2=mysqli_query($conn,$sql2);
						  $pur_id="";
						  while($row2=mysqli_fetch_array($result2))
						  {
							  $amount=$row2['Amount'];
							  $pur_id=$row2['Purchase_id'];
							  $sql3="select Supplier_id from  purchase where Purchase_id='$pur_id'";
							  $result3=mysqli_query($conn,$sql3);
							  $sup_id="";
							  while($row3=mysqli_fetch_array($result3))
							  {
								  $sup_id=$row3['Supplier_id'];
								  
							  }

							
							  $sql4="select Supplier_name,Sup_contact from supplier where Supplier_id='$sup_id'";
							  $result4=mysqli_query($conn,$sql4);
							  $sup_name="";
							  $sup_contact="";
							  while($row4=mysqli_fetch_array($result4))
							  {
								  $sup_name=$row4['Supplier_name'];
								  $sup_contact=$row4['Sup_contact'];
								  
                  
							  }
						
								
									  echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$newDate."</td>
					<td>".$sup_name."</td>
					<td>".$sup_contact."</td>
					<td>₹ ".$amount."</td>
					<td><a href='?link=52&edit_pur=".$pur_id."'>DETAILS</a></td>

          <td><a href='?link=59&add_pur=".$pur_id."'>PAYMENT</a></td>
						   </tr>";
								  }
								  
							  $i+=1;}
							  	
						  }   
			elseif($queryresult<=0){
		echo "<script> alert('No Result Found') </script>";
	}
			}
			else
			{
      
      
       
	   	  
     // $get_c="select p.Purchase_id,p.Purchase_date,p.Amount,s.Supplier_name,s.Sup_contact from purchase p,supplier s 
//where s.Supplier_id=p.Supplier_id";
     // $run_c=mysqli_query($conn,$get_c);
      $i=$startpoint;
      $i+=1; $sup_name="";
                $sup_contact="";
      while($row_c=mysqli_fetch_array($result)){
                $s_id=$row_c['Supplier_id'];
                $p_id=$row_c['Purchase_id'];
                $s="select Supplier_name,Sup_contact from supplier where Supplier_id='$s_id'";
                $re=mysqli_query($conn,$s);
               
                while($r=mysqli_fetch_array($re))
                {
                  $sup_name=$r[0];
                  $sup_contact=$r[1];
                 
                }

        
        $p_date=$row_c['Purchase_date'];
          $originalDate = $p_date;
       $newDate = date("d-m-Y", strtotime($originalDate));
        $amount=$row_c['Amount'];

?>
     <tr align="center">
       <td><?php echo $i;?></td>
       <td><?php echo $newDate;?></td>
       <td><?php echo $sup_name;?></td>
       <td><?php echo $sup_contact;?></td>
	   <td> ₹ <?php echo $amount;?></td>
	    <td><a href='?link=52&edit_pur=<?php echo $p_id; ?>'>DETAILS</a></td>
     <td><a href='?link=69&add_pur=<?php echo $p_id; ?>'>PAYMENT</a></td>
   
       </tr>
<?php   $i++; } ?>
			<?php } ?>
  </table>

  <hr>
  <?php 
  if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=14','_self')</script>";

}

  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   mysqli_close($conn);
   ?>
  <hr>

</body>

</html>
