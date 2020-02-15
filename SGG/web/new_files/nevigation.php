
<!-- fas fa-chevron-down-->
<?php
$u_name="";
if(isset($_SESSION['username'])){
$u_name=$_SESSION['username'];}

?>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
<style>
a, a:hover
{
	text-decoration: none;
	-webkit-font-smoothing: antialiased;
	-webkit-text-shadow: rgba(0,0,0,.01) 0 0 1px;
	text-shadow: rgba(0,0,0,.01) 0 0 1px;
}
.standard_dropdown li
{
	display: inline-block;
	position:relative;
	height: 56px;
}
.standard_dropdown li li
{
	width: 100%;
	height:auto;
}
a{
	color: white;
}
.standard_dropdown li li a
{

	display: block;
	width: 100%;
	border-bottom: solid 1px #f2f2f2;
	font-size: 16px;
}
.standard_dropdown li:last-child a
{
	border-bottom: none;
	margin-left: 10px;

}
.standard_dropdown li.hassubs > a 
{
	color:#2fdab8;
	
}

.standard_dropdown li.hassubs > a i
{
	display: inline-block;
	margin-left: 5px;

}
.standard_dropdown li a
{
	display: block;
	position: relative;
	font-size: 16px;
	font-weight: 300;
	color: #2fdab8;
	line-height: 25px;
	white-space: nowrap;
	-webkit-transition: all 200ms ease;
	-moz-transition: all 200ms ease;
	-ms-transition: all 200ms ease;
	-o-transition: all 200ms ease;
	transition: all 200ms ease;
}
.standard_dropdown li a:hover
{
	color: #0e8ce4;
}
.standard_dropdown li a i
{
	display: none;
	-webkit-transform: translateY(-1px);
	-moz-transform: translateY(-1px);
	-ms-transform: translateY(-1px);
	-o-transform: translateY(-1px);
	transform: translateY(-1px);
	font-size: 12px;
}
.standard_dropdown li ul
{
	display: block;
	position: absolute;
	top: 120%;
	left: 0;
	width: auto;
	visibility: hidden;
	opacity: 0;
	background: #FFFFFF;
	box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
	-webkit-transition: opacity 0.3s ease;
	-moz-transition: opacity 0.3s ease;
	-ms-transition: opacity 0.3s ease;
	-o-transition: opacity 0.3s ease;
	transition: all 0.3s ease;
	z-index: 1;
}
.standard_dropdown li:hover > ul
{
	top: 100%;
	visibility: visible;
	opacity: 1;
}
.standard_dropdown ul ul
{
	left: 100%;
	top: 0 !important;
}

.main_nav_dropdown li
{
	margin-right: 35px;
}

</style>

