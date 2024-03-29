<?php
include "./db.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>

<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<style>
a, a:hover
{
	text-decoration: none;
	-webkit-font-smoothing: antialiased;
	-webkit-text-shadow: rgba(0,0,0,.01) 0 0 1px;
	text-shadow: rgba(0,0,0,.01) 0 0 1px;
}
.standard_dropdown li
{
	display: inline-block;
	position: relative;
	height: 56px;
}
.standard_dropdown li li
{
	display: block;
	width: 100%;
}
.standard_dropdown li li a
{
	display: block;
	width: 100%;
	border-bottom: solid 1px #f2f2f2;
	font-size: 16px;
}
.standard_dropdown li:last-child a
{
	border-bottom: none;
}
.standard_dropdown li.hassubs > a i
{
	display: inline-block;
	margin-left: 5px;
}
.standard_dropdown li a
{
	display: block;
	position: relative;
	font-size: 16px;
	font-weight: 300;
	color: #000000;
	line-height: 56px;
	white-space: nowrap;
	-webkit-transition: all 200ms ease;
	-moz-transition: all 200ms ease;
	-ms-transition: all 200ms ease;
	-o-transition: all 200ms ease;
	transition: all 200ms ease;
}
.standard_dropdown li a:hover
{
	color: #0e8ce4;
}
.standard_dropdown li a i
{
	display: none;
	-webkit-transform: translateY(-1px);
	-moz-transform: translateY(-1px);
	-ms-transform: translateY(-1px);
	-o-transform: translateY(-1px);
	transform: translateY(-1px);
	font-size: 12px;
}
.standard_dropdown li ul
{
	display: block;
	position: absolute;
	top: 120%;
	left: 0;
	width: auto;
	visibility: hidden;
	opacity: 0;
	background: #FFFFFF;
	box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
	-webkit-transition: opacity 0.3s ease;
	-moz-transition: opacity 0.3s ease;
	-ms-transition: opacity 0.3s ease;
	-o-transition: opacity 0.3s ease;
	transition: all 0.3s ease;
	z-index: 1;
}
.standard_dropdown li:hover > ul
{
	top: 100%;
	visibility: visible;
	opacity: 1;
}
.standard_dropdown ul ul
{
	left: 100%;
	top: 0 !important;
}

.main_nav_dropdown li
{
	margin-right: 35px;
}

</style>
</head>

<body>
	<div style="position: fixed">
		<ul class="standard_dropdown main_nav_dropdown">
			<li><a href="#">Home<i class="fas fa-chevron-down"></i></a></li>
			<li class="hassubs">
					<a href="#">Categories<i class="fas fa-chevron-down"></i></a>
					<ul>
						
							<?php 

							$query="select * from category";
							$result=mysqli_query($conn,$query);
							while($row=mysqli_Fetch_array($result))
							{
									echo "<li class='hassubs'> <a href='#''>".$row['Category_name']."<i class='fas fa-chevron-right'></i></a><ul>";
									$cat=$row['Category_id'];
									$query1="select * from  subcategory where Category_id='$cat'";
									$result1=mysqli_query($conn,$query1);
									while($row1=mysqli_fetch_Array($result1))
									{
									echo "
									
								<li><a href='#''>".$row1['Subcategory_name']."<i class='fas fa-chevron-right'></i></a></li>
								
					
						";
							}
							echo " </ul></li>";
							}
							?>
							
						
					</ul>
				</li>
			<li class="hassubs">
				<a href="#">Menu Item2<i class="fas fa-chevron-down"></i></a>
				<ul>
						<li class="hassubs">
							<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
							<ul>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
							</ul>
						</li>
						<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
						<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
						<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
					</ul>
			</li>
			<li class="hassubs">
				<a href="#">Menu Item3<i class="fas fa-chevron-down"></i></a>
				<ul>
						<li class="hassubs">
							<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
							<ul>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
							</ul>
						</li>
						<li class="hassubs">
							<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
							<ul>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
							</ul>
						</li>
						<li class="hassubs">
							<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
							<ul>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
							</ul>
						</li>
						<li class="hassubs">
							<a href="#">Menu Item<i class="fas fa-chevron-right"></i></a>
							<ul>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
								<li><a href="#">Menu Item<i class="fas fa-chevron-right"></i></a></li>
							</ul>
						</li>
					</ul>
			</li>
			
			
		</ul>
	</div>
</body>

</html>