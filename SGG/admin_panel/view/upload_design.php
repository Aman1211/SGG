
<?php
include "../db.php";
$target_dir = "../../image/";
$check="";
if(isset($_POST["Cancel"]))
{
   echo "<script>window.open('../index.php?link=27','_self')</script>";
}

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])){
	  $d_name=$_POST['d_name'];
		$price=$_POST['d_price'];
		$update_id=$_POST['d_id'];

		
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	
		$img="";$i="";
		
		$img=basename($_FILES["fileToUpload"]["name"]);
		$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if($check !== false) 
    	{
    	    #echo "<script>alert('File is an image - " . $check["mime"] . ".')</script>";
    	    $uploadOk = 1;
   		}
   		else 
   		{
        	echo "<script>alert('File is not an image.')</script>";
        	$uploadOk = 0;
    	}
    	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
    	{
    		echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
    		$uploadOk = 0;
		}
		if ($uploadOk == 0) 
		{
    		echo "<script>alert('Sorry, your file was not uploaded.')</script>";
   			// echo "<script>window.open('../index.php?link=27','_self')</script>";
			// if everything is ok, try to upload file
		}
    else{
		$query1="update design set Design_name='$d_name',Design_image='$img',Price='$price' where Design_id='$update_id'";	
		$execute=mysqli_query($conn,$query1);
		if($execute)
			{
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
        			echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   				 }//if 
   				 else
   				 {
        			echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    			 }
    			 echo "<script>alert('Design has been Updated ')</script>";
				 echo "<script>window.open('../index.php?link=27','_self')</script>";
    		}
    		else
    		{
    			echo "<script>alert('not')</script>";
				echo "<script>window.open('../index.php?link=27','_self')</script>";	
    		}
  }  	
    	
}

?>