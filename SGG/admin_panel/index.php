<!DOCTYPE html>
<?php
session_start();

$count=0;
function check()
{
if(!isset($_SESSION['username']))
{

      header("Location:../login/login2.php");
}
elseif($_SESSION['typeid']==2)
{
    header("Location:../login/login2.php");
}
}
check();
 // update last activity time
include "db.php";
$sql="select * from request";
$rex=mysqli_query($conn,$sql);
while($fex=mysqli_fetch_array($rex))
{
  $j=$fex['Request_id'];
  $ad=$fex['Site_address'];
  if($ad=='')
  {

    $q="delete  from customer_requirement where Customer_req_id='$j'";
    $gaya=mysqli_query($conn,$q); 
    if($gaya){

    $z="delete  from request where Request_id='$j'";
    mysqli_query($conn,$z); 
     }
    }
}

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
	
	 $count=2;
        }
}

$v="";$rp="";
              $sqlkamlesh = "SELECT COUNT(*) FROM `complain` WHERE `status` = 0";
              $run=mysqli_query($conn,$sqlkamlesh);
              if($run)
              {
                while($r=mysqli_fetch_array($run))
                {
                  $v=$r[0];
                }
              }
              $sqlrequest = "SELECT COUNT(*) FROM `request` WHERE `status`=0";
              $re=mysqli_query($conn,$sqlrequest);
              if($re)
              {
                while ($reo=mysqli_fetch_array($re)) {
                  $rp=$reo[0];
                }
              }
?>


  <head>
<style>


.notification {
  background-color: #555;
  color: white;
  text-decoration: none;
  padding: 15px 35px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
  margin-right:50px;
}

.notification:hover {
  background:rgba(0,0,0,.5);
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}
.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -60px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
  <script>

