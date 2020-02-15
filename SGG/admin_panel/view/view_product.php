<?php
include('./db.php');
 $url='index.php?link=23&';
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from product";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "product"; //you have to pass your query over here table name
      
$query = "SELECT * FROM product order by Product_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);

?>

<html>
  <title>
        VIEW PRODUCT
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>
  <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />

  <style>
   input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.search-container button {
 
  padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  border:solid 1px;
}
.search-container button:hover {
  background: #ccc;
}
@media screen and (max-width: 600px) {
   .search-container {
    float: none;
  }
     input[type=text], .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
   input[type=text] {
    border: 1px solid #ccc;  
  }
}
  </style>
<body>
 
<div class="search-container">
    <form action="" method="post">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit">Search</button>
	  <button type="submit" name="showall">Showall</button>
   </form>
  </div>
  <table id="data">
    <tr>
      <td colspan="11" align="center">
        <h2>
          View All PRODUCTS
        </h2>
      </td>
    </tr>
	 <tr>
      <th>SR NO.</th>
      <th>PRODUCT NAME</th>
	  <th>DESIGN NAME</th>
      <TH>SUB CATEGORY</TH>
      <TH>BRAND NAME</TH>
      <th>THICKNESS</th>
      <th>PRICE</th>
	  <th>IMAGE</th>
	  
	  <th>EDIT</th>
	  <th>MORE IMAGES </th>
	  <th>DELETE</th>
     
    </tr>
   
		 
			 <?php
	 

	if(isset($_POST['submit']))
	{
		$i=$startpoint;
		$i+=1;

		$search=mysqli_real_escape_string($conn,$_POST['search']);
		$sql="select * from product WHERE Product_id like'%$search%' or Product_name like '%$search%' or Price like '%$search%' or Design_id in(select Design_id from design where Design_name like '%$search%') or Subcategory_id in(select Subcategory_id from subcategory where Subcategory_name like '%$search%') or Brand_id in(select Brand_id from brand where Brand_name like '%$search%') or Price_size_id in (select Price_Size_id from price_size where Thickness like '%$search%')";
		$result=mysqli_query($conn,$sql);
		$queryresult=mysqli_num_rows($result);
		$t_c=$queryresult;				
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
						$pro_id=$row['Product_id'];
						$pro_name=$row['Product_name'];
						$price=$row['Price'];
						$path=$row['image_path'];
						$design=$row['Design_id'];
						$brand=$row['Brand_id'];
						$price=$row['Price'];
						$sub=$row['Subcategory_id'];
						$thick=$row['Price_size_id'];
						
						$sql2="select * from product where Product_id='$pro_id' and Product_name='$pro_name' and Design_id='$design' and Subcategory_id='$sub' and Brand_id='$brand' and Price_size_id='$thick' and Price='$price'and image_path='$path'";
						$result2=mysqli_query($conn,$sql2);
						while($row2=mysqli_fetch_array($result2))
						{
							
						
					$sql3="select Design_name from design where Design_id='$design'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						$id2=$row3['Design_name'];
					}
					
					$sql4="select Brand_name from brand where Brand_id='$brand'";
					$result4=mysqli_query($conn,$sql4);
					$id3="";
					while($row4=mysqli_fetch_array($result4))
					{
						$id3=$row4['Brand_name'];
					}
					
					$sql5="select Thickness from price_size where Price_size_id='$thick'";
					$result5=mysqli_query($conn,$sql5);
					$id4="";
					while($row5=mysqli_fetch_array($result5))
					{
						$id4=$row5['Thickness'];
					}
					
					$sql6="select Subcategory_name from subcategory where Subcategory_id ='$sub'";
					$result6=mysqli_query($conn,$sql6);
					$id5="";
					while($row6=mysqli_fetch_array($result6))
					{
						$id5=$row6['Subcategory_name'];
					}
					echo"
					<tr align='center'>
					
				    <td> ".$i."</td>
					<td>".$row['Product_name']."</td>
					<td>".$id2."</td>
					<td>".$id5."</td>
					<td>".$id3."</td>
					<td>".$id4."</td>
					<td>₹ ".$row['Price']."</td>
					<td><image src=../image/".$row['image_path']." height=100 width=100/></td>
					<td><a href='?link=37&edit_d=".$row['Product_id']."' class='fas fa-fw fa-edit'></a></td>
					<td> <a href='?link=23&image=".$pro_id."' class='fa fa-camera-retro fa-lg'></a> </td>";
					?>
						<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product.php?delete_p=<?php echo $pro_id ?>'}" class="fas fa-fw fa-trash"></a></td>
			</tr>
			<?php
		}
$i++;	}
	}
	elseif($queryresult<=0){
		echo "<script> alert('No Result Found') </script>";
	}
	}
