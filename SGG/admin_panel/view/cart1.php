<html>
<head>
	<title> PHP Cart </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"> </script>
<style>
.popover
{
	width:100px;
	max-width:800px;
}
</style>
</head>
<body>
	<div class="container">
		<br/>
		<h3 align="center"> Cart </h3>
		<br/>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar=toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Menu</span>
						<span class="glyphicon glyphicon-menu-hamburger"></span>
					</button>
					<a class="navbar-brand" href="/">
					Weblesson </a>
				</div>
				<div id="navbar-cart" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a id="cart-popover" class="btn" data-placement="bottom" title="Shopping Cart">
								<span class="glyphicon glyphicon-shopping-cart"></span>
								<span class="badge"></span>
								<span class="total_price">0.00</span>
							</a>
						</li>
					</ul>
			</div>
		</nav>
		<div id="popover_content_wrapper" style="display:none">
			<span id="cart_details"></span>
			<div align="right">
				<a href="#" class="btn-btn-primary" id="check_out_cart">
					<span class="glyphicon glyphicon-shopping-cart"></span>Check out</a>
					<a href="#" class="btn btn-default" id="clear_cart">
						<span class="glyphicon glyphicon-trash"></span>Clear</a></div>
	</div>
	<div id="display_item">

</div>
</div>
</body>
</html>
<script>
	$(document).ready(function(){
		load_product();
			load_cart_data();
			function load_product(){
				$.ajax({
				url:"fetch_item.php",
				method:"POST",
				success:function(data)
				{
					$('#display_item').html(data);
				}
			});
			}
			function load_cart_data()
			{
				$.ajax({
					url:"fetch_cart.php",
					method:"POST",
					dataType:"json",
					successkey: "value", 												
					function(data)
					{
						$('#cart_details').html(data.cart_details);
						$('.total_price').text(data.total_price);
						$('.badge').text(data.total_item);
					}
				});
			}
			$('#cart-popover').popover({
				html:true,
				container:"body",
					content:function(){
						return $('#popover_content_wrapper').html();
					}
			});
			$(document).on('click','.add_to_cart',function(){
				var product_id=$(this).attr("id");
				var product_name=$('#name'+product_id+'').val();
				var product_price =$('#price'+product_id+'').val();
				var product_quantity=$('#quantity'+product_id).val();
				var action ="add";
				if(product_quantity>0)
				{
						$.ajax({
							url:"action.php",
							method:"POST",
							data:{product_id:product_id,product_name:product_name,product_price:product_price,product_quantity:product_quantity,action:action},
							success:function(data)
							{
								load_cart_data();
								alert("Item has been added to cart");
							}
						});
				}
				else
				{
					alert("Please Enter number of quantity");
				}
			});
			

			
				});
	</script>