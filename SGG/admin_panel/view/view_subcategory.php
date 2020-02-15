<?php
include('./db.php');
 $url='index.php?link=11&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from subcategory";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 6; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "subcategory"; //you have to pass your query over here table name
        $query = "SELECT * FROM subcategory order by Subcategory_id DESC LIMIT {$startpoint}, {$limit}";
        $result = mysqli_query($conn, $query);

?>
<?php $no_rec="";$i=1;?>

 
<html>
  <title>
        VIEW SUBCATEGORY
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
      <td colspan="5" align="center">
        <h2>
          VIEW All SUB_CATEGORY
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>SUB CATEGORY NAME</th>
      <th>CATEGORY NAME</th>
      <th>EDIT</th>
      <th>DELETE</th>

    </tr>
    <?php

      
      if(isset($_POST['submit']))
      {
        $i=$startpoint;
        $i+=1;
        $search=mysqli_real_escape_string($conn,$_POST['search']);
        $sql="select * from subcategory where Subcategory_id like '%$search%' or Subcategory_name like '%$search%' or Category_id in(select Category_id from category where Category_name like '%$search%')";
        $hardik=mysqli_query($conn,$sql);
        $t_c=mysqli_num_rows($hardik);
        $queryresult=mysqli_num_rows($hardik);
        if($queryresult>0)
        {
          while($row=mysqli_fetch_array($hardik)){
            $id=$row['Subcategory_id'];
            $s_name=$row['Subcategory_name'];
            
            $hp="select Category_id from subcategory where Subcategory_id='$id' and Subcategory_name='$s_name'";
          $result=mysqli_query($conn,$hp);
          $id1="";
          while ($row2=mysqli_fetch_assoc($result)) {
            $id1=$row2['Category_id'];
         
          
          } 
          $sql3="select Category_name from Category where Category_id='$id1'";
          $hp1=mysqli_query($conn,$sql3);
          $id2="";
          while($row3=mysqli_fetch_array($hp1)){
            $id2=$row3['Category_name'];
          }
            echo"
          <tr align='center'>
           <td> ".$i."</td>
           <td>".$row["Subcategory_name"]."</td> 
           <td>".$id2."</td>
          " ?>
          <td><a href="?link=61&edit_s=<?php echo $id ?>"class="fas fa-fw fa-edit"></a></td>
           <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_subcategory.php?delete_s=<?php echo $id; ?>'}"class="fas fa-fw fa-trash"></a></td>
             </tr>

           <?php
         $i++;
           }
          }
  
          else{
    echo "<script> alert('No Result Found') </script>";
  }
    
        }
else{
  $i=$startpoint;
  $i+=1;
     
      while($row_c=mysqli_fetch_array($result)){
        $s_id=$row_c['Subcategory_id'];
        $s_NAME=$row_c['Subcategory_name'];
        $c_id=$row_c['Category_id'];
        $k="select * from category where Category_id='$c_id'";
        $k_r=mysqli_query($conn,$k);
        while($k_row=mysqli_fetch_array($k_r)){
          $c_name=$k_row['Category_name'];
        }
        
      ?>
      <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $s_NAME; ?></td>
       <td><?php echo $c_name; ?></td>
       <td><a href="?link=61&edit_s=<?php echo $s_id; ?>"class="fas fa-fw fa-edit"></a></td>
       <td><a href="javascript:if(confirm('Are you want to delete this record?')){location.href='./delete/delete_subcategory.php?delete_s=<?php echo $s_id; ?>'}"class="fas fa-fw fa-trash"></a></td>
     </tr>
<?php $i++; } ?>
<?php } ?>
<?php
if(isset($_POST['showall'])){
  echo "<script>window.open('./index.php?link=11','_self')</script>";

}
?>
  </table>
  <hr>
  <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
?>
</hr>
 <?php mysqli_close($conn);?>
</body>
</html>
