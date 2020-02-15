<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Questions</title>
<link rel="icon" href="../image/SGG.ICO">
    <!-- Icons font CSS-->
    <link href="./vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="./vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
  

    <!-- Main CSS-->
    <link href="./vendor/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Security Question</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Enter Your Nickname" name="uname">
                        </div>
						 <div class="p-t-10">
                              <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="cancel"
							>Cancel</button>
                        </div>


<?php
session_start();
$username=$_GET['user'];

if(isset($_POST['cancel']))
{
	header("location:../web/index.php");
}
if (isset($_POST['submit'])) 
{
    $ans=$_POST['uname'];
	$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
$query1="select  SEQURITY_ANSWER from login where USER_NAME='$username'";
$result1=mysqli_query($conn,$query1);
$row=mysqli_fetch_row($result1);
$num=mysqli_num_rows($result1);
if($ans==$row[0])
{
    $query2="select User_Email_id from login where USER_NAME='$username'";
$result2=mysqli_query($conn,$query2);
$row2=mysqli_fetch_row($result2);
$email=$row2[0];
$otp=rand(100000,999999);
$_SESSION['otp']=$otp;
$_SESSION['u']=$username;
$_SESSION['email']=$email;
$to="$email";
    $subject="One Time Password";
    $message="Your One Time Password is:-".$otp;
    $header='From:SGG'; 
    mail($to,$subject,$message,$header);
    header("location:recover.php");

}
else
{
		echo "<script type='text/javascript'>alert('Invalid Answer')</script>";
}
}
?>
</body>
</html>	


