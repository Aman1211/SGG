<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <!-- <LABEL for="hp" name="hardik"  data-toggle="modal" data-target="#myModal">HARDIK</LABEL>-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="FONT">COMPALIAN</h4>
        </div>
        <div class="modal-body">
        <form>
        <tr>
        	<td><label for="PRODUCT NAME">PRODUCT NAME</label><td>
            <td><select class="form-control"><option class="form-control">1</option><option>1</option><option>1</option><option>1</option></select></td>
        </tr>
        <tr>
        	<td><label for="PRODUCT NAME">Description</label><td><br/>
            <td><textarea class="form-control" rows="4" cols="50"></textarea></td>
        </tr>
        <tr>
        	<input type="submit" name="submit" id="submit" value="submit" class="btn btn-info btn-block"/>
            <input type="submit" name="reset" id="reset" value="RESET" class="btn btn-info btn-block"/>
        </tr>
        </form>
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

</body>
</html>