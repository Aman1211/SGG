<html>
<head>
  <link rel="stylesheet" type="text/css" href="rating_style.css">
  <script type="text/javascript">
  
   function change(id)
   {
      var cname=document.getElementById(id).className;
      var ab=document.getElementById(id+"_hidden").value;
      document.getElementById(cname+"rating").innerHTML=ab;

      for(var i=ab;i>=1;i--)
      {
         document.getElementById(cname+i).src="star2.png";
      }
      var id=parseInt(ab)+1;
      for(var j=id;j<=5;j++)
      {
         document.getElementById(cname+j).src="star1.png";
      }
   }

</script>
  
</head>

<body>

<h1>Star Rating System Using PHP and JavaScript</h1>

<?php
    $host="localhost";
    $username="root";
    $password="";
    $databasename="sample";

    $connect=mysql_connect($host,$username,$password);
    $db=mysql_select_db($databasename);
	
    $select_rating=mysql_query("select php,asp,jsp from rating");
    $total=mysql_num_rows($select_rating);
  
    while($row=mysql_fetch_array($select_rating))
    {
	  $phpar[]=$php;
	  $aspar[]=$asp;
	  $jspar[]=$jsp;
	  
    }
    $total_php_rating=(array_sum($phpar)/$total);
    $total_asp_rating=(array_sum($aspar)/$total);
    $total_jsp_rating=(array_sum($jspar)/$total);
  
?>

<form method="post" action="insert_rating.php">
  <p id="total_votes">Total Votes:<?php echo $total;?></p>
  <div class="div">
	  <p>PHP (<?php echo $total_php_rating;?>)</p>
	  <input type="hidden" id="php1_hidden" value="1">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="php1" class="php">
	  <input type="hidden" id="php2_hidden" value="2">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="php2" class="php">
	  <input type="hidden" id="php3_hidden" value="3">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="php3" class="php">
	  <input type="hidden" id="php4_hidden" value="4">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="php4" class="php">
	  <input type="hidden" id="php5_hidden" value="5">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="php5" class="php">
  </div>

  <div class="div">
	  <p>ASP (<?php echo $total_asp_rating;?>)</p>
	  <input type="hidden" id="asp1_hidden" value="1">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="asp1" class="asp">
	  <input type="hidden" id="asp2_hidden" value="2">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="asp2" class="asp">
	  <input type="hidden" id="asp3_hidden" value="3">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="asp3" class="asp">
	  <input type="hidden" id="asp4_hidden" value="4">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="asp4" class="asp">
	  <input type="hidden" id="asp5_hidden" value="5">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="asp5" class="asp">
  </div>

  <div class="div">
  	  <p>JSP (<?php echo $total_jsp_rating;?>)</p>
	  <input type="hidden" id="jsp1_hidden" value="1">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="jsp1" class="jsp">
	  <input type="hidden" id="jsp2_hidden" value="2">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="jsp2" class="jsp">
	  <input type="hidden" id="jsp3_hidden" value="3">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="jsp3" class="jsp">
	  <input type="hidden" id="jsp4_hidden" value="4">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="jsp4" class="jsp">
	  <input type="hidden" id="jsp5_hidden" value="5">
	  <img src="images/star1.png" onmouseover="change(this.id);" id="jsp5" class="jsp">
  </div>

  <input type="hidden" name="phprating" id="phprating" value="0">
  <input type="hidden" name="asprating" id="asprating" value="0">
  <input type="hidden" name="jsprating" id="jsprating" value="0">
  <input type="submit" value="Submit" name="submit_rating">

</form> 

</body>
</html>
