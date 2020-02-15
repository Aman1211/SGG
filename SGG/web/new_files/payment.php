<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Simple PHP Contact Form</title>
    <meta name="HandheldFriendly" content="true">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1,user-scalable=no">
    <style>
    .wrapper {
    margin: 47px auto;
    max-width:580px;
}
 
#contact_form {
    text-shadow:0 1px 0 #FFF;
    border-radius:4px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    background:#F9F9F9;
    padding:25px;
 
}
 
#ff label {
    cursor:pointer;
    margin:4px 0;
    color:#ed7700;
    display:block;
    font-weight:800;
 
}
 
select {
    display:block;
    width:90%;
    border-radius:4px;
    -webkit-border-radius:4px;
    -moz-border-radius:4px;
    background-color:#f4f4f4;
    color:#000;
    border:1px solid #5f5f5f;
    padding:10px;
    margin-bottom:25px;
}
 
.sendButton {
    cursor:pointer;
    -moz-box-shadow:inset 0px 1px 0px 0px #fce2c1;
    -webkit-box-shadow:inset 0px 1px 0px 0px #fce2c1;
    box-shadow:inset 0px 1px 0px 0px #fce2c1;
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ffc477), color-stop(1, #fb9e25) );
    background:-moz-linear-gradient( center top, #ffc477 5%, #fb9e25 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffc477', endColorstr='#fb9e25');
    background-color:#ffc477;
    -webkit-border-radius:16px;
    -moz-border-radius:16px;
    border-radius:16px;
    border:1px solid #eeb44f;
    color:#ffffff;
    font-family:Arial;
    font-size:14px;
    width:25%;
    font-weight:bold;
    text-shadow:1px 1px 0px #cc9f52;
}
.sendButton:hover {
    background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #fb9e25), color-stop(1, #ffc477) );
    background:-moz-linear-gradient( center top, #fb9e25 5%, #ffc477 100% );
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fb9e25', endColorstr='#ffc477');
    background-color:#fb9e25;
}
</style>
</head>
 
<body>
  <div class="wrapper">  
    <div id="contact_form">
    <form name="form1" id="ff" method="post" action="">
    <center><h1>Payment Mode</h1></center>
    
        <label>
        <span>SELECT:</span>
        <select name="payment">
            <option>Cash</option>
            <option>Cheque</option>
            <option>Online</option>
        </select>
        </label>
         
       
       
        <input class="sendButton" type="submit" name="Submit" value="Send">
             
    </form>
    </div>
   </div>
 
</body>
</html>