<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Login</title>

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
                    <h2 class="title">Login Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="uname">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="psw">
               </div>
			   <div class="p-t-10">
                              <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="cancel"
							>Cancel</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="forgot"
							>Forgot Password</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
	<?php 
	session_start();
    $_SESSION['count']=0;
    $_SESSION['r_id']=0;
	$check=0;
	if(isset($_POST['cancel'])){
		header("location:../index.php");
	}
	if(isset($_POST['forgot'])){
		header("location:forgot.php");
	}
	if(isset($_POST['submit'])){
		$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 

$username=$_POST['uname'];
$password=$_POST['psw'];
$query="SELECT user_category_id from login WHERE USER_NAME='$username' AND USER_PASSWORD=ENCODE('$password','secret')";
$result=mysqli_query($conn,$query);

if(!$result)
{
	echo "could not run query";
}

$row=mysqli_fetch_row($result);
if($row[0]==1)
{
    setcookie('user','$username');
	$check=1;

    $_SESSION['username']=$_POST['uname'];
$_SESSION['password']=$_POST['psw'];
	header("location:admin_panel\index.php");
	 
}
else if($row[0]==2)
{
	$check=1;
    $_SESSION['username']=$_POST['uname'];
$_SESSION['password']=$_POST['psw'];
	header("location:../index.php");
}
else if($check==0)
{
echo "<script type='text/javascript'>alert('Invalid username or password!')</script>";
}
}			
?>
</body>
</html>