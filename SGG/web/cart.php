
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
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
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

<!-- banner -->


<div style="margin-top: 10px">
            
            
            <div class="container">
                <table class="table table-bordered table-striped">
                    <tbody>
                       
                      
     	<?php 
     	include 'db.php';
     	$r_id=$_SESSION['r_id'];
     	
 		$i=1;
 		$p_name="";$price="";$img="";
     $query4="select * from customer_requirement where Customer_req_id=$r_id";
	$result=mysqli_query($conn,$query4);
	$no_of=mysqli_num_rows($result);
	if($no_of>0)
	{
		?>
		 <tr><th colspan="9" style="font-size:25px">My Requirements</th></tr>
		 <tr>
                            <th>SR NO.</th>
                                         <th> Product Image </th>
                            <th>Thickness</th>
                            <th>Product Name</th>
               				
                            <th>Height</th>
                            <th>width</th>
                            <th>Qty</th>
                            <th>Product Price</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        $price_id="";$thi="";
	while($row=mysqli_fetch_array($result)){
		$cr_id=$row['requirement_id'];
		$p_id=$row['Product_id'];
		$query1="select * from product where Product_id=$p_id";
		$run1=mysqli_query($conn,$query1);
		while($row1=mysqli_fetch_array($run1))
		{
			$p_name=$row1['Product_name'];
			$price=$row1['Price'];
			$img= $row1['image_path'];
			$price_id=$row1['Price_size_id'];
             $th="SELECT `Thickness` FROM `price_size` WHERE `Price_Size_id` LIKE $price_id";
            $runth=mysqli_query($conn,$th);
            if($runth){
            while($r=mysqli_fetch_array($runth))
            {
              $thi=$r[0];
            }
             }
		}
		

     	?>                      
                         
                        <tr>
                            <th><?php echo $i?></th>
                            <th><img src="../image/<?php echo $img ;?>" height="50"; widt h="50";> </th>
                            <th><?php echo $thi;?></th>
                            <th><?php echo $p_name;?></th>
                            
                            <th><?php echo $row['Size_Height'];?></th>
                            <th><?php echo $row['Size_Width'];?></th>
                            <th><?php echo $row['qty'];?></th>
                            <th>₹ <?php echo $price;?></th>

                           <th><a href="remove_cart.php?id=<?php echo $cr_id;?>" class="fa fa-trash" style="color:black;font-size:30px;"></a></th>
                        </tr>
             
                  		 <?php $i+=1;}?>
                  		<tr>
                            
                             <th colspan="8"></th>
                           <th><a  class="btn btn-primary" data-toggle="modal" data-target="#hp_address">Confirm Order</a></th>
                        </tr>
                        <?php 
                        }	
                        else
						{?>
							<center style='margin-top:30px;'><h2> No Requirements Found...</h2></center>
							<center style='margin-top:40px;'>
								<div class="occasion-cart">
							<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
								<fieldset>
									<input type="submit" name="submit" value="BACK.." class="button" onClick="document.location.href='index.php'">
								</fieldset>
							</div>
						</div>
					</center>
					<?php }?>
                    </tbody>
                </table>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
        </div>

<!-- footer -->
<?php include './new_files/footer.php'; ?>
<!-- //footer -->

<!-- login -->
			<?php include'./new_files/login.php';?>
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

<script type="text/javascript">
		$(document).ready(function() {
			$('#add_address').on('submit',function(event){
				event.preventDefault();
				if($('#as').val()=='')
				{
					alert("Enter The Address");
				}
				else
				{
					$.ajax({
						url:"insert_address.php",
						method:"POST",
						data:$('#add_address').serialize(),
						 beforeSend:function(){  
     $('#insert').val("Inserting");  
    }, 
						success:function(data){
							
							$('#hp_address').modal('hide'); 
							location.href='index.php';
    						}
					});
				}
			});
		});
</script>
<div class="container">
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="hp_address" role="dialog">
    <div class="modal-dialog">
					    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
  	        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Enter The Site Address</h4>
        </div>
       
        <div class="modal-body">
        	<form method="post" id="add_address">
        		<div>
           			<textarea name="address" id="as" class="form-control" rows="5" id="comment"></textarea>
       				</div>
       				<div>
       					<input type="checkbox" name="lab" value="Labour">Labour Work
       				</div>
        		<div class="_button">
        		  <div class="_b1">
        			<input type="submit" name="insert" id="insert" value="Insert" />
<span>    </span><span>   </span>
       				<input type="submit" name="reset" id="reset" value="clear" class="btn btn-success" style="background-color: Black;
border-color: Black;
"/> 
        	       </div>
        		</div>
        	</form>
		</div>
        <div class="modal-footer">
        	<button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