function admin_reg()
{
window.open("./reg.php", "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
</script>
<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SGG Admin - Dashboard</title>
    <link rel="icon" href="image/SGG.ICO">

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">
    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
 <a class="navbar-brand" href="#">
          <img src="sgg_symbol.jpg" width="100" height="70" alt="">
        </a>
      <a class="navbar-brand mr-1" href="index.php">SGG ADMINISTRATOR</a>
	
      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          
          <div class="input-group-append">
          
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        
        <li class="nav-item dropdown no-arrow mx-1">
         
         <?php if($count==2){?>


        </li><a href="./index.php?link=29" class="notification" data-toggle="tooltip" title="New Requests Has Been Arrived Click Here To See!">
  <span>New Requests</span>
  <span class="badge">1</span>
</a>
<?php }
else
{
  ?>
   </li><a href="./index.php?link=29" class="notification" data-toggle="tooltip" title="No New Requests!">
  <span>New Requests</span>
  <span class="badge"><?php echo $count ?></span>
</a>
<?php } ?>

          

        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../login/myaccount.php">My Account</a>
            <a class="dropdown-item" href="#" onclick="admin_reg()">New Admin</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="javascript:if(confirm('Are you sure you want to do Logout?')) {location.href='../login/logout.php'}">Logout</a>
          
          </div>
        </li>
      </ul>

    </nav> 

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-user"></i>
            <span>USERS</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=3">View Users</a>
            </div>
          
        </li>
       <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>AREA</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=1">View Area</a>
            <a class="dropdown-item" href="?link=2">Add Area</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>CITY</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=4">View City</a>
            <a class="dropdown-item" href="?link=5">Add City</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>BRAND</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=6">View Brand</a>
            <a class="dropdown-item" href="?link=7">Add Brand</a>
            </div>
          
        </li>
			<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-list"></i>
            <span>CATEGORY</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=8">View Category</a>
            <a class="dropdown-item" href="?link=9">Add Category</a>
			  <a class="dropdown-item" href="?link=11">View Sub-Category</a>
       <a class="dropdown-item" href="?link=10">Add Sub-Category</a>
			
            </div>
          
        </li>
		 	<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-city"></i>
            <span>COMPANY</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=12">View Company</a>
            <a class="dropdown-item" href="?link=13">Add Company</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-plus"></i>
            <span>PURCHASE</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=14">View Purchase</a>
            <a class="dropdown-item" href="?link=15">Add Purchase</a>
			 <a class="dropdown-item" href="?link=49">View Purchase Payment</a>
      
           
            </div>
          
        </li>
				<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-user"></i>
            <span>SUPPLIER</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=19">View Supplier</a>
            <a class="dropdown-item" href="?link=20">Add Supplier</a>
            </div>
          
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>PRICE_SIZE</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=21">View Price_Size</a>
            <a class="dropdown-item" href="?link=22">Add Price_Size</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>PRODUCT</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=23">View Product</a>
			<a class="dropdown-item" href="?link=47">Add Product</a>
            <a class="dropdown-item" href="?link=64">Add Product_Image</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-paint-brush"></i>
            <span>DESIGN</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=27">View Design</a>
            <a class="dropdown-item" href="?link=28">Add Design</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>REQUEST</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=29">View Request</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-user"></i>
            <span>LABOUR</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=30">View Labour</a>
            <a class="dropdown-item" href="?link=31">Add Labour</a>
			 <a class="dropdown-item" href="?link=32">View Labour Type</a>
            <a class="dropdown-item" href="?link=33">Add Labour Type</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-minus"></i>
            <span>SALES</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=34">View Sales</a>
          <!--  <a class="dropdown-item" href="?link=35">View Sales Payment</a>-->
			 <a class="dropdown-item" href="?link=36">View Sales Payments</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-star"></i>
            <span>RFC</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=37">View Rating</a>
            <a class="dropdown-item" href="?link=38">View Feedback</a>
			 <a class="dropdown-item" href="?link=39">View Complain</a>
            </div>
          
        </li>
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-clipboard"></i>
            <span>REPORTS</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="?link=50">LABOUR REPORT</a>
            <a class="dropdown-item" href="?link=70">FEEDBACK REPORTS</a>
			      <a class="dropdown-item" href="?link=71">RATING REPORTS</a>
            <a class="dropdown-item" href="?link=73">PRODUCT SUMMARY</a>
            <a class="dropdown-item" href="?link=74">AREA WISE CUSTOMER</a>
             <a class="dropdown-item" href="?link=75">SUPPLIER REPORT</a>
            </div>
          
        </li>
      </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <!-- Icon Cards-->
                  <!-- Area Chart Example-->
          
          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              DATA</div>
            <div class="card-body">
              <div class="table-responsive">
			  <?php
							$link="";
						if(isset($_GET['link']))
						{
								$link=$_GET['link'];
								$_SESSION['link']=$link;
						}
             if($link=='')
            {
              ?>
              <a href="index.php?link=29">
               <DIV style="width: 200px;margin-left: 50px;color:white;background-color: rgba(0,0,0,0.5);">
              
              <img src="../image/chura.png" height="50" width="50" style="margin-left: 70px">
              
              <center>NO OF<br/> REQUEST PENDING</center>
               <CENTER> <SPAN style="color:red;background-color: white"><?php echo $rp;?></SPAN></CENTER>
</DIV>
</a>
<a href="index.php?link=39">
<DIV style="width: 200px;margin-left:350px;margin-top: -120px;color:white;background-color: rgba(0,0,0,0.5);">
              <img src="../image/com.jpg" height="50" width="50" style="margin-left: 70px">
              
              <center>NO OF COMPLAIN PENDING </center>
               <CENTER> <SPAN style="color:red;background-color: white"><?php echo $v;?></SPAN></CENTER>
</DIV></a>
              <?php
            }
						if($link=='1')
						{
						    include 'view/view_area.php';	
						}
					else if($link=='2')
{
					include 'add/add_area.php';
}
else if($link=='3')
{
					include 'view/view_user.php';
}
	else if($link=='4')
{
					include 'view/view_city.php';
}
else if($link=='5')
{
					include 'add/add_city.php';
}
else if($link=='6')
{
					include 'view/view_brand.php';
}
else if($link=='7')
{
					include 'add/add_brand.php';
}
else if($link=='8')
{
					include 'view/view_category.php';
}
else if($link=='9')
{
					include 'add/add_category.php';
}
else if($link=='10')
{
					include 'add/add_subcategory.php';
}
else if($link=='11')
{
					include 'view/view_subcategory.php';
}
else if($link=='12')
{
					include 'view/view_company.php';
}
else if($link=='13')
{
					include 'add/add_company.php';
}
else if($link=='14')
{
					include 'view/view_purchase.php';
}else if($link=='15')
{
					include 'add/add_purchase.php';
}else if($link=='16')
{
					include 'view/view_purchase_return.php';
}else if($link=='53')
{
					include 'add/add_purchase_return.php';
}else if($link=='18')
{
					include 'view/view_purchase_payment.php';
}
else if($link=='19')
{
					include 'view/view_supplier.php';
}else if($link=='20')
{
					include 'add/add_supplier.php';
}					
else if($link=='21')
{
					include 'view/view_price_size.php';
}
else if($link=='22')
{
					include 'add/add_price_size.php';
}
else if($link=='23')
{
					include 'view/view_product.php';
}
else if($link=='24')
{
					include 'view/view_product_image.php';
}
else if($link=='25')
{
					include 'add/add_pur_pro.php';
}
else if($link=='26')
{
					include 'add/add_image.php';
}
else if($link=='27')
{
					include 'view/view_design.php';
}
else if($link=='28')
{
					include 'add/add_design.php';
}
else if($link=='29')
{
					include 'view/view_request.php';
}
else if($link=='30')
{
					include 'view/view_labour.php';
}
else if($link=='31')
{
					include 'add/add_labour.php';
}
else if($link=='32')
{
					include 'view/view_labour_type.php';
}
else if($link=='33')
{
					include 'add/add_labour_type.php';
}
else if($link=='34')
{
					include 'view/view_sales.php';
}
else if($link=='35')
{
					include 'view/view_sales_payment.php';
}
else if($link=='36')
{
					include 'view/view_sales_payments_all.php';
}

else if($link=='37')
{
					include 'view/view_rating.php';
}

else if($link=='38')
{
					include 'view/view_feedback.php';
}

else if($link=='39')
{
					include 'view/view_complain.php';
}

else if($link=='40')
{
					include 'view/view_sales_labour.php';
}

else if($link=='41')
{
					include 'view/edit_company.php';
}

else if($link=='42')
{
				include 'view/edit_design.php';
}
else if($link=='43')
{
				include 'view/edit_labour.php';
}
else if($link=='44')
{
				include 'view/edit_price_size.php';
}


else if($link=='45')
{
				include 'view/edit_product.php';
}
else if($link=='46')
{
				include 'view/edit_supplier.php';
}
elseif ($link=='47')
{
	include 'add/add_product.php';
}
else if($link=='48')
{
				include 'view/view_purchase_return.php';
}

else if($link=='49')
{
				include 'view/view_purchase_payment.php';
}
else if($link=='50')
{
				include 'view/labour_report.php';
}
else if($link=='51')
{
				include 'view/view_requirement.php';
}
else if($link=='52')
{
				include 'view/view_purchase_detail.php';
}

elseif($link=='54')

{
	include 'add/add_pur_ret_detail.php';
}
elseif($link=='55')

{
  include 'view/view_pur_ret.php';
}
elseif($link=='56')

{
  include 'view/edit_area.php';
}
elseif($link=='57')

{
  include 'view/edit_brand.php';
}
elseif($link=='58')

{
  include 'view/edit_category.php';
}
elseif($link=='59')

{
  include 'add/add_purchase_payment.php';
}
elseif($link=='60')

{
  include 'view/edit_city.php';
}
elseif($link=='61')

{
  include 'view/edit_subcategory.php';
}
elseif($link=='62')

{
  include 'add/adddetail.php';
}
elseif($link=='63')
{
  include 'view/edit_labour_type.php';
}
elseif($link=='64')
{
  include 'add/add_image1.php';
}
elseif ($link=='65') {
  include 'view/view_sales_details.php';
  # code...
}
elseif ($link=='66'){
  include 'view/view_lab_requirement.php';
}
elseif($link=='67'){
  include 'add/add_sales_payment.php';
}
elseif($link=='68')
{
  include 'view/view_manage_labour.php';
}
elseif($link=='69')
{
  include 'view/view_purchase_payment_sup.php';
}
elseif($link=='70')
{
  include 'view/feeback_reports.php';
}
elseif($link=='71')
{
  include 'view/rating_reports.php';
}
elseif($link=='72')
{
  include 'view/edit_complain.php';
}
elseif($link=='73')
{
  include 'view/view_product_suumery.php';
}

elseif($link=='74')
{
  include 'view/area_wise_customer.php';
}
elseif($link=='75')
{
  include 'view/Supplier.php';
}



		
			  ?>
                
              </div>
            </div>
            <div class="card-footer small text-muted">SHREE GURUKRUPA GLASS TRADERS</div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © SHREE GURUKRUPA GLASS TRADERS</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="js/demo/datatables-demo.js"></script>
    <script src="js/demo/chart-area-demo.js"></script>

  </body>

</html>
