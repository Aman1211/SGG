<?php
include("./db.php");
if(isset($_GET['edit_s'])){
	$supplier_id=$_GET['edit_s'];
	$get_edit="select * from supplier where Supplier_id='$supplier_id'";
	$run_edit=mysqli_query($conn,$get_edit);
	$row_edit=mysqli_fetch_array($run_edit);
	
	$update_id=$row_edit['Supplier_id'];
	$s_name=$row_edit['Supplier_name'];
    $s_con=$row_edit['Sup_contact'];
    $su_add1=$row_edit['Address1'];
    $su_add2=$row_edit['Address2'];
    $co_e_id=$row_edit['Sup_Email_id'];
    $area=$row_edit['Area_id'];
	$area_name="select Area_name from area where Area_id='$area'";
    $run_cat1=mysqli_query($conn,$area_name);
	while($row=mysqli_fetch_array($run_cat1))
		{
			$Area_name1=$row['Area_name'];
		}
    echo "<script>alert('$Area_name1')</script>";
    $com_id=$row_edit['Company_id'];
    $company_name="select Company_name from company where company_id='$com_id'";
    $run_cat2=mysqli_query($conn,$company_name);
	while($row=mysqli_fetch_array($run_cat2))
				{
					$com_name1=$row['Company_name'];
				}
                   $gst_no=$row_edit['GST_NO'];        
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#s_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_sup_name.php",{brand_name: brand_check},function(data)
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
<script type="text/javascript">
	$(document).ready(function(){
		$('#c_num').keyup(function(){
				var con_check=$(this).val();
				$('#con_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_sup_contact.php",{brand_name: con_check},function(data)
				{
					if(data.status == true)
					{
						$('#con_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#con_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#con_check').html(data.msg);
				},'json');
		});

	});

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#gst').keyup(function(){
				var gst_check=$(this).val();
				$('#gst_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_sup_gst.php",{brand_name: gst_check},function(data)
				{
					if(data.status == true)
					{
						$('#gst_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#gst_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#gst_check').html(data.msg);
				},'json');
		});

	});

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#email').keyup(function(){
				var email_check=$(this).val();
				$('#email_check').html('<img src="loading.gif" width="150"/>');
				$.post("./check_sup_email.php",{brand_name: email_check},function(data)
				{
					if(data.status == true)
					{
						$('#email_check').parent('div').removeClass('has-error').addClass('has-success');
					}	
					else
					{
						$('#email_check').parent('div').removeClass('has-success').addClass('has-error');
					}
					$('#email_check').html(data.msg);
				},'json');
		});

	});

</script>
</head>
<body>

<form action="" method="post">
  <div class="container">
    <h1>ADD SUPPLIER</h1>
<hr>
    <label for="name"><b>Enter Supplier Name</b></label>
    <input type="text" placeholder="Enter Name" name="s_name" id="s_name" required value="<?php echo $s_name;?>">
     <span id='brand_check' class="help-block"></span>

	<label for="contact"><b>Enter Contact </b></label>
        <input type="text" placeholder="Contact Number" name="c_num" id="c_num" required value="<?php echo  $s_con;?>">
         <span id='con_check' class="help-block"></span>
        <label for="address"><b>Address1</b></label>
	<input type="text" name="add1" value="<?php echo $su_add1;?>">
        
	<label for="add2"><b>Address2</b></label>
        <input type="text" name="add2" value="<?php echo $su_add2;?>">
        	<label for="email"><b>Email</b></label>
	<input type="text" placeholder="Email" name="email" id="email" value="<?php echo $co_e_id;?>">
	<span id='email_check' class="help-block"></span>
	<label for="area"><b>Select Area</b></label>
	<select name="area1" required>
	  <option disabled="disabled" selected="selected" value="<?php echo $area;?>"><?php echo $Area_name1;?></option>
          
<?php
include ("./db.php");
$query="select *  from area";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Area_name"];
	echo "<option value='$var'>".$row["Area_name"]."</option>";
}	
?>
</select>
<label for="company"><b>Select Company</b></label>
	<select name="company" required>
	  <option disabled="disabled" selected="selected" value="<?php echo $com_id;?>"><?php echo $com_name1;?></option>
<?php
include ("./db.php");
$query="select *  from company";
$result=mysqli_query($conn,$query);
while($row=mysqli_fetch_assoc($result))
{
	$var=$row["Company_name"];
	echo "<option value='$var'>".$row["Company_name"]."</option>";
}	
?>
</select>
<label for="gst"><b>GST_NO</b></label>
	<input type="text" placeholder="GST Number" id="gst" name="gst" required value="<?php echo $gst_no;?>">
	<span id='gst_check' class="help-block"></span>
	<hr>
    <input type="submit" class="registerbtn" name="submit" value="UPDATE">
  </div>
  </form>
  
  <?php
  $link=9;
include("./db.php");
if(isset($_POST['submit']))
{
	

	if(empty($_POST['s_name']) || empty($_POST['c_num']) || empty($_POST['add1']) || empty($_POST['email']) || empty($_POST['area1']) || empty($_POST['company']) || empty($_POST['gst']))
	{
		echo "<script>alert('PLEASE ENTER THE ALL FIELD');</script>";
	}
	else
	{
		 $s_name=$_POST['s_name'];
	$con=$_POST['c_num'];
	$add=$_POST['add1'];
	$add1=$_POST['add2'];
	$email=$_POST['email'];
	$area2=$_POST['area1'];
	$company=$_POST['company'];
	$gst=$_POST['gst'];	
		function val_gst()
		{
			$gst=$_POST['gst'];
			if(strlen($gst)==15)
			{
				return 1;
			}
			else{
			 echo "<script type='text/javascript'>alert('Invalid GST Number')</script>";
			}
		}
		$num=val_gst();
		if($num==1)
		{
   			$qup="select * from supplier where Supplier_name='$s_name' and Sup_contact='$con' and Sup_Email_id='$email' and GST_NO='$gst'";
			$dupquery=mysqli_query($conn,$qup);
			if(mysqli_num_rows($dupquery)>0)
			{
				echo "<script>alert('Supplier Data is already exists.')</script>";
			}
			else
			{
				$query="select * from area where Area_name like '$area2'";
				$execute=mysqli_query($conn,$query);
				while($row=mysqli_fetch_array($execute))
				{
					$id1=$row['Area_id'];
				}
				$query1="select * from company where Company_name like '$company'";
				$execute1=mysqli_query($conn,$query1);
				while($row1=mysqli_fetch_array($execute1))
				{
					$id2=$row1['company_id'];
				}
					$query12="update supplier set Supplier_name='$s_name',Sup_contact='$con',Address1='$add',Address2='$add1',Sup_Email_id='$email',Area_id='$id1',Company_id='$id2',GST_NO='$gst' where Supplier_id='$update_id'  ";
					$execute2=mysqli_query($conn,$query12);
					if($execute2)
					{
						echo "<script>alert('Supplier has been updated ')</script>";
						echo "<script>window.open('../index.php?link=$link','_self')</script>";
        			}
       		}//else close
    	}//gst if close
	}//submit if close
}
?>

</body>
</html>

 