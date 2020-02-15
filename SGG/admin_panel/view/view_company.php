<?php
include('./db.php');
 $url='index.php?link=12&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from company";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "company"; //you have to pass your query over here table name
       $query = "SELECT * FROM company order by company_id DESC LIMIT {$startpoint}, {$limit}";
       $result = mysqli_query($conn, $query);

?>


<?php $no_rec="";$i=1;?>
<html>
  <title>
        VIEW COMPANY
  </title>
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
          View All COMPANY
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>COMPANY NAME</th>
      <th>ADDRESS</th>
      <th>EMAIL ID</th>
      <th>AREA NAME</th>
      <TH>CONTACT</TH>
      <TH>GST NO</TH>
      <TH>EDIT</TH>
      
    </tr>
    <?php

      
      if (isset($_POST['submit'])){
$i=$startpoint;
$i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from company where company_id like '%$search%' or Company_name like '%$search%' or Address like '%$search%' or Email_id like '%$search%' or Contact like '%$search%' or GST_no like '%$search%'";
        $result=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($result);
        $t_c=$queryresult;
        if($queryresult>0){
          while ($row=mysqli_fetch_assoc($result)) {
           $id=$row['company_id'];
           $name=$row['Company_name'];
           $add=$row['Address'];
           $e_id=$row['Email_id'];
           $con=$row['Contact'];
           $gst_no=$row['GST_no'];
           $sqlh="select Area_id from company where company_id='$id' and Company_name='$name' and Address='$add' and Email_id='$e_id' and Contact='$con' and GST_no='$gst_no'";
           $resulth=mysqli_query($conn,$sqlh);
           $idh="";
           while($row2=mysqli_fetch_assoc($resulth)){
            $idh=$row2['Area_id'];
           }
           
           $sqlhp="select Area_name from area where Area_id='$idh'";
           $hp=mysqli_query($conn,$sqlhp);
           while($row3=mysqli_fetch_array($hp)){
            $aname=$row3['Area_name'];
           }
            echo "
            <tr align='center'>
            <td>".$i."</td>
            <td>".$row['Company_name']."  </td>
            <td>".$row['Address']." </td>
            <td> ".$row['Email_id']."</td>
            <td> ".$aname."</td>
            <td> ".$row['Contact']."</td>
            <td> ".$row['GST_no']."</td>" ?>
           
           
           <td><a href="?link=41&edit_c=<?php echo $id ?>" class="fas fa-fw fa-edit"></a></td>
            
             </tr><?php
         $i+=1; }
        }
        if($queryresult<1){
          $i=$startpoint;
          $i+=1;
        $sql1="select * from Company c ,AREA a where a.Area_name like '%$search%' and a.Area_id=c.Area_id";
        $resu=mysqli_query($conn,$sql1);
        $queryresult1=mysqli_num_rows($resu);
        $t_c=$queryresult1;
        if($queryresult1>0){
          while($row1=mysqli_fetch_assoc($resu)){
            $id1=$row1['company_id'];
            echo "
                <tr align='center'>
            <td>".$i."</td>
            <td>".$row1['Company_name']."  </td>
            <td>".$row1['Address']." </td>
            <td> ".$row1['Email_id']."</td>
            <td> ".$row1['Area_name']."</td>
            <td> ".$row1['Contact']."</td>
            <td> ".$row1['GST_no']."</td>" ?>

          <!--<td><a href="javascript:if(confirm('Are you want to edit this record?')){location.href=?link=41&edit_c=<?php echo $id;?>}">EDIT</a></td>-->
           <td><a href="?link=41&edit_c=<?php echo $id1 ?>"class="fas fa-fw fa-edit"></a></td>

      
             </tr>
            <?php
        $i+=1;  }
        }
        else
        {
          echo "<script>alert ('No Result Found')</script>";
        }

      }
    }
    else{
      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
$idh=$row_c['Area_id'];
        $sqlhp="select Area_name from area where Area_id='$idh'";
           $hp=mysqli_query($conn,$sqlhp);
           while($row3=mysqli_fetch_array($hp)){
            $aname=$row3['Area_name'];
           }
           

        $c_id=$row_c['company_id'];
        $c_NAME=$row_c['Company_name'];
        $address=$row_c['Address'];
        $e_id=$row_c['Email_id'];
		    
        $contact=$row_c['Contact'];
        $gst_no=$row_c['GST_no'];
	
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $c_NAME; ?></td>
       <td><?php echo $address;?></td>
       <td><?php echo $e_id; ?></td>
       <td><?php echo $aname; ?></td>
       <td><?php echo $contact; ?></td>
       <td><?php echo $gst_no; ?></td>
      <!--<td><a href="javascript:if(confirm('Are you want to edit this record?')){location.href=?link=41&edit_c=<?php echo $id;?>}">EDIT</a></td>-->
      <td><a href="?link=41&edit_c=<?php echo $c_id ?>"class="fas fa-fw fa-edit"></a></td>
      
       
     </tr>
     <?php $i+=1; } ?>
<?php } ?>
<?php 
if(isset($_POST['showall'])){
  echo "<script>window.open('./index.php?link=12','_self')</script>";

}
?>
  </table>

  <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
  ?>
 <?php 
mysqli_close($conn);
 ?>
  </hr>

</body>

</html>
