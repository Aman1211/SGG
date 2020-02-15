<!DOCTYPE html>
<?php $GLOBALS['hp'] = ""; ?>
<html>
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
}

.submenu{
  margin-left: 140px;
  position: absolute;
}

.submenu li{
  margin-bottom: -7px;
}
</style>
</head>
<body>
   
<div class="container">
                                   
  <div class="dropdown">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Category
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
<?php include 'db.php';
  $qu="select * from category";
  $run=mysqli_query($conn,$qu);
  while ($row=mysqli_fetch_array($run)) {
    $cat_name=$row['Category_name'];
    ?>
  
    <li class="dropdown-item">
        <a class="test"  href="?hardik=<?php echo $cat_name ;?>"><?php echo $cat_name; ?> <span class="fa fa-caret-right"></span></a>
        <ul class="submenu">
          <li>abc</li>
          <li>abc1</li>
        </ul>
      
      </li>
      
     <?php } ?></ul>


  </div>
</div>
<?php
        if(isset($_GET['hardik']))  
        {
          $val=$_GET['hardik'];
          echo "<script> alert('$val'); </script>";
        }
?>
<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

</body>
</html>
