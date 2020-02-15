<!--$sql = "SELECT * FROM `ratings` WHERE `Rating_date` BETWEEN \'2018-12-04\' AND \'2019-02-01\'";-->
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<form method="post">
	<input type="submit" name="hp" value="ALL RATING">	
	<input type="submit" name="hp1" value="CUSTOMER WISE">
	<input type="submit" name="hp2" value="PRODUCT WISE">
	<input type="submit" name="hp3" value="DATE WISE">

	
	<div id="hp" style="margin-top: 10px;">
	<?php
		include './db.php';
		$u_id="";$u_name="";$u_id1="";
		if(isset($_POST['hp']))
		{
			echo "<script> window.open('./view/rating_all_report.php',target='_blank'); </script>";
		}
		if(isset($_POST['hp1']))
		{	
				include 'view_customer_rating.php';	
		 }?>


<!------------------------------------------------------------------------------------------------->
<?php 
if(isset($_POST['hp2']))
		{	
					
				include 'view_prorating.php';	
				 }?>

<!------------------------------------------------------------------------------------------------->

<?php 
if(isset($_POST['hp3']))
		{	
				
					include 'view_daterating.php';

				}?>

			</form>
			<?php

					if(isset($_POST['generate'])){
						$n=$_POST['rat1'];
					
					echo "<script>window.open('./view/rating_customer_wise.php?name=$n',target='_blank')</script>";
					}
					if(isset($_POST['generate1']))
					{
							$n=$_POST['rat2'];
					
					echo "<script>window.open('./view/rating_product_wise.php?name=$n',target='_blank')</script>";
					}
					if(isset($_POST['generate3']))
					{
							$n=$_POST['rat3'];
							$p=$_POST['rat4'];
					
					echo "<script>window.open('./view/rating_date_wise.php?name=$n&name1=$p',target='_blank')</script>";
					}


					?>
		
	</body>
</html>