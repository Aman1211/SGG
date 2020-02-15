
<?php
session_start();
$count=0;
function check()
{
if(!isset($_SESSION['username']))
{
      header("Location:../login2.php");
}
}
check();
include "db.php";
$query="select max(Request_id) from request";
$execute=mysqli_query($conn,$query);
while($row=mysqli_fetch_array($execute))
{
	$max_id=$row[0];
}
$query1="select status from ststus";
$execute1=mysqli_query($conn,$query1);
while($row1=mysqli_fetch_array($execute1))
{
	$status=$row1[0];
}
if($status<$max_id)
{
	if($count<=1)
	{
		$query2="update ststus set status=$max_id";
$execute2=mysqli_query($conn,$query2);	
	 echo "<script>alert('New Request Has been Arrived')</script>";
	 $count=2;
        }
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

<meta http-equiv="Content-Type" content=="text/html; charset=utf-8">
<title>Admin</title>
<link rel="stylesheet" href="style.css" media="all"/>
<script type="text/javascript">
function admin_reg()
{
window.open("./reg.php", "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
function adjustHeight() {
    document.getElementById('left').style.height = document.defaultView.getComputedStyle(document.getElementById('right'), "").getPropertyValue("height");
}
</script>
</head>

<body>
<div class="wrapper">
<div class="header"></div>	
<div class="menu">
<div class="menu">
<a href="home.php"><h3>Home</h3></a>
<a href="#account"><h3>My Account</h3></a>
<a href="#" onclick="admin_reg();"><h3>New Admin</h3></a>
<a href="#admin"><h3>Signout</h3></a>
</div>
</div>
<div class="aman">
<div class="right">
<h1>Manage</h1>
<div class="dropdown">
  <button class="dropbtn"><h2>Users</h2></button>
  <div class="dropdown-content">
    <a href="?link=1" name="v_user"><h2>View Users</h2></a>
	</div>
	</div>
	<div class="dropdown">
	<button class="dropbtn"><h2>Area</h2></button>
  <div class="dropdown-content">
    <a href="?link=2" name="v_area"><h2>View Area</h2></a>
	<a href="?link=23"><h2>Add Area</h2></a>
  </div>
</div>
<div class="dropdown">
	<button class="dropbtn"><h2>City</h2></button>
  <div class="dropdown-content">
    <a href="?link=3"><h2>View City</h2></a>
	<a href="?link=25"><h2>Add City</h2></a>
  </div>
</div>
<div class="dropdown">
	<button class="dropbtn"><h2>Brand</h2></button>
  <div class="dropdown-content">
    <a href="?link=4"><h2>View Brand</h2></a>
	<a href="?link=22"><h2>Add Brand</h2></a>
  </div>
</div>
<div class="dropdown">
	<button class="dropbtn"><h2>Category</h2></button>
  <div class="dropdown-content">
    <a href="?link=5"><h2>View Category</h2></a>
	<a href="?link=24"><h2>Add Category</h2></a>
	<a href="?link=6"><h2>View Sub-Category</h2></a>
	<a href="?link=26"><h2>Add Sub-Category</h2></a>
  </div>
</div>

<div class="dropdown">
	<button class="dropbtn"><h2>Company</h2></button>
  <div class="dropdown-content">
    <a href="?link=7"><h2>View Company</h2></a>
	<a href="?link=28"><h2>Add Company</h2></a>
  </div>
  
</div>
<div class="dropdown">
	<button class="dropbtn"><h2>Purchase</h2></button>
  <div class="dropdown-content">
    <a href="?link=8"><h2>View Purchase</h2></a>
	<a href="?link=36"><h2>Add Purchase</h2></a>
	<a href="#"><h2>View Purchase Return</h2></a>
	<a href="#"><h2>Add Purchase Return</h2></a>
	<a href="#"><h2>View Purchase Payment</h2></a>
  </div>
  
</div>
<div class="dropdown">
	<button class="dropbtn"><h2>Supplier</h2></button>
  <div class="dropdown-content">
    <a href="?link=9"><h2>View Supplier</h2></a>
	<a href="?link=27"><h2>Add Supplier</h2></a>
  </div>
  </div>
  <div class="dropdown">
	<button class="dropbtn"><h2>Price_Size</h2></button>
  <div class="dropdown-content">
    <a href="?link=18"><h2>View Price_Size</h2></a>
	<a href="?link=19"><h2>Add Price_Size</h2></a>
  </div>
  </div>
  <div class="dropdown">
	<button class="dropbtn"><h2>Product</h2></button>
  <div class="dropdown-content">
    <a href="?link=12"><h2>View Product</h2></a>
	 <a href="?link=42"><h2>View Product Image</h2></a>
	<a href="?link=30"><h2>Add Product</h2></a>
	<a href="?link=31"><h2>Add Product_Image</h2></a>
  </div>
  </div>
    <div class="dropdown">
	<button class="dropbtn"><h2>Design</h2></button>
  <div class="dropdown-content">
    <a href="?link=17"><h2>View Design</h2></a>
	<a href="?link=29"><h2>Add Design</h2></a>
  </div>
  </div>
   <div class="dropdown">
	<button class="dropbtn"><h2>Requirements</h2></button>
  <div class="dropdown-content">
    <a href="?link=13"><h2>View Requirements</h2></a>
  </div>
  </div>
  <div class="dropdown">
	<button class="dropbtn"><h2>Labour</h2></button>
  <div class="dropdown-content">
    <a href="?link=10"><h2>View Labour</h2></a>
	  <a href="?link=21"><h2>Add Labour</h2></a>
	    <a href="?link=11"><h2>View Labour_Type</h2></a>
	<a href="?link=20"><h2>Add Labour_Type</h2></a>
  </div>
  </div>
   <div class="dropdown">
	<button class="dropbtn"><h2>Sales</h2></button>
  <div class="dropdown-content">
    <a href="?link=33"><h2>View Sales</h2></a>
	<a href="?link=34"><h2>View Sales Payment</h2></a>
	 <a href="?link=35"><h2>View Sales Labour</h2></a>
  </div>
  </div>
   <div class="dropdown">
	<button class="dropbtn"><h2>Quotation</h2></button>
  <div class="dropdown-content">
    <a href="#"><h2>Generate Quotation</h2></a>
  </div>
  </div>
   <div class="dropdown">
	<button class="dropbtn"><h2>RFC</h2></button>
  <div class="dropdown-content">
    <a href="?link=14"><h2>View Rating</h2></a>
	 <a href="?link=15"><h2>View Feedback</h2></a>
	  <a href="?link=16"><h2>View Complain</h2></a>
  </div>
  </div>
     <div class="dropdown">
	<button class="dropbtn"><h2>REPORTS</h2></button>
  <div class="dropdown-content">
    <a href="?link=14"><h2>REPORT1</h2></a>
	 <a href="?link=15"><h2>REPORT2</h2></a>
	  <a href="?link=16"><h2>REPORT3</h2></a>
  </div>
  </div>
   </div>
<div class="left" background="rgba(255,255,255,.5)">

<?php
include 'db.php';
if(isset($_GET['link'])){
$link=$_GET['link'];
$_SESSION['link']=$link;
if($link=='1'){
	include 'view/view_user.php';
}
elseif($link=='2'){
	include 'view/view_area.php';
}
elseif($link=='3')
{
	include 'view/view_city.php';
}
elseif($link=='4')
{
	include 'view/view_brand.php';
}
elseif($link=='5')
{
	include 'view/view_category.php';
}
elseif($link=='6')
{
    include 'view/view_subcategory.php';
}
elseif($link=='7')
{
	include 'view/view_company.php';
}
elseif($link=='8')
{
	include 'view/view_purchase.php';
}
elseif($link=='9')
{
	include 'view/view_supplier.php';
}
elseif($link=='10')
{
	include 'view/view_labour.php';
}
elseif($link=='11')
{
	include 'view/view_labour_type.php';
}
elseif($link=='12')
{
	include 'view/view_product.php';
}
elseif($link=='13')
{
	include 'view/view_requirement.php';
}

elseif($link=='14')
{
	include 'view/view_rating.php';
}

elseif($link=='15')
{
	include 'view/view_feedback.php';
}

elseif($link=='16')
{
	include 'view/view_complain.php';
}
elseif($link=='17')
{
	include 'view/view_design.php';
}
elseif($link=='18')
{
	include 'view/view_price_size.php';
	
}
elseif($link=='19')
{
	include 'add/add_price_size.php';
	
}
elseif($link=='20')
{
	include 'add/add_labour_type.php';
	
}
elseif($link=='21')
{
		include 'add/add_labour.php';
}
elseif($link=='22')
{
	
	include 'add/add_brand.php';
}
elseif($link=='23')
{
	include 'add/add_area.php';
}
elseif($link=='24')
{
	include 'add/add_category.php';
}
elseif($link=='25')
{
	include 'add/add_city.php';
}
elseif($link=='26')
{
	include 'add/add_subcategory.php';
}
elseif($link=='27')
{
	include 'add/add_supplier.php';
}
elseif($link=='28')
{
	include 'add/add_company.php';
	
}
elseif($link=='29')
{
	include 'add/add_design.php';
	
}
elseif($link=='30')
{
	include 'add/add_product.php';
}
elseif($link=='31')
{
	include 'add/add_image.php';
}
elseif($link=='32')
{
	include 'view/edit_company.php';
}
elseif($link=='33')
{
	include 'view/view_sales.php';
}
elseif($link=='34')
{
	include 'view/view_sales_payment.php';
}
elseif($link=='35')
{
	include 'view/view_sales_labour.php';
}	
elseif($link=='36')
{
	include 'add/add_purchase.php';
}	
elseif($link=='37')
{
	include 'view/edit_design.php';
}	
elseif($link=='38')
{
	include 'view/edit_labour.php';
}	
elseif($link=='39')
{
	include 'view/edit_price_size.php';
}	
elseif($link=='40')
{
	include 'view/edit_supplier.php';
}	
elseif($link=='41')
{
	include 'add/add_pur_pro.php';
}
elseif($link=='42')
{
	include 'view/view_product_image.php';
}	
elseif($link=='43')
{
	include 'view/edit_product.php';
}	
elseif($link=='44')
{
	
}						
}
?>
</div>

</div>
</div>
</body>
</html>

