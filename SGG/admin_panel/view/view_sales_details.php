
<?php
include('./db.php');
$s_id=$_REQUEST['s_d'];
$r_id=$_REQUEST['r_id'];
 $url="index.php?link=65&s_d=$s_id&r_id=$r_id&";
        $statement="";
        $limit="";
        $page="";
        $total1="";
        $i="";
        
        $query="select * from sales_detail where sales_id='$s_id'";
        $result=mysqli_query($conn,$query);
        $total1 = mysqli_num_rows($result);
        include("pagination/function.php");
        $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
        $limit = 5; //if you want to dispaly 10 records per page then you have to change here
        $startpoint = ($page * $limit) - $limit;
        $statement = "sales_detail"; //you have to pass your query over here table name
          
            $sql1="select FirstName,LastName from login where USER_ID in(select User_id from request where Request_id in(select Request_id from sales where Request_id='$r_id'))";
            $run=mysqli_query($conn,$sql1);
            while($row=mysqli_fetch_array($run))
            {
              $f_name=$row['FirstName'];
              $l_name=$row['LastName'];
            }


$query = "SELECT * FROM sales_detail where sales_id='$s_id' order by sales_id DESC LIMIT {$startpoint}, {$limit}";
$result = mysqli_query($conn, $query);
$l="";
$sql="select labour from request where Request_id='$r_id'";
$res=mysqli_query($conn,$sql);
while($lab=mysqli_fetch_array($res))
{
    $l=$lab['labour'];
}

?>

<html>
  <head>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>

   <link href="./view/pagination/css/pagination.css" rel="stylesheet" type="text/css" />
  <link href="./view/pagination/css/A_green.css" rel="stylesheet" type="text/css" />
 <style>
 input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.search-container button {
 
  padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
  border:solid 1px;
}
.search-container button:hover {
  background: #ccc;
}
@media screen and (max-width: 600px) {
   .search-container {
    float: none;
  }
     input[type=text], .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
   .hp {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
  }

   input[type=text] {
    border: 1px solid #ccc;  
  }
}
 </style>
 

  </head>
  <body>
