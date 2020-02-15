<?php
include('./db.php');
 $url='index.php?link=34&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from sales";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "sales"; //you have to pass your query over here table name
$query = "SELECT * FROM sales order by Sales_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <head>

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
          View All SALES
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>SALES DATE</th>
      <th>CUSTOMER NAME</th>
      <TH>SALES DETAILS</TH>
      <TH>SALES PAYMENT</TH>
      <th>SALES LABOUR</th>
      <th>INVOICE</th>
      
    </tr>
    <?php

        $i=$startpoint;
        $i+=1;
     if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
  $sql= "select * from sales where Sales_id like '%$search%' or Sales_date like '%$search%' or Request_id in (select Request_id from request where User_id in(select USER_ID from login where FirstName like '%$search%' or LastName like '%$search%'))";
  $result=mysqli_query($conn,$sql);
  $queryresult=mysqli_num_rows($result);
  $t_c=$queryresult;
  if($queryresult>0){
    while($row=mysqli_fetch_assoc($result)){
          $p_id=$row['Sales_id'];
          $date=$row['Sales_date'];
        
              $newDate = date("d-m-Y", strtotime($date));
          $rq=$row['Request_id'];
            $sql1="select FirstName,LastName from login where USER_ID in(select User_id from request where Request_id in(select Request_id from sales where Request_id='$rq'))";
            $run=mysqli_query($conn,$sql1);
            while($row=mysqli_fetch_array($run))
            {
              $f_name=$row['FirstName'];
              $l_name=$row['LastName'];
            }
              $mob="select labour from request where Request_id in(select Request_id from sales where Sales_id='$p_id')";
        $ri=mysqli_query($conn,$mob);
        $invi="";
        while($su=mysqli_fetch_array($ri))
        {
            $invi=$su['labour'];
        }
          
            ?>
          <tr align='center'>
          
            <td><?php echo $i;?></td>
          <td><?php echo $newDate; ?></td>
          <td><?php echo $f_name;echo $l_name?></td>
          <td><a href='?link=65&s_d=<?php echo $p_id;?>&r_id=<?php echo $rq?>'>Details</a></td>
          <td><a href='?link=35&s_id=<?php echo $p_id;?>'>Payment</a></td>
            <td><a href='?link=68&s_id=<?php echo $p_id;?>'>Labour</a></td>
            <?php if($invi==0) { ?>
             <td><button name="invoice" class="btn btn-primary" onclick="window.open('./view/invoice.php?s_id=<?php echo $p_id;?>',target='_blank');" >Invoice</button></td> <?php 
            } else { ?>
               <td><button name="invoice" class="btn btn-primary" onclick="window.open('./view/invoice1.php?s_id=<?php echo $p_id;?>',target='_blank');" >Invoice</button></td>
         <?php   } ?>
           
          </tr>
      <?php
        $i+=1;  
      }//while close
  }//if close
    else{
      echo "<script> alert('No Result Found') </script>";
      }
  }//main if close
  else
  {
    $i=$startpoint;
        $i+=1;
    while($row_c=mysqli_fetch_array($result)){
    $p_id=$row_c['Sales_id'];
        $p_date=$row_c['Sales_date'];
        $newDate = date("d-m-Y", strtotime($p_date));
    $r_id=$row_c['Request_id'];
        $sql="select FirstName,LastName from login where USER_ID in(select User_id from request where Request_id in(select Request_id from sales where Request_id='$r_id'))";
        $run=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($run))
        {
          $f_name=$row['FirstName'];
          $l_name=$row['LastName'];
        }
        $mob="select labour from request where Request_id in(select Request_id from sales where Sales_id='$p_id')";
        $ri=mysqli_query($conn,$mob);
        $invi="";
        while($su=mysqli_fetch_array($ri))
        {
            $invi=$su['labour'];
        }
  ?>
     <tr align="center"> 
       <td><?php echo $i; ?></td>
       <td><?php echo $newDate; ?></td>
       <td><?php echo $f_name;echo $l_name ?></td>
       <td><a href='?link=65&s_d=<?php echo $p_id; ?>&r_id=<?php echo $r_id;?>'>Details</a></td>
       <td><a href='?link=35&s_id=<?php echo $p_id;?>'>Payment</a></td>
        <td><a href='?link=68&s_id=<?php echo $p_id;?>'>Labour</a></td>
        <?php if($invi==0) {?>
         <td><button name="invoice" class="btn btn-primary" onclick="window.open('./view/invoice.php?s_id=<?php echo $p_id;?>',target='_blank');" >Invoice</button></td>
       <?php } else { ?>
         <td><button name="invoice" class="btn btn-primary" onclick="window.open('./view/invoice1.php?s_id=<?php echo $p_id;?>',target='_blank');" >Invoice</button></td> <?php } ?>
      
       </tr>
<?php $i++; } ?>
    <?php }?>
  </table>

   
  
  <hr>
 <?php 
 if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=34','_self')</script>";

}

  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   mysqli_close($conn);?>

</body>

</html>
