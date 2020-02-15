<?php 
 include "db.php";
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
 	<input type="button" name="add_to_cart" id="'.$row['Product_id'].'" style="margin-top:5px;" class="btn-btn-success form-control add_to_cart" value="Add to Cart"/>
 	</div>
 	</div>';
 }
 echo $output;
 ?>