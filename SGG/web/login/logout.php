<?php
 // set the session max lifetime to 2 hours

session_start();
 




  
		session_destroy();
	header("location:login2.php");
	?>