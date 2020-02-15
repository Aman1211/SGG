<?php
session_start();

$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 

?>
<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Email Validation</title>
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
                    <h2 class="title">Email Validation</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="OTP" name="otp">
                        </div>
                        
			    <div class="p-t-10">
                              <button class="btn btn--pill btn--green" type="submit" name="abc">Submit</button>
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

if(isset($_POST['abc']))
{   
$sq=unserialize($_GET['array1']);
	$email1=$sq[0];
	$contact1=$sq[2];
$username=$sq[3];
$password=$sq[4];
$add=$sq[5];
$fname=$sq[6];
$lname=$sq[7];
$ans=$sq[8];
$otp=$sq[9];
	$area=$sq[1];
function val_con()
{
    $sq=unserialize($_GET['array1']);
	$contact=$sq[2];
	
	if(strlen($contact)<=10 and strlen($contact)>=8)
	{
		return 1;

}
else{

	 echo "<script type='text/javascript'>alert('Invalid contact number')</script>";
}
}

	$num2=val_con();
	if($num2==1)
	{

		$u="";
$query10="select * from login where USER_NAME='$username'";
$result10=mysqli_query($conn,$query10);
while($row10=mysqli_fetch_array($result10))
{
        $u=$row10['USER_NAME'];
}
if($username!=$u)
{
$query2="select Area_id from area where Area_name='$area'";
$result2=mysqli_query($conn,$query2)or die(mysqli_error($conn));
$row1=mysqli_fetch_row($result2);
$c_id=$row1[0];

        if($otp==$_POST['otp'])
        {
            $_SESSION['username']=$sq[3];
	$query="INSERT INTO login(USER_NAME,USER_PASSWORD,SEQURITY_ANSWER,user_category_id,User_Email_id,USER_ADDRESS,contact_no,FirstName,LastName,Area_id)VALUES('$username',ENCODE('$password','secret'),'$ans',2,'$email1','$add','$contact1','$fname','$lname','$c_id')";
$data=mysqli_query($conn,$query) or die(mysqli_error($conn));
}
else
{
	echo"<script> alert('Invalid Otp'); </script>";
}
if($data)
{
    
    $to="$email1";
    $subject="SGG Conformation";
    $message="Thank you for Registration";
    $header='Fr
    om:SGG'; 
    mail($to,$subject,$message,$header);
    echo "<script> location.href='../web/index.php';</script>";
}
}
else
{
    echo "<script> alert('Username Already Exists'); </script>";
}
}
}
if(isset($_POST['cancel']))
{
    echo "<script> location.href='../web/index.php';</script>";
    
}
?>
</body>
</html>
