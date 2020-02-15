<?php
	include("./db.php");
	if(isset($_GET['edit_l'])){
		$edit_brand=$_GET['edit_l'];
		$qu="select * from labour_type where Labour_type_id='$edit_brand'";
		$run_query=mysqli_query($conn,$qu);
		$row_edit=mysqli_fetch_array($run_query);
		$update_id=$row_edit['Labour_type_id'];
		$Brand_name=$row_edit['Labour_type_name'];
		}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">

<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#b_name').keyup(function(){
				var brand_check=$(this).val();
				$('#brand_check').html('<img src="loading.gif" width="150"/>');
				$.post("./view/check_labour_type.php",{brand_name: brand_check},function(data)
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

  </head>
<body>

<form action="" method="post">
  <div class="from-group">
    <h1>UPDATE LABOUR TYPE</h1>
<hr>
    <label for="exampleInputEmail1"><b>LABOUR TYPE NAME</b></label>
    <input type="text" placeholder="Labour_type_name" class="from-group" name="b_name" id="b_name" required value="<?php echo $Brand_name;?>" onkeypress="return (event.charCode>64 && event.charCode<91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)"/><br>
    <span id='brand_check' class="help-block"></span>

	<hr>
	 <input type="submit" class="registerbtn" name="submit" value="UPDATE">
	 <input type="submit" class="registerbtn" value="Cancel" name="Cancel">
  </div>
  </form>
  <?php
	$link=32;
if(isset($_POST['Cancel'])){echo"<script>window.open('./index.php?link=$link','_self')</script>"  ;}
if(isset($_POST['submit']))
{


		$b_name=$_POST['b_name'];
	
		$query1="update labour_type set Labour_type_name='$b_name' where Labour_type_id='$edit_brand'";
		$execute=mysqli_query($conn,$query1);
		if($execute)
		{
			echo "<script>alert('Labour Type has been updated ')</script>";
			//echo "<script>window.open('../index.php?link=$link','_self')</script>";
      		echo"<script>window.open('./index.php?link=$link','_self')</script>";    
       	}   
       	
       }mysqli_close($conn);
	?>
  </body>
  </html>
  
	