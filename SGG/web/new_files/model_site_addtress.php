<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <style type="text/css">
._button{
	margin-left: 10px;
	margin-top: 10px;
}
._button ._b1{
page-break-inside: 5px;
}
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
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
        		<div class="_button">
        		  <div class="_b1">
        			<input type="submit" name="insert" id="insert" value="Insert"  class="btn btn-success" style="background-color: Black;
border-color: Black;
">
<span>    </span><span>   </span>
       				<input type="submit" name="reset" id="reset" class="btn btn-success" style="background-color: Black;
border-color: Black;
"> 
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
						success:function(data){
							alert("data stored");

							$('#add_address')[0].reset();
							$('#myModal').modal('hide');
						}
					});
				}
			});
		});
</script>
</html>
