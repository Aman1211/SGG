	<?php
	$u_id="";
	$textColour = array( 0, 0, 0 );
$headerColour = array( 100, 100, 100 );
$tableHeaderTopTextColour = array( 255, 255, 255 );
$tableHeaderTopFillColour = array( 125, 152, 179 );
$tableHeaderTopProductTextColour = array( 0, 0, 0 );
$tableHeaderTopProductFillColour = array( 143, 173, 204 );
$tableHeaderLeftTextColour = array( 99, 42, 57 );
$tableHeaderLeftFillColour = array( 184, 207, 229 );
$tableBorderColour = array( 50, 50, 50 );
$tableRowFillColour = array( 213, 170, 170 );
$reportName = "2009 Widget Sales Report";
$reportNameYPos = 160;
$logoFile = "widget-company-logo.png";
$logoXPos = 50;
$logoYPos = 108;
$logoWidth = 110;
$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 80;
$chartXLabel = "Product";
$chartYLabel = "2009 Sales";
$chartYStep = 20000;

$chartColours = array(
                  array( 255, 100, 100 ),
                  array( 100, 255, 100 ),
                  array( 100, 100, 255 ),
                  array( 255, 255, 100 ),
                );

$data = array(
          array( 9940, 10100, 9490, 11730 ),
          array( 19310, 21140, 20560, 22590 ),
          array( 25110, 26260, 25210, 28370 ),
          array( 27650, 24550, 30040, 31980 ),
        );

	require 'fpdf.php';
	
	class mypdf extends fpdf
	{
		function header (){
		
			$this ->Image('sgg_symbol.jpg',10,0,50	,40);
			$this ->SetFont('Arial','B',14);
			$this->Cell(245,5,'SHREE GURUKRUPA GLASS TRADERS',0,1,'C');
			$this->ln();
			$this->setfont('times','',12);
			$this->Cell(245,10,'Nr,Arbuda Shopping center,Opp New Naranpura Police Station,New Vadaj ',0,0,'C');
				$this->ln();
			$this->setfont('times','',12);
			$this->Cell(245,10,'Contact:9601914264',0,0,'C');
			$this->ln();
	
		}
		function footer(){
			$this->sety(-15);
			$this->setfont('Arial','',8);
		$this->Cell(0,1,'COPYRIGHT 2019 SGG ALL RIGHT RESERVED',0,0,'C');	
		 $this->Cell(0,1,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}
		function headertable()
		{
			$d=date('d-m-Y');
			//$this->ln();
			$this->setfont('Arial','B',12);
			$this->Cell(170,10,'PRODUCT SUMMARY REPORT',1,0,'C');
			$this->Cell(25,10,$d,1,0,'C');
			$this->ln();
			$this->ln();
			$this->setfont('Arial','B',12);
			/*$this->Cell(80,10,'CUSTOMER NAME',1,0,'C');
			$this->Cell(80,10,'REQUEST DATE',1,0,'C');
			$this->Cell(70,10,'GENERATION DATE',1,0,'C');
			$this->Cell(50,10,'AREA',1,0,'C');*/
			require'./db.php';
				
			$this->setfont('Arial','B',9);
					
			$this->Cell(15,10,'SR NO.',1,0,'C');
			$this->Cell(30,10,'THICKNESS',1,0,'C');
			$this->Cell(43,10,'PRODUCT',1,0,'C');
			$this->Cell(28,10,'SUBCATEGORY',1,0,'C');
			$this->Cell(30,10,'DESIGN NAME',1,0,'C');
			$this->Cell(30,10,'BRAND NAME',1,0,'C');
			$this->Cell(20,10,'PRICE',1,0,'C');
	}
		function viewtable()
		{
					//$sq=unserialize($_GET['array1']);	$pr=unserialize($_GET['array2']);
			$i=1;
			require'./db.php';
			$this->SetFont('Arial','',12);
				//$id=get();

			$query = "SELECT * FROM product order by Product_id DESC";
			$result = mysqli_query($conn, $query);
			if($result)
				{

		while($row_c=mysqli_fetch_array($result)){


			        $p_id=$row_c['Product_id'];
			        $p_name=$row_c['Product_name'];
			        $design=$row_c['Design_id'];
					$brand=$row_c['Brand_id'];
					$sub=$row_c['Subcategory_id'];
					$thick=$row_c['Price_size_id'];
			        $sql3="select Design_name from design where Design_id='$design'";
					$result3=mysqli_query($conn,$sql3);
					$id2="";
					while($row3=mysqli_fetch_array($result3))
					{
						 $p_d=$row3['Design_name'];
		
					}
					
					$sql4="select Brand_name from brand where Brand_id='$brand'";
					$result4=mysqli_query($conn,$sql4);
					$id3="";
					while($row4=mysqli_fetch_array($result4))
					{
						$p_b=$row4['Brand_name'];
					}
					
					$sql5="select Thickness from price_size where Price_size_id='$thick'";
					$result5=mysqli_query($conn,$sql5);
					$id4="";
					while($row5=mysqli_fetch_array($result5))
					{
						$p_t=$row5['Thickness'];
					}
					$sql6="select Subcategory_name from subcategory where Subcategory_id ='$sub'";
					$result6=mysqli_query($conn,$sql6);
					$id5="";
					while($row6=mysqli_fetch_array($result6))
					{
						$p_c=$row6['Subcategory_name'];
					}
					$p_p=$row_c['Price'];
					

					$this->ln();

						$this->setfont('Arial','B',9);
							
						$this->Cell(15,10,$i,1,0,'C');
						
						$this->Cell(30,10,$p_t,1,0,'C');
						$this->Cell(43,10,$p_name,1,0,'C');
						$this->Cell(28,10,$p_c,1,0,'C');
						$this->Cell(30,10,$p_d,1,0,'C');
						$this->Cell(30,10,$p_b,1,0,'C');
						$this->Cell(20,10,$p_p,1,0,'C');
						$this->setFillcolor(184,204,275);

						$i++;
						//$b++;
					}//end of while
				}//end of if
			
			}//end of view table
		}

	$pdf=new mypdf('P','mm',array(210,297));

$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  
		$pdf->aliasNBPages();
		$pdf->Addpage();
		$pdf->Rect(10, 0, 195, 40, 'D');
		$pdf->Rect(10,0,50,40,'D');
		
		
		$pdf->headertable();
		$pdf->viewtable();
		$pdf->output();
/*		$to = abc();
$from = "aman.sharma122111@gmail.com"; 
$subject = "Quotation of the Product Requested by you,Hope you accept the Quotation"; 
$message = "<p>Please see the attachment.</p>";

// a random hash will be necessary to send mixed content
$separator = md5(time());

// carriage return type (we use a PHP end of line constant)
$eol = PHP_EOL;

// attachment name
$filename = "QUOTATION.pdf";

// encode data (puts attachment in proper format)
$pdfdoc = $pdf->Output("", "S");
$attachment = chunk_split(base64_encode($pdfdoc));
$pdf->Output();
// main header
$headers  = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol; 
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"";

// no more headers after this, we start the body! //

$body = "--".$separator.$eol;
$body .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
$body .= "SGG QUOTATION.".$eol;

// message
$body .= "--".$separator.$eol;
$body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$body .= $message.$eol;

// attachment
$body .= "--".$separator.$eol;
$body .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol; 
$body .= "Content-Transfer-Encoding: base64".$eol;
$body .= "Content-Disposition: attachment".$eol.$eol;
$body .= $attachment.$eol;
$body .= "--".$separator."--";

// send message
mail($to, $subject, $body, $headers);
$a=get();
include '../db.php';
$query10="UPDATE `request` SET status=1 where Request_id='$a'";
mysqli_query($conn,$query10);
mail($to, $subject, $body, $headers);

		//$doc=$pdf->Output('F',$dest);
		// email stuff (change data belo*/
	?>