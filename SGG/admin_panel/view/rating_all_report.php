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
			$this->Cell(170,10,'RATING REPORT',1,0,'C');
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
					
			$this->Cell(10,10,'SR NO.',1,0,'C');
			$this->Cell(50,10,'CUSTOMER NAME',1,0,'C');
			$this->Cell(50,10,'PRODUCT NAME',1,0,'C');
			$this->Cell(50,10,'RATING',1,0,'C');
			$this->Cell(35,10,'RATING DATE',1,0,'C');
			
			
					
			
		}
		function viewtable()
		{
					//$sq=unserialize($_GET['array1']);	$pr=unserialize($_GET['array2']);

			require'./db.php';
			$this->SetFont('Arial','',12);
				//$id=get();

			$f_id="";$i=1;
				$p_id="";$f_name="";$l_name="";$pro_name="";$rating="";$date="";$u_id="";

				$feed="SELECT * FROM `ratings`";
				$feedrun=mysqli_query($conn,$feed);
				if($feedrun)
				{
					while($feedrow=mysqli_fetch_array($feedrun))
					{
						$u_id=$feedrow['user_id'];
						$p_id=$feedrow['Product_id'];
						$rating=$feedrow['Rating'];
						$date=$feedrow['Rating_date'];
						
						$newDate = date("d-m-Y", strtotime($date));
						
						$sql="SELECT `FirstName`,`LastName` FROM `login` WHERE `USER_ID` LIKE '$u_id'";
						$run=mysqli_query($conn,$sql);
						if($run)
						{
							while ($row=mysqli_fetch_array($run)) {
								$f_name=$row['FirstName'];
								$l_name=$row['LastName'];
								# code...
							}
						}
						$sql1="SELECT `Product_name` FROM `product` WHERE `Product_id` LIKE '$p_id'";
						$run1=mysqli_query($conn,$sql1);
						if($run1)
						{
							while($row1=mysqli_fetch_array($run1)){
								$pro_name=$row1['Product_name'];
							}
						}
						$this->ln();

						$this->setfont('Arial','B',9);
							
						$this->Cell(10,10,$i,1,0,'C');
						
						$this->Cell(50,10,$f_name.$l_name,1,0,'C');
						$this->Cell(50,10,$pro_name,1,0,'C');
						$this->Cell(50,10,$rating,1,0,'C');
						$this->Cell(35,10,$newDate,1,0,'C');
						
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
	?>