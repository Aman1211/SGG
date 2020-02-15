
<?php
include "header.php"
?>
<form action="search.php" method="POST">
	<input type="text" name="search" placeholder="Search">
	<button type="submit" name="submit">Search</button>
	</form>
<h1>Front Page</h1>
<h2>All Articles</h2>
<div class="container">
<?php	
		$sql="select * from search";
		$result=mysqli_query($conn,$sql);
		$queryresult=mysqli_num_rows($result);
		if($queryresult > 0){
			while($row=mysqli_fetch_assoc($result)){
				echo "<div>
					<h3>".$row['Book_id']."</h3>
					<h3>".$row['Book_name']."</h3>
					<h3>".$row['Author_name']."</h3>
					<p>".$row['Description']."</p>	
					<image src=".$row['image']."></image>
					</div>";
			}
		}
		?>
		</div>
	
</body>
</html>
             