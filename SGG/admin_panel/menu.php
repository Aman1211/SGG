<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
}

.navbar {
  overflow: hidden;
  background-color:rgba(0,0,0,.5);
  font-family: Arial, Helvetica, sans-serif;
}

.navbar a {
  float: left;
  font-size: 16px;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

.dropdown {
float:left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 16px;  
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font: inherit;
  margin: 0;
}

.navbar a:hover, .dropdown:hover .dropbtn {
  background-color: red;
}

.dropdown-content {
  display: none;
  position: absolute;
  background:url("hello.jpg");background-repeat:no-repeat;background-position:center; background-size:cover;

  width: 30%;
  left: 0;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content .header {
  background: red;
  padding: 16px;
  color: white;
}

.dropdown:hover .dropdown-content {
  display: block;
}

/* Create three equal columns that floats next to each other */
.column {
  float: right;
  width: 50%;
  padding: 10px;
   background:url("hello.jpg");background-repeat:no-repeat;background-position:center;

  height: 500px;
}

.column a {
  float: none;
  color: black;
  padding: 16px;
  text-decoration: none;
  display: block;
  text-align: left;
  font-size:20px;
}

.column a:hover {
  background-color: #ddd;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    width: 20%;
    height: auto;
  }
}
</style>
</head>
<body>

<div class="navbar">
  <a href="#home">Home</a>
  <a href="#news">News</a>
  <div class="dropdown">
    <button class="dropbtn">Dropdown 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <div class="header">
        <h2>Mega Menu</h2>
      </div> 
      <div class="row"> 
      <?php
include 'db.php';
$sql="Select * from category";
$result=mysqli_query($conn,$sql);

while($row=mysqli_fetch_array($result))
{
    $cat_id=$row['Category_id'];
    $cat_name=$row['Category_name'];
    $sql2="select * from subcategory where Category_id='$cat_id'";
    $result2=mysqli_query($conn,$sql2);
    ?>

     
        <div class="column">
          <h3><?php echo $cat_name ?></h3>
          <?php
    while($row2=mysqli_fetch_array($result2))
    {
      $sub=$row2['Subcategory_name'];
      ?>
           
          <a href="#"><?php echo $sub ?></a>
        
        
      <?php 
    }
    ?>
  </div>
    <?php
} 
?> 
      </div>
    </div>
  </div> 
</div>

<div style="padding:16px">
  <h3>Responsive Mega Menu (Full-width dropdown in navbar)</h3>
  <p>Hover over the "Dropdown" link to see the mega menu.</p>
  <p>Resize the browser window to see the responsive effect.</p>
</div>

</body>
</html>
