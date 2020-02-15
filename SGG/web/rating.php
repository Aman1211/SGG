<?php 
/*include 'db.php';*/
function rating($p_id,$conn){

	$query = "SELECT * from ratings where Product_id=$p_id";
	$statement=mysqli_query($conn,$query);
	$result=mysqli_num_rows($statement);
	$output = '';
	while($row=mysqli_fetch_array($statement)){
	 
		$rating = count_rating($row['Product_id'],$conn);//id as name of the function parameter
		$color = '';
		$output .= '
		<ul class="list-inline" data-rating="' .$rating.'"
		title="Average Rating - ' .$rating.'">
		';

		for($count=1; $count <=5; $count++)
		{
			if($count <= $rating)
			{
				$color = 'color:#ffcc00;';
			}
			else
			{
				$color = 'color:#ccc;';
			}
$output .= '<li title="'.$count.'" id="' .$row['Product_id'].'-'. $count.'" data-index="' .$count.'" data-business_id="'.$row['Product_id'].'" data-rating="'.$rating.'" class="rating" style="cursor:pointer; '.$color.'; font-size:30px;">&#9733;</li>';
		}
		$output .= '
		</ul>

		<hr />';

	}
}	
	
	function count_rating($Product_id, $conn)
	{
		
		$output = 0;
		$query = "SELECT avg(Rating) as Rating FROM ratings WHERE Product_id  = '".$Product_id."'";
		$statement=mysqli_query($conn,$query);
		$result=mysqli_num_rows($statement);
		$total_row=mysqli_num_rows($statement);
		if($total_row > 0)
		{
			while($row=mysqli_fetch_array($statement))
				{
					$out = round($row["Rating"]);
				}
		}
		return $out;
	}?>