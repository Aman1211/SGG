<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Login</title>
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
                    <h2 class="title">Login Info</h2>
                    <form method="POST">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Username" name="uname" id="user" required>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="password" placeholder="Password" name="psw" id="pwd" class="masked" style="width:210px" >

                            <button type="button" id="eye">
                                <img src="../image/eye.png" height="25" width="25" alt="eye"/>
                            </button>
               </div>
               
			   <div class="p-t-10">
                              <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green"  name="cancel" onclick="location.href='../web/index.php'">Cancel</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" name="forgot" onclick="location.href='./forgot.php'"
							>Forgot Password?</button> 
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green"  name="reg" onclick="location.href='./reg.php'"
                            >Registration</button>
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
	//if(isset($_POST['cancel'])){
	//	header("location:../web/index.php");
	//}

  //  if(isset($_POST['reg'])){
    //    header("location:reg.php");
    //}
//	if(isset($_POST['forgot'])){
	//	header("location:forgot.php");
	//}
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

	$check=1;
     $_SESSION['typeid']=1;  
    $_SESSION['username']=$_POST['uname'];
$_SESSION['password']=$_POST['psw'];
	header("location:../admin_panel/index.php");
	 
}
else if($row[0]==2)
{
	$check=1;
    $_SESSION['typeid']=2;
            
    $_SESSION['username']=$_POST['uname'];
$_SESSION['password']=$_POST['psw'];
	header("location:../web/index.php");
}
else if($check==0)
{
echo "<script type='text/javascript'>alert('Invalid username or password!')</script>";
}
}			
?>
<script type="text/javascript">
    function check(){
        var c=document.getElementById("user");
        if(c.value.length()==0)
        {
        c.setAttribute('placeholder','Username is Mandatory');
        c.focus();
    }
    }
    function show(){
        var p=document.getElementById('pwd');
        p.setAttribute('type','text');

    }
    function hide(){
        var p =document.getElementById('pwd');
        p.setAttribute('type','password');
    }
    document.getElementById("user").addEventListener("blur",function(){
                check();
    }
    var pwShown=0;
    document.getElementById("eye").addEventListener("click",function(){
        if(pwShown==0){
           pwShown=1;
           show(); 
        }else{
            pwShown=0;
            hide();
        }
    },false);
</script>
</body>
</html>