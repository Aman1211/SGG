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
<select name="product" required>
    <?php
	$link=
include ("./db.php");
$query="select *  from product";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Product_name"];
	echo "<option value='$var'>".$row["Product_name"]."</option>";
}	
?>
</select>
	 <label for="name"><b>Select Image</b></label>
	 <input type="file" name="fileToUpload" required="">
	 
	 <hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=23'">Cancel</button>
	</div>
	</form>
 <?php
 $link=23;
 
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
			    #echo "<script>window.open('./index.php?link=23','_self')</script>";
			// if everything is ok, try to upload file
			}
			else
			{
				 $product=$_POST['product'];
				 $sql1="select Product_id from product where Product_name ='$product'";
 				 $run1=mysqli_query($conn,$sql1);
 				 if($run1)
 				 {	
 		             while($row1=mysqli_fetch_array($run1))
 		   			 {
 			        	$p_id=$row1['Product_id'];
 					 }
 				 }
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
					echo "<script>alert('Product Image has been Added ')</script>";
					echo "<script>window.open('./index.php?link=23','_self')</script>";
				}	
				else
				{
					echo "<script>alert('Image Can't Be added)</script>";
					echo "<script>window.open('./index.php?link=23','_self')</script>";
				}
		 	 }
	}
mysqli_close($conn);
		 ?>
		</body>
</html>		