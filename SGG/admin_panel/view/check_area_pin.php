<?php
include './db.php';
if(isset($_POST['p_num']) && $_POST['p_num'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['p_num']);
        $sql  = "select Pincode from area where Pincode='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'Area Pincode already exists.....';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'Area Pincode not exists.....';
		}
		 echo json_encode($response);
    }
    mysqli_close($conn);?>