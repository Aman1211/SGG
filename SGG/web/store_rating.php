<?php
session_start();
include "./db.php";
    //if(isset($_POST&#91;'star'&93;)){  
        $star =($_POST['star']);
        $p_id=$_POST['product_id'];

        $p_name="";
        //valid star id array
        $valid_star = array('1','2','3','4','5');
                    
        //show a error message if some hacker (Noobs) try to change the star id
        if(!in_array($star,$valid_star)){
            echo "<b class='r'>Not Stored.</b>";
            exit();
        }
        
        // STORE THE RATING INTO DATABASE
 
        // Display the result
       $d=date("Y-m-d");
        $var=$_SESSION['username'];
        $query="select * from  login where USER_NAME='$var'";
        $result=mysqli_query($conn,$query);
       $user_id="";
        while($row=mysqli_fetch_array($result))
        {
                $user_id=$row['USER_ID'];
        }
        
                
         $query3="select * from ratings where user_id='$user_id' and Product_id='$p_id'";
         $result3=mysqli_query($conn,$query3);
         $num=mysqli_num_rows($result3);
         if($num==0)
         {
              
        $query1="INSERT INTO `ratings`(`user_id`, `Product_id`, `Rating`, `Rating_date`) VALUES ('$user_id','$p_id','$star','$d')";
        $result1=mysqli_query($conn,$query1);
        if($result1)
        {
                    echo "<b class='g'>Thanks! You rated this product {$star} Stars .</b>";
        }
    }
    else
    {
            $query4="update ratings set Rating='$star' where user_id='$user_id' and Product_id='$p_id'";
            $result4=mysqli_query($conn,$query4);
            if($result4)
            {
                echo "<b class='g'>Thanks! You rating has been updated to {$star} Stars .</b>";
            }
    }

?>