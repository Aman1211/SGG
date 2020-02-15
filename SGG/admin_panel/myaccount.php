<?php 
session_start();
$u=$_SESSION['username'];
if(!isset($_SESSION['username']))
{
	header("location:../login2.php");
}
?>

<head>
<script type="text/javascript">
function admin_del()
{
window.open("../front.php", "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}
function admin_rec()
{
window.open("./forgot.php", "_self", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400");
}

</script>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <!-- Title Page-->
    <title>Account Info</title>

    <!-- Icons font CSS-->
    <link href="login/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="login/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="login/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="login/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="login/main.css" rel="stylesheet" media="all">
</head>

<body>
<?php
include 'db.php';
$name=$_SESSION['username'];
$my_acc="select * from login where USER_NAME like '$name'";
$my_query=mysqli_query($conn,$my_acc);
while($my_row=mysqli_fetch_array($my_query))
{
		$uname=$my_row['USER_NAME'];
		$email=$my_row['User_Email_id'];
		$contact=$my_row['contact_no'];
		$fname=$my_row['FirstName'];
		$lname=$my_row['LastName'];
		$add=$my_row['USER_ADDRESS'];
		$area=$my_row['Area_id'];
		}
	$my_acc1="select * from area where Area_id=$area";
$my_query1=mysqli_query($conn,$my_acc1);
while($my_row1=mysqli_fetch_array($my_query1))
{
		$area_name=$my_row1['Area_name'];
}
$my_acc2="select * from city  where City_id IN (select city_id from area where Area_id=$area)";
$my_query2=mysqli_query($conn,$my_acc2);
while($my_row2=mysqli_fetch_array($my_query2))
{
		$city_name=$my_row2['City_name'];
}
?>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Account Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="username" value="<?php	echo "$uname"?>">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Email" name="Email" value="<?php	echo "$email"?>">
                 
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Contact" name="mob" value="<?php	echo "$contact"?>">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Firstname" name="fname" value="<?php	echo "$fname"?>">
                        </div>
						<div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Lastname" name="lname" value="<?php	echo "$lname"?>">
                        </div>
						<div class="input-group">
						 <textarea name="add" class="input--style-3" rows="5" cols="25" onfocus="msg2()"required placeholder="Address"><?php	echo "$add"?></textarea>
						 </div>
						
<div class="input-group">
                            <input class="input--style-3" type="text" value="<?php echo "$area_name"?>" name="Area" Placeholder="Area_Name">
							
                        </div>
						<div class="input-group">
                            <input class="input--style-3" type="text" value="<?php echo "$city_name"?>" name="city" Placeholder="City_Name">
							
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="Update">Update</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="delete" >Delete</button>
                        </div>
						    
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="change" >change_password
							</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		</div>

    <!-- Jquery JS-->
    <script src="login/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="login/vendor/select2/select2.min.js"></script>
    <script src="login/vendor/datepicker/moment.min.js"></script>
    <script src="login/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="login/js/global.js"></script>
<?php
include 'db.php';
$name1=$_SESSION['username'];
try{
	if(isset($_POST['Update']))
	{
		$uname1=$_POST['username'];
		$email1=$_POST['Email'];
		$contact1=$_POST['mob'];
		$fname1=$_POST['fname'];
		$lname1=$_POST['lname'];
		$add1=$_POST['add'];
		$area=$_POST['Area'];
		$my_acc4="select * from area where Area_name like '$area'";
$my_query4=mysqli_query($conn,$my_acc4);
while($my_row4=mysqli_fetch_array($my_query4))
{
		$area_id=$my_row4['Area_id'];
}
$update="UPDATE login	
SET USER_NAME = '$uname1',
User_Email_id = '$email1',
contact_no = '$contact1',
FirstName = '$fname1',
LastName = '$lname1',
Area_id = '$area_id'
WHERE USER_NAME like '$name1'";
	   $update_result=mysqli_query($conn,$update);
	   
	
	}
	if(isset($_POST['delete']))
	{
		$delete="delete from login where USER_NAME like '$name1'";
		$delete_result=mysqli_query($conn,$delete);
		session_destroy();
		echo " <script> admin_del(); </script> ";
	}
	if(isset($_POST['change']))
	{
		echo "<script> admin_rec(); </script>";
	}
}
catch(Exception $e){}
?>
</html>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>

