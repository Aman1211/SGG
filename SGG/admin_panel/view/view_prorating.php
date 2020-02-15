<html>
<body>
	<form method="post">
<select name="rat2">
						<option disabled="disabled">SELECT PRODUCT NAME</option>
						<?php 
						$u_name="";
							$sql = "SELECT DISTINCT(`Product_id`) FROM ratings";
							$run=mysqli_query($conn,$sql);
							if($run)
							{
								while($row=mysqli_fetch_array($run))
								{
									$u_id=$row[0];
									$sql1="SELECT `Product_name` FROM `product` WHERE `Product_id` LIKE '$u_id'";
									$run1=mysqli_query($conn,$sql1);
									if($run1)
									{
										while($row1=mysqli_fetch_array($run1))
										{
											$u_name=$row1[0];
										echo "<option value='$u_name'>" .$row1["Product_name"]. "</option>";
											
									}
									}
								}
							}
							

						?>
					</select>
					<input type="submit" name="generate1" value="GENRATE"></form></body></html>