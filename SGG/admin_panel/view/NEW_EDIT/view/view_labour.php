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
      <th>LABOUR_ID</th>
      <th>LABOUR_TYPE_NAME</th>
      <th>WORKER_NAME</th>
      <th>WORKER_CONTACT</th>
      <TH>EDIT</TH>
      <TH>DELETE</TH>
    </tr>
    <?php
 $i=0;
   
      include("./db.php");
if(isset($_POST['submit']))
      {
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from labour where Labour_id like '%$search%' or Worker_name like '%$search%' or Worker_contact like '%$search%'";
        $hardik=mysqli_query($conn,$sql);
        $queryresult=mysqli_num_rows($hardik);
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
           <td> ".$row["Labour_id"]."</td>
          <td>".$id2."</td> 
          <td>".$row["Worker_name"]."</td>
          <td>".$row['Worker_contact']."</td>
          " ?>
           <td><a href="?link=43&edit_l=<?php echo $id ?>">EDIT</a></td>
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='../delete/delete_labour.php?delete_s=<?php echo $id; ?>'}">DELETE</a></td>
             </tr>

           <?php
         
           }
          }
 elseif($queryresult<1)
        {
          $sql3="select * from labour where Labour_type_id in(select Labour_type_id from labour_type where Labour_type_name like '%$search%')";
          $result3=mysqli_query($conn,$sql3);
          while($row3=mysqli_fetch_array($result3))
          {
            $lid=$row3['Labour_type_id'];
			$w_name=$row3['Worker_name'];
            echo "<script> alert('$lid'); </script>";
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
          <td> ".$l_id."</td>
          <td>".$l_name."</td>
          <td>".$w_name."</td>
          <td>".$con."</td>"?>
          <td><a href="?link=43&edit_l=<?php echo $l_id ?>">EDIT</a></td>
          
          <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_labour.php?delete_s=<?php echo $l_id; ?>'}">DELETE</a></td>
          
          </tr>
          <?php
          }
            }
          }
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }

     else{ $get_c="select * from labour l,labour_type l1 where l.Labour_type_id=l1.Labour_type_id";
      $run_c=mysqli_query($conn,$get_c);
      while($row_c=mysqli_fetch_array($run_c)){
        $l_id1=$row_c['Labour_id'];
        $l_NAME=$row_c['Labour_type_name'];
        $w_n=$row_c['Worker_name'];
        $w_c=$row_c['Worker_contact'];
      $i++;
      ?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $l_NAME; ?></td>
       <td><?php echo $w_n; ?></td>
       <td><?php echo $w_c; ?></td>
     <td><a href="?link=43&edit_l=<?php echo $l_id1 ?>">EDIT</a></td>
    <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_labour.php?delete_s=<?php echo $l_id1; ?>'}">DELETE</a></td>
     </tr>
<?php } ?>

<?php } ?>
<?php
if(isset($_POST['showall'])){}
?>
  </table>
</body>

</html>
