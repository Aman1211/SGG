 <html>
   <head>
     <title>Open Data Table</title>
     <script src="jsjquery-2.2.4.js"></script>
     <script src="js/OpenDataTable.js"></script>

<link href="./css/style.css" rel="stylesheet">

     <script type="text/javascript">
    $(document).ready(function(){
      $(".OpenDataTable").OpenDataTable({  
        url:"data.php",
      });
    });
     </script>
   </head>
   <body>
     <table class="OpenDataTable table strip table-striped table-bordered">
	       <thead>
		       <tr>
			        <th>City</th>
			        <th>Name</th>
		        </tr>
	       </thead>
       <tbody></tbody>
     </table>
   </body>
 </html>

