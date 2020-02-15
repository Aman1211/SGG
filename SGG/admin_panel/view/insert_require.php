<?php
include './db.php';
if(!empty($_POST)) {
	$output='';
	$req=$_POST['hide'];
	$product=$_POST['product'];
	$height=$_POST['h'];
    $width=$_POST['w'];

    $qty=$_POST['qty'];
	$pro_id="";
	
	
    $query2="select * from product where Product_name='$product'";
    $result2=mysqli_query($conn,$query2);
    while($row2=mysqli_fetch_array($result2))
    {
    		$pro_id=$row2['Product_id'];
            $price=$row2['Price'];
    }
   
    $qu="INSERT INTO `customer_requirement`(`Customer_req_id`, `Product_id`, `Size_Height`, `Size_Width`, `qty`,`rate`) VALUES ('$req','$pro_id','$height','$width','$qty','$price')";
	/*$qu="INSERT INTO request(User_id,Request_date,Site_address)VALUES ('$i','$d','$add')";*/
	if(mysqli_query($conn,$qu)){
		$output .='<label class="text-success">Data Insertded</label>';
	
	}
	echo $output;
}

?>