<html>
<body>
<form method="post">
<label> Select Labour Name:-</label>
<select name="l_name" required>
						<option disabled="disabled">SELECT LABOUR NAME</option>
						<?php
						include './db.php'; 
						$u_name="";
							$sql = "SELECT DISTINCT(`Worker_name`) FROM `labour`";
							$run=mysqli_query($conn,$sql);
							if($run)
							{
								while($row=mysqli_fetch_array($run))
								{
									$u_name=$row[0];
																		
												echo "<option value='$u_name'>" .$row["Worker_name"]. "</option>";
								 	}
									}
							
						
							

						?>
					</select>

					<input type="submit" name="sub" value="GENRATE">


			

<!------------------------------------------------------------------------------------------------->
</form>
<?php 
if(isset($_POST['sub']))
{
	$var=$_POST['l_name'];
	echo "<script> window.open('./view/labour_report1.php?id=$var',target='_blank'); </script>";
}
?>

</body>
</html>