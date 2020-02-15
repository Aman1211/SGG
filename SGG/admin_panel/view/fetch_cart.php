<?php
session_start();
$total_price=0;
$total_item=0;
$output ='<div class="table-responsive" id="order_table"> 
<table class="table table-bordered table-striped"> 
<tr>
<th width="40%">Product Name </th>
<th width="10%">Quantity</th>
<th width="20%">Price</th>
<th width="15%">Total</th>
<th width="5%">Action</th>
</tr>';
if(!empty($_SESSION['shopping_cart']))
{
	foreach($_SESSION['shopping_cart'] as $keys => $values)
	{
		$output .= '
				<tr>
				<td>' .$values["product_name"].'</td>
				<td>'.$values["product_quantity"].'</td>
				<td align="right"> '.$values["product_price"].'</td>
				<td align="right"> '.number_format($values["product_quantity"] * $values["product_price"],2).'</td>
				<td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values['product_id'].'">Remove</button></td>
				</tr>
		';
		$total_item=$total_item+1;
	}

}
else
{
	$output .= '
	<tr>
	<td colspan="5" align="center">
	Your Cart is Empty! 
	</td>
	</tr>';
}
$output.='</table> </div>';
$data=array(
'cart_details'  => $output,
'total_item'  => $total_item);
echo json_encode($data);
?>