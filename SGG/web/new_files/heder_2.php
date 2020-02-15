<head>


	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 436px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid aqua;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid aqua;
        border-top: none;
        cursor: pointer;
        background-color: white;
    }
    .result p:hover{
        /*background: #f2f2f2;*/
        background:white;
    }
   
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="search"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("new_files/ajax1.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="search"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

</head>
<body>
        
<div class="header-bot">
	<div class="header-bot_inner_wthreeinfo_header_mid">
		<div class="col-md-4 header-middle">
            <form method="post">
			 <div class="search-box">
                    <input type="search" name="search" placeholder="Search Product here..." required="" autocomplete="off">
                    
                    <div class="result"></div>
                    <input type="submit" value=" " name="submit">
                </div>
                                
            </form>
		</div>
		<!-- header-bot -->
			<div class="col-md-4 logo_agile">
				<h1><a href="index.php"><img src="../image/sgg_symbol.jpg" height="80"></a></h1>
			</div>
			<div class="col-md-4 agileits-social top_content">
							<ul class="social-nav model-3d-0 footer-social w3_agile_social">
																								 <li class="share">Share On : </li>
																<li><a href="https://www.facebook.com/hardiksgg" class="facebook" target="_blank">
																		<div class="front"><i class="fa fa-facebook" aria-hidden="true"></i></div>
																		<div class="back"><i class="fa fa-facebook" aria-hidden="true"></i></div></a></li>

																<li><a href="https://www.instagram.com/shree_gurukrupa_glass_traders/" class="instagram">
																		<div class="front"><i class="fa fa-instagram" aria-hidden="true"></i></div>
																		<div class="back"><i class="fa fa-instagram" aria-hidden="true"></i></div></a></li>
															

			</div>
			<div class="clearfix"></div>
		</div>
	</div>
<?php
$host = "localhost";
$user ="root";
$pass ="";
$dbname ="sgg1";
$conn = mysqli_connect($host,$user,$pass,$dbname);
if(!$conn){
die('Could not connect: '.mysqli_connect_error());
}

    if(isset($_POST['submit']))
    {
            $p_name=$_POST['search'];
           
            $sql_hp="select * from product where Product_name='$p_name'";
            $run=mysqli_query($conn,$sql_hp);
            while($row=mysqli_fetch_array($run)){
                $id=$row['Product_id'];
            }
           
            $path="../web/single.php?id=$id";
                 echo "<script>location.href='$path'</script>";
     }

?>