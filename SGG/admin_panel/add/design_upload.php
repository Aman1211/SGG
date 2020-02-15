
<?php
$target_dir = "../../image/";
$check="";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	include "../db.php";
	$img="";$i="";
	$d_name=$_POST['d_name'];
	$price=$_POST['d_price'];
	$img=basename( $_FILES["fileToUpload"]["name"]);
	echo "<script>alert('$img')</script>";

	$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   // echo "<script>alert('$check')</script>";
    if($check !== false) {
        echo "<script>alert('File is an image - " . $check["mime"] . ".')</script>";
        $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }

// Check if file already exists

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
 //   echo "<script>window.open('../index.php?link=28','_self')</script>";
// if everything is ok, try to upload file
} 

else {
	$qup="select * from design where Design_name='$d_name'";
	$dupquery=mysqli_query($conn,$qup);
	if(mysqli_num_rows($dupquery)>0)
	{
		echo "<script>alert('Design_name is already exists.')</script>";
	}
	else
	{
		$query="INSERT INTO design(Design_name,Design_image,Price) VALUES ('$d_name','$img','$price')";
		$execute=mysqli_query($conn,$query);
		if($execute)
		{
				if (file_exists($target_file)) {
    				echo "<script>alert(Sorry, file already exists.')</script>";
			}

			else {
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
        	echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   			 }//if 
   			
			echo "<script>alert('Design has been Added ')</script>";
			echo "<script>window.open('../index.php?link=27','_self')</script>";
        }
		else
		{
			echo "<script>alert('not')</script>";
			echo "<script>window.open('../index.php?link=28','_self')</script>";
		}
	}
}
}
?>