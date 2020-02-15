
<html>
<head>
<script type="text/javascript">
	function abc() {
		var abc=$('.hp').val();
		
		$.ajax({	
					method:"POST",
					url:"./add/get_thick_price.php",
						
						data:"id="+abc,
						success:function(data){
							
							document.getElementById('rilex').value=data;
    						}
					});
	}
	function abc1() {
		var abc=$('.hp1').val();
		
		$.ajax({	
					method:"POST",
					url:"./add/get_design_price.php",
						
						data:"id="+abc,
						success:function(data){
							
							document.getElementById('hp').value=data;
    						}
					});
	}
		



</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>
<form action="" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>ADD PRODUCT</h1>
<hr>
    <label for="name"><b>Product Name</b></label>
    <input type="text" placeholder="Enter Product Name" name="p_name" required>
	<label for="type"><b>Select Design</b></label>
<select name="design" onchange="abc1()" id="aman" class="hp1" required>
	  <option disabled="disabled" selected="selected">Design</option>
<?php

include ("./db.php");
$query="select *  from design";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Design_name"];
	$i=$row["Design_id"];
	echo "<option value='$i'>".$row["Design_name"]."</option>";
	
}

?>

</select>
<input type="text" name="dpri" id="hp" disabled>
    <label for="type"><b>Select Subcategory</b></label>

<select name="sub" required>
	  <option disabled="disabled" selected="selected">Subcategory</option>
<?php

$query="select *  from subcategory";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Subcategory_name"];
	echo "<option value='$var'>".$row["Subcategory_name"]."</option>";
}	
?>
</select>
<label for="type"><b>Select Brand</b></label>
<select name="brand" required>
	  <option disabled="disabled" selected="selected">Brand</option>
<?php

$query="select *  from brand";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Brand_name"];
	echo "<option value='$var'>".$row["Brand_name"]."</option>";
}	
?>
</select>
<label for="type"><b>Select Thickness</b></label>
<select name="thick" class="hp" onchange="abc();" required>
	  <option disabled="disabled" selected="selected">Thickness</option>
<?php

$query="select *  from price_size";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Thickness"];
	$i=$row["Price_Size_id"];

	echo "<option value='$i'>".$row["Thickness"]."</option>";
}	
?>
</select>
<input type="text" name="tpri" id="rilex" disabled>
<label for="image"><b>Select Image</b></label><br>
	<input type="file" placeholder="Product Image" name="fileToUpload" required><br>
<hr>
    <input type="submit" class="registerbtn" name="submit" value="Insert">
    <button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=23'">Cancel</button>
	
  </div>
  
 
</form>
<?php

$link=23;$c=0;
		if(isset($_POST['submit']))
		{
			if(!isset($_POST['design'])){
							echo "<script>alert('Please Select Design')</script>";
							$c+=1;
						}
			if(!isset($_POST['sub'])){
							echo "<script>alert('Please Select Subcategory')</script>";
						$c+=1;}
			if(!isset($_POST['brand'])){
							echo "<script>alert('Please Select Brand')</script>";
						$c+=1;}
			if(!isset($_POST['thick'])){
							echo "<script>alert('Please Select Product Thickness')</script>";
						$c+=1;}
			$img="";
			$target_dir = "../image/";
			$check="";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$img=basename($_FILES["fileToUpload"]["name"]);
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
			   // echo "<script>window.open('./index.php?link=26','_self')</script>";
			// if everything is ok, try to upload file
			}
			else{
					if($c==0){
						$name=$_POST['p_name'];
						$design=$_POST['design'];
						$sub=$_POST['sub'];
						$brand=$_POST['brand'];
						$thick=$_POST['thick'];
						
						$d_id="";
						$price="";
						$s_id="";
						$b_id="";
						$t_id="";
						$tprice="";
						
						$query8="select Price from design where Design_id like '$design'";
						$execute8=mysqli_query($conn,$query8);
						while($row8=mysqli_fetch_array($execute8))
						{
							$price=$row8['Price'];
						}
						$query1="select Subcategory_id from subcategory where Subcategory_name like '$sub'";
						$execute1=mysqli_query($conn,$query1);
						while($row1=mysqli_fetch_array($execute1))
						{
							$s_id=$row1['Subcategory_id'];
						}
						$query2="select Brand_id from brand where Brand_name like '$brand'";
						$execute2=mysqli_query($conn,$query2);
						while($row2=mysqli_fetch_array($execute2))
						{
							$b_id=$row2['Brand_id'];
						}
						
						$query9="select Price from price_size where Price_Size_id like '$thick'";
						$execute9=mysqli_query($conn,$query9);
						while($row9=mysqli_fetch_array($execute9))
						{
							$tprice=$row9['Price'];
						}
						$total=$price+$tprice;
						
							    
						$query4="insert into product(Product_name,Design_id,Subcategory_id,Brand_id,Price_size_id,image_path,Price) values('$name','$design','$s_id','$b_id','$thick','$img','$total')";
						
						$execute4=mysqli_query($conn,$query4);
						if($execute4)
						{	
							if (file_exists($target_file)) {
    						echo "<script>alert(Sorry, file already exists.')</script>";
    		
							}
							else{
						if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
							{
						        echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   			 				}//if 
   			 				else
   			 				{
        						echo "<script>alert('Sorry, there was an error uploading your file because file is already exists in your folder.')</script>";
    						}		
							
						}
						echo "<script>alert('Product has been Added ')</script>";
							echo "<script>window.open('./index.php?link=26','_self')</script>";
					}
						else
						{
							echo "<script>alert('not')</script>";
							
						}
				}}
			}
	mysqli_close($conn);	
?>
<script src="vendor/jquery/jquery.min.js"></script>
</body>

</html>