<?php
include '../db.php';
if(isset($_POST['brand_name']) && $_POST['brand_name'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['brand_name']);
        $sql  = "select Labour_type_name from labour_type where Labour_type_name='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'LABOUR_TYPE_NAME already exists.';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'LABOUR_TYPE_NAME is available.';
		}
		 echo json_encode($response);
    }
mysqli_close($conn);
   ?>