
<?php
$p_name="";
$i="";
	include 'db.php';
	if(isset($_REQUEST['id']))
	{
	$id1=$_REQUEST['id'];
	}
	else
	{
		$q="select max(Product_id) from product";
		$qr=mysqli_query($conn,$q);
		while($row=mysqli_fetch_array($qr))
		{
			$i=$row[0];
		}
		$id1=$i;
	}
?>

<!DOCTYPE html>
<html>
<head>

<title>SGG [SHREE GURUKRUPA GLASS TRADERS].</title>
 <link rel="icon" href="images/SGG.ICO">
<!--/tags -->
<style type="text/css">
	.l1{
		margin-left: 40px;
	}
	.aman{
		padding-right:80px;
	}
	.container{
    background: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    
    padding: 40px;
}
.star{
    color: #ccc;
    cursor: pointer;
    transition: all 0.2s linear;
}
.star-checked{
    color: gold;
}
#result{
    display: none;
}
b.r{
    color: red;
}
b.g{
    color: green;
}
.checked{
	color:gold;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elite Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
		
<!-- //tags -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="./style_rating.css"/>

<!-- //for bootstrap working -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>
</head>
<body>
<!-- header -->
<?php include './new_files/heder_1.php';?>
<!-- //header -->
<!-- header-bot -->
<?php include './new_files/heder_2.php'; ?>
        <!-- header-bot -->

<!-- //header-bot -->
<!-- banner -->
<?php include './new_files/nevigation.php';?>
<!-- //banner-top -->
<!-- Modal1 -->
<?php include './new_files/model_1.php';?>
<!-- //Modal1 -->
<!-- Modal2 -->
<?php include './new_files/sign_up.php';?>
<!-- //Modal2 -->
<!--/single_page-->
       <!-- /banner_bottom_agile_info -->
<div class="page-head_agile_info_w3l">
		<div class="container">
			<!--/w3_short-->
				 <div class="services-breadcrumb">
						<div class="agile_inner_breadcrumb">

						   <ul class="w3_short">
								
							</ul>
						 </div>
				</div>
	   <!--//w3_short-->
	</div>
</div>
<?php 
$p_name="";
$d_name="";
$b_name="";
$thick="";
$price="";

	$sql="select * from product where Product_id=$id1";
	$result5=mysqli_query($conn,$sql);
	while ($row_hp=mysqli_fetch_array($result5)) {
		# code...
		$p_id=$row_hp['Product_id'];
		$p_name=$row_hp['Product_name'];
		$price=$row_hp['Price'];
		$p_img=$row_hp['image_path'];
		$d_id=$row_hp['Design_id'];
		$b_id=$row_hp['Brand_id'];
		$t_id=$row_hp['Price_size_id'];
		$query="select Design_name  from design where Design_id=$d_id";
		$result=mysqli_query($conn,$query);
		while($row=mysqli_fetch_array($result))
		{
			$d_name=$row['Design_name'];
		}
		$query1="select Brand_name  from brand where Brand_id=$b_id";
		$result1=mysqli_query($conn,$query1);
		while($row1=mysqli_fetch_array($result1))
		{
			$b_name=$row1['Brand_name'];
		}
		$query2="select Thickness  from price_size where Price_Size_id=$t_id";
		$result2=mysqli_query($conn,$query2);
		while($row2=mysqli_fetch_array($result2))
		{
			$thick=$row2['Thickness'];
		}
	
		
	}
?>
  <!-- banner-bootom-w3-agileits -->
<div class="banner-bootom-w3-agileits">
	<div class="container">
	     <div class="col-md-4 single-right-left ">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					
					<ul class="slides">
						<?php 

							$img_id="select * from product_image where Product_id=$p_id";
							$img_run=mysqli_query($conn,$img_id);
							$no_img=mysqli_num_rows($img_run);
							
							if($no_img>0)
							{?>
							<li data-thumb="../image/<?php echo $p_img?>">
							<div class="thumb-image"> <img src="../image/<?php echo $p_img?>" data-imagezoom="true" class="img-responsive"> </div>
							</li>
						<?php		
							while($img_row=mysqli_fetch_array($img_run)){
								$img_path=$img_row['Image_path'];
							?>
							<li data-thumb="../image/<?php echo $img_path?>">
							<div class="thumb-image"> <img src="../image/<?php echo $img_path?>" data-imagezoom="true" class="img-responsive"> </div>
							</li>
								<?php }
							}
							else
							{?>
							<li data-thumb="../image/<?php echo $p_img?>">
							<div class="thumb-image"> <img src="../image/<?php echo $p_img?>" data-imagezoom="true" class="img-responsive" style="height:455px;"> </div>
							</li>
								<?php
							}
							

/*-------------------------------------------------------------------------RATING COUNT--------------------------------------------------------------------------------------*/


/*---------------------------------------------------------------RATING FINISH------------------------------------------------------------------------------------------------------------------------------*/

							 
						?>
						
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>

		<?php
		 $user_id="";
		include 'db.php';
		$var="";
		if(isset($_SESSION['username']))
		{
		 $var=$_SESSION['username'];
		 } 
		
		 $query8="select * from  login where USER_NAME='$var'";
        $result8=mysqli_query($conn,$query8);
      
        while($row8=mysqli_fetch_array($result8))
        {
                $user_id=$row8['USER_ID'];
        }
		$query7="select sum(Rating) from ratings where Product_id='$id1'";
		$result7=mysqli_query($conn,$query7);
		$rating="";
		$exact="";
		$giver="";
		if($result7)
		{
		while($row7=mysqli_fetch_array($result7))
		{
				$rating=$row7[0];
		}
		$avg="select  count(*) from ratings where Product_id='$id1'";
		$avg1=mysqli_query($conn,$avg);
		while($key=mysqli_fetch_array($avg1))
		{
				$giver=$key[0];
		}
			if($giver>0)
			{
		$exact=floor($rating/$giver);
	}
	else{
		$exact=0;
	}

}		?>
			
		<div class="col-md-8 single-right-left simpleCart_shelfItem">

					<h3><?php echo $p_name ?></h3>
					<p>PER Sq.feet :  <span class="item_price">₹ <?php echo $price?></span></p>
					<!--<span><?php echo $output;?></span>-->
						<?php if(isset($_SESSION['username'])){
							$quarry="select * from  ratings where Product_id='$id1' and user_id='$user_id'";
							$exec=mysqli_query($conn,$quarry);
							$exact1="";
							$ct=mysqli_num_rows($exec);
							while($raw=mysqli_fetch_array($exec))
							{
								$exact1=$raw['Rating'];
							}
						?>
						<script type="text/javascript" src="main.js"></script>

						<?php
						if($ct==0){
						 if($exact==0)
						
						{?>
							<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star " id="star-1"></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>

						<?php if($exact==1)
						{?>
					<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>
<?php if($exact==2)
{?>
	<div class="container">
      <input type="hidden" value="<?php echo $id1 ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php
}
?>
<?php if($exact==3)
{?>
	<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star checked" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php } ?>
<?php if($exact==4)
{?><div class="container">
      <input type="hidden" value="<?php echo $id1 ?>"  id="hello">
        <div id="star-container">

            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star checked" id="star-3"></i>
            <i class="fa fa-star fa-1x star checked" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php } ?>
<?php if($exact==5 or $exact>5)
{?>
	<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star checked" id="star-3"></i>
            <i class="fa fa-star fa-1x star checked" id="star-4"></i>
            <i class="fa fa-star fa-1x star checked" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php }}
else{

	if($exact1==0)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star " id="star-1"></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>

<?php if($exact1==1)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked " id="star-1" ></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>

<?php if($exact1==2)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked " id="star-1" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-2" ></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>
<?php if($exact1==3)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-3" ></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>
<?php if($exact1==4)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked " id="star-1" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-2" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-3" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-4"></i>
            <i class="fa fa-star fa-1x star " id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>
<?php if($exact1==5)
	{?>
		<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star checked " id="star-1" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-2" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-3" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-4" ></i>
            <i class="fa fa-star fa-1x star checked" id="star-5" ></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>
	<?php }
}else{
	if($exact==0)
						{ ?>

							<div class="you">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="star-container">
            <i class="fa fa-star fa-1x star " id="star-1"></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>

<?php if($exact==1) {?>
					
							<div class="you">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="aman-container">
            <i class="fa fa-star fa-1x star " id="star-1" checked></i>
            <i class="fa fa-star fa-1x star" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div> <?php } ?>

<?php if($exact==2)
{?>
	<div class="container">
      <input type="hidden" value="<?php echo $id1 ?>"  id="hello">
        <div id="aman-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php
}
?>
<?php if($exact==3)
{?>
	<div class="container">
      <input type="hidden" value="<?php echo $id1; ?>"  id="hello">
        <div id="aman-container">
            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star checked" id="star-3"></i>
            <i class="fa fa-star fa-1x star" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php } ?>
<?php if($exact==4)
{?><div class="container">
      <input type="hidden" value="<?php echo $id1 ?>"  id="hello">
        <div id="aman-container">

            <i class="fa fa-star fa-1x star checked" id="star-1"></i>
            <i class="fa fa-star fa-1x star checked" id="star-2"></i>
            <i class="fa fa-star fa-1x star checked" id="star-3"></i>
            <i class="fa fa-star fa-1x star checked" id="star-4"></i>
            <i class="fa fa-star fa-1x star" id="star-5"></i>
        </div>
        <div id="result"></div>
    </div>
<?php } ?>
<?php if($exact==5 or $exact>5)
{?>
	<div class="you">
    
        <div id="aman-container">
            <i class="fa fa-star fa-1x star checked" ></i>
            <i class="fa fa-star fa-1x star checked" ></i>
            <i class="fa fa-star fa-1x star checked" ></i>
            <i class="fa fa-star fa-1x star checked" ></i>
            <i class="fa fa-star fa-1x star checked" ></i>
        </div>
        <div id="result"></div>
    </div>
<?php } ?>

<?php } ?>



 


 
					<div class="description">

									<?php  if (isset($_SESSION['username']))
										{?>
						 <form action="cart_add.php" method="post" class="" style="width: 360px;">
						 	<input type="hidden"  name="p_id" value="<?php echo $p_id?>">
						 	<label>HEIGHT</label>
						<input type="number" max="120" min="6" name="height" id="height" required="" placeholder="ENTER THE HEIGHT OF GLASS" class="form-control"><br/>
						<LABEL>WIDTH</LABEL>
						<input type="number" max="120" min="6" name="width" id="width" required="" placeholder="ENTER THE WIDTH OF GLASS" class="form-control"><br/>
						<label>Quality :</label>
							<input type="number" name="qty" class="form-control" placeholder="ENTER THE QTY.." min="1" max="15" required="">
						
									<input type="submit" name="submit" value="Add to requirement" class="btn btn-success" style="width: auto;margin-top: 20px;">
								<br>
									<input type="reset" name="reset" value="RESET" Class="btn btn-success" style="margin-top: 10px;width:256px;background-color: red;color: white">
									
						</form>
					<?php }
					else
						{?>

							<form action="../login/login_d.php?id=<?php echo $p_id ?>" method="" class="" style="width: 360px;">
						 	<input type="hidden"  name="p_id" value="<?php echo $p_id?>">
						 	<label>HEIGHT</label>
						<input type="number" max="120" min="3" name="height" id="height" required="" placeholder="ENTER THE HEIGHT OF GLASS" class="form-control"><br/>
						<LABEL>WIDTH</LABEL>
						<input type="number" max="120" min="3" name="width" id="width" required="" placeholder="ENTER THE WIDTH OF GLASS" class="form-control"><br/>
						<label>Quality :</label>
							<input type="number" name="qty" class="form-control" placeholder="ENTER THE QTY.." min="1" max="15" required="">
						
									<input type="submit" name="aman" value="Add to requirement" class="btn btn-success" style="width: auto;margin-top: 20px;">
								<br>
									<input type="reset" name="reset" value="CANCEL" Class="btn btn-success" style="margin-top: 10px;width:256px;background-color: red;color: white">
								
						</form>
						
					<?php }?>
					</div>

					
					

<!---------------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php
			 $sql_sub_id="select * from product where Product_id=$id1";
				$result_sub=mysqli_query($conn,$sql_sub_id);
			while ($row_hp=mysqli_fetch_array($result_sub)) {
					$s_id=$row_hp['Subcategory_id'];
			}
	?>

<!---------------------------------------------------------------------------------------------------------------------------------------------------------->
		
					
					
		      </div>
		      <!--display data finished-->

	 			<div class="clearfix"> </div>
				<!-- /new_arrivals --> 
				<div class="responsive_tabs_agileits"> 
				<div id="horizontalTab">
						<ul class="resp-tabs-list" style="margin-left: 30px;">
							<li>Description</li>
							<li style="margin-left: 60px;">Reviews</li>
						</ul>
					<div class="resp-tabs-container">
					<!--/tab_one-->
					   <div class="tab1">

							<div class="single_page_agile_its_w3ls">
								<ul style="margin-left: 5px;">
								<label class="aman" >PRODUCT NAME</label><br/>
								<label class="aman">DESIGN NAME</label>	<br/>
								<label class="aman">BRAND NAME</label><br/>
								<label class="aman">THICKNESS</label><br/>
								<label class="aman">PRICE</label><br/>
								</ul>
								<ul style="margin-left: 155px;margin-top: -114px;">
								<LABEL class="l1"><?php echo $p_name; ?></LABEL><br/>
								<LABEL class="l1"><?php echo $d_name; ?></LABEL><br/>
								<LABEL class="l1"><?php echo $b_name; ?></LABEL><br/>
								<LABEL class="l1"><?php echo $thick; ?></LABEL><br/>
								<LABEL class="l1"><?php echo $price; ?></LABEL><br/>
								</ul>
							</div>
						</div>
						<!--//tab_one-->
						<div class="tab2">
							
							<div class="single_page_agile_its_w3ls">
								<div class="bootstrap-tab-text-grids">
									<h4><b>Other Reviews</b></h4>
									<div class="bootstrap-tab-text-grid">
										<!--<div class="bootstrap-tab-text-grid-left">
											
										</div>-->
										<div class="bootstrap-tab-text-grid-left">
											
									
											<ul>
											<?php 
												include 'db.php';

											     $query10="select * from feedback where Product_id='$id1'";
											     $result10=mysqli_query($conn,$query10);
											     		$fname="";
											     		$lname="";
											     while($row10=mysqli_fetch_array($result10))

											     {  
											     			$var=$row10['User_id'];
											     			$query11="select * from login where USER_ID='$var'";
											     			$result11=mysqli_query($conn,$query11);
											     			while($row11=mysqli_fetch_array($result11))
											     			{
											     					$fname=$row11['FirstName'];
											     					$lname=$row11['LastName'];
											     			} 
											     	?>
											     		<div>
											     		<p><b> <u><?php echo $fname." ". $lname ?></u> </b></p>
											     		<p> <?php echo $row10['Feedback_desc']; ?> </p>
											     	</div>
													 <?php    } ?>

											</ul>
									</textarea>
											
										</div>
										<div class="clearfix"> </div>
						             </div>
						             <?php if(isset($_SESSION['username']))
						             {?>
									 <div class="add-review">
										<h4>add a review</h4>
										<form action="#" method="post">
												<!--<input type="text" name="Name" required="Name">
												<input type="email" name="Email" required="Email"> -->
												<textarea name="Message" required="" placeholder="write your review..."></textarea>
											<input type="submit" value="SEND" name="feedback_submit">
										</form>
									</div>
								<?php } ?>
								 </div>
								 
							 </div>
						 </div>
						
					</div>
				</div>	
			</div>
	<!-- //new_arrivals --> 
	  	<!--/slider_owl--><?php if(isset($_POST['feedback_submit']))
	  	{
	  		$feedback=$_POST['Message'];
	  		 $d=date("Y-m-d");
        $var=$_SESSION['username'];
        $query12="select * from  login where USER_NAME='$var'";
        $result12=mysqli_query($conn,$query12);
       $user_id="";
        while($row12=mysqli_fetch_array($result12))
        {
                $user_id=$row12['USER_ID'];
        }

        $query13="INSERT INTO `feedback`(`Product_id`, `Feedback_desc`, `Feedback_date`, `User_id`) VALUES ('$id1','$feedback','$d','$user_id')";
        $result13=mysqli_query($conn,$query13);

	  	}
			?>
			<div class="w3_agile_latest_arrivals">
			<h3 class="wthree_text_info">Related <span>Products</span></h3>	

 	<div class="container">
     <div class="row">
					<?php 
						$pro_rand="select * from product ORDER BY RAND() LIMIT 4";
						$pro_run=mysqli_query($conn,$pro_rand);
						while($row_rand=mysqli_fetch_array($pro_run))
						{
							$p_id_r=$row_rand['Product_id'];
							$p_name=$row_rand['Product_name'];
							$d_id=$row_rand['Design_id'];
							$p_s_i=$row_rand['Price_size_id'];
							$price_rand=$row_rand['Price'];
							$i_path=$row_rand['image_path'];
							$mm="select * from price_size where Price_Size_id=$p_s_i";
							$qu=mysqli_query($conn,$mm);
							while($row_qu=mysqli_fetch_array($qu))
							{
								$mm_name=$row_qu['Thickness'];
							}?>

							 <div class="col-md-3 col-sm-6">
                        	<div class="thumbnail" style="border-color: aqua;border-width: 1px;">
                            <a href="single.php?id=<?php echo $p_id_r;?>">
                                <img src="../image/<?php echo $i_path ?>" style="width: 208px;height:220px;position: center;margin-left: 35px;margin-top: 10px"  alt="Cinque Terre">
                            </a>
                            <center>
                                <div class="caption">
                                    <label name="product_name"><?php echo $p_name ?></label>
                                    <p><?php echo $mm_name ?></p>
                                    <span>per sq.feet</span>₹<p><?php echo $price_rand ?></p>
                            		
                                    	<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
												<fieldset>
													<input type="submit" name="submit" value="DETAILS" class="button" onClick="document.location.href='single.php?id=<?php echo $p_id_r;?>';">
													<!--<button class="button" type="submit" name="cancel" onClick="document.location.href='single.php?id=<?php echo $pro;?>';" >Add to cart</button>-->
												</fieldset>
											</div>
                                     
                  					 </div>
                  			
                            </center>
                        </div>
                    </div>
							
                   
						 

							<!--while close for rabd function-->
						<?php } ?>
					  </div></div>
							<div class="clearfix"> </div>
					<!--//slider_owl-->
		         </div>
	        </div>
 </div>
<!--//single_page-->

<!-- footer -->
<?php include './new_files/footer.php'; ?>
<!-- //footer -->

<!-- login -->
			<?php include './new_files/login.php';?>
<!-- //login -->
<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<script src="js/modernizr.custom.js"></script>
	<!-- Custom-JavaScript-File-Links --> 
	<!-- cart-js -->
	<script src="js/minicart.min.js"></script>
<script>
	// Mini Cart
	paypal.minicart.render({
		action: '#'
	});

	if (~window.location.search.indexOf('reset=true')) {
		paypal.minicart.reset();
	}
</script>

	<!-- //cart-js --> 
	<!-- single -->
<script src="js/imagezoom.js"></script>
<!-- single -->
<!-- script for responsive tabs -->						
<script src="js/easy-responsive-tabs.js"></script>
<script>
	$(document).ready(function () {
	$('#horizontalTab').easyResponsiveTabs({
	type: 'default', //Types: default, vertical, accordion           
	width: 'auto', //auto or any width like 600px
	fit: true,   // 100% fit in a container
	closed: 'accordion', // Start closed if in accordion view
	activate: function(event) { // Callback function if tab is switched
	var $tab = $(this);
	var $info = $('#tabInfo');
	var $name = $('span', $info);
	$name.text($tab.text());
	$info.show();
	}
	});
	$('#verticalTab').easyResponsiveTabs({
	type: 'vertical',
	width: 'auto',
	fit: true
	});
	});
</script>
<!-- FlexSlider -->
<script src="js/jquery.flexslider.js"></script>
						<script>
						// Can also be used with $(document).ready()
							$(window).load(function() {
								$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
								});
							});
						</script>
					<!-- //FlexSlider-->
<!-- //script for responsive tabs -->		
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->
<!------------------------------rating js-------------------------------------------->

<!------------------------------rating js-------------------------------------------->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>
