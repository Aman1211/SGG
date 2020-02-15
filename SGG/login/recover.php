

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Password Recovery</title>
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
                    <h2 class="title">Password Recovery</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="OTP" name="otp">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder=" New Password" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
               </div>
			    <div class="input-group">
                            <input class="input--style-3" type="password" placeholder=" Re-enter Password" name="pass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
               </div>
			    <div class="p-t-10">
                              <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="cancel"
							>Cancel</button>
							
                        </div>	
</form>						
                </div>
            </div>
        </div>
    </div>

<?php
session_start();
if(isset($_POST['cancel']))
{
	 $var=$_SESSION['typeid'];
    if($var==2)
    {
    echo "<script> location.href='../web/index.php' </script>";
}
else
{
    echo "<script> location.href='../admin_panel/index.php' </script>";
}
}
if(isset($_POST['submit']))
{
	$otp1=$_POST['otp'];
	$re=$_POST['pass1'];
	if($_POST['pass']==$re)
	{
	if($_SESSION['otp']==$otp1)
	{
			$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
$password=$_POST['pass'];
$username=$_SESSION['u'];

$email=$_SESSION['email'];
$query="UPDATE login set USER_PASSWORD=ENCODE('$password','secret') where USER_NAME='$username'";
$result=mysqli_query($conn,$query);
if(!$result)
{
	echo "could not run query";
}
else
{
	$to="$email";
	$subject="SGG Password Recovery";
	$message="Password Has been Changed Successfully";
	$header='From:SGG'; 
	mail($to,$subject,$message,$header);
    $var=$_SESSION['typeid'];
    if($var==2)
    {
    echo "<script> location.href='../web/index.php' </script>";
}
else
{
    echo "<script> location.href='../admin_panel/index.php' </script>";
}
}
	}
	else
	{
		echo "<script type='text/javascript'>alert('Invalid OTP!')</script>";
	}
			
}
else
	{
		echo "<script type='text/javascript'>alert('Re-Enter Password')</script>";
	}
}
?>
</body>
</html>
	
		
