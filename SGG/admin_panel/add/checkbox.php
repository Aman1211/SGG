<?php
include '../db.php';
?>
<html>
<body>
<form method="post">
	<?php
$query="select * from cbox";
$res=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($res))
{
$var=$row['Name'];
	?>
	<input type="checkbox" name="aman[]" value='<?php echo $var; ?>' >
	<label> <?php echo $var; ?></label><br>


<?php  
}
?>
<input type="submit" name="submit" value="submit"> 
<?php
if(isset($_POST['submit']))
if(isset($_POST['aman']))
{
	foreach($_POST['aman'] as $selected)
	{
		$query1="update cbox set status=1 where Name='$selected'";
		$res1=mysqli_query($conn,$query1);
			echo "<script> alert('Completed'); </script>";
	}
}
?>
</form>
</body>
</html>
