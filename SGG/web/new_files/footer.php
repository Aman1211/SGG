<?php 
	include('./db.php');
	$query="select * from company where company_id=1";
	$run=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($run)){
		$add=$row['Address'];
		$con=$row['Contact'];
		$eid=$row['Email_id'];
	}
?>

<style type="text/css">
	.hardik{
			margin-left: 38%;
			width:55%;
			height:20%;
			padding-bottom: 2%;
	}
	
</style>
<div class="footer">
	<div class="footer_agile_inner_info_w3l">
		<div class="col-md-3 footer-left">
			<h2><a href="index.php"><span>S</span>GG </a></h2>
			<p>SGG GLASS PROVIDES THE GLASS,
				 ALUMINUM SECTION,VARIOUT DESIGNFULL GLASS,
				 PROFILE SUTTER.</p>
			<ul class="social-nav model-3d-0 footer-social w3_agile_social two">
															<li><a href="https://www.facebook.com/hardiksgg" class="facebook">
																  <div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>
																 <li><a href="https://www.instagram.com/shree_gurukrupa_glass_traders/" class="instagram">
																  <div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																  <div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>

														</ul>
		</div>
		<div class="col-md-9 footer-right">
			<div class="sign-grds">
				<div class="col-md-4 sign-gd">
					<h4>Our <span>Information</span> </h4>
					<ul>
						<li><a href="index.php">Home</a></li>
						
					
						<li><a href="./about.php">About</li>
						<li><a href="./contact.php">Contact</li>
						
						
					</ul>
				</div>
		<div class="col-md-5 sign-gd-two">

				
					<h4>Store <span>Information</span></h4>
					<div class="w3-address">
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-phone" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Phone Number</h6>
								<p style="color: white;"><?php echo $con;?></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Email Address</h6>
								<p><a href="mailto:prajapatihardik4199@outlook.com"><?php echo $eid; ?></a></p>
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="w3-address-grid">
							<div class="w3-address-left">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</div>
							<div class="w3-address-right">
								<h6>Location</h6>
								<p>SHREE GURUKRUPA GLASS TRADERS ,
									Opp New Narapura Police Station,
									New vadaj,Ahmedabad:380013.
									Ahmedabad,Gujrat.
								</p>
							</div>

							<div class="clearfix"> </div>

						</div>
					</div>
				</div>


				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		
			

		
	</div>
		<p class="copy-right">&copy <script>document.write(new Date().getFullYear());</script> SGG. All rights reserved | Design by HARDIK,AMAN,KAMLESH</a></p>
	</div>
</div>