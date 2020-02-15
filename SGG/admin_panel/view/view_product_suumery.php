<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<input type="submit" name="product">
	</form>
</body>
</html>
<?php
	if(isset($_POST['product']))
	{
		echo "<script> window.open('./view/product_sum.php',target='_blank'); </script>";
	}
?>