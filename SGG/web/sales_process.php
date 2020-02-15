<?php
include 'db.php';
$r_id=$_GET['link'];
$mode=$_GET['mode'];
$type=$_GET['type'];
$sales_id="";
$result1="";
$sq="";
$total=0;
$query="update request set status=2 where Request_id='$r_id'";
mysqli_query($conn,$query);
	$d=date("Y-m-d");
	$query1="INSERT INTO `sales`(`Sales_date`, `Request_id`) VALUES ('$d','$r_id')";
	$result=mysqli_query($conn,$query1);
	if($result)
	{
		$query2="select max(Sales_id) from sales";
		$result2=mysqli_query($conn,$query2);
		while($row=mysqli_fetch_array($result2))
		{
				$sales_id=$row[0];
		}
		$query3="select * from customer_requirement where Customer_req_id='$r_id'";
		$result2=mysqli_query($conn,$query3);
		while($row3=mysqli_fetch_array($result2))
		{
			$pro=$row3['Product_id'];
			$qty=$row3['qty'];
			$s=$row3['Size_Height']; 
			$h=$row3['Size_Width'];
			$sq=$row3['sq_feet'];
			$query5="select Price from product where Product_id='$pro'";
			$result5=mysqli_query($conn,$query5);
			$price="";
			while($row5=mysqli_fetch_array($result5))
			{
				

					$price=$row5['Price'];
					
				}
				$query4="INSERT INTO `sales_detail`(`sales_id`, `Product_id`, `Qty`,`Price`,`height`,`widht`,`sqfeet`) VALUES ('$sales_id','$pro','$qty','$price','$s','$h','$sq')";
				$result1=mysqli_query($conn,$query4);

		}		
		if($result1)
		{
			 $mob="select labour from request where Request_id in(select Request_id from sales where Sales_id='$sales_id')";
        $ri=mysqli_query($conn,$mob);
        $invi="";
        while($su=mysqli_fetch_array($ri))
        {
            $invi=$su['labour'];
        }

			$pr="";

				$query6="select Price from sales_detail where sales_id='$sales_id'";
				$result6=mysqli_query($conn,$query6);
				while($row6=mysqli_fetch_Array($result6))
				{

							$pr=$row6['Price'];
						
							$amt=$pr*$sq;
							$total=$total+$amt;

						

				}
						$cgst=($total*18)/100;
						$total=$total+$cgst;

					if($mode=='Cash' and $type=='Advance')
					{

						$amount=($total*30)/100;
							$query7="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`) VALUES ('$sales_id','$amount','18','$d',1)";
							$result7=mysqli_query($conn,$query7);
							if($result7)
							{

			echo "<script> alert('Thanks! Your Order has been Confirmed');</script>";
           if($invi==0)
           {
           			echo "<script> window.open('../admin_panel/view/invoice.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";

           }
           else
           {

	echo "<script> window.open('../admin_panel/view/invoice1.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";
           }
			echo "<script>  location.href='./index.php'</script>";
							}
					} 
					elseif($mode=='Cash' and $type=='Full')
					{
						$amount=$total;
							$query7="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`) VALUES ('$sales_id','$amount','18','$d',1)";
							$result7=mysqli_query($conn,$query7);
							if($result7)
							{
								echo "<script> alert('Thanks! Your Order has been Confirmed');</script>";
								 if($invi==0)
           {
           			echo "<script> window.open('../admin_panel/view/invoice.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";

           }
           else
           {

	echo "<script> window.open('../admin_panel/view/invoice1.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";
           }
			echo "<script>  location.href='./index.php'</script>";
							}
					}
					elseif($mode=='Cheque' and $type=='Advance')
					{
						$amount=($total*30)/100;
							$query7="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`) VALUES ('$sales_id','$amount','18','$d',2)";
							$result7=mysqli_query($conn,$query7);
							if($result7)
							{

			echo "<script> alert(' Thanks! Your Order has been Confirmed');</script>";
			 if($invi==0)
           {
           			echo "<script> window.open('../admin_panel/view/invoice.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";

           }
           else
           {

	echo "<script> window.open('../admin_panel/view/invoice1.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";
           }
			echo "<script>  location.href='./index.php'</script>";
							}

					}
					elseif($mode=='Cheque' and $type=='Full')
					{
						$amount=$total;
							$query7="INSERT INTO `sales_payment`( `Sales_id`, `Amount`, `GST`, `Payment_date`, `Payment_type_id`) VALUES ('$sales_id','$amount','18','$d',2)";
							$result7=mysqli_query($conn,$query7);
							if($result7)
							{

			echo "<script> alert('Thanks! Your Order has been Confirmed');</script>";
			 if($invi==0)
           {
           			echo "<script> window.open('../admin_panel/view/invoice.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";

           }
           else
           {

	echo "<script> window.open('../admin_panel/view/invoice1.php?s_id='<?php echo $sales_id;?>',target='_blank');  </script>";
           }
			echo "<script>  location.href='./index.php'</script>";
							}
					}




			

		}

	}
?>