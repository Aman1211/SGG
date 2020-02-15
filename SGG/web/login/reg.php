<?php

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
    <link href="./vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="./vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="./vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="./vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="./vendor/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST" action="">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="username" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                 
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" name="email"
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="number" placeholder="Contact" name="mob" >
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
                            <input class="input--style-3" type="text" placeholder="Enter Your Nickname" name="ans" required>
                        </div>
						 <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
    <select name="city">
	  <option disabled="disabled" selected="selected">Area</option>
<?php
session_start();
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
                            <button class="btn btn--pill btn--green" type="submit" name="cancel" onClick="document.location.href='../index.php';" >Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="./vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="./vendor/select2/select2.min.js"></script>
    <script src="./vendor/datepicker/moment.min.js"></script>
    <script src="./vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="./vendor/js/global.js"></script>
<?php

try{
if(isset($_POST['submit'])){
    $email1=$_POST['email'];

    $area=$_POST['city'];
        $_SESSION['mail']=$_POST['email'];
        $_SESSION['con']=$_POST['mob'];
        $_SESSION['uname']=$_POST['username'];
        $_SESSION['pass']=$_POST['password'];
        $_SESSION['add']=$_POST['add'];
        $_SESSION['fname']=$_POST['fname'];
        $_SESSION['lname']=$_POST['lname'];
        $_SESSION['ans']=$_POST['ans'];
        $_SESSION['area']=$_POST['city'];
        $otp=rand(100000,999999);
        $_SESSION['otp']=$otp;
$to="$email1";
    $subject="One Time Password";
    $message="Your One Time Password for Registration is:-".$otp;
    $header='From:SGG'; 
    mail($to,$subject,$message,$header);
        echo "<script> location.href='validate.php' </script>";
}
}
catch(Exception $e){}
?>
</html>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->