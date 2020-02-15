<?php
include('./db.php');
 $url='index.php?link=30&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from labour";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "labour"; //you have to pass your query over here table name
$query = "SELECT * FROM labour order by Labour_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>
<html>
  <title>
        VIEW LABOUR
  </title>
 <link rel="stylesheet" href="view_style.css" type="text/css"/> 
  <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />
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
      <td colspan="6" align="center">
        <h2>
          VIEW All LABOUR
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>LABOUR TYPE </th>
      <th>WORKER NAME</th>
      <th>WORKER CONTACT</th>
      <TH>EDIT</TH>
      <TH>DELETE</TH>
    </tr>
    <?php
        $i=$startpoint;
        $i+=1;
      
      if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
      $sql="select * from labour where Labour_id like '%$search%' or Worker_name like '%$search%' or Worker_contact like '%$search%'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
        $t_c=$queryresult;
        if($queryresult>0)
        {
          while($row=mysqli_fetch_assoc($hardik)){
            $id=$row['Labour_id'];
            $F_desc=$row['Worker_name'];
            $f_date=$row['Worker_contact'];
           
          $hp="select Labour_type_id from labour where Labour_id='$id' and Worker_name='$F_desc' and Worker_contact='$f_date' ";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_array($result)) {
            # code...
            $id1=$row2['Labour_type_id'];
          } 
          $sql3="select Labour_type_name from labour_type where Labour_type_id='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['Labour_type_name'];
          }
            echo"
          <tr align='center'>
           <td> ".$i."</td>
          <td>".$id2."</td> 
          <td>".$row["Worker_name"]."</td>
          <td>".$row['Worker_contact']."</td>
          " ?>
            <td><a href="?link=43&edit_l=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>    
            <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_labour.php?delete_s=<?php echo $id; ?>'}"class="fas fa-fw fa-trash"></a></td>
             </tr>

           <?php
         
       $i+=1;    }
          }
 elseif($queryresult<1)
        {
          $i=$startpoint;
          $i+=1;
          $sql3="select * from labour where Labour_type_id in(select Labour_type_id from labour_type where Labour_type_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          $t_c=mysqli_num_rows($result3);
          while($row3=mysqli_fetch_array($result3))
          {
            $lid=$row3['Labour_type_id'];
			       $w_name=$row3['Worker_name'];
           
            $sql4="select * from labour where Labour_type_id='$lid' and Worker_name='$w_name'";
            $result4=mysqli_query($conn,$sql4);
            while($row4=mysqli_fetch_array($result4))
            {
              $l_id=$row4['Labour_id'];
              
              $con=$row4['Worker_contact'];
              $sql5="select Labour_type_name from labour_type where Labour_type_id='$lid'";
              $result5=mysqli_query($conn,$sql5);
              $pro_name="";
              while($row5=mysqli_fetch_array($result5))
              {
                $l_name=$row5['Labour_type_name'];
              }
              echo"
          <tr align='center'>
          <td> ".$i."</td>
          <td>".$l_name."</td>
          <td>".$w_name."</td>
          <td>".$con."</td>"?>
      <td><a href="?link=43&edit_l=<?php echo $l_id ?>"class="fas fa-fw fa-edit"></a></td>    
          <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_labour.php?delete_s=<?php echo $l_id; ?>'}" class="fas fa-fw fa-trash"></a></td>
          
          </tr>
          <?php
          }
           $i+=1; }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }

     else{ 

      $i=$startpoint;
      $i+=1;
      while($row_c=mysqli_fetch_array($result)){
        $l_id1=$row_c['Labour_id'];
        $l_t_id=$row_c['Labour_type_id'];
        $r="select * from labour_type where Labour_type_id=$l_t_id";
        $r_r=mysqli_query($conn,$r);
        while($row_r=mysqli_fetch_array($r_r))
        {
         $l_NAME=$row_r['Labour_type_name'];   
        }
       
        $w_n=$row_c['Worker_name'];
        $w_c=$row_c['Worker_contact'];
      
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $l_NAME; ?></td>
       <td><?php echo $w_n; ?></td>
       <td><?php echo $w_c; ?></td>
      <td><a href="?link=43&edit_l=<?php echo $l_id1 ?>"class="fas fa-fw fa-edit"></a></td>
<td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_labour.php?delete_s=<?php echo $l_id1; ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
<?php $i+=1; } ?>

<?php } ?>
<?php
if(isset($_POST['showall'])){

  echo "<script>window.open('./index.php?link=30','_self')</script>";
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
