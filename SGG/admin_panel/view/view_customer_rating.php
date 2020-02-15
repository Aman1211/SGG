<html>
<body>
	<form method="post">
<select name="rat1">
						<option disabled="disabled">SELECT CUSTOMER NAME</option>
						<?php 
						$u_name="";
							$sql = "SELECT DISTINCT(`user_id`) FROM ratings";
							$run=mysqli_query($conn,$sql);
							if($run)
							{
								while($row=mysqli_fetch_array($run))
								{
									$u_id=$row[0];
									$sql1="SELECT `USER_NAME` FROM `login` WHERE `USER_ID` LIKE '$u_id'";
									$run1=mysqli_query($conn,$sql1);
									if($run1)
									{
										while($row1=mysqli_fetch_array($run1))
										{
											$u_name=$row1[0];
									echo "<option value='$u_name'>" .$row1["USER_NAME"]. "</option>";
										
								 	}
									}
								}
							}
							

						?>
					</select>
					<input type="submit" name="generate" value="GENRATE"></form></body></html>