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
<link rel="icon" href="../image/SGG.ICO">
    <!-- Icons font CSS-->
    <link href="../admin_panel/login/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../admin_panel/login/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../admin_panel/login//vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../admin_panel/login/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">


    <!-- Main CSS-->
    <link href="../admin_panel/login/main.css" rel="stylesheet" media="all">

    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#username').keyup(function(){
                var brand_check=$(this).val();
                $('#brand_check').html('<img src="loading.gif" width="150"/>');
                $.post("./check_username.php",{brand_name: brand_check},function(data)
                {
                    if(data.status == true)
                    {
                        $('#brand_check').parent('div').removeClass('has-error').addClass('has-success');
                    }   
                    else
                    {
                        $('#brand_check').parent('div').removeClass('has-success').addClass('has-error');
                    }
                    $('#brand_check').html(data.msg);
                },'json');
        });

    });

</script>
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
                            <input class="input--style-3" type="text" placeholder="Username" name="username" id="username" required>
                             <span id='brand_check' class="help-block" style="color:red"></span>
                            <!---JSON ON USERNAME--->
                            
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
    <select name="city" style="width:300px; background-color:black;height:25px; font-size:15px; font-weight: bold; color:white;">
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
<div class="select-dropdown" style="background-color:red;"></div>
                            </div>
                        </div>
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="submit">Submit</button>
                        </div>
						<div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit" name="cancel" onClick="document.location.href='../web/index.php';" >Cancel</button>
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
 
if(isset($_POST['submit'])){
    $aman=array();

    $aman[0]=$_POST['email'];
$email1=$_POST['email'];
    $aman[1]=$_POST['city'];
    
        $aman[2]=$_POST['mob'];
        $aman[3]=$_POST['username'];
        $aman[4]=$_POST['password'];
        $aman[5]=$_POST['add'];
        $aman[6]=$_POST['fname'];
        $aman[7]=$_POST['lname'];
        $aman[8]=$_POST['ans'];
    
        $otp=rand(100000,999999);
        $aman[9]=$otp;
        $urlPortion= '&array1='.urlencode(serialize($aman));
$to="$email1";
    $subject="One Time Password";
    $message="Your One Time Password for Registration is:-".$otp;
    $header='From:SGG'; 
    mail($to,$subject,$message,$header);

        echo "<script> location.href='validate.php?id=hello.$urlPortion' </script>";
}
?>
</html>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->