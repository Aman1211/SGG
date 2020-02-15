<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script>
function msg(){
setTimeout(
function()
{
	
	document.body.style.backgroundImage="url('container2.jpg')";
},3500);
}
function msg1(){
setTimeout(
function()
{
	
	document.body.style.backgroundImage="url('cont.jpg')";
},3500);
}
function msg2(){
setTimeout(
function()
{
	
	document.body.style.backgroundImage="url('container.jpg')";
},3500);
}
</script>

<title> My First Website</title>
<style>
body{
	background:url("container.jpg");
	background-repeat:no-repeat;
	width:100%;
	height:100vh;
}
.form-container{
	border:0px solid #fff;
	padding:50px 60px;
	margin-top:20vh;
	-webkit-box-shadow: -1px 4px 26px 12px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 4px 26px 12px rgba(0,0,0,0.75);
box-shadow: -1px 4px 26px 12px rgba(0,0,0,0.75);
}
a{
	color:rgba(50,80,150);
}
a p{
	text-align:center;
	text-decoration:underline;
}

h1{
	font-weight:bold;
	text-align:center;
	text-decoration:underline;
}
*{
	font-weight:bold;
	}
</style>	
</head>
<body>
<div class="container-fluid bg">
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12"></div>
<div class="col-md-4 col-sm-4 col-xs-12">
<form class="form-container" action="register.php" method="POST">
<h1>SIGN UP </h1>
<a href="front.php"><p>Click here to go back</p></a><br/>
<div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" onfocus="msg()"placeholder="Username" required>
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" name="password"  placeholder="Password"  required>
  </div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="text" class="form-control" id="email" name="email"  placeholder="Email" onfocus="msg1()" required>
  </div>
  <div class="form-group">
    <label for="mob">Contact</label>
    <input type="text" class="form-control" id="mob" name="mob"  placeholder="Contact_no"  required>
  </div>
  <div class="form-group">
    <label for="fname">Firstname</label>
    <input type="text" class="form-control" id="fname" name="fname"  placeholder="Firstname"  required>
  </div>
  <div class="form-group">
    <label for="lname">Lastname</label>
    <input type="text" class="form-control" id="lname" name="lname"  placeholder="Lastname"  required>
  </div>
  <div class="form-group">
    <label for="add">Address</label><br>
    <textarea name="add" class="form-control" rows="5" cols="41" onfocus="msg2()"required></textarea>
  </div>
   <div class="form-group">
    <label for="city">Area:-</label>
    <select name="city">
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
  </div>

<button type="submit" class="btn btn-primary btn-block" name="submit">SIGN UP</button>
</div>
<div class="col-md-4 col-sm-4 col-xs-12"></div>
</form>
</div>
</div>
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
$result2=mysqli_query($conn,$query2)or die(mysql_error());
$row1=mysqli_fetch_row($result2);
$c_id=$row1[0];
$query="INSERT INTO login(USER_NAME,USER_PASSWORD,user_category_id,User_Email_id,USER_ADDRESS,contact_no,FirstName,LastName,Area_id)VALUES('$username',ENCODE('$password','secret'),2,'$email','$add',$contact,'$fname','$lname',$c_id)";
$data=mysqli_query($conn,$query) or die(mysql_error());
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
</body>
</html>