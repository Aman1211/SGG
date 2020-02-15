<?php
include "db.php";

?>
<!DOCTYPE html>
<html>
<head>

 <style>
  .modal-header, h4, .close {
    background-color: #5cb85c;
    color:white !important;
    text-align: center;
    font-size: 30px;
  }
  .modal-footer {
    background-color: #f9f9f9;
  }
  </style>

<title> Request </title>
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="container">
		<div id="display_item">
			<?php 
			$output="";
 $query="select * from product";
 $result=mysqli_query($conn,$query);
 while($row=mysqli_fetch_array($result))
 {
 	$output .='<div class="col-md-3"  style="margin-top:12px;">
 	<div style="border:1px solid #333 background-color:#f1f1f1;  border-radius:5px; padding:16px; height:350px;" align="center">
 	<img src="product_image/'.$row['image_path'].'" class="img-responsive" /> <br/>
 	<h4 class="text-info">'.$row['Product_name'].'</h4>
 	<h4 class="text-danger"> '.$row['Price'].'</h4>
 	<input type="text" name="quantity" id="quantity'.$row['Product_id'].'" class="form-control" value="1"/>
 	<input type="hidden" name="hidden_name"  id="name'.$row["Product_id"].'" value="'.$row["Product_name"].'"/>
 	<input type="hidden" name="hidden_price" id="price'.$row['Product_id'].'" value="'.$row['Price'].'"/>
 	<input type="button" name="add_to_cart" id="'.$row['Product_id'].'" style="margin-top:5px;" class="btn-btn-success form-control add_to_cart" data-toggle="modal" value="Add to Cart" data-target="#myModal"/>
 	</div>
 	</div>';
 }
 echo $output;
 ?>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span>REQUIREMENTS</h4>
        </div>
        </div>
         <div class="modal-body" style="padding:40px 50px;">
           <form role="form">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>ENTER HEIGHT</label>
              <input type="text" class="form-control" id="height" placeholder="Enter HEIGHT" required>
              <label for="usrname"><span class="glyphicon glyphicon-user"></span>ENTER WIDTH</label>
              <input type="text" class="form-control" id="width" placeholder="Enter WIDTH" required>
               <label for="usrname"><span class="glyphicon glyphicon-user"></span>ENTER QTY</label>
              <input type="number" class="form-control" id="qty" placeholder="Enter QTY" required>
            </div>
        </form>
        </div>
        <div class="modal-footer">
         				  <button type="submit" name="sub" class="btn btn-danger btn-default pull-right" id="submit"><span class=""></span>SUBMIT</button>
        </div>
      </div>
      
    </div>
  </div>
 	

		</div>
			<script>
				$(document).on('click','.sub',function(){
					
				
					$.ajax({
				url:"check_log.php",
				method:"POST",
				success:function(data)
				{
				 			alert("abc");
				}

				});
		});
			</script>
	</body>
</html>
