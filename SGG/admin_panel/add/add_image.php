 <?php 
 $p_id="";
 $p_name="";
 include("./db.php");
 $sql="select max(Product_id) from product";
 $run=mysqli_query($conn,$sql);
if($run){
 while($row=mysqli_fetch_array($run))
 {
 	$p_id=$row[0];
 }
}
	$sql1="select Product_name from product where Product_id='$p_id'";
 	$run1=mysqli_query($conn,$sql1);
 	if($run1)
 	{	
 		while($row1=mysqli_fetch_array($run1))
 		{
 			$p_name=$row1['Product_name'];
 		}
 	}
?>
 <html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>ADD PRODUCT_IMAGE</h1>
<hr>

	<input type="text" name="p_name" value="<?php echo $p_name;?>" disabled>
	 <label for="name"><b>Select Image</b></label>
	 <input type="file" name="fileToUpload">
	 
	 <hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <input type="submit" class="registerbtn" name="img" value="No More Images">
   
	</div>
	</form>
 <?php
 if(isset($_POST['img']))
 {
 		echo "<script>window.open('./index.php?link=23','_self')</script>";
 }
 $link=24;
 if(isset($_POST['submit']))
 {
 		$target_dir = "../image/";
			$check="";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$img=basename( $_FILES["fileToUpload"]["name"]);
			$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    		if($check !== false) {
        		echo "<script>alert('File is an image - " . $check["mime"] . ".')</script>";
        		$uploadOk = 1;
    		} 
    		else 
    		{
        		echo "<script>alert('File is not an image.')</script>";
        		$uploadOk = 0;
   			 }
				// Check if file already exists
			/*if (file_exists($target_file)) {
    			echo "<script>alert(Sorry, file already exists.')</script>";
    			$uploadOk = 0;
			}
			/* Check file size
			if ($_FILES["fileToUpload"]["size"] > 100000) {
			    echo "<script>alert('Sorry, your file is too large.')</script>";
			    $uploadOk = 0;
			}*/
						// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
			   # echo "<script>window.open('./index.php?link=26','_self')</script>";
			// if everything is ok, try to upload file
			}

else{

		 $query6="insert into product_image(Product_id,Image_path) values('$p_id','$img')";
		 $execute6=mysqli_query($conn,$query6);
		 if($execute6)
		 {
		 	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
				        echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
    			}//if 
   	 		else
   			 	{
        			echo "<script>alert('Sorry, there was an error uploading your file because file is already exists in your folder.')</script>";
    			}
		 	echo "<script>alert('Done')</script>";

		 }
		else
			{
				echo "<script>alert('not')</script>";
				#echo "<script>window.open('./index.php?link=26','_self')</script>";
			}
	}
	 }mysqli_close($conn);
		 ?>
		</body>
</html>		