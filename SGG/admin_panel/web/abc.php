<html>
<head>

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<!--theme-style-->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />	
<!--//theme-style-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!--fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//fonts-->
<script src="js/jquery.min.js"></script>
<!--</hscript-->
</head>
<body>
	<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}
</style>
</head>
   
<div class="container">
  <h2>Multi-Level Dropdowns</h2>
  <p>In this example, we have created a .dropdown-submenu class for multi-level dropdowns (see style section above).</p>
  <p>Note that we have added jQuery to open the multi-level dropdown on click (see script section below).</p>                                        
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Tutorials
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
     <div class="custom-dropdown">
				<div class=" top-nav rsidebar span_1_of_left">
					<h3 class="cate">CATEGORIES</h3>
		 <ul class="menu">
		 	  <?php
include '../db.php';
$sql="Select * from category";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result))
{
    $cat_id=$row['Category_id'];
    $cat_name=$row['Category_name'];
    $sql2="select * from subcategory where Category_id='$cat_id'";
    $result2=mysqli_query($conn,$sql2);
    ?>

		<li class="item1"><a href="#"><?php echo $cat_name ?><img class="arrow-img" src="images/arrow1.png" alt=""/> </a>
			<ul class="cute">
			<?php 
			while($row2=mysqli_fetch_array($result2))
			{
				$sub=$row2['Subcategory_name'];
			?>
				<li class="subitem1"><a href="product.html"><?php echo $sub ?></a></li>
		
		
	
				<?php 
				}
				?>
			</ul>
				</li>
				<?php
			}
				?>		
		
					</div>
            </ul>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</div>




<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.container .menu > li > ul'),
			           menu_a  = $('.container .menu > li > a');
			    menu_ul.hide();
			    menu_a.mouseenter(function(e) {
			    	var aman=1;
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			           	menu_a.css("background","skyblue");
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
				
			});
		</script>
				</body>
				</html>