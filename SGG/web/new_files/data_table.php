
<html>
<head>
	<meta charset="utf-8"/>
	<link href="../css/hp.css" rel="stylesheet"/>
	 <link rel="icon" href="images/SGG.ICO">
<!--/tags -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--//tags -->
 
 
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href="../css/font-awesome.css" rel="stylesheet">
 <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">-->
<link href="../css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
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
<hr>
<div style="margin-top:10px;margin-bottom: 100px;margin-left: 8px;margin-right: 8px">
	<div class="wrapper">
		<table class="table">
			<thead>
				<tr>

					<th data-colsearch="yes">PRODUCT NAME </th>
					<th data-colsearch="yes"> HEIGHT </th>
					<th data-colsearch="yes">WIDTH </th>
					<th data-colsearch="yes">QTY </th>
				</tr>
			</thead>
			<tbody></tbody>
		</table>

	</div>

<?php
$_SESSION['id1']=$_GET['id'];


  ?>
	<script src="js/aman.js"></script>
	<script src="js/OpenDataTable.js"></script>
	<script type="text/javascript">
		$('.table').OpenDataTable({
			url: "data.php"
		})
	</script>
	<!-- footer -->
</div>
<hr>
<?php include 'footer.php'; ?>
<!-- //footer -->

<!-- login -->
			<?php include'login.php';?>
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