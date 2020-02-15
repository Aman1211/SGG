<?php
include 'db.php';
if(isset($_POST['a_name']) && $_POST['a_name'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['a_name']);
        $sql  = "select Area_name from area where Area_name='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'Area Name already exists.....';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'Area Name not exists.....';
		}
		 echo json_encode($response);
	}
	mysqli_close($conn);
?>