<html>
<head>
	<title>php star rating system by using ajax jquery </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" style="width:800px;">
	<h2 align="center"> php star rating system by using ajax jquery </h2>
	<br />
	<span id="Product_list"></span>
	<br />
	<br />
	</div>
</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		load_business_data();
		function load_business_data()
		{
			$.ajax({
				url:'./fetch.php',
				method:"POST",
				success:function(data)
				{
					$('#Product_list').html(data);
				}
			})
		}
	});
</script>














