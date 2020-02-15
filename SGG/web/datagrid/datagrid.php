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
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
       <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
            rel='stylesheet'>

            <?php include '../new_files/heder_1.php';?>
<!-- //header -->
<!-- header-bot -->
<?php include '../new_files/heder_2.php'; ?>
        <!-- header-bot -->

<!-- //header-bot -->
<!-- banner -->

<?php include '../new_files/nevigation.php';?>

<!-- //banner-top -->
<!-- Modal1 -->
<?php include '../new_files/model_1.php';?>
<!-- //Modal1 -->
<!-- Modal2 -->
<?php include '../new_files/sign_up.php';?>
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
                                                    PRODUCT NAME
                                                </th>
                                                <th>
                                                    HEIGHT
                                                </th>
                                                <th>
                                                    WIDTH
                                                </th>
                                                <th>
                                                    QUANTITY
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <tr class="odd gradeX">
                                          <?php 
                                          $id=$_GET['id'];
                                            $sql="select * from customer_requirement where Customer_req_id='$id'";
                                            $run=mysqli_query($conn,$sql);
                                            while($row=mysqli_fetch_array($run)){
                                                $p_id=$row['Product_id'];
                                                $h=$row['Size_Height'];
                                                $w=$row['Size_Width'];
                                                $q=$row['qty'];
                                                $pro_name="";
                                                $sql2="select Product_name from product where Product_id='$p_id'";
                                                $result2=mysqli_query($conn,$sql2);
                                                while($row2=mysqli_fetch_Array($result2))
                                                {
                                                            $pro_name=$row2['Product_name'];
                                                }
                                          ?>
                                          <td><?php echo $pro_name;?></td> 
                                          <td><?php echo $h;?></td> 
                                          <td><?php echo $w;?></td>
                                          <td><?php echo $q;?></td>
                                          
                                      </tr>
                                            <?php }?>
                                        </tbody>
                                       
                                    </table>
                                </div>
                            </div>
        <!--/.wrapper-->
        <div class="footer">
            <div class="container">
            
            </div>
        </div>
        <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
        <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
        <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
        <script src="scripts/flot/jquery.flot.resize.js" type="text/javascript"></script>
        <script src="scripts/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="scripts/common.js" type="text/javascript"></script>
      
    </body>