</head>
<?php
if(isset($_SESSION['username'])){
?>
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>ss
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav menu__list">
					<li class=" menu__item "><a class="menu__link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
					<!--<li class="menu__item"><a class="menu__link" href="">Category</a>-->

					<!--			<div style="position: fixed">-->
									<ul class="standard_dropdown main_nav_dropdown">
										<li class="hassubs">
											<a href="#" style="color: white;margin-left: 20px;margin-top: 23px; font-family: 'Open Sans', sans-serif;font-size: 15px;font-weight: normal;letter-spacing:2px;">Categories<i class="fa fa-angle-down"></i></a>
										<ul>
						
							<?php 

							$query="select * from category";
							$result=mysqli_query($conn,$query);
							while($row=mysqli_Fetch_array($result))
							{
									echo "<li class='hassubs' style=' border-right:2px;color:#2fdab8; margin-left:5px;'> <a href='#''>".$row['Category_name']."<span> </span><span> </span><span class='fa fa-angle-right'></span></a><ul>";
									$cat=$row['Category_id'];
									$query1="select * from  subcategory where Category_id='$cat'";
									$result1=mysqli_query($conn,$query1);
									while($row1=mysqli_fetch_Array($result1))
									{
										$sub=$row1['Subcategory_id'];
									echo "
									
								<li  style='color:green;'><a href='./product.php?link=$sub'>".$row1['Subcategory_name']."<i class='fas fa-chevron-right'></i></a></li>
								
					
						";
							}
							echo " </ul></li>";
							}
							?>
							
						
					</ul>
				<!--</li>-->

		
			
			
		</ul>
	<!--</div>-->



					</li>		
 							
					
					<li class=" menu__item"><a class="menu__link" href="about.php">About</a></li>
					<li class=" menu__item"><a class="menu__link" href="contact.php">Contact</a></li>
				
							<li class="menu__item"><a class="menu__link" data-toggle="modal" data-target="#kam">Complain</a></li>
							
				
			
							
					  <div class="modal fade" id="kam" role="dialog">
    						<div class="modal-dialog">
   						    <!-- Modal content-->
	 						    <div class="modal-content">
		        					<div class="modal-header">
			          					<button type="button" class="close" data-dismiss="modal">&times;</button>
								          <h4 class="modal-title" style="font-size: 30PX;">COMPLAIN</h4>
							        </div>
							        <div class="modal-body">
								        <form method="post" id="aman">
									        <tr>
									        	<td><label for="PRODUCT NAME">PRODUCT NAME</label><td>
									            <td><select class="form-control" name="product" id="product_id">
									          	<?php 
									            	$user_name=$_SESSION['username'];
									            	$user_id="";
									            	$pro_name="";
									            	$pro_id="";
									            	$sql="select USER_ID from login where USER_NAME='$user_name'";
									            	$result=mysqli_query($conn,$sql);
									            	while($row=mysqli_fetch_Array($result))
									            	{
									            		$user_id=$row['USER_ID'];
									            	}
									            	$sql2="SELECT DISTINCT(Product_id) from sales_detail where sales_id in(SELECT Sales_id from sales WHERE Request_id in(SELECT Request_id from request WHERE User_id='$user_id'))";
									            	$result2=mysqli_query($conn,$sql2);
									            	while($row2=mysqli_fetch_array($result2))
									            	{
									            			$pro_name=$row2['Product_id'];
									            			$sql3="select Product_name from product where Product_id='$pro_name'";
									            			$result3=mysqli_query($conn,$sql3);
									            			while($row3=mysqli_fetch_array($result3))
									            			{?><option class="form-control"><?php

									            					$pro_id=$row3['Product_name'];
									            					echo $pro_id;
									            					?>
									            					</option><?php
									            				}
									            				
									            			}
									            			?> </option></select></td>
									        </tr>
									        <tr>
									        	<td><label for="PRODUCT NAME">Description</label><td><br/>
									            <td><textarea class="form-control" rows="4" cols="50" id="comp" name="complain" ></textarea></td>
									        </tr>
									        <tr>
									        	<input type="submit" name="submit" id="submit" value="submit" class="btn btn-info btn-block"/>
									            <input type="reset" name="reset" id="reset" value="RESET" class="btn btn-info btn-block"/>
									        </tr>
								        </form>
							    	</div>
							        <div class="modal-footer">
							          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							        </div>
	      						</div>
      
    						</div>
  						</div>
					</form>
					
				  </ul>
				</div>
			  </div>
			</nav>
		</div>
		
		
		<div class="top_nav_right">
			<form action="#" method="post" class="last">
			<div class="wthreecartaits wthreecartaits2 cart cart box_1">
			<a href="../web/cart.php" value="REQUSET">REQUIREMENT</a>
		</form>
			</div> 
</div>

		<div class="clearfix"></div>
	</div>
</div>
<!---------------------------->

<?php }else{?>
<div class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>ss
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1" >
				  <ul class="nav navbar-nav menu__list">
					<li class=" menu__item " style="margin-left: 50px"><a class="menu__link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
					<!--<li class="menu__item"><a class="menu__link" href="">Category</a>-->

					<!--			<div style="position: fixed">-->
									<ul class="standard_dropdown main_nav_dropdown">
										<li class="hassubs">
											<a href="#" style="color: white;margin-left: 20px;margin-top: 23px; font-family: 'Open Sans', sans-serif;font-size: 15px;font-weight: normal;letter-spacing:2px;">Categories<i class="fa fa-angle-down"></i></a>
										<ul>
						
							<?php 

							$query="select * from category";
							$result=mysqli_query($conn,$query);
							while($row=mysqli_Fetch_array($result))
							{
									echo "<li class='hassubs' style=' border-right:2px;color:#2fdab8; margin-left:5px;'> <a href='#''>".$row['Category_name']."<span> </span><span> </span><span class='fa fa-angle-right'></span></a><ul>";
									$cat=$row['Category_id'];
									$query1="select * from  subcategory where Category_id='$cat'";
									$result1=mysqli_query($conn,$query1);
									while($row1=mysqli_fetch_Array($result1))
									{
										$sub=$row1['Subcategory_id'];
									echo "
									
								<li  style='color:green;'><a href='./product.php?link=$sub'>".$row1['Subcategory_name']."<i class='fas fa-chevron-right'></i></a></li>
								
					
						";
							}
							echo " </ul></li>";
							}
							?>
							
						
					</ul>
				<!--</li>-->

		
			
			
		</ul>
	<!--</div>-->



					</li>		
 							
					
					<li class=" menu__item"><a class="menu__link" href="about.php">About</a></li>
					<li class=" menu__item"><a class="menu__link" href="contact.php">Contact</a></li>
				
						
				
			
				
					 
					
					
				  </ul>
				</div>
			  </div>
			</nav>
		</div>
		
	
</div>

		<div class="clearfix"></div>
	</div>
</div>

<?php }?>
<!----------------------------------------------------------------myrequirement modal------------------------------------------------------------------------>

