<?php 
	session_start();

$u_name="";
if(isset($_SESSION['username'])){
$u_name=$_SESSION['username'];}

	include('./db.php');
	$query="select * from company where company_id=1";
	$run=mysqli_query($conn,$query);
	while($row=mysqli_fetch_array($run)){
		$id=$row['company_id'];
		$con=$row['Contact'];
		$eid=$row['Email_id'];
		
	}
?>
<style type="text/css">
	.set{
		margin-left: 180px;
		padding-left: 5px;
	}

</style>
<div class="header" id="home">
	<div class="container">
		
		<?php 
		
					
			if(isset($_SESSION['username']))
			{?>
			<ul style="margin-left: 120px;" >
			<li><i class="fa fa-phone" aria-hidden="true"></i> Call : <?php echo $con;?></li>
			<li style="margin-left:30px;"><i class="fa fa-envelope-o" aria-hidden="true"></i>
			<a href="mailto:prajapatihardik4199@outlook.com"><?php echo $eid; ?></a></li>
			<input type="hidden"  name="hide2" id="check" value="<?php echo $u_name; ?>">
			<li style="margin-left: 50px;"> <a data-toggle="modal">Welcome...  <?php echo $_SESSION['username'];?> </a></li>
			 <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           
            <span class="fa fa-user-circle" style="font-size:23px;"></span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../login/myaccount.php" style="color:black;">My Account</a><br><hr>
            <a class="dropdown-item" href="" style="color:black;" data-toggle="modal" data-target="#hat">My Requirements</a><br><hr>
            <a class="dropdown-item" data-toggle="modal" data-target="#orders" style="color:black;">My Orders</a><br><hr>
            	
 <a class="dropdown-item" href="javascript:if(confirm('Are you sure you want to do Logout?')) {location.href='../login/logout.php'}" style="color:black;">Logout</a><br>
            </div>
          
        </li>
		    </ul>


		<?php }
		else{?>
			<ul style="margin-left:120px;">
				<li> <a href="../login/login2.php" data-toggle="modal" ><i class="fa fa-unlock-alt" aria-hidden="true"></i> Sign In </a></li>
		    <!--sign up model open karva  data-target="#myModal2"-->
				<li> <a href="../login/reg.php" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Sign Up </a></li>
			<li><i class="fa fa-phone" aria-hidden="true"></i> Call : <?php echo $con;?></li>
			<li><i class="fa fa-envelope-o" aria-hidden="true"></i> <a href="mailto:prajapatihardik4199@outlook.com"><?php echo $eid; ?></a></li>
			</ul>

		<?php }
		?>
			<!--sign up model open karva data-target="#myModal"-->
		    
		
	</div>
</div>
  <div class="container">
    <div class="modal fade" id="hat" role="dialog">
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
        <table border="2" class="table"> 
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
            <th>Status</th>
        	</tr>
        	<?php 
        				
        		while ($row1=mysqli_fetch_array($run1)) {
        			$r_id=$row1['Request_id'];
        			$r_date=$row1['Request_date'];
              $status=$row1['status'];
        			$newDate = date("d-m-Y", strtotime($r_date));?>
        		<tr>
        		<td><?php echo $r_id;?></td>
        		<td><?php echo $newDate;?></td>

        		<td><span><u><a href="../web/datagrid.php?id=<?php echo $r_id;?>" style="color: black">Requirements</a></u></span></td>
            
            <?php
          
         
          if($status==1)
            {?>

                <td><a class="btn btn-primary" name='confirm' href='gst.php?link=<?php echo $r_id;?>'>Confirm Quotation</a><br>
               

            <?php } ?>
          <?php 
            if($status==2)
              {?>
                  <td>Confirmed</td>
            <?php  } if($status==0){
              ?>
                  <td>Pending </td>
      
        
        	</tr>
        		
        
        <?php 
        }}}
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
 <!-- <div class="container">
    <div class="modal fade" id="orders" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->

<div class="container">
    <div class="modal fade" id="orders" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
           <center> <h4 class="modal-title">My Orders</h4></center>
      <hr>
          </div>
          <div class="modal-body" >
          <form method="post" >
        <table border="2" class="table"> 
      
            <?php
            $i=1;
            $sql1="SELECT * FROM `sales` WHERE Request_id in(select Request_id from request where User_id='$u_id')";

            $run1=mysqli_query($conn,$sql1);
            $no=mysqli_num_rows($run1);
            if($no>0){
            ?>

        
          <tr>
            <th>SR NO</th>
            <th>ORDER DATE</th>
            <th>DETAILS</th>
          
          </tr>
          <?php 
                
            while ($row1=mysqli_fetch_array($run1)) {
              
              $r_date=$row1['Sales_date'];
              $id=$row1['Sales_id'];
              $newDate = date("d-m-Y", strtotime($r_date));?>
            <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $newDate;?></td>
 <td><a class="btn btn-primary" name='confirm' href='../web/odetail.php?link=<?php echo $id;?>'>DETAILS</a><br>
               
           
            
            <?php
          
         
         

               
$i=$i+1;  }
            
         }
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
