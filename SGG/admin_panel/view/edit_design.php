<?php
	include("./db.php");
	$edit_design_id="";$design_image="";$design_name="";
	$update_id="";
	if(isset($_GET['edit_design'])){
		$edit_design_id=$_GET['edit_design'];
		
		$qu="select * from design where Design_id='$edit_design_id'";
		$run_query=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run_query);
		$update_id=$row_edit['Design_id'];
		$design_name=$row_edit['Design_name'];
		$design_image=$row_edit['Design_image'];
		
		$design_price=$row_edit['Price'];
	}
?>
<html>
<head>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#d_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_design.php",{brand_name: brand_check},function(data)
				{
					if(data.status == true)
					{
						$('#brand_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#brand_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#brand_check').html(data.msg);
				},'json');
		});

	});

</script>
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>UPDATE DESIGN</h1>
<hr>
<input type="hidden" name="d_id" value="<?php echo $edit_design_id;?>">
    <label for="name"><b>Design Name</b></label>
    <input type="text" placeholder="Design Name" name="d_name" id="d_name" value="<?php echo $design_name;?>" onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/><br>
     <span id='brand_check' class="help-block"></span><br/>
	<label for="image"><b>Select Image</b></label><br>
	<input type="file" placeholder="Design  Image" name="fileToUpload" id="fileToUpload" required value="<?php echo $design_image;?>"><br>
	 <label for="price"><b>Design Price</b></label>
    <input type="number" placeholder="Design Price" name="d_price" min="1" value="<?php echo $design_price;?>"><br>
	<hr>
	 <input type="submit" class="registerbtn" name="submit" value="UPDATE">
	 <input type="submit" class="registerbtn" value="Cancel" name="Cancel">
  </div>
  </form>
  </body>
 
  </html>



<?php
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {


	//include "../db.php";
	$img="";$i="";
	$d_name=$_POST['d_name'];
	$price=$_POST['d_price'];

	if(isset($_FILES['fileToUpload']['name'])){

	$target_dir = "../image/";
$check="";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));	
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

		$query1="update design set Design_name='$d_name',Design_image='$img',Price='$price' where Design_id='$update_id'";
		$execute=mysqli_query($conn,$query1);
		if($execute)
		{
				if (file_exists($target_file)) {
    				echo "<script>alert(Sorry, file already exists.')</script>";
			}

			else {
				move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
        	echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   			 }//if 
   			
			echo "<script>alert('Design has been Updated ')</script>";
			echo "<script>window.open('./index.php?link=27','_self')</script>";
        }
		else
		{
			echo "<script>alert('Some Error')</script>";
			echo "<script>window.open('./index.php?link=28','_self')</script>";
		}
	}
}
}
	
}

?>
  
	