else{			
      $i=$startpoint;
      $i+=1;
     
      while($row_c=mysqli_fetch_array($result)){


			        $p_id=$row_c['Product_id'];
			        $p_name=$row_c['Product_name'];
			        $design=$row_c['Design_id'];
					$brand=$row_c['Brand_id'];
					$sub=$row_c['Subcategory_id'];
					$thick=$row_c['Price_size_id'];
			        $sql3="select Design_name from design where Design_id='$design'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						 $p_d=$row3['Design_name'];
		
					}
					
					$sql4="select Brand_name from brand where Brand_id='$brand'";
					$result4=mysqli_query($conn,$sql4);
					$id3="";
					while($row4=mysqli_fetch_array($result4))
					{
						$p_b=$row4['Brand_name'];
					}
					
					$sql5="select Thickness from price_size where Price_size_id='$thick'";
					$result5=mysqli_query($conn,$sql5);
					$id4="";
					while($row5=mysqli_fetch_array($result5))
					{
						$p_t=$row5['Thickness'];
					}
					
					$sql6="select Subcategory_name from subcategory where Subcategory_id ='$sub'";
					$result6=mysqli_query($conn,$sql6);
					$id5="";
					while($row6=mysqli_fetch_array($result6))
					{
						$p_c=$row6['Subcategory_name'];
					}
					$p_p=$row_c['Price'];
					$path=$row_c['image_path'];
?>
	
     <tr align="center">
       <td><?php echo $i; ?></td>
       <td><?php echo $p_name; ?></td>
       <td><?php echo $p_d; ?></td>
       <td><?php echo $p_c; ?></td>
       <td><?php echo $p_b; ?></td>
       <td><?php echo $p_t; ?></td>
       <td>₹ <?php echo $p_p; ?></td>
	   <td><img src="../image/<?php echo $path; ?>" width="130" height="80"/></td>
	   <td> <a href="?link=45&edit_product=<?php echo $p_id; ?>" class="fas fa-fw fa-edit"></a></td>
	   <td> <a href="?link=23&image=<?php echo $p_id;?>" class="fa fa-camera-retro fa-lg"></a> </td>
       <td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product.php?delete_p=<?php echo $p_id ?>'}" class="fas fa-fw fa-trash"></a></t
       </tr>
			  
	  <?php $i+=1; }  ?>
	  <?php } ?>
  </table>

  <hr>
  <?php
	if(isset($_GET['image'])){
		$image=$_GET['image'];
		
	 	$qu="select * from product_image p,product p1 where p.Product_id='$image' and p1.Product_id='$image'";
		$run=mysqli_query($conn,$qu);
		$aman=array();
		$name="";
		while($row=mysqli_fetch_array($run))
		{
			array_push($aman,$row['Image_path']);
			$name=$row['Product_name'];
			$pro_img_id=$row['Product_image_id'];
		}
		?>

 <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"> IMAGES</i>
			   <table id="data">
			  <th>PRODUCT_NAME</th>
			  <th> IMAGES </th>
			  <th> EDIT </th>
			  <th> DELETE </th>
			  </div>
            <div class="card-body">
              <div class="table-responsive">
			 
			  <?php 
							$len=sizeof($aman);
							for($i=0;$i<$len;$i++)
							{
								  echo"
								<form method=post enctype='multipart/form-data'>
					<tr align='center'>
									
					<td>".$name."</td> 
					<td><image src=../image/".$aman[$i]." height=100 width=100 /></td>
					<td><input type=file name=fileToUpload required accept=image/*> <button  name=image_submit class=''>EDIT</button></td>"; ?>
								<td><a href="javascript:if(confirm('Are you want to Delete this record?')) {location.href='./delete/delete_product_image.php?delete_p=<?php echo $pro_img_id ?>'}" class="fas fa-fw fa-trash"></a></td>
								</form>
								<?php
					
							}
							if(isset($_POST['image_submit']))
							{
								$target_dir = "../image/";
								$check="";
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


								$image_name=$_POST['img_edit'];
								$sql="update product_image set Image_path='$img'  where Product_id='$image' and Product_image_id='$pro_img_id'";
								$result=mysqli_query($conn,$sql);								
								if($result){
									if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
									 {
        								echo "<script>alert('The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.')</script>";
   									 }//if 
   									 else
   									 {
        								echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
    								 }
									echo "<script> alert('Image has been updated'); </script>";
									echo "<script> location.href='./index.php?link=23' </script>";
								}
								else
								{
									echo "<script> alert('Image Not updated Some Error Plz Try agian'); </script>";
									echo "<script> location.href='./index.php?link=23' </script>";
								}
							}
						}
			  ?>
			  </div>
			  </div>
			  </table>
			 
			  </div>
		
		<?php 
	} ?>
	<hr>
  <?php
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
  ?>
 <?php 
 if(isset($_POST['showall']))
 {
 echo "<script>window.open('./index.php?link=23','_self')</script>";
}
  mysqli_close($conn);?>
  <hr>
</body>

</html>