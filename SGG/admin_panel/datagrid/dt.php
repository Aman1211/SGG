<?php
$host = "localhost";  
$user ="root";  
$pass ="";  
$dbname ="sgg1";  
$conn = mysqli_connect($host,$user,$pass,$dbname);  
if(!$conn){  
  die('Could not connect: '.mysqli_connect_error());  
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edmin</title>
       <!-- <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!--    <link type="text/css" href="css/theme.css" rel="stylesheet">-->
     <!--  <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">-->
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>
    </head>
    <body>
       
        <!-- /navbar -->
       <div class="module">
                                <div class="module-head">
                                    <h3>
                                        DataTables</h3>
                                </div>
                                <div class="module-body table">
                                    <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
                                        width="auto"style="margin-top:50px;">
                                        <thead>
                                          
                                            <tr>
                                                <th>
                                                    CITY ID
                                                </th>
                                                <th>
                                                    CITY NAME
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr class="odd gradeX">
                                          <?php 
                                            $sql="select * from city";
                                            $run=mysqli_query($conn,$sql);
                                            while($row=mysqli_fetch_array($run)){
                                                $c_id=$row['City_id'];
                                                $c_name=$row['City_name'];
                                          ?>
                                          <td><?php echo $c_id;?></td> 
                                          <td><?php echo $c_name;?></td> 
                                      </tr>
                                            <?php }?>
                                        </tbody>
                                        <tfoot>
                                          
                                            <tr>
                                                <th>
                                                    CITY ID
                                                </th>
                                                <TH>
                                                    CITY NAME
                                                </TH>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
                <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
            </div>
        </div>
       
      
    </body>