<div class="search-container">
    <form action="" method="post">
    
  <!--      <input type="text" placeholder="Search.." name="search">
      <button type="submit" name="submit">Search</button>
    <button type="submit" name="showall">Showall</button>-->
    <button type="submit" name="back">Back</button>
     <?php if($l==1)
    {?>
       <a href=""  data-toggle="modal" data-target="#req" id="abc" style="border:solid 1px; cursor:pointer; padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;">Manage Labour</a>
   <a href=""  data-toggle="modal" data-target="#free" id="xyz" style="border:solid 1px; cursor:pointer; padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;">Free Labour</a>
   <a href=""  data-toggle="modal" data-target="#amount" id="amt" style="border:solid 1px; cursor:pointer; padding: 6px;
  margin-top: 8px;
  margin-right: 0px;
  background: #ddd;
  font-size: 17px;">Labour Wages</a>
    <?php } ?>
    </form>
  </div>
  <table id="data">
    <thead>
    <tr>
      <td colspan="5" align="center">
        <h2>
          View All Sales Details
        </h2>
      </td>
      <td colspan="3" align="left"> Name :  <u><?php echo $f_name.$l_name?></u></td>
    </tr>

    <tr>
      <th>SR NO.</th>
      <th>THICKNESS</th>
      <th>PRODUCT NAME</th>
      <th>HEIGHT</th>
      <th>WIDTH</th>
      <th>QTY</th>
      <th>SQ.FT </th>
      <TH>PRICE</TH>
    </tr>
  </thead>
     <tbody id="myTable tr">
    <?php
    if(isset($_POST['back'])){
      echo "<script>location.href='./index.php?link=34'</script>";
    }
  
  
    $p_s_id="";$thick="";$h="";$w="";
    $i=$startpoint;
        $i+=1;
    while($row_c=mysqli_fetch_array($result)){
    
    $p_id=$row_c['Product_id'];
    $qty=$row_c['Qty'];
    $st=$row_c['sqfeet'];
    $price=$row_c['Price'];    
      
  
        $pro_name="select * from product where Product_id='$p_id'";
        $pro_query=mysqli_query($conn,$pro_name);
        while($pro=mysqli_fetch_array($pro_query))
        {
          $pro_name=$pro['Product_name'];
          $p_s_id=$pro['Price_size_id'];
        }
       $pri="SELECT * FROM `price_size` WHERE `Price_Size_id` LIKE $p_s_id";
       $pri_run=mysqli_query($conn,$pri);
       if($pri_run){
       while($pri_row=mysqli_fetch_array($pri_run)){
          $thick=$pri_row['Thickness'];
         } 
       }
       else
       {
      echo "<script>alert('Error')</script>";
       }
       $hw="SELECT  `Size_Height`,`Size_Width` FROM `customer_requirement` WHERE `Customer_req_id` LIKE '$r_id'";
       $hwrun=mysqli_query($conn,$hw);
       if($hwrun){
        while($hwrow=mysqli_fetch_array($hwrun))
        {
          $h=$hwrow['Size_Height'];
          $w=$hwrow['Size_Width'];
        }
       }

  ?>
     <tr align="center"> 
       <td><?php echo $i; ?></td>
       <td><?php echo $thick; ?></td>
       <td><?php echo $pro_name; ?></td>
       <td><?php echo $h;?></td>
       <td><?php echo $w; ?></td>
       <td><?php echo $qty;?></td>
       <td><?php echo $st;?></td>
       <td>₹ <?php echo $price; ?></td>
      </tr>
<?php $i++; } ?>
 </tbody>
  </table>
  <hr>
  <?php
   if(isset($_POST['showall']))
{
   echo "<script>window.open('./index.php?link=65&s_d=$s_id&r_id=$r_id','_self')</script>";

}

  echo "<div id='pagingg' >";
echo pagination($total1,$limit,$page,$url);
echo "</div>";
   ?>

  
 
<div class="container">
  <div class="modal fade" id="req" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">MANAGE LABOUR</h4></center>
    <hr>
        </div>
        <div class="modal-body" >
        <form method="post" id="extra" >
          <tr>
                              
                            <td><label for="PRODUCT NAME">LABOUR NAME</label></td>
                            <input type="hidden" name="sales" id="sal" value="<?php echo $s_id ?>">

                              <td><select class="form-control" name="labour[]" id="product_id" size=20 multiple>
                              <?php 
  ?>
                                        <?php
                                        include 'db.php'; 

                                        $pro_name="";
                                      $query2="select * from labour where status=0";
                                      $result2=mysqli_query($conn,$query2);
                                      while($row2=mysqli_fetch_array($result2))
                                      {
                                            $pro_name=$row2['Worker_name'];
                                            ?><option><?php
                                            echo $pro_name;?>
                                            </option><?php 
                                          
                                      }
                                        
                                    ?> </select></td>
                          </tr>
                          <div id="result"></div>
                            <button  class="btn btn-info btn-block" name="submit" id="submit">Submit</button> 
                              <input type="reset" name="reset" id="reset" value="RESET" class="btn btn-info btn-block"/>
                          </tr>
                          


        </form>
       </div>
   </div>
</div>
</div>
</div>

