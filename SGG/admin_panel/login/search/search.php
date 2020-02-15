<?php
include "header.php"
?>
<h1>Search Page</h1>
<div class="container">
<?php
if(isset($_POST['submit'])){
	$search=mysqli_real_escape_string($conn,$_POST['search']);
	$sql= "select * from search WHERE Description like'%$search%' or book_name like '%$search%' or Author_name like '%$search%'";
	$result=mysqli_query($conn,$sql);
	$queryresult=mysqli_num_rows($result);
	echo "There are $queryresult results";
	if($queryresult>0){
		while($row=mysqli_fetch_assoc($result)){
					echo "<div>
				    <h3>".$row['Book_id']."</h3>
					<h3>".$row['Book_name']."</h3>
					<h3>".$row['Author_name']."</h3>
					<p>".$row['Description']."</p>
					<image src=".$row['image']." height=100 width=100/>
					</div>";
		}
	}else{
		echo "There are no results matching your result";
	}
}

	?>
	
</div>

</body>
