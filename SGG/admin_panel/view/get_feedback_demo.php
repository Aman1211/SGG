<?php 
		include '../db.php';
		$var=$_POST['id'];

		$hp="";$hp1="";
		if($var=="uname")
		{
			
			$sql="select * from feedback";
			$run=mysqli_query($conn,$sql);
			if($row=mysqli_fetch_array($run))
			{
				$desc=$row['Feedback_desc'];
			
			}
			
			
		
		}
		else
		{
			$hp="hardik";
		 }
		 echo $hp;

		
	?>		
