
<html>
<body>
	<form method="post">
<label for="bday">SELECT DATE :-</label>
					<select name="sdate">
						<option disabled="disabled" >SELECT FEDDBACK DATE</option>
						<?php 
						include './db.php';
							$sql = "SELECT DISTINCT(`Feedback_date`) FROM `feedback` ORDER BY `Feedback_date` DESC";
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
					<select name="edate">
						<option disabled="disabled" >SELECT FEDDBACK DATE</option>
						<?php 
							$sql = "SELECT DISTINCT(`Feedback_date`) FROM `feedback` ORDER BY `Feedback_date` DESC";
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
					<input type="submit" name="aub">
				</form>
			</body>
			</html>