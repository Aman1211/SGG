<?php 
 $require=""; 	
   include("./db.php");
     
	  
if(isset($_GET['edit_r']))
{
$require=$_GET['edit_r'];
}
 $st="";
	   $abc="select status,labour from request where Request_id='$require'";
	   $res=mysqli_query($conn,$abc);
	   while($rows=mysqli_fetch_array($res))
	   {
	   		$st=$rows['status'];

	   }
?>

<html>
  <title>
        VIEW REQUIREMENTS
  </title>
  <link rel="stylesheet" href="view_style.css" type="text/css"/>
  <style>
 input[type=text] {
  padding: 6px;
  margin-top: 8px;
  font-size: 17px;
  border: none;
}
.hp {
   padding:8px 16px;
   border:1px solid #ccc;
   color:#333;
   font-weight:bold;
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
#add{
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
   input[type=text] {
    border: 1px solid #ccc;  
  }
}
</style>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
     
<body>
<div class="search-container">
    <form action="" method="post">
    
	 
	  <a href="./index.php?link=29" id="add">Back </a>
	  <?php if($st==0){?>
	  <a href="" data-toggle="modal" data-target="#req" id="add">Add </a>
	<?php } ?>
  </div>
  <table id="data">
    <tr>
      <td colspan="10" align="center">
        <h2>
          View All REQUIREMENTS
        </h2>
      </td>
    </tr>
    <tr>
      <th>REQUEST_ID</th>
      <th>PRODUCT_NAME</th>
      <th>HEIGHT</th>
      <TH>WIDTH</TH>
      <th>SQ-FEET</th>
      <th>RATE</th>
	  <th>QTY</th>
	  <th>Labour Rate</th>
    </tr>
    <?php
	
   
      $get_c="select * from product p,customer_requirement cr where cr.Customer_req_id=$require and cr.Product_id=p.Product_id ";
      $run_c=mysqli_query($conn,$get_c);
      $num1=mysqli_num_rows($run_c);
      $i=0;
      $var="Aman";
      $var4="hardik";
      $var1="price";
      $var2="height";
      $var3="width";
      $var5="lab";
      while($row_c=mysqli_fetch_array($run_c)){


        $r_id=$row_c['Customer_req_id'];
        $p_name=$row_c['Product_name'];
        $s_h=$row_c['Size_Height'];
		    $s_w=$row_c['Size_Width'];
       
        $price=$row_c['rate'];
		$qty=$row_c['qty'];
		$lab_rate=$row_c['lab_rate'];
	
?>
<tbody>
     <tr align="center">
       <td><?php echo $r_id; ?></td>
       <td><?php echo $p_name; ?></td>
   
       <td> <input type="number" min="1" name=<?php echo  $var2.$i; ?> value=<?php echo $s_h; ?>></td>
       <td> <input type="number" min="1" name=<?php echo  $var3.$i; ?> value=<?php echo $s_w; ?>></td>
       
       <?php
       			$h_n=Square_Height($s_h);
				$w_n=Square_Width($s_w);
				//echo "<script> alert('$h_n $w_n'); </script>";
				$sq_ft=($h_n*$w_n)/144;
	       ?>
	       <input type="hidden" name=<?php echo $var4.$i;?> value=<?php echo $sq_ft*$qty; ?>>
      <td><input type="number" min="1" name=<?php echo $var.$i; ?> value=<?php echo $sq_ft*$qty; ?> disabled></td>
       <td><input type="number" min="1" name=<?php echo  $var1.$i; ?> value=<?php echo $price; ?>></td>
	   <td><?php echo $qty; ?></td>
	   <?php if($st==0) {?>
	   <td><input type="number" min="1" required name=<?php echo $var5.$i; ?> value=<?php echo $lab_rate?> ></td>
	  	<?php }
	  	  else{ ?> 
	  		<td><input type="number" min="1" disabled name=<?php echo $var5.$i; ?> value=<?php echo $lab_rate?> ></td>
	  		<?php } ?>

       </tr> 
     	
       
<?php $i++;} ?>
			
			
			<tr align="center">
				<?php if($st==0){?>
			 <td colspan="4"><button name="genrate"> GENERATE QUOTATION </button></td>
			 <td colspan="4"><button name="view"> VIEW QUOTATION </button> </td>
			<?php } else {
			?>
			 <td colspan="8"><button name="view1"> VIEW QUOTATION </button> </td>
			<?php } ?>
					
			</tr>
			</tbody>
  </table>
