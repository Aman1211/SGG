<?php
	$link="";
	$link=$_REQUEST['link'];
	?>
<!DOCTYPE html>
<html>
<head>
<title>SGG [SHREE GURUKRUPA GLASS TRADERS].</title>
 <link rel="icon" href="images/SGG.ICO">
<!--/tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//tags -->
 
 
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet">
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
 <link href="pagination/css/pagination.css" rel="stylesheet" type="text/css" />
<link href="pagination/css/A_green.css" rel="stylesheet" type="text/css" />
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

<!-- /banner_bottom_agile_info -->

<!-- /banner_bottom_agile_info -->
<?php 
	$sub_name="";
		$sub_query="select * from subcategory where Subcategory_id=$link";
		$sub_query_run=mysqli_query($conn,$sub_query);
			while($row4=mysqli_fetch_array($sub_query_run)){
				$sub_name=$row4['Subcategory_name'];
			}?>
 	<div class="container">
     <div class="row">
     	<?php 
     	
	 $url="product.php?link=$link&";
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from product where Subcategory_id='$link'";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 2; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "product"; //you have to pass your query over here table name
        $query="select * from brand LIMIT ";
	$query="select * from product where Subcategory_id='$link' LIMIT {$startpoint} , {$limit}";
	$result5=mysqli_query($conn,$query);
	if(mysqli_num_rows($result5)){
		while($row10=mysqli_fetch_array($result5))
		{
			$sub_cat_id=$row10['Subcategory_id'];
		
			$sub_query="select * from subcategory where Subcategory_id=$sub_cat_id";
			$sub_query_run=mysqli_query($conn,$sub_query);
			while($row2=mysqli_fetch_array($sub_query_run))
			{
				$sub_name=$row2['Subcategory_name'];
			}
			$pro=$row10['Product_id'];
			$image_path=$row10['image_path'];
			$price=$row10['Price'];
			$price_mm=$row10['Price_size_id'];
			$p_name=$row10['Product_name'];
			$mm="select * from price_size where Price_Size_id=$price_mm";
			$qu=mysqli_query($conn,$mm);
			while($row1=mysqli_fetch_array($qu))
			{
				$mm_name=$row1['Thickness'];
			}?>
			 <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <a href="./single.php?id=<?php echo $pro;?>">
                                <img src="../image/<?php echo $image_path ?>" alt="Cannon" style="width: 208px;height:260px">
                            </a>
                            <center>
                                <div class="caption">
                                    <h3><?php echo $p_name ?></h3>
                                    <p><?php echo $mm_name ?></p>
                                    <span>per sq.feet</span>   ₹<?php echo $price ?>
                                   
<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
												<fieldset>
													<input type="submit" name="submit" value="DETAILS" class="button" onClick="document.location.href='single.php?id=<?php echo $pro;?>';">
													<!--<button class="button" type="submit" name="cancel" onClick="document.location.href='single.php?id=<?php echo $pro;?>';" >Add to cart</button>-->
												</fieldset>
											</div>
                  					 </div>
                            </center>
                        </div>
                    </div>
				
		<?php }
	}
	else
		{
			echo "No data exists";
			
		}



?>
</div>
 <?php 
  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   ?>
</div>

	<!-- team -->
	
<!-- //team -->

	<!-- schedule-bottom -->
	
<!-- //schedule-bottom -->
  <!-- banner-bootom-w3-agileits -->

<!--grids-->
<!-- footer -->
 
<?php include './new_files/footer.php';?>
	
<!-- //footer -->
<?php include './new_files/login.php';?>
<!-- login -->
			
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
<!-- //script for responsive tabs -->
<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
<!-- //stats -->
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
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
				};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

			});
	</script>
<!-- //here ends scrolling icon -->


<!-- for bootstrap working -->
<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>