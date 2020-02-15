<?php 
include 'db.php';
function get_row_count(){

	$sql="select count(*) from AS rows from product";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		$row=mysqli_fetch_assoc($result);
		return $row['rows'];
	}
	return 0;
}?>
<?php
function display_content($offset,$total)
{ ?>
	
        <?php
			$sql="select * from product where Subcategory_id=$link LIMIT $offset,$total";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result))
			{ 
				while($row=mysqli_fetch_array($result))
				{
					$sub_cat_id=$row['Subcategory_id'];
					$sub_query="select * from subcategory where Subcategory_id=$sub_cat_id";
					$sub_query_run=mysqli_query($conn,$sub_query);
					
					while($row2=mysqli_fetch_array($sub_query_run))
					{
						$sub_name=$row2['Subcategory_name'];
					}
					$image_path=$row['image_path'];
					$price=$row['Price'];
					$price_mm=$row['Price_size_id'];
					$p_name=$row['Product_name'];
					$mm="select * from price_size where Price_Size_id=$price_mm";
					$qu=mysqli_query($conn,$mm);
					while($row1=mysqli_fetch_array($qu))
					{
						$mm_name=$row1['Thickness'];
					}?>

                    <div class="col-md-3 col-sm-6">
                        <div class="thumbnail">
                            <a href="cart.php">
                              <img src="./image/<?php echo $image_path ?>" alt="Cannon" style="width:208px;height:260px;">
                            </a>
                            <center>
                                <div class="caption">
                                    <h3><?php echo $p_name ?></h3>
                                    <p><?php echo $mm_name ?></p>
                                    <span>per sq.feet</span><p><?php echo $price ?></p>
                                    <?php
                                    	 if(!isset($_SESSION['email']))
                                    	{  ?>
                                        	<p><a href="login.php" role="button" class="btn btn-primary btn-block">Buy Now</a></p>
                                        	<?php
                                        }
                                        else
                                        {
                                            if(check_if_added_to_cart(1))
                                            {
                                                echo '<a href="#" class=btn btn-block btn-success disabled>Added to cart</a>';
                                            }
                                            else
                                            {
                                                ?>
                                                <a href="cart_add.php?id=1" class="btn btn-block btn-primary" name="add" value="add" class="btn btn-block btr-primary">Add to cart</a>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                            </center>
                        </div>
                    </div>
			<?php}
			}
			else
			{
				echo '<p> No data exists in database</p>';
			}

 }?>

<?php 

function pagination(){
$pagination_buttons=11;
$page_number=(isset($_REQUEST['page']) AND !empty($_REQUEST['page']))? $_REQUEST['page']:1;
$per_page_records=12;
$rows=get_row_count();
$last_page=ceil($rows/$per_page_records);
$pagination='';
$pagination .='<nav aria-label="">';
$pagination .='<ul class="pagination">';

if($page_number<1)
{
	$page_number=1;
}
else if($page_number>$last_page)
{
	$page_number=$last_page;
}

echo '<h3>showing page: '.$page_number.' / '.$last_page.'</h3>';

display_content(($page_number-1),$per_page_records);


$half=floor($pagination_buttons/2);

if($page_number<$pagination_buttons and ($last_page == $pagination_buttons or $last_page>$pagination_buttons))
	{
		for($i=1;$i<=$pagination_buttons;$i++)
		{
			if($i== $page_number){
				$pagination .='<li class="active"><a href="product.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}
			else
			{
				$pagination .='<li><a href="product.php?page='.$i.'">'.$i.'</a></li>';
			}
		}
		if($last_page>$pagination_buttons)
		{	
			$pagination .='<li><a href="product.php>page='.($pagination_buttons+1).'">&raquo;</a></li>';
		}
	}
else if($page_number >=$pagination_buttons and $last_page >$pagination_buttons){
	if(($page_number+$half)>=$last_page)
	{
		$pagination .='<li> <a href="product.php?page='.($last_page - $pagination_buttons).'">&laquo;</a></li>';
		for($i=($last-$pagination_buttons)+1;$i<=$last_page;$i++)
		{
			if($i==$page_number)
			{
			$pagination.='<li class="active"><a href="product.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}
			else
			{
				$pagination .='<li><a href="product.php?page='.$i.'">'.$i.'</a></li>';
			}
		}
	}
	elseif (($page_number+$half)<$last_page) 
	{
		$pagination .='<li> <a href="product.php?page='.(($page_number-$half)-1).'">&laquo;</a></li>';
		for($i=($page_number-$half);$i<=($page_number+$half);$i++)
		{
			if($i==$page_number)
			{
$pagination.='<li class="active"><a href="product.php?page='.$i.'">'.$i.'<span class="sr-only">(current)</span></a></li>';
			}
			else
			{
				$pagination .='<li><a href="product.php?page='.$i.'">'.$i.'</a></li>';
			}
		}
		$pagination .='<li> <a href="product.php?page='.(($page_number-$half)+1).'">&raquo;</a></li>';
	}
}
$pagination .='</nav></ul>';
echo $pagination;
}?>