<?php
include './db.php';
if(isset($_POST['b_name']) && $_POST['b_name'] != '')
    {
		$response = array();
		$username = mysqli_real_escape_string($conn,$_POST['b_name']);
        $sql  = "select Category_name from category where Category_name='".$username."'";
        $res    = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($res);
        if($count > 0)
		{
			$response['status'] = false;
			$response['msg'] = 'Category already exists.';
		}
		else
		{
			$response['status'] = true;
			$response['msg'] = 'Category is not exists .';
		}
		 echo json_encode($response);
    }
mysqli_close($conn);
   ?>