<div class="container">
  <div class="modal fade" id="free" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">FREE LABOUR</h4></center>
    <hr>
        </div>
        <div class="modal-body" >
        <form method="post" id="free1" >
          <tr>
                              
                            <td><label for="PRODUCT NAME">LABOUR NAME</label></td>
                            <input type="hidden" name="sales1" id="sal1"value="<?php echo $s_id ?>">

                              <td><select class="form-control" name="labour1[]" id="error" size=20 multiple>
                              <?php 
  ?>
                                        <?php
                                        include 'db.php'; 

                                        $pro_name="";
                                      $query2="select * from labour where status=1";
                                      $result2=mysqli_query($conn,$query2);
                                      while($row2=mysqli_fetch_array($result2))
                                      {
                                            $pro_name=$row2['Worker_name'];
                                            ?><option><?php
                                            echo $pro_name;?>
                                            </option><?php 
                                          
                                      }
                                        
                                    ?> </select></td>
                          </tr>
                         
                            <button  class="btn btn-info btn-block" name="aman" id="hello">Submit</button> 
                              <input type="reset" name="reset" id="reset" value="RESET" class="btn btn-info btn-block"/>
                          </tr>
                          


        </form>
       </div>
   </div>
</div>
</div>
</div>

<div class="container">
  <div class="modal fade" id="amount" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
     <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">LABOUR WAGES</h4></center>
    <hr>
        </div>
        <div class="modal-body" >
        <form method="post" id="amount1" >
          <tr>
                              
                            <td><label for="PRODUCT NAME">LABOUR NAME</label></td>
                            <input type="hidden" name="sales1" id="sal1"value="<?php echo $s_id ?>">

                              <td><select class="form-control" name="lab1" id="lab1">
                              <?php 
  ?>
                                        <?php
                                        include 'db.php'; 

                                        $pro_name="";
                                      $query2="select * from labour where Labour_id in(select Labour_id from sales_labour where Sales_id='$s_id') and status=1";
                                      $result2=mysqli_query($conn,$query2);
                                      while($row2=mysqli_fetch_array($result2))
                                      {
                                            $pro_name=$row2['Worker_name'];
                                            ?><option><?php
                                            echo $pro_name;?>
                                            </option><?php 
                                          
                                      }
                                        
                                    ?> </select></td>
                          </tr>
<div id="result"></div>
                         <tr>
                           <td><label for="PRODUCT NAME">AMOUNT</label></td> 
                          <input class="form-control" type="number" name="total" id="t">
                            
                        </tr>
                          
                    
                            <tr> <td><button  class="btn btn-info btn-block" name="good" id="bye">Submit</button></td></tr> 
                              <input type="reset" name="reset" id="reset" value="RESET" class="btn btn-info btn-block"/>
                          </tr>
                          


        </form>
       </div>
   </div>
</div>
</div>
</div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
      $('#free1').on('submit',function(event){
       
        event.preventDefault();
        var sal=$("#sal1").val(),
        result=$("#result"),
       pro_name=$("#error").val();
       
          $.ajax({

            url:"./view/free_labour.php",
            type:"POST",
            data:{sal:sal,labour:pro_name},
             beforeSend:function(){  

     $('#hello').val("Inserting");  
    }, 
            success:function(data){
              result.html(data);
             $('#free').modal('hide'); 

            location.href="./index.php?link=34";
                }
          });
        
      });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#extra').on('submit',function(event){
       
        event.preventDefault();
        var sal=$("#sal").val(),
        result=$("#result"),
       pro_name=$("#product_id").val();

       
          $.ajax({

            url:"./view/manage_labour.php",
            type:"POST",
            data:{sal:sal,labour:pro_name},
             beforeSend:function(){  

     $('#submit').val("Inserting");  
    }, 
            success:function(data){
              result.html(data);
             $('#req').modal('hide'); 

            location.href="./index.php?link=34";
                }
          });
        
      });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#amount1').on('submit',function(event){
       
        event.preventDefault();
        var sal=$("#sal1").val(),
        result=$("#result"),
       pro_name=$("#lab1").val(),
       total=$("#t").val();
       
          $.ajax({

            url:"./view/allot_amount.php",
            type:"POST",
            data:{sale:sal,la:pro_name,total:total},
             beforeSend:function(){  
                
     $('#bye').val("Inserting");  
    }, 
            success:function(data){
              alert('added');
            
           
                }
          });
        
      });
    });
</script>


</body>

</html>