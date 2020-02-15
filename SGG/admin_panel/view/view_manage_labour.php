<?php
include('./db.php');

if(isset($_GET["s_id"]))
{
  $s_id=$_GET['s_id'];
}





?>
<html>
  <title>
        VIEW LABOUR
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

</head>
<body>
<div class="search-container">
    <form action="" method="post">
     
    <button type="submit" name="back">BACK</button>
    </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="6" align="center">
        <h2>
          VIEW All LABOUR
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>LABOUR NAME</th>
      <th>DOJ</th>
      <th>DOL</th>
      <th>STATUS</th>
      <TH>AMOUNT</TH>
      
    </tr>
    <?php
       // $i=$start_from;
        //$i+=1;
      
     if(isset($_POST['back'])) 
     {
      echo "<script> location.href='./index.php?link=34' </script>";
     } 

    //  $i=$start_from;
      $i=1;
      $st="";
      $name="";
      $doj="";
      $dol="";
      $amount="";
      $query="select * from sales_labour where Sales_id='$s_id'";
      $result=mysqli_query($conn,$query);

      while($row_c=mysqli_fetch_array($result)){
        $l_id=$row_c['Labour_id'];

        $query2="select * from labour where Labour_id='$l_id'";
        $result2=mysqli_query($conn,$query2);
      while($row2=mysqli_fetch_array($result2))
      {
              $name=$row2['Worker_name'];
              $st=$row2['status'];
        
      }
        $r="select * from sales_labour where Labour_id=$l_id and Sales_id='$s_id'";
        $r_r=mysqli_query($conn,$r);
        while($row_r=mysqli_fetch_array($r_r))
        {
         $doj=$row_r['dateofjoin'];
         $dol=$row_r['dateofleave'];
         $amount=$row_r['amount'];   
               
       
      
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $name; ?></td>
       <td><?php echo $doj; ?></td>
       <td><?php echo $dol; ?></td>
       <?php if($st==0){?>
       <td>Completed</td><?php } else { ?>
        <td> Working </td> <?php }?>
       <td><?php echo $amount?> </td>
      
     </tr>
<?php $i++; }} ?>


<?php
if(isset($_POST['showall'])){}
?>
  </table>
   <div align="center">
    <br />

 
  </div> 
  <hr>
  <?php
mysqli_close($conn); 
 ?>
  <hr>

</body>

</html>
