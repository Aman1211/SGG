<?php
 // set the session max lifetime to 2 hours

session_start();
 





unset($_SESSION['username']);  
		session_destroy();
	header("location:../login/login2.php");
	?>