<div class="container">
  <div class="modal fade" id="my_req" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">My Requirements...</h4></center>
  	<hr>
        </div>
        <div class="modal-body" >
       	<form method="post" >
        <table border="2"> 
       	<?php 
        		$u_id="";$r_id="";$r_date="";
        		$sql_sql="select * from login where USER_NAME='$u_name'";
        		$run_sql=mysqli_query($conn,$sql_sql);
        		while($row_kam=mysqli_fetch_Array($run_sql))
        		{
        				$u_id=$row_kam['USER_ID'];
        		}
        		
        		$sql1="SELECT * FROM `request` WHERE User_id='$u_id'";
        		$run1=mysqli_query($conn,$sql1);
        		$no=mysqli_num_rows($run1);
        		if($no>0){
        		?>

        
        	<tr>
        		<th>Request No</th>
        		<th>Request Date</th>
        		<th>Requirements</th>
        	</tr>
        	<?php 
        				
        		while ($row1=mysqli_fetch_array($run1)) {
        			$r_id=$row1['Request_id'];
        			$r_date=$row1['Request_date'];
        			$newDate = date("d-m-Y", strtotime($r_date));?>
        		<tr>
        		<td><?php echo $r_id;?></td>
        		<td><?php echo $newDate;?></td>

        		<td><span><u><a href="../web/data_table.php?id=<?php echo $r_id;?>" style="color: black">Requirements</a></u></span></td>
        	</tr>
        		
        	<?php }}
        	else{
        		echo "<h2>No Requirements Found...</h2>";
        	}
        	?>
        
        </table>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script type="text/javascript">
		$(document).ready(function() {
			$('#add_address').on('submit',function(event){
				event.preventDefault();
				if($('#as').val()=='')
				{
					alert("Enter The Address");
				}
				else
				{
					$.ajax({
						url:"insert_address.php",
						method:"POST",
						data:$('#add_address').serialize(),
						 beforeSend:function(){  
     $('#insert').val("Inserting");  
    }, 
						success:function(data){
							
							$('#hp_address').modal('hide'); 
							location.href='index.php';
    						}
					});
				}
			});
		});
</script>
<script type="text/javascript">
		$(document).ready(function() {
			$('#aman').on('submit',function(event){
				event.preventDefault();
				var product_id=$("#product_id").val(),
				desp=$("#comp").val();
				if($('#comp').val()=='')
				{
					alert("Enter The Complain");
				}
				else
				{
					$.ajax({
						url:"./new_files/insert_complain.php",
						method:"POST",
						data:$('#aman').serialize(),
						 beforeSend:function(){  
     $('#submit').val("Inserting");  
    }, 
						success:function(data){
							
							$('#kam').modal('hide'); 
							location.href='index.php';
    						}
					});
				}
			});
		});
</script>


<!----------------------------------------------------------------myrequirement modal------------------------------------------------------------------------>