<?php
session_start();
include './db.php';
if(!empty($_POST)) {
	$output='';
	$r_id=$_SESSION['r_id'];
	$hp=$_POST["address"];
	$user_name=$_SESSION['username'];
	$u_id="";
	$d=date("Y/m/d");
	$add=mysqli_real_escape_string($conn,$_POST["address"]);
	$query="select * from login where USER_NAME='$user_name'";
    $run=mysqli_query($conn,$query);
    while($row=mysqli_fetch_array($run))
    {
    	$u_id=$row['USER_ID'];
    }
    if(isset($_POST['lab']))
    {
    	  $qu="UPDATE `request` SET `Request_id`='$r_id',`User_id`='$u_id',`Request_date`='$d',`Site_address`='$add',`labour`=1 WHERE  Request_id='$r_id'";
   }
   else{ 	
    $qu="UPDATE `request` SET `Request_id`='$r_id',`User_id`='$u_id',`Request_date`='$d',`Site_address`='$add' WHERE  Request_id='$r_id'";
}
	/*$qu="INSERT INTO request(User_id,Request_date,Site_address)VALUES ('$i','$d','$add')";*/
	if(mysqli_query($conn,$qu)){
		$output .='<label class="text-success">Data Insertded</label>';
		$_SESSION['r_id']=$_SESSION['r_id']+1;
		$_SESSION['count']=0;
	}
	echo $output;
}

?>