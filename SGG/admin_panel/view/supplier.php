<html>
<body>
	<form method="post">
<select name="rat1">
						<option disabled="disabled">SELECT SUPPLIER NAME</option>
					<?php 
									$sql1="SELECT `Supplier_name` FROM `supplier`";
									$run1=mysqli_query($conn,$sql1);
									if($run1)
									{
										while($row1=mysqli_fetch_array($run1))
										{
											$u_name=$row1[0];
									echo "<option value='$u_name'>" .$row1["Supplier_name"]. "</option>";
										
								 	}
									}
							
						
							

						?>
					</select>
					<input type="submit" name="generate" value="GENRATE"></form>
<?php 
if(isset($_POST['generate']))
{
	$var=$_POST['rat1'];
	echo "<script> window.open('./view/supp.php?id=$var',target='_blank'); </script>";
}
?>

				</body></html>
