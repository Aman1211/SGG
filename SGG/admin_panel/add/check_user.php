<?php
include '../db.php';
if(isset($_POST['brand_name']) && $_POST['brand_name'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['brand_name']);
        $sql  = "select USER_NAME from login where USER_NAME='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'Brand already exists.....';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'Brand is not exists.....';
		}
		 echo json_encode($response);
    }
mysqli_close($conn);
    ?>