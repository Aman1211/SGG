<!DOCTYPE html>
<html>
<head>
	<title>rating hardik prajapati</title>
<script type="text/javascript"></script>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="container" style="width:800px;">
		<span id="business_list"></span>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		function load_bussiness_data(){
			$.ajax({
				url:'fetch.php',method="POST",success:function(data){
					$('#business_list').html(data);
				}
			});
		}

	});
</script>
</html>