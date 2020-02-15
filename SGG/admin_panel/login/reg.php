<?php
session_start();
$u=$_SESSION['username'];
?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">


    <!-- Title Page-->
    <title>Registration</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="username">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password">
                 
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Email" name="email"
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Contact" name="mob">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Firstname" name="fname">
                        </div>
						<div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Lastname" name="lname">
                        </div>
						<div class="input-group">
						 <textarea name="add" class="input--style-3" rows="5" cols="25" onfocus="msg2()"required placeholder="Address" ></textarea>
						 </div>
						 <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
    <select name="city">
	  <option disabled="disabled" selected="selected">Area</option>
<?php
$host ="localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
$query="select Area_name from area";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Area_name"];
	echo "<option value='$var'>".$row["Area_name"]."</option>";
}	
?>
</select>
<div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="cancel" onClick="document.location.href='front.php';" >Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>
<?php

try{
if(isset($_POST['submit'])){
	function val_email()
{
	$email1=$_POST['email'];
	if(!filter_var($email1, FILTER_VALIDATE_EMAIL)) { 
	 echo "<script type='text/javascript'>alert('Invalid Email')</script>";
	}
	else
	{
		return 1;
	}	
}
function val_con()
{
	$contact1=$_POST['mob'];
	if(is_numeric($contact1) and strlen($contact1)<=10 and strlen($contact1)>=8)
	{
		return 1;
}
else{
	 echo "<script type='text/javascript'>alert('Invalid contact number')</script>";
}
}
	$num1=val_email();
	$num2=val_con();
	if($num1==1 and $num2==1)
	{
		$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
$username=$_POST['username'];
$password=$_POST['password'];
$email=$_POST['email'];
$contact=$_POST['mob'];
$add=$_POST['add'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
		
	$area=$_POST['city'];
$query2="select Area_id from area where Area_name='$area'";
$result2=mysqli_query($conn,$query2)or die(mysqli_error($conn));
$row1=mysqli_fetch_row($result2);
$c_id=$row1[0];
$q="select user_category_id from login where USER_NAME like '$u'";
$r=mysqli_query($conn,$q) or die(mysqli_error($conn));
$r1=mysqli_fetch_row($r);
$cat_id=$r1[0];
if($cat_id==1)
{
$query="INSERT INTO login(USER_NAME,USER_PASSWORD,user_category_id,User_Email_id,USER_ADDRESS,contact_no,FirstName,LastName,Area_id)VALUES('$username',ENCODE('$password','secret'),1,'$email','$add',$contact,'$fname','$lname',$c_id)";
$data=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
else
{
	$query="INSERT INTO login(USER_NAME,USER_PASSWORD,user_category_id,User_Email_id,USER_ADDRESS,contact_no,FirstName,LastName,Area_id)VALUES('$username',ENCODE('$password','secret'),2,'$email','$add',$contact,'$fname','$lname',$c_id)";
$data=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
if($data)
{
	$to="$email";
	$subject="SGG Conformation";
	$message="Thank you for Registration";
	$header='From:SGG'; 
	mail($to,$subject,$message,$header);
}
}
}
}
catch(Exception $e){}
?>
</html>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->