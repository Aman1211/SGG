

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post">
	<input type="submit" name="hp" value="ALL FEEDBACK" required>	
	<input type="submit" name="hp1" value="CUSTOEMR WISE">
	<input type="submit" name="hp2" value="PRODUCT WISE">
	<input type="submit" name="hp3" value="DATE WISE">
	
	<div id="hp" style="margin-top: 10px;">
	<?php
		include './db.php';
		$u_id="";$u_name="";$u_id1="";
		if(isset($_POST['hp']))
		{
			echo "<script> window.open('./view/feedback_report.php',target='_blank'); </script>";
		}
		if(isset($_POST['hp1']))
		{	
					include 'view_customer_report.php';
				} ?>


<!------------------------------------------------------------------------------------------------->

<?php 
if(isset($_POST['hp2']))
		{	
							include 'product_report_form.php';
					}
					?>
<!------------------------------------------------------------------------------------------------->

<?php 
if(isset($_POST['hp3']))
		{			
				include 'date_report.php';
					
				 }?>
</div>
</form>
	<?php

					if(isset($_POST['sub'])){
						$n=$_POST['p_name'];
					
					echo "<script>window.open('./view/feedback_product_wise.php?name=$n',target='_blank')</script>";
					}
					if(isset($_POST['generate']))
					{
							$n=$_POST['aman'];
					
					echo "<script>window.open('./view/feedback_customer_wise.php?name=$n',target='_blank')</script>";
					}
					if(isset($_POST['aub']))
					{
							$n=$_POST['sdate'];
							$p=$_POST['edate'];
					
					echo "<script>window.open('./view/feedback_date_wise.php?name=$n&name1=$p',target='_blank')</script>";
					}


					?>
				
	</body>
</html>