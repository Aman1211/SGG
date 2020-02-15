<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice Info</title>
     <link rel="icon" href="../image/SGG.ICO">
<!--/tags -->
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Elite Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
        
<!-- //tags -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

<link href="css/font-awesome.css" rel="stylesheet"> 
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="./style_rating.css"/>

<!-- //for bootstrap working -->
<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,900,900italic,700italic' rel='stylesheet' type='text/css'>

    <?php include './new_files/heder_1.php';?>
<!-- //header -->
<!-- header-bot -->
<?php include './new_files/heder_2.php'; ?>
        <!-- header-bot -->

<!-- //header-bot -->
<!-- banner -->

<?php include './new_files/nevigation.php';?>


    <style>
    .wrapper {
    margin: 47px auto;
    max-width:2000px;
}
 
#contact_form {
    text-shadow:0 1px 0 #FFF;
    border-radius:4px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    background:#F9F9F9;
    padding:25px;
    width:1500px;
    height:500px;
    background-image:url('image/arial.jpg');
    background-repeat: no-repeat;
    background-size: cover;
 
}
 
#ff label {
    cursor:pointer;
    margin:4px 0;
    color:#ed7700;
    display:block;
    font-weight:800;
    margin-left:50px;
 
}
 
#abc {
    display:block;
    width:90%;
    border-radius:4px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    background-color:#f4f4f4;
    color:#000;
    border:1px solid #5f5f5f;
    padding:10px;
    margin-bottom:25px;
    margin-left:50px;
}
 span{
    margin-left:50px;
 }
.sendButton {
    cursor:pointer;
    -moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
    -webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
    box-shadow:inset 0px 1px 0px 0px #fce2c1;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25) );
    background:-moz-linear-gradient( center top, #ffc477 5%, #fb9e25 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc477', endColorstr='#fb9e25');
    background-color:#ffc477;
    -webkit-border-radius:16px;
    -moz-border-radius:16px;
    border-radius:16px;
    border:1px solid #eeb44f;
    color:#ffffff;
    font-family:Arial;
    font-size:14px;
    width:25%;
    font-weight:bold;
    text-shadow:1px 1px 0px #cc9f52;
}
.sendButton:hover {
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477) );
    background:-moz-linear-gradient( center top, #fb9e25 5%, #ffc477 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477');
    background-color:#fb9e25;
}
</style>
</head>
 
<body>
  <div class="wrapper">  
    <div id="contact_form">
    <form name="form1" id="ff" method="post" action="">
    <center><h1>INFO FOR INVOICE<h1></center>
    
        <label>
        <span>ENTER NAME FOR INVOICE</span>
        <input type="text" name="cname" id="abc" required>

        </label>
         
        <label>
        <span>ENTER GST NUMBER</span>
        <input type="text" name="gst" id="abc">
            
        
        
        </label>
       
        <input class="sendButton" type="submit" name="Submit" value="Send" style="height:40px; width:1000px; margin-left: 195px">
             
    </form>
    </div>
   </div>
 <?php include './new_files/footer.php'; ?>
<!-- //footer -->

<!-- login -->
            <?php include './new_files/login.php';?>
<!-- //login -->
<a href="#home" class="scroll" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<!-- //js -->
<script src="js/modernizr.custom.js"></script>
    <!-- Custom-JavaScript-File-Links --> 
    <!-- cart-js -->
    <script src="js/minicart.min.js"></script>
<script>
    // Mini Cart
    paypal.minicart.render({
        action: '#'
    });

    if (~window.location.search.indexOf('reset=true')) {
        paypal.minicart.reset();
    }
</script>

    <!-- //cart-js --> 
    <!-- single -->
<script src="js/imagezoom.js"></script>
<!-- single -->
<!-- script for responsive tabs -->                     
<script src="js/easy-responsive-tabs.js"></script>
<script>
    $(document).ready(function () {
    $('#horizontalTab').easyResponsiveTabs({
    type: 'default', //Types: default, vertical, accordion           
    width: 'auto', //auto or any width like 600px
    fit: true,   // 100% fit in a container
    closed: 'accordion', // Start closed if in accordion view
    activate: function(event) { // Callback function if tab is switched
    var $tab = $(this);
    var $info = $('#tabInfo');
    var $name = $('span', $info);
    $name.text($tab.text());
    $info.show();
    }
    });
    $('#verticalTab').easyResponsiveTabs({
    type: 'vertical',
    width: 'auto',
    fit: true
    });
    });
</script>
<!-- FlexSlider -->
<script src="js/jquery.flexslider.js"></script>
                        <script>
                        // Can also be used with $(document).ready()
                            $(window).load(function() {
                                $('.flexslider').flexslider({
                                animation: "slide",
                                controlNav: "thumbnails"
                                });
                            });
                        </script>
                    <!-- //FlexSlider-->
<!-- //script for responsive tabs -->       
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/jquery.easing.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){     
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>
<!-- here stars scrolling icon -->
    <script type="text/javascript">
        $(document).ready(function() {
                                
            $().UItoTop({ easingType: 'easeOutQuart' });
                                
            });
    </script>
<!-- //here ends scrolling icon -->
<!------------------------------rating js-------------------------------------------->
<script type="text/javascript" src="main.js"></script>
<!------------------------------rating js-------------------------------------------->
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

<?php
if(isset($_POST['Submit']))
{
    include './db.php';
        $id=$_GET['link'];
        $gst=$_POST['gst'];
        $cname=$_POST['cname'];
        if($gst=='')
        {
            $query="UPDATE `request` SET `gst`='$gst',`iname`='$cname' WHERE Request_id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
        echo "<script> location.href='payment.php?link=$id' </script>";
    }
    else
    {
         echo "<script> alert('error'); </script>";
    }
        }
        else
        {
        if(strlen($gst)!=15)
        {
            echo "<script> alert('Enter Valid GST Number'); </script>";
        }

    

            else{

        $query="UPDATE `request` SET `gst`='$gst',`iname`='$cname' WHERE Request_id='$id'";
        $result=mysqli_query($conn,$query);
        if($result){
        echo "<script> location.href='payment.php?link=$id' </script>";
    }
    else
    {
         echo "<script> alert('error'); </script>";
    }
}}}
?>