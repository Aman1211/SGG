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
<?php  

function get_row_count(){
include "./db.php";
	$sql="select count(*)  AS rows from product";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result))
	{
		$row=mysqli_fetch_array($result);
		return $row['rows'];
	}
	return 0;
}
function display_content($offset,$total){
	include "./db.php";
	$link=$_GET['link'];
	$sql="select Product_name from product where Subcategory_id=$link LIMIT $offset,$total";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)){
		while($row=mysqli_fetch_array($result))
		{
			echo $row['Product_name'];echo'<br/>';
		}

	}
	else
		{
			echo "No data exists";
			
		}


}
function pagination($link){
	$link=$link;
	echo "<script>alert ('$link');</script>";
$pagination_buttons=2;
$page_number=(isset($_GET['page']) and !empty($_GET['page']))? $_GET['page']:1;
$per_page_records=3;
$rows=get_row_count();
$last_page=ceil($rows/$per_page_records);
$pagination='';
$pagination .='<nav aria-label="">';
$pagination .= '<ul class="pagination">';

if($page_number<1){
$page_number=1;
}
elseif($page_number>$last_page){
	$page_number=$last_page;
}
echo '<h3> Showing page: '.$page_number.' / '.$last_page.'</h3>';

display_content(($page_number-1),$per_page_records);

$half=$pagination_buttons/2;
if($page_number < $pagination_buttons and ($last_page==$pagination_buttons or $last_page > $pagination_buttons)){
	for($i=1;$i<=$pagination_buttons;$i++){
		if($i==$page_number){
			$pagination .= '<li class="active">';
			$pagination .= '<a href="product.php?link='.$link.'&page='.$i.'">' .$i.' <span class="sr-only">(current)</span></a></li>';
		}
		else
		{
			$pagination .= '<li><a href="product.php?link='.$link.'&page='.$i.'">'.$i.'</a></li>';
		}
	}
	if($last_page > $pagination_buttons){
		$pagination .= '<li><a href="product.php?link='.$link.'&page='.($pagination_buttons+1).'">&raquo;</a></li>';
	}
}
elseif($page_number>= $pagination_buttons and $last_page > $pagination_buttons){
	if(($page_number+$half) >= $last_page){
	$pagination.= '<li><a href="product.php?link='.$link.'&page='.($last_page-$pagination_buttons).'">&laquo;</a></li>';
	for($i=($last_page-$pagination_buttons)+1; $i<=$last_page; $i++){
		if($i==$page_number){
				$pagination .= '<li class="active">';
			$pagination .= '<a href="product.php?link='.$link.'&page='.$i.'">' .$i.' <span class="sr-only">(current)</span></a></li>';
		}
		else
		{
			$pagination .= '<li><a href="product.php?link='.$link.'&page='.$i.'">'.$i.'</a></li>';
		}

	}
}
elseif(($page_number+$half)< $last_page){
	$pagination .= '<li><a href="product.php?link='.$link.'&page='.(($page_number-$half)-1).'">&laquo;</a></li>';
	for($i=($page_number-$half); $i<=($page_number+$half); $i++){
		if($i==$page_number){
				$pagination .= '<li class="active">';
			$pagination .= '<a href="product.php?link='.$link.'&page='.$i.'">' .$i.' <span class="sr-only">(current)</span></a></li>';
		}
		else
		{
			$pagination .= '<li><a href="product.php?link='.$link.'&page='.$i.'">'.$i.'</a></li>';
		}

	}
	$pagination .= '<li><a href="product.php?link='.$link.'&page='.(($page_number-$half)+1).'">&raquo;</a></li>';

}
	
}
$pagination .='</ul>';
$pagination .='</nav>';

echo $pagination;

}
?>