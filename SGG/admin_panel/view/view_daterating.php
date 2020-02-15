
<html>
<body>
	<form method="post">
<label for="bday">SELECT DATE :-</label>
					<select name="rat3">
						<option disabled="disabled">SELECT RATING DATE</option>
						<?php 
							$sql = "SELECT DISTINCT(`Rating_date`) FROM `ratings` ORDER by `Rating_date` DESC";
							$run=mysqli_query($conn,$sql);
							if($run)
							{
								while($row=mysqli_fetch_array($run))
								{
									$u_id=$row[0];
									$newDate = date("d-m-Y", strtotime($u_id));
										echo "<option value='$newDate'>" .$row[0]. "</option>";
									
									
							}
							}
							

						?>
					</select>
					<select name="rat4">
						<option disabled="disabled">SELECT RATING DATE</option>
						<?php 
							$sql = "SELECT DISTINCT(`Rating_date`) FROM `ratings` ORDER by `Rating_date` DESC";
							$run=mysqli_query($conn,$sql);
							if($run)
							{
								while($row=mysqli_fetch_array($run))
								{
									$u_id=$row[0];
									$newDate = date("d-m-Y", strtotime($u_id));
									
								echo "<option value='$newDate'>" .$row[0]. "</option>";
								
									
								 }
							}
							

						?>
					</select>
					<input type="submit" name="generate3">
</form></body></html>