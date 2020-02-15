	<?php
	
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
			$this ->Image('sgg.jpg',20,-18);
			$this ->SetFont('Arial','B',14);
			$this->Cell(276,5,'SHREE GURUKRUPA GLASS TRADERS',0,1,'C');
			$this->ln();
			$this->setfont('times','',12);
			$this->Cell(276,10,'Nr,Arbuda Shopping center,Opp New Naranpura Police Station,New Vadaj ',0,0,'C');
				$this->ln();
			$this->setfont('times','',12);
			$this->Cell(276,10,'Contact:9601914264',0,0,'C');
			$this->ln();
		}
		function footer(){
			$this->sety(-15);
			$this->setfont('Arial','',8);
		 $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');

		}
		function headertable(){
			$this->ln();
			$this->setfont('Arial','B',12);
			$this->Cell(280,10,'SGG QUOTATION',1,0,'C');
			$this->ln();
			$this->combobox("Aman","Chura");
			$this->ln();
$this->setfont('Arial','B',12);
			$this->Cell(80,10,'CUSTOMER NAME',1,0,'C');
			$this->Cell(80,10,'REQUEST DATE',1,0,'C');
			$this->Cell(70,10,'GENERATION DATE',1,0,'C');
			$this->Cell(50,10,'AREA',1,0,'C');
			require'../db.php';
				$id2=get();
				$f_name="";
				$l_name="";
				$date="";
				$area_name="";
				$query3="select * from request where Request_id='$id2'";
				$result3=mysqli_query($conn,$query3);
				while($row3=mysqli_fetch_array($result3))
				{
					$u_id=$row3['User_id'];
					$date=$row3['Request_date'];
					$sql6="select  FirstName,LastName,Area_id from login where USER_ID='$u_id'";
					$result6=mysqli_query($conn,$sql6);
					while($row6=mysqli_fetch_array($result6))
					{
						$f_name=$row6['FirstName'];
						$l_name=$row6['LastName'];
						$area=$row6['Area_id'];
						$sql="select Area_name from area where Area_id='$area'";
						$result8=mysqli_query($conn,$sql);
						while($row8=mysqli_fetch_array($result8))
						{
								$area_name=$row8['Area_name'];
						}
					}
				}
				$date1 = date('d-m-Y');
				$this->ln();
			$this->Cell(80,10,$f_name." ".$l_name,1,0,'C');
			$this->Cell(80,10,$date,1,0,'C');
			$this->Cell(70,10,$date1,1,0,'C');
			$this->Cell(50,10,$area_name,1,0,'C');
			$this->ln();
			$this->ln();
			$this->setfont('Arial','B',12);
					
			$this->Cell(30,10,'SRNO',1,0,'C');
			$this->Cell(70,10,'PRODUCT NAME',1,0,'C');
			$this->Cell(30,10,'QTY',1,0,'C');
			$this->Cell(30,10,'HEIGHT',1,0,'C');
			$this->Cell(30,10,'WIDTH',1,0,'C');
			$this->Cell(30,10,'PRICE',1,0,'C');
			$this->cell(30,10,'SQ-FEET',1,0,'C');
			$this->Cell(30,10,'TOTAL',1,0,'C');
		}
		function viewtable()
		{
			require'../db.php';
			$this->SetFont('Arial','',12);
				$id=get();
			$query1="select * from product p,customer_requirement c where c.Customer_req_id='$id' and p.Product_id=c.Product_id";
			$result=mysqli_query($conn,$query1);
			$i=1;
				$total=0;
			while($row=mysqli_fetch_array($result))
			{
				$price1=$row['Price'];
				$h=$row['Size_Height'];
				$w=$row['Size_Width'];
				$qty=$row['qty'];
				$h_n=Square_Height($h);
				$w_n=Square_Width($w);
				//echo "<script> alert('$h_n $w_n'); </script>";
				$sq_ft=($h_n*$w_n)/144;
				$price=($sq_ft* $price1)*$qty;
				$total+=$price;
				$this->ln();

				$this->setfont('Arial','B',12);
				
			$this->Cell(30,10,$i,1,0,'L');
			$this->Cell(70,10,$row['Product_name'],1,0,'L');
			$this->Cell(30,10,$row['qty'],1,0,'L');
			$this->Cell(30,10,$row['Size_Height'],1,0,'L');
			$this->Cell(30,10,$row['Size_Width'],1,0,'L');
			$this->Cell(30,10,$price1,1,0,'L');
			$this->Cell(30,10,$sq_ft,1,0,'L');
			$this->Cell(30,10,$price,1,0,'L');
			$this->setFillcolor(184,204,275);

			$i++;
			
			}
			$this->ln();
			$this->Cell(250,10," QUOTATION TOTAL",1,0,'C');
			
			$this->Cell(30,10,$total,1,0,'L');
		}
	}
	function Square_Height($h)
	{
			if($h==0 or $h==6)
			{
				return $h;
			}
			if($h>0 and $h<6)
			{
				return 6;
			}
			if($h==12)
			{
				return $h;
			}
			if($h>6 and $h<12)
			{
				return 12;
			}
			if($h==18)
			{
				return $h;
			}
			if($h>12 and $h<18)
			{
				return 18;
			}
			if($h==24)
			{
				return $h;
			}
			if($h>18 and $h<24)
			{
				return 24;
			}
			if($h==30)
			{
				return $h;
			}
			if($h>24 and $h<30)
			{
				return 30;
			}
			if($h==36)
			{
				return $h;
			}
			if($h>30 and $h<36)
			{
				return 36;
			}
			if($h==42)
			{
				return $h;
			}
			if($h>36 and $h<42)
			{
				return 42;
			}
			if($h==48)
			{
				return $h;
			}
			if($h>42 and $h<48)
			{
				return 48;
			}
			if($h==54)
			{
				return $h;
			}
			if($h>48 and $h<54)
			{
				return 54;
			}
			if($h==60)
			{
				return $h;
			}
			if($h>54 and $h<60)
			{
				return 60;
			}
			if($h==66)
			{
				return $h;
			}
			if($h>60 and $h<66)
			{
				return 66;
			}
			if($h==72)
			{
				return $h;
			}
			if($h>66 and $h<72)
			{
				return 72;
			}
			if($h==78)
			{
				return $h;
			}
			if($h>72 and $h<78)
			{
				return 78;
			}
			if($h==84)
			{
				return $h;
			}
			if($h>78 and $h<84)
			{
				return 84;
			}
			if($h==90)
			{
				return $h;
			}
			if($h>84 and $h<90)
			{
				return 90;
			}
			if($h==96)
			{
				return $h;
			}
			if($h>90 and $h<96)
			{
				return 96;
			}
			if($h==102)
			{
				return $h;
			}
			if($h>96 and $h<102)
			{
				return 102;
			}
			if($h==108)
			{
				return $h;
			}
			if($h>102 and $h<108)
			{
				return 108;
			}
			if($h==114)
			{
				return $h;
			}
			if($h>108 and $h<114)
			{
				return 114;
			}
			if($h==120)
			{
				return $h;
			}
			if($h>114 and $h<120)
			{
				return 120;
			}
			
			
			
			
			
			
	}
	function Square_Width($h)
	{
			if($h==0 or $h==6)
			{
				return $h;
			}
			if($h>0 and $h<6)
			{
				return 6;
			}
			if($h==12)
			{
				return $h;
			}
			if($h>6 and $h<12)
			{
				return 12;
			}
			if($h==18)
			{
				return $h;
			}
			if($h>12 and $h<18)
			{
				return 18;
			}
			if($h==24)
			{
				return $h;
			}
			if($h>18 and $h<24)
			{
				return 24;
			}
			if($h==30)
			{
				return $h;
			}
			if($h>24 and $h<30)
			{
				return 30;
			}
			if($h==36)
			{
				return $h;
			}
			if($h>30 and $h<36)
			{
				return 36;
			}
			if($h==42)
			{
				return $h;
			}
			if($h>36 and $h<42)
			{
				return 42;
			}
			if($h==48)
			{
				return $h;
			}
			if($h>42 and $h<48)
			{
				return 48;
			}
			if($h==54)
			{
				return $h;
			}
			if($h>48 and $h<54)
			{
				return 54;
			}
			if($h==60)
			{
				return $h;
			}
			if($h>54 and $h<60)
			{
				return 60;
			}
			if($h==66)
			{
				return $h;
			}
			if($h>60 and $h<66)
			{
				return 66;
			}
			if($h==72)
			{
				return $h;
			}
			if($h>66 and $h<72)
			{
				return 72;
			}
			if($h==78)
			{
				return $h;
			}
			if($h>72 and $h<78)
			{
				return 78;
			}
			if($h==84)
			{
				return $h;
			}
			if($h>78 and $h<84)
			{
				return 84;
			}
			if($h==90)
			{
				return $h;
			}
			if($h>84 and $h<90)
			{
				return 90;
			}
			if($h==96)
			{
				return $h;
			}
			if($h>90 and $h<96)
			{
				return 96;
			}
			if($h==102)
			{
				return $h;
			}
			if($h>96 and $h<102)
			{
				return 102;
			}
			if($h==108)
			{
				return $h;
			}
			if($h>102 and $h<108)
			{
				return 108;
			}
			if($h==114)
			{
				return $h;
			}
			if($h>108 and $h<114)
			{
				return 114;
			}
			if($h==120)
			{
				return $h;
			}
			if($h>114 and $h<120)
			{
				return 120;
			}
			
			
			
			
			
	}
	function get()
	{
		if(isset($_GET['link']))
	{
		$link=$_GET['link'];
		return $link;
	}
	}
	$pdf=new mypdf();

$pdf->SetTextColor( $headerColour[0], $headerColour[1], $headerColour[2] );
$pdf->SetTextColor( $tableHeaderLeftTextColour[0], $tableHeaderLeftTextColour[1], $tableHeaderLeftTextColour[2] );
  
		$pdf->aliasNBPages();
		$pdf->Addpage('L','A4',0);
		$pdf->Rect(10, 0, 279, 40, 'D');
		$pdf->Rect(10,0,70,40,'D');
		$pdf->Rect(81,0,208.5,40,'D');
		$pdf->headertable();
		$pdf->viewtable();
		$to = "sharma.aman1298@gmail.com"; 
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
$pdf->output();
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

		//$doc=$pdf->Output('F',$dest);
		// email stuff (change data below)


	?>