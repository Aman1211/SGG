<script type="text/javascript">
	function abc() {
		var abc=$('.hp').val();
		
		$.ajax({	
					method:"POST",
					url:"./view/get_thick_price.php",
						
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
					url:"./view/get_desing_price.php",
						
						data:"id="+abc,
						success:function(data){
							
							document.getElementById('hp').value=data;
    						}
					});
	}
		



</script>

<?php
	include("./db.php");
	$p_name="";$design_name="";$sub_name="";$b_name="";$thic="";$price="";$d_price="";$thic_price="";$img="";$uploadOk = 1;$check="";
	if(isset($_GET['edit_product'])){
		$edit_product=$_GET['edit_product'];
	
	 	$qu="select * from product where Product_id='$edit_product'";
		$run=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run);
		$update_id=$row_edit['Product_id'];
		$p_name=$row_edit['Product_name'];
		$d_id=$row_edit['Design_id'];
		
		$qu1="select * from design where Design_id='$d_id'";
		$run_cat1=mysqli_query($conn,$qu1);
				while($row=mysqli_fetch_array($run_cat1))
				{
					$design_name=$row['Design_name'];
					$d_price=$row['Price'];
				}
		$s_id=$row_edit['Subcategory_id'];
		$qu2="select * from subcategory where Subcategory_id='$s_id'";
		$run2=mysqli_query($conn,$qu2);
		while ($rowh=mysqli_fetch_array($run2)) {
			$sub_name=$rowh['Subcategory_name'];
		}
		$b_id=$row_edit['Brand_id']; 
		$qu3="select * from brand where Brand_id='$b_id'";
		$run3=mysqli_query($conn,$qu3);
		while ($rowh=mysqli_fetch_array($run3)) {
			$b_name=$rowh['Brand_name'];
		}
		$p_s_id=$row_edit['Price_size_id'];
		$qu4="select * from price_size where Price_Size_id='$p_s_id'";
		$run4=mysqli_query($conn,$qu4);
		while ($rowp=mysqli_fetch_array($run4)) {
			$thic=$rowp['Thickness'];
			$thic_price=$rowp['Price'];
		}
		$price=$row_edit['Price'];
		$img=$row_edit['image_path'];
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
    <h1>EDIT PRODUCT</h1>
<hr>
    <label for="name"><b>Product Name</b></label>
    <input type="text" placeholder="Enter Product Name" name="p_name" value="<?php echo $p_name;?>">
	<label for="type"><b>Select Design</b></label>
<select name="design" onchange="abc1()" id="aman" class="hp1">
	  <option disabled="disabled" selected="selected" value=<?php echo $d_id;?> ><?php echo $design_name;?></option>
<?php


$query="select *  from design";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Design_name"];
	$i=$row["Design_id"];
	echo "<option value='$i' >".$row["Design_name"]."</option>";
	
}

?>

</select>
<input type="text" name="" id="hp" disabled value="<?php echo $d_price;?>">

    <label for="type"><b>Select Subcategory</b></label>

<select name="sub">
	  <option disabled="disabled" selected="selected" value="<?php echo $s_id;?>" ><?php echo $sub_name;?></option>
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
<select name="brand">
	  <option disabled="disabled" selected="selected" value="<?php echo $b_id;?>" ><?php echo $b_name;?> </option>
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
<select name="thick" class="hp" onchange="abc();">
	  <option disabled="disabled" selected="selected" value="<?php echo $p_s_id;?>" ><?php echo $thic;?></option>
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
<input type="text" name="" id="rilex" disabled value="<?php echo $thic_price;?>">
<label for="image"><b>Select Image</b></label>
<input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo $img?>" /><img src='../image/<?php echo $img ?>' height=100 width=100>
<hr>
    <input type="submit" class="registerbtn" name="submit" value="Update">
    <input type="submit" class="registerbtn" value="Cancel" name="Cancel">
	
  </div>
  
 

<?php

$link=23;
	if(isset($_POST['Cancel'])){echo "<script> location.href='./index.php?link=23'</script>";}
		if(isset($_POST['submit']))
		{
			
			$target_dir = '../image/';
			
			

			if(isset($_POST['p_name']))
			{
				$name=$_POST['p_name'];	
			}
			else
			{
				$name=$p_name;
			}
			if(isset($_POST['design']))
			{
				$design=$_POST['design'];	
			}
			else
			{
				$design=$design_name;
			}
			if(isset($_POST['sub']))
			{
				$sub=$_POST['sub'];	
			}
			else
			{
				$sub=$sub_name;
			}
			if(isset($_POST['brand']))
			{
				$brand=$_POST['brand'];	
			}
			else
			{
				$brand=$b_name;
			}
			if(isset($_POST['thick']))
			{
				$thick=$_POST['thick'];	
			}
			else
			{
				$thick=$thic;
			}
			if(isset($_FILES["fileToUpload"]["name"]))
			{
				$check="";
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				$img1=basename( $_FILES["fileToUpload"]["name"]);
				$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
   				if($check !== false)
   				 {
       				# echo "<script>alert('File is an image - " . $check["mime"] . ".')</script>";
        			$uploadOk = 1;
    			}
    		 	else{
        			echo "<script>alert('File is not an image.')</script>";
       				$uploadOk = 0;
    			}
    			if (file_exists($target_file)) {
   				 echo "<script>alert(Sorry, file already exists.')</script>";
   				 $uploadOk = 0;
				}
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    				echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
    				$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
    			echo "<script>alert('Sorry, your file was not uploaded because file is already in your folder.')</script>";
    			#echo "<script>window.open('./index.php?link=23','_self')</script>";
				// if everything is ok, try to upload file
				}			

			}
			
	
			$query="select * from design where Design_name like '$design'";
			$execute=mysqli_query($conn,$query);
			while($row=mysqli_fetch_array($execute))
			{
				$d_id=$row['Design_id'];
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
			$query3="select Price_Size_id from price_size where Thickness like '$thick'";
			$execute3=mysqli_query($conn,$query3);
			while($row3=mysqli_fetch_array($execute3))
			{
				$t_id=$row3['Price_Size_id'];
			}
			$query9="select Price from price_size where Thickness like '$thick'";
			$execute9=mysqli_query($conn,$query9);
			while($row9=mysqli_fetch_array($execute9))
			{
				$tprice=$row9['Price'];
			}
			$total=$price+$tprice;
			
			$query4="update product set Product_name='$name',Design_id='$d_id',Subcategory_id='$s_id' ,Brand_id='$b_id',Price_size_id='$t_id',Price='$total', image_path='$img1' where Product_id='$update_id' ";
			$execute4=mysqli_query($conn,$query4);
			if($execute4)
			{	$hp=basename( $_FILES["fileToUpload"]["name"]);
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
				{
        			echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   			 	}//if 
   			 	else
   			 	{
        			echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    			}
			
				echo "<script>alert('Product has been updated')</script>";
			 	echo "<script> location.href='./index.php?link=23'</script>";
			}
			else
			{
				echo "<script>alert('not')</script>";
				echo "<script>window.open('./index.php?link=23','_self')</script>";
			}
	
}
mysqli_close($conn);
?>
</form>
</body>
</html>