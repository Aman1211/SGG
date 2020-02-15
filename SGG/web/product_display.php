
 	<div class="container">
     <div class="row">
<?php 
	include 'db.php';
	$sql="select * from product order by RAND() LIMIT 8";
	$result5=mysqli_query($conn,$sql);
	
		while($row10=mysqli_fetch_array($result5))
		{
			$sub_cat_id=$row10['Subcategory_id'];
		
			$sub_query="select * from subcategory where Subcategory_id=$sub_cat_id";
			$sub_query_run=mysqli_query($conn,$sub_query);
			while($row2=mysqli_fetch_array($sub_query_run))
			{
				$sub_name=$row2['Subcategory_name'];
			}
			$pro=$row10['Product_id'];
			$image_path=$row10['image_path'];
			$price=$row10['Price'];
			$price_mm=$row10['Price_size_id'];
			$p_name=$row10['Product_name'];
			$mm="select * from price_size where Price_Size_id=$price_mm";
			$qu=mysqli_query($conn,$mm);
			while($row1=mysqli_fetch_array($qu))
			{
				$mm_name=$row1['Thickness'];
			}?>
			 <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <a href="single.php?id=<?php echo $pro;?>">
                                <img src="../image/<?php echo $image_path ?>" alt="Cannon" style="width: 208px;height:260px;margin-top: 10px;">
                            
                            <center>
                                <div class="caption">
                                    <h3><?php echo $p_name ?></h3>
                                    <p><?php echo $mm_name ?></p>
                                    <span style="margin-left: 1px;">per sq.feet</span><span>    </span>₹<?php echo $price ?>
                                   
                                     <!--<a href="single.php?id=<?php echo $pro;?>" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to request</a>-->
	                                   
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out button2">
												<fieldset>
													<input type="submit" name="submit" value="DETAILS" class="button" onClick="document.location.href='single.php?id=<?php echo $pro;?>';">
													<!--<button class="button" type="submit" name="cancel" onClick="document.location.href='single.php?id=<?php echo $pro;?>';" >Add to cart</button>-->
												</fieldset>
											</div>
										
                  				</div>
                            </center>
                        </div>
                    </div>
				
		<?php }
		
?>
</div>
</div>