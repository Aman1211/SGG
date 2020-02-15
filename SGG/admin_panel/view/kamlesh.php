<?php
	session_start();
$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  

  if(isset($_POST["add"])){
  	if(isset($_SESSION["cart"])){
  		$item_array_id=array_column($_SESSION["cart"],array_column("Product_id"));
  		if(!in_array($_GET["id"],$item_array_id)){
  			$count = count($_SESSION["cart"]);
  			$item_array =  array(
  				'Product_id' => $_GET["id"],
  				'item_name' => $_POST["hidden_name"],
  				'product_price' => $_POST["hidden_price"],
  				'item_quantity' => $_POST["quantity"],
  			);
  			$_SESSION["cart"]["$count"] = $item_array;
  			echo '<script> window.location="Cart.php"</script>';
  		}else{
  			echo '<script>alert("Product is already added in the product")</script>';
  			echo '<script>window.location="Cart.php"</script>';

  		}else{
  			$item_array=array(
  				'Product_id' => $_GET["id"],
  				'item_name' => $_POST["hidden_name"],
  				'product_price' => $_POST["hidden_price"],
  				'item_quantity' => $_POST["quantity"],
  			);
  			$_SESSION["cart"][0] = $item_array;
  		}
  	}
  }
} 
if(isset($_GET["action"])){
	if($_GET["action"] == "delete"){
		foreach ($_SESSION["cart"] as $keys => $value) {
			if($value["Product_id"] == $_GET["id"]){
				unset($_SESSION["cart"][$keys]);
				echo '<script>alert("product has been removed")</script>';
				echo '<script>window.location="Cart.php</script>'
			}
		}
	}
}
?>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css?family=Titillium+Web');
		*{
			font-family: 'Titillium Web', sans-serif;
		}
		.product{
			border: 1px solid #eaeaec;
			margin: -1px 19px 3px -1px;
			padding: 10px;
			text-align: center;
			background-color: #efefef;
		}
		table, th ,tr{
			text-align: center;
		}
		.title2{
			text-align: center;
			color: #66afe9;
			background-color: #efefef;
			padding: 2%;
		}
		h2{
			text-align: center;
			color: #66afe9;
			background-color: #efefef;
			padding: 2%;	
		}
		table th{
			background-color: #efefef;
		}
	</style>
</head>
<body>
	<div class="container" style="width: 65 %">
		<h2> Shopping cart </h2>
		<?php
		$image="product_image";
			$query="select * from product ORDER BY Product_id ASC";
			$result=mysqli_query($conn ,$query);
			if(mysqli_num_rows($result) > 0){
				while($row=mysqli_fetch_array($result)){
					?>
				<div class="col-md-3">
					<form method="post" action="Cart.php?action=add&id=<?php echo $row["Product_id"]; ?>">
						<div class="product">
							<img src="product_image/<?php echo $row["image_path"]; ?>" class="img-responsive" height="150px" width="150px">
							<h5 class="text-info"><?php echo $row["Product_name"]; ?> </h5>
							<h5 class="text-danger"><?php echo $row["Price"]; ?> </h5>
							<input type="text" name="qty" class="form-control" value="1">
							<input type="hidden" name="hidden_name" value="<?php echo $row["Product_name"]; ?>">
							<input type="hidden" name="hidden_price" value="<?php echo $row["Price"]; ?>">
							<input type="submit" name="add" style="margin-top: 5px;" class="btn btn-success" value="Add to Cart">
							
						</div><br/>
					</form>
				</div>
				<?php
				}
			}
			?>

			<div style="clear: both"></div>
			<h3 class="title"> Shopping cart details </h3>
			<div class="table-responsive">
				<table class="table table-bordered">
				<tr>
					<th width="30%"> Product Name </th>
					<th width="10%"> Quantity </th>
					<th width="13%"> Price Details </th>
					<th width="10%"> Total Price </th>
					<th width="17%"> Remove Item </th>					
				</tr>
				<?php
				if(!empty($_SESSION["cart"])){
					$total=0;
					foreach ($_SESSION["cart"] as $key => $value) {
					?>
					<tr>
						<td><?php echo $value["item_name"] ; ?></td>
						<td><?php echo $value["item_quantity"] ; ?></td>	
						<td><?php echo $value["product_price"] ; ?></td>	
						<td><?php number_format( $value["item_quantity"] * $value["product_price"]); ?></td>	
						<td><a href="cart.php?action=delete&id=<?php echo $value["Product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
					</tr>
					<?php
					$total=$total + ($value["item_quantity"] * $value["product_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<th align="right">$ <?php echo number_format($total); ?> </th>
					</tr>
					<?php
				}
					?>
				</table>
			</div>
	</div>
</body>
</html>














