<?php  
 function fetch_data()  
 {  
      $output = '';  
      $conn = mysqli_connect("localhost", "root", "", "sgg1");  
      $sql = "SELECT * FROM customer_requirement c,product p where c.Customer_req_id=2 and c.Product_id=p.Product_id";  
      $result = mysqli_query($conn, $sql);  
      while($row = mysqli_fetch_array($result))  
      {       
      $output .= '<tr>  
                          <td>'.$row["Product_name"].'</td>  
                          <td>'.$row["qty"].'</td>  
                          <td>'.$row["Size_Height"].'</td>  
                          <td>'.$row["Size_Width"].'</td>    
                     </tr>  
                          ';  
      }  
      return $output;  
 }  
 if(isset($_POST["generate_pdf"]))  
 {  
  include('tcpdf/tcpdf.php');
      require_once('tcpdf/fonts/times.php'); 
      require_once('tcpdf/fonts/timesb.php');
      require_once('tcpdf/fonts/timesbi.php');
      require_once('tcpdf/fonts/timesi.php');
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP");
      $PDF_HEADER_LOGO = "sgg.jpg";//any image file. check correct path.
$PDF_HEADER_LOGO_WIDTH = "50";
$PDF_HEADER_TITLE = "SHREE GURUKRUPA GLASS TRADERS";
$PDF_HEADER_STRING = "Tel 1234567896 Fax 987654321\n"
. "E abc@gmail.com\n"
. "www.abc.com";

  
    $obj_pdf->SetHeaderData($PDF_HEADER_LOGO, $PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);
  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));   
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(true);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h4 align="center">SGG QUOTATION</h4><br /> 
      <table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
                <th width="45%">PRODUCT NAME</th>  
                               <th width="10%">QTY</th>  
                               <th width="10%">HEIGHT</th>  
                               <th width="10%">WIDTH</th>  
                               <th width="20%">PRICE </th> 
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      $obj_pdf->Output('file.pdf', 'I');  
 }  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>SoftAOX | Generate HTML Table Data To PDF From MySQL Database Using TCPDF In PHP</title>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />            
      </head>  
      <body>  
           <br />
           <div class="container">  
                <h4 align="center"> SGG QUOTATION</h4><br />  
                <div class="table-responsive">  
                	<div class="col-md-12" align="right">
                     <form method="post">  
                          <input type="submit" name="generate_pdf" class="btn btn-success" value="Generate PDF" />  
                     </form>  
                     </div>
                     <br/>
                     <br/>
                     <table class="table table-bordered">  
                          <tr>  
                               <th width="45%">PRODUCT NAME</th>  
                               <th width="10%">QTY</th>  
                               <th width="10%">HEIGHT</th>  
                               <th width="10%">WIDTH</th>  
                               <th width="20%">PRICE </th> 
                          </tr>  
                     <?php  
                     echo fetch_data();  
                     ?>  
                     </table>  
                </div>  
           </div>  
      </body>  
</html>  