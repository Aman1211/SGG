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
	
	class mypdf extends fpdf{
		function header (){
			if($this->pageno()==1){
			$this ->Image('sgg_symbol.jpg',10,0,50,40);
			$this ->SetFont('Arial','B',14);
			$this->Cell(250,5,'SHREE GURUKRUPA GLASS TRADERS',0,1,'C');
			$this->ln();
			$this->setfont('times','',12);
			$this->Cell(250,10,'Nr,Arbuda Shopping center,Opp New Naranpura Police Station,New Vadaj ',0,0,'C');
				$this->ln();
			$this->setfont('times','',12);
			$this->Cell(250,10,'Contact:9601914264',0,0,'C');
			$this->ln();
		}
		}
		function footer(){
			$this->sety(-15);
			$this->setfont('Arial','',8);
		 $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}
		function headertable(){
		
			if($this->PageNo()==1){
			$this->ln();
			$this->setfont('Arial','B',20);
			$this->Cell(195,10,'INVOICE',1,0,'C');
			$this->ln();
		
$this->setfont('Arial','B',12);
			$this->Cell(70,5,'Invoice No',1,0,'C');
			
			$this->Cell(70,5,'Invoice Date',1,0,'C');
			

			$this->Cell(55,5,'State',1,0,'C');
			
		
			require'./db.php';
		$id=$_GET['s_id'];
			$no="Sgg-18/19-".$id;
				$this->ln();
			$this->setfont('Arial','B',12);
			$this->Cell(70,5,$no ,1,0,'C');
			$date=date('d/m/Y');
			$this->Cell(70,5,$date ,1,0,'C');
		

			$this->Cell(55,5,"Gujarat" ,1,0,'C');
				$this->ln();
			$this->setfont('Arial','B',9);
			$id=$_GET['s_id'];
$query10="select * from request where Request_id in(select Request_id from sales where Sales_id=$id)";
				$result10=mysqli_query($conn,$query10);
				$gst="";
				$iname="";
				$add="";
				while($row10=mysqli_fetch_array($result10))
				{
						$gst=$row10['gst'];
						$iname=$row10['iname'];
						$add=$row10['Site_address'];
				}
			$this->Cell(50,5,"NAME " ,1,0,'C');
			
			$this->Cell(145,5,$iname,1,0,'C');
			$this->ln();

			$this->Cell(50,20," ADDRESS" ,1,0,'C');
			$this->Cell(145,20,$add ,1,0,'C');
		$this->ln();
				$this->Cell(50,5,"GST" ,1,0,'C');
			
			$this->Cell(145,5,$gst,1,0,'C');
			$this->ln();
			$this->cell(10,10,"SR NO",1,0,'C');
			$this->cell(55,10,"DESCRIPTION",1,0,'C');
			$this->cell(15,10,"HEIGHT",1,0,'C');
			$this->cell(15,10,"WIDTH",1,0,'C');
			$this->cell(20,10,"QTY",1,0,'C');
			$this->cell(20,10,"SQ FEET",1,0,'C');
			$this->cell(20,10,"RATE",1,0,'C');
			$this->cell(15,10,"LABOUR",1,0,'C');
			
			$this->cell(25,10,"AMOUNT",1,0,'C');
			
			
		}
		}
		function viewtable(){
$id=$_GET['s_id'];
						include './db.php';
						$query3="select * from sales_detail where sales_id=$id";
						$result3=mysqli_query($conn,$query3);
						$pro_id="";
						$qty="";
						$price="";
						$height="";
						$width="";
						$sq_feet="";
							$rate="";
							$cgst="";
							$sgst="";
							$total=0;
							$i=1;
							$qty1=0;
							$sq=0;
							$tax=0;
							$c=0;
							$s=0;
							$t=0;
							$lab=0;
							$query45="select Request_id from sales where Sales_id=$id";
							$result45=mysqli_query($conn,$query45);
							$req="";
							while($row45=mysqli_fetch_array($result45))
							{
								$req=$row45['Request_id'];
							}
						while($row3=mysqli_fetch_array($result3))
						{

								$pro_id=$row3['Product_id'];
								$query46="select lab_rate from customer_requirement where Customer_req_id='$req' and Product_id='$pro_id'";
								$result46=mysqli_query($conn,$query46);
								$lab_rate="";
								while($row46=mysqli_fetch_array($result46))
								{	
										$lab_rate=$row46['lab_rate'];
								}
								$lab=$lab+$lab_rate;
								$pro_name="";
								$qty=$row3['Qty'];
								$qty1=$qty1+$qty;

								$price=$row3['Price'];
								$height=$row3['height'];
								$width=$row3['widht'];
								$sq_feet=$row3['sqfeet'];
								$sq=$sq+$sq_feet;

								$rate=($price*$sq_feet)+$lab_rate;
								$tax=$tax+$rate;

								$cgst=($rate*9)/100;
								$c=$c+$cgst;

								$sgst=($rate*9)/100;
								$s=$s+$sgst;

								$total1=$rate+$cgst+$sgst;
								$total=$total+$total1;
								$t=$t+$total;
								$pris="";
								$pris1="";
									$query4="select Product_name,Price_size_id  from product where Product_id='$pro_id'";
									$result4=mysqli_query($conn,$query4);
									while($row4=mysqli_fetch_Array($result4))
									{
											$pro_name=$row4['Product_name'];
											$pris=$row4['Price_size_id'];
											$query20="select Thickness from price_size where Price_Size_id='$pris'";
											$result20=mysqli_query($conn,$query20);
											while($row20=mysqli_fetch_Array($result20))
											{
												$pris1=$row20['Thickness'];
											}
									}
									$this->ln();
								$this->cell(10,10,$i,1,0,'C');
			$this->cell(55,10,$pris1.$pro_name,1,0,'C');
			$this->cell(15,10,$height,1,0,'C');
			$this->cell(15,10,$width,1,0,'C');
			$this->cell(20,10,$qty,1,0,'C');
			$this->cell(20,10,$sq_feet,1,0,'C');
			$this->cell(20,10,$price,1,0,'C');
				$this->cell(15,10,$lab_rate,1,0,'C');
			$this->cell(25,10,$rate,1,0,'C');
			
		
			$i++;
						}

$this->ln();
								$this->cell(95,10,"TOTAL",1,0,'C');
									$this->cell(20,10,$qty1,1,0,'C');
										$this->cell(20,10,$sq,1,0,'C');
											$this->cell(20,10,"",1,0,'C');
												$this->cell(15,10,$lab,1,0,'C');
											$this->cell(25,10,$tax,1,0,'C');
											
			
			
			$this->ln();
			$this->cell(155,5,"TOTAL AMOUNT BEFORE TAX",1,0,'C');
			$this->cell(40,5,$tax+$lab,1,0,'C');
			$this->ln();
			$this->cell(155,5,"CGST",1,0,'C');
			$this->cell(40,5,$c,1,0,'C');
				$this->ln();
			$this->cell(155,5,"SGST",1,0,'C');
			$this->cell(40,5,$s,1,0,'C');
			$this->ln();
			$this->cell(155,5,"TOTAL TAX AMOUNT",1,0,'C');
			$this->cell(40,5,$c+$s,1,0,'C');
			$this->ln();
			$this->cell(155,5,"TOTAL AMOUNT AFTER TAX",1,0,'C');
			$this->cell(40,5,$t,1,0,'C');
			$this->ln();
			$this->cell(155,5,"BANK ACCOUNT NUMBER",1,0,'C');
			$this->cell(40,5,"1279102000003704",1,0,'C');
			$this->ln();
			$this->cell(155,5,"BANK IFSC",1,0,'C');
			$this->cell(40,5,"IBKL0001279",1,0,'C');
			$this->ln();
			$this->cell(155,20,"AUTHORISED SIGNATORY SGG",1,0,'C');
			$this->cell(40,20,"",1,0,'C');
		}
	function get()
	{
		if(isset($_GET['id']))
	{
		$link=$_GET['id'];

		return $link;
	}
	}
		}
		$head=1;
	$pdf=new mypdf('P','mm',array(210,297));
	
$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  
		$pdf->aliasNBPages();
		$pdf->Addpage();
		$pdf->Rect(10, 0, 195, 40, 'D');
		$pdf->Rect(10,0,50,40,'D');
		//$pdf->Rect(81,0,208.5,40,'D');
	
		
		$pdf->headertable();
		
	
		$pdf->viewtable();

		
		$to = "";
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
		// email stuff (change data belo
	?>