<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,intial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
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
}
button{
	background:rgba(50,80,150,.5);
	width:auto;
	height:auto;
	padding:18px 25px;
	margin:8px 0;
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

<script>
function msg(){
setTimeout(
function()
{
	
	document.body.style.backgroundImage="url('container2.jpg')";
},3500);
}
function msg2(){
setTimeout(
function()
{
	
	document.body.style.backgroundImage="url('cont.jpg')";
},3500);
}
</script>
</head>
<body>
<div class="container-fluid bg">
<div class="row">
<div class="col-md-4 col-sm-4 col-xs-12"></div>
<div class="col-md-4 col-sm-4 col-xs-12">
<form class="form-container" action="login1.php" method="post">
<h1> Login Form </h1>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1"" name="uname" onfocus="msg()"placeholder="Username" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="psw"  placeholder="Password" onfocus="msg2()" required>
  </div>
  <button type="submit" class="btn btn-primary btn-block" >Submit</button>
  <button type="button" class="btn btn-primary btn-block">Cancel</button><br>
  <a href="forgot.php" ><p>Forgot password?</p></a>

 </form>
 </div>
 <div class="col-md-4 col-sm-4 col-xs-12"></div>
 </div>
 </div>
 
<?php 
	if(isset($_POST['submit'])){
		session_start();
		$_SESSION['username']=$_POST['uname'];
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
	header("location:admin.php");
}
else if($row[0]==2)
{
	header("location:search/index.php");
}
else
{
echo "<script type='text/javascript'>alert('Invalid username or password!')</script>";
}
}			
?>

</body>
</html>