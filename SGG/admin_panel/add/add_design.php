<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="add_style.css" type="text/css">
</head>
<body>

<form action="./add/design_upload.php" method="post" enctype="multipart/form-data">
  <div class="container">
    <h1>ADD DESIGN</h1>
<hr>
    <label for="name"><b>Design Name</b></label>
    <input type="text" placeholder="Design Name" name="d_name" autocomplete="off"  onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)|| (event.charCode==32)"required>
	<label for="image"><b>Select Image</b></label><br>
	<input type="file" placeholder="Design  Image" name="fileToUpload" id="fileToUpload"><br>
	 <label for="price"><b>Design Price</b></label>
    <input type="number" placeholder="Design Price" name="d_price" min="1" required>
	<hr>
	 <input type="submit" class="registerbtn" name="submit" value="Insert">
	<button name="cancel" class="registerbtn" onclick="location.href='./index.php?link=27'">Cancel</button>
  </div>
  </form>

  </body>
 
  </html>
  
	