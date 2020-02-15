<?php
include('./db.php');
 $url='index.php?link=29&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from request";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "request"; //you have to pass your query over here table name
$query = "SELECT * FROM request order by Request_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);
?>
<html>
  <title>
        VIEW REQUIREMENTS
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
      <td colspan="10" align="center">
        <h2>
          View All REQUESTS
        </h2>
      </td>
    </tr>
    <tr>
      <th>SR NO.</th>
      <th>CUSTOMER NAME</th>
	  <th>SITE ADDRESS</th>
      <th>REQUEST DATE</th>
       <th>STATUS</th>
	  <th>REQUIREMENTS</th>
     
     
    </tr>
    <?php
    	
      
	   if(isset($_POST['submit']))
			{
				$i=$startpoint;
    			$i+=1;
	$search=mysqli_real_escape_string($conn,$_POST['search']);

	$sql= "select * from request where Request_id like '%$search%' or Request_date like '%$search%' or Site_address like '%$search%' or User_id in (select USER_ID from login where FirstName like '%$search%') or User_id in (select USER_ID from login where LastName like '%$search%') ";
	$result_hp=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result_hp);
	$t_c=mysqli_num_rows($result_hp);

	if($queryresult>0){
    $fname="";
        $lname="";
		while($row=mysqli_fetch_Array($result_hp))
		{
      $st=$row['status'];
			$req=$row['Request_id'];
			$date=$row['Request_date'];
			$originalDate = $date;
       $newDate = date("d-m-Y", strtotime($originalDate));
			$add=$row['Site_address'];
			$user=$row['User_id'];
			$sql1="select  * from request where Request_id='$req' and User_id='$user' and Request_date='$date' and Site_address='$add'";
			$result=mysqli_query($conn,$sql1);
			
			while($row1=mysqli_fetch_array($result))
			{	$u_id=$row1['User_id'];
					$sql2="select FirstName,LastName from login where USER_ID='$u_id'";
					$result2=mysqli_query($conn,$sql2);
			
				
				while($row2=mysqli_fetch_array($result2))
				{
						$fname=$row2['FirstName'];
						$lname=$row2['LastName'];
				}
			
			}
      if($st==0){
			echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$fname.$lname."</td>
					<td>".$add."</td>
					<td>".$newDate."</td>
          <td>Pending</td>
					<td><a href='?link=51&edit_r=".$req."'>REQUIREMENTS</a></td>
					</tr>";
				}
        else{
          echo"
          <tr align='center'>
          
            <td> ".$i."</td>
          <td>".$fname.$lname."</td>
          <td>".$add."</td>
          <td>".$newDate."</td>
          <td>Completed</td>
          <td><a href='?link=51&edit_r=".$req."'>REQUIREMENTS</a></td>
          </tr>";
			$i++;}}
	} else
        {
          echo "<script>alert ('no result found')</script>";
        }
					
				}
	
			else
			{
				$i=$startpoint;
				$i+=1;
      while($row_c=mysqli_fetch_array($result)){
		$r_id=$row_c['Request_id'];
       	$user=$row_c['User_id'];
        $st=$row_c['status'];
       	$sql7="Select FirstName,LastName from login where USER_ID='$user'";
	    $result7=mysqli_query($conn,$sql7);
	    $fname="";
	    $lname="";
		while($row7=mysqli_fetch_array($result7))
		{
			$c_name=$row7['FirstName'];
			$c_name1=$row7['LastName'];
		}
        $s_a=$row_c['Site_address'];
		$d_r=$row_c['Request_date'];
		$originalDate = $d_r;
       $newDate = date("d-m-Y", strtotime($originalDate));
	if($st==0){
?>
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $c_name; echo $c_name1;?></td>
	    <td><?php echo $s_a; ?></td>
		 <td><?php echo $newDate; ?></td>
     <td><?php echo 'Pending' ?></td>
		 <td><a href='?link=51&edit_r=<?php echo $r_id; ?>'>REQUIREMENTS</a></td>
       </tr> 
     <?php }else{ ?>
 <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $c_name; echo $c_name1;?></td>
      <td><?php echo $s_a; ?></td>
     <td><?php echo $newDate; ?></td>
     <td><?php echo 'Completed' ?></td>
     <td><a href='?link=51&edit_r=<?php echo $r_id; ?>'>REQUIREMENTS</a></td>
       </tr> 
     <?php } ?>
<?php $i+=1; 
	} ?>
	
			<?php } ?>

  </table>
		
  
  <hr>
  <?php
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
  ?>
 <?php 
if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=29','_self')</script>";

}
  mysqli_close($conn);?>
  </hr>


</body>

</html>
