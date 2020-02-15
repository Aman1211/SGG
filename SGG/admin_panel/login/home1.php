<?php
include("conn.php");
?>
<html lang="en>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style/home.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<div class="w3-container">
<div class="w3-display-container">
<div class="w3-padding w3-display-top">
<div class="w3-panel">
    <h1>SHREE GURUKRUPA GLASS TRADERS </h1>
  </div>
</div>
<div class="w3-padding menubar">
<div class="dropdown">
  <button class="dropbtn">Menu</button>
  <div class="dropdown-content">
    <a href="#search">Home</a>
	<a href="#">Events</a>
    <a href="#">Gallery</a>
    <a href="#">About us</a>
  </div>
</div>
<button class="btn info">Sign up</button>
<button class="btn info">Sign in</button>
<div class="search-container">
    <form action="action_page.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>
</div>
<div class="sidebar">
 <a href="#">Category</a>
	<ul>
	<?php
	$get_cat="select * from category";
	$cat=mysqli_query($conn,$get_cat);
	while($rows=mysqli_fetch_array($cat)){
		$cat_id=$rows['Category_id'];
		$cat_name=$rows['Category_name'];
		
  echo"<li><a href='home1.php?cat=$cat_id'>$cat_name</a><li>";
	}
	?>
 </ul>
 <a href="#">Brand</a>
 <ul>
	<?php
	$get_brand="select * from brand";
	$brand=mysqli_query($conn,$get_brand);
	while($rows=mysqli_fetch_array($brand)){
		$brand_id=$rows['Brand_id'];
		$brand_name=$rows['Brand_name'];
		
  echo"<li><a href='home1.php?brand=$brand_id'>$brand_name</a><li>";
	}
	?>
 </ul>
</div>
<div class="content">
<section class="sec">
<img class="image" src="sgg.jpg">
<h3> SGG LOGO </h3><br>
<h2> 50rs</h3>
</section>
<section class="sec">
<img class="image" src="gif.gif">
</section>

</div>
</div>
</div>
</body>
</html>