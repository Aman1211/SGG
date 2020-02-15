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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SGG [Shree Gururupa Glass Traders]</title>
      <link rel="icon" href="../image/SGG.ICO">

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
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

<!-- //footer -->
            <?php include './new_files/heder_1.php';?>
<!-- //header -->
<!-- header-bot -->
<?php include './new_files/heder_2.php'; ?>
        <!-- header-bot -->

<!-- //header-bot -->
<!-- banner -->

<?php include './new_files/nevigation.php';?>

<!-- //banner-top -->
<!-- Modal1 -->
<?php include './new_files/model_1.php';?>
<!-- //Modal1 -->
<!-- Modal2 -->
<?php include './new_files/sign_up.php';?>

    </head>
    <body>
       

<div style="margin-top: 10px">
            
            
            <div class="container">
                <table class="table table-bordered table-striped">
                    <tbody>
                      <tr><th colspan="8" style="font-size:25px">My Requirements</th></tr>
             <tr>
                            <th>SR NO.</th>
                                         <th> Product Image </th>
                            <th>Thickness</th>
                            <th>Product Name</th>
                            
                            <th>Height</th>
                            <th>width</th>
                            <th>Qty</th>
                            <th>Product Price</th>
                            
                        </tr>
        
         <tr>
                                          <?php 
                                          include 'db.php';
                                          $id=$_GET['id'];
                                           $price_id="";$i=1;$rate="";
                                            $sql="select * from customer_requirement where Customer_req_id='$id'";
                                            $run=mysqli_query($conn,$sql);
                                            while($row=mysqli_fetch_array($run)){
                                                $p_id=$row['Product_id'];
                                                $h=$row['Size_Height'];
                                                $w=$row['Size_Width'];
                                                $q=$row['qty'];
                                                $rate=$row['rate'];
                                                $pro_name="";$thi="";$img="";
                                                $sql2="select image_path,Product_name,Price_size_id from product where Product_id='$p_id'";
                                                $result2=mysqli_query($conn,$sql2);
                                                while($row2=mysqli_fetch_Array($result2))
                                                {
                                                            $pro_name=$row2['Product_name'];
                                                            
                                                            $img=$row2['image_path'];
                                                            $price_id=$row2['Price_size_id'];
                                                            $th="SELECT `Thickness` FROM `price_size` WHERE `Price_Size_id` LIKE $price_id";
                                                            $runth=mysqli_query($conn,$th);
                                                            if($runth){
                                                                while($r=mysqli_fetch_array($runth))
                                                                {
                                                                    $thi=$r[0];
                                                                }
                                                            }
                                                }
                                          ?>
                                          <td><?php echo $i;?></td>
                                          <td><img src="../image/<?php echo $img;?>" height="50" width="50"></td> 
                                          <td><?php echo $thi?></td>
                                          <td><?php echo $pro_name;?></td> 
                                          <td><?php echo $h;?></td> 
                                          <td><?php echo $w;?></td> 
                                          <td><?php echo $q;?></td>
                                          <td>₹ <?php echo $rate;?></td>
                                          
                                      </tr>
                                            <?php $i+=1; }?>
             
                       
                       
                       
                    </tbody>
                </table>
            </div>
            
        </div>



</body>
      <?php include './new_files/footer.php'; ?>
      <script type="text/javascript" src="main.js"></script>
<!------------------------------rating js-------------------------------------------->
<script type="text/javascript" src="js/bootstrap.js"></script>
    </html>