</form>
  <?php
  function Square_Height($h)
	{
			if($h==0 or $h==6)
			{
				return $h;
			}
			if($h>0 and $h<6)
			{
				return 6;
			}
			if($h==12)
			{
				return $h;
			}
			if($h>6 and $h<12)
			{
				return 12;
			}
			if($h==18)
			{
				return $h;
			}
			if($h>12 and $h<18)
			{
				return 18;
			}
			if($h==24)
			{
				return $h;
			}
			if($h>18 and $h<24)
			{
				return 24;
			}
			if($h==30)
			{
				return $h;
			}
			if($h>24 and $h<30)
			{
				return 30;
			}
			if($h==36)
			{
				return $h;
			}
			if($h>30 and $h<36)
			{
				return 36;
			}
			if($h==42)
			{
				return $h;
			}
			if($h>36 and $h<42)
			{
				return 42;
			}
			if($h==48)
			{
				return $h;
			}
			if($h>42 and $h<48)
			{
				return 48;
			}
			if($h==54)
			{
				return $h;
			}
			if($h>48 and $h<54)
			{
				return 54;
			}
			if($h==60)
			{
				return $h;
			}
			if($h>54 and $h<60)
			{
				return 60;
			}
			if($h==66)
			{
				return $h;
			}
			if($h>60 and $h<66)
			{
				return 66;
			}
			if($h==72)
			{
				return $h;
			}
			if($h>66 and $h<72)
			{
				return 72;
			}
			if($h==78)
			{
				return $h;
			}
			if($h>72 and $h<78)
			{
				return 78;
			}
			if($h==84)
			{
				return $h;
			}
			if($h>78 and $h<84)
			{
				return 84;
			}
			if($h==90)
			{
				return $h;
			}
			if($h>84 and $h<90)
			{
				return 90;
			}
			if($h==96)
			{
				return $h;
			}
			if($h>90 and $h<96)
			{
				return 96;
			}
			if($h==102)
			{
				return $h;
			}
			if($h>96 and $h<102)
			{
				return 102;
			}
			if($h==108)
			{
				return $h;
			}
			if($h>102 and $h<108)
			{
				return 108;
			}
			if($h==114)
			{
				return $h;
			}
			if($h>108 and $h<114)
			{
				return 114;
			}
			if($h==120)
			{
				return $h;
			}
			if($h>114 and $h<120)
			{
				return 120;
			}
			
			
			
			
			
			
	}
	function Square_Width($h)
	{
			if($h==0 or $h==6)
			{
				return $h;
			}
			if($h>0 and $h<6)
			{
				return 6;
			}
			if($h==12)
			{
				return $h;
			}
			if($h>6 and $h<12)
			{
				return 12;
			}
			if($h==18)
			{
				return $h;
			}
			if($h>12 and $h<18)
			{
				return 18;
			}
			if($h==24)
			{
				return $h;
			}
			if($h>18 and $h<24)
			{
				return 24;
			}
			if($h==30)
			{
				return $h;
			}
			if($h>24 and $h<30)
			{
				return 30;
			}
			if($h==36)
			{
				return $h;
			}
			if($h>30 and $h<36)
			{
				return 36;
			}
			if($h==42)
			{
				return $h;
			}
			if($h>36 and $h<42)
			{
				return 42;
			}
			if($h==48)
			{
				return $h;
			}
			if($h>42 and $h<48)
			{
				return 48;
			}
			if($h==54)
			{
				return $h;
			}
			if($h>48 and $h<54)
			{
				return 54;
			}
			if($h==60)
			{
				return $h;
			}
			if($h>54 and $h<60)
			{
				return 60;
			}
			if($h==66)
			{
				return $h;
			}
			if($h>60 and $h<66)
			{
				return 66;
			}
			if($h==72)
			{
				return $h;
			}
			if($h>66 and $h<72)
			{
				return 72;
			}
			if($h==78)
			{
				return $h;
			}
			if($h>72 and $h<78)
			{
				return 78;
			}
			if($h==84)
			{
				return $h;
			}
			if($h>78 and $h<84)
			{
				return 84;
			}
			if($h==90)
			{
				return $h;
			}
			if($h>84 and $h<90)
			{
				return 90;
			}
			if($h==96)
			{
				return $h;
			}
			if($h>90 and $h<96)
			{
				return 96;
			}
			if($h==102)
			{
				return $h;
			}
			if($h>96 and $h<102)
			{
				return 102;
			}
			if($h==108)
			{
				return $h;
			}
			if($h>102 and $h<108)
			{
				return 108;
			}
			if($h==114)
			{
				return $h;
			}
			if($h>108 and $h<114)
			{
				return 114;
			}
			if($h==120)
			{
				return $h;
			}
			if($h>114 and $h<120)
			{
				return 120;
			}
			
			
			
			
			
	}

  		if(isset($_POST['genrate']))
  		{
  		
  			$cnt=0;
  		

if(isset($choices)) {

foreach ($choices as $key => $value)
{
	$labour[$cnt]=$value;
	$cnt++;
}
}
  			
			$query1="select * from product p,customer_requirement c where c.Customer_req_id='$require' and p.Product_id=c.Product_id";
			$result=mysqli_query($conn,$query1);
			$i=1;
			$b=0;
				$total=0;
				$sq=array();
				$pr=array();

			while($row=mysqli_fetch_array($result))
			{
				$pro_id=$row['Product_id'];
				$h=$row['Size_Height'];
				$w=$row['Size_Width'];
				$qty=$row['qty'];
				
				//echo "<script> alert('$h_n $w_n'); </script>";
			
				$sq_ft=$_POST['hardik'.$b];
				$price1=$_POST['price'.$b];
		
				$query3="insert into estimate(Request_id,Product_id,Qty,Size,Size_Width,Price) values('$require','$pro_id','$qty','$h','$w','$price1')";
				mysqli_query($conn,$query3);
				$sq[$b]=$sq_ft;
				$pr[$b]=$price1;
		
				
			$i++;
			$b++;
			}

					
				$urlPortion= '&array1='.urlencode(serialize($sq)).
             '&array2='.urlencode(serialize($pr));
//echo "<script> location.href='./view/quotation.php?id=$require.$urlPortion'</script>";
echo "<script> window.open('./view/quotation.php?id=$require.$urlPortion',target='_self'); </script>";
		}
			if(isset($_POST['view']))
  		{
  			$labour=Array();
  			$cnt=0;

if(isset($choices)) {
$abc="";
foreach($choices as $key=>$value)
{
	$labour[$cnt]=$value;
	$cnt++;
}
}
			$query1="select * from product p,customer_requirement c where c.Customer_req_id='$require' and p.Product_id=c.Product_id";
			$result=mysqli_query($conn,$query1);		
			$i=1;
			$b=0;
				$total=0;
				$sq=array();
				$pr=array();

			while($row=mysqli_fetch_array($result))
			{
				$main=$row['requirement_id'];
				$pro=$row['Product_id'];
				$req=$row['Customer_req_id'];
				$h=$row['Size_Height'];
				$w=$row['Size_Width'];
				$qty=$row['qty'];

				
				//echo "<script> alert('$h_n $w_n'); </script>";

				$sq_ft=$_POST['hardik'.$b];
				$price1=$_POST['price'.$b];
				$labour1=$_POST['lab'.$b];
				$h=$_POST['height'.$b];
				$w=$_POST['width'.$b];
				$sq[$b]=$sq_ft;
				$pr[$b]=$price1;
				$labour[$b]=$labour1;
					$h_n=Square_Height($h);
				$w_n=Square_Width($w);
		$sq_ft=($h_n*$w_n)/144;
		$sq_ft=$sq_ft*$qty;
				$sql="update customer_requirement set Size_Height='$h',Size_Width='$w',rate='$price1',sq_feet='$sq_ft',lab_rate='$labour1' where Customer_req_id='$req' and Product_id='$pro' and requirement_id='$main'";
					$abc=mysqli_query($conn,$sql);
						if($abc)
						{
							
				
						}
			$i++;
			$b++;
			}
			
					$urlPortion= '&array1='.urlencode(serialize($sq)).
             '&array2='.urlencode(serialize($pr)).'&array3='.urlencode(serialize($labour));
				if($abc){
					
						
//echo "<script> location.href='./view/quotation1.php?id=$require.$urlPortion'</script>";
echo "<script> window.open('./view/quotation1.php?id=$require.$urlPortion',target='_blank');</script>";

		}}
		
  ?>
  <?php 
  if(isset($_POST['view1']))
  		{
  			$labour=Array();
  			$cnt=0;

if(isset($choices)) {
$abc="";
foreach($choices as $key=>$value)
{
	$labour[$cnt]=$value;
	$cnt++;
}
}
			$query1="select * from product p,customer_requirement c where c.Customer_req_id='$require' and p.Product_id=c.Product_id";
			$result=mysqli_query($conn,$query1);		
			$i=1;
			$b=0;
				$total=0;
				$sq=array();
				$pr=array();

			while($row=mysqli_fetch_array($result))
			{
				$main=$row['requirement_id'];
				$pro=$row['Product_id'];
				$req=$row['Customer_req_id'];
				$h=$row['Size_Height'];
				$w=$row['Size_Width'];
				$qty=$row['qty'];

				
				//echo "<script> alert('$h_n $w_n'); </script>";

				$sq_ft=$_POST['hardik'.$b];
				$price1=$_POST['price'.$b];
		
				$h=$_POST['height'.$b];
				$w=$_POST['width'.$b];
				$sq[$b]=$sq_ft;
				$pr[$b]=$price1;
			
					$h_n=Square_Height($h);
				$w_n=Square_Width($w);
		$sq_ft=($h_n*$w_n)/144;
		$sq_ft=$sq_ft*$qty;
							$i++;
			$b++;
			}
			
					$urlPortion= '&array1='.urlencode(serialize($sq)).
             '&array2='.urlencode(serialize($pr));
				if($abc){
					
						
//echo "<script> location.href='./view/quotation1.php?id=$require.$urlPortion'</script>";
echo "<script> window.open('./view/quotation1.php?id=$require.$urlPortion',target='_blank');</script>";
		}}mysqli_close($conn);
		
  ?>
  <div class="container">
  <div class="modal fade" id="req" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         <center> <h4 class="modal-title">ADD REQUIREMENTS</h4></center>
  	<hr>
        </div>
        <div class="modal-body" >
       	<form method="post" id="extra" >
       		<tr>
       												<input type="hidden" id="hide" value="<?php echo $require ?>" name="hide">
									        	<td><label for="PRODUCT NAME">PRODUCT NAME</label></td>
									            <td><select class="form-control" name="product" id="product_id">
									          	<?php 
	?>
									            					<?php
									            					include 'db.php'; 

									            					$pro_name="";
									            				$query2="select * from product";
									            				$result2=mysqli_query($conn,$query2);
									            				while($row2=mysqli_fetch_array($result2))
									            				{
									            							$pro_name=$row2['Product_name'];
									            							?><option><?php
									            							echo $pro_name;?>
									            							</option><?php 
									            						
									            				}
									         							
									            			?> </select></td>
									        </tr>
									        <tr>
									        	<td><label for="PRODUCT NAME">HEIGHT</label></td>
									        	<input type="number" class="form-control" name="h" id="h1">
									        </td></tr>
									        <tr>
									        	<td><label for="PRODUCT NAME">WIDTH</label></td>
									        	<input type="number" class="form-control" name="w" id="w1">
									        </td></tr>
									        
									        <tr>
									        	<td><label for="PRODUCT NAME">QTY</label></td>
									        	<input type="number" class="form-control" name="qty" id="qty1">
									        </td></tr>
									         <tr>
									        	<button  class="btn btn-info btn-block" name="submit" id="submit">Submit</button> 
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
<?php $var=$_GET['edit_r']; ?>
<script type="text/javascript">
		$(document).ready(function() {
			$('#extra').on('submit',function(event){
				event.preventDefault();
				var pro_name=$("#product_id").val(),
				height=$("#h1").val(),
				width=$("#w1").val(),
				
				qty=$("qty1").val();
				if($('#h1').val()=='')
				{
					alert("Please Enter Height");
				}
					if($('#w1').val()=='')
				{
					alert("Please Enter Width");
				}
					if($('#qty1').val()=='')
				{
					alert("Please Enter Quantity");
				}
					
				else
				{
					$.ajax({
						url:"./view/insert_require.php",
						method:"POST",
						data:$('#extra').serialize(),
						 beforeSend:function(){  
     $('#submit').val("Inserting");  
    }, 
						success:function(data){
							
							$('#req').modal('hide'); 
						location.href="./index.php?link=66&edit_r=<?php echo $require ?>";
    						}
					});
				}
			});
		});
</script>
