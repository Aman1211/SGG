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
				$this->settitle('Quotation');
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
			$this->ln();
			$this->setfont('Arial','B',12);
			$this->Cell(195,10,'SGG QUOTATION',1,0,'C');

			$this->ln();
		
			$this->ln();
$this->setfont('Arial','B',9);
			$this->Cell(50,10,'CUSTOMER NAME',1,0,'C');
			$this->Cell(50,10,'REQUEST DATE',1,0,'C');
			$this->Cell(50,10,'GENERATION DATE',1,0,'C');
			$this->Cell(45,10,'AREA',1,0,'C');
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
				$newDate = date("d-m-Y", strtotime($date));
				$this->ln();
			$this->Cell(50,10,$f_name." ".$l_name,1,0,'C');
			$this->Cell(50,10,$newDate,1,0,'C');
			$this->Cell(50,10,$date1,1,0,'C');
			$this->Cell(45,10,$area_name,1,0,'C');
			$this->ln();
			$this->ln();
	
					
			
				
			
			$this->setfont('Arial','B',9);
					
			$this->Cell(10,10,'SRNO',1,0,'C');
			$this->Cell(30,10,'PRODUCT NAME',1,0,'C');
			$this->Cell(20,10,'QTY',1,0,'C');
			$this->Cell(15,10,'HEIGHT',1,0,'C');
			$this->Cell(15,10,'WIDTH',1,0,'C');
			$this->Cell(20,10,'PRICE',1,0,'C');
			$this->cell(20,10,'SQ-FEET',1,0,'C');
			$this->cell(20,10,'RATE',1,0,'C');
			$this->cell(25,10,'LABOUR RATE',1,0,'C');
			$this->Cell(20,10,'TOTAL',1,0,'C');
			
		}
		function viewtable()
		{
					$sq=unserialize($_GET['array1']);
$pr=unserialize($_GET['array2']);
if(isset($_GET['array3']))
{
$lab=unserialize($_GET['array3']);
}
			require'../db.php';
			$this->SetFont('Arial','',12);
				$id=get();
			$query1="select * from product p,customer_requirement c where c.Customer_req_id='$id' and p.Product_id=c.Product_id";
			$result=mysqli_query($conn,$query1);
			$i=1;
			$b=0;
				$total=0;
				$lab_total=0;
				$final1=0;
			while($row=mysqli_fetch_array($result))
			{
				$price1=$pr[$b];
				if(isset($_GET['array3'])){
				$lab_rate=$lab[$b];

			}
			else
			{
					$lab_rate=$row['lab_rate'];
			}
				$h=$row['Size_Height'];
				$w=$row['Size_Width'];
				$qty=$row['qty'];
				$sq_ft=$row['sq_feet'];
				$sq_ft=$sq_ft;
	
				//echo "<script> alert('$h_n $w_n'); </script>";

				$price=($sq_ft* $price1);
				$total+=$price;
				$lab_total+=$lab_rate;
				$final=$lab_rate*$sq_ft;
					$final1+=$final;
				$this->ln();

				$this->setfont('Arial','B',9);
				
			$this->Cell(10,10,$i,1,0,'C');
			$this->Cell(30,10,$row['Product_name'],1,0,'C');
			$this->Cell(20,10,$row['qty'],1,0,'C');
			$this->Cell(15,10,$row['Size_Height'],1,0,'C');
			$this->Cell(15,10,$row['Size_Width'],1,0,'C');
			$this->Cell(20,10,$price1,1,0,'C');
			$this->Cell(20,10,$sq_ft,1,0,'C');

			if($lab_rate=='')
			{
			$this->cell(20,10,0,1,0,'C');
		}else{
			$this->cell(20,10,$lab_rate,1,0,'C');
		}
			$this->Cell(25,10,$final,1,0,'C');
			$this->Cell(20,10,$price,1,0,'C');
			$this->setFillcolor(184,204,275);

			$i++;
			$b++;
			}
			$grand=$final1+$total;
			$this->ln();
			$this->Cell(150,10," QUOTATION TOTAL",1,0,'C');
			$this->Cell(25,10,$final1,1,0,'L');
			$this->Cell(20,10,$total,1,0,'L');
			$this->ln();
			$this->Cell(150,10," GRAND TOTAL",1,0,'C');
			$this->Cell(45,10,$grand,1,0,'C');
		}
	}
		function get()
	{
		if(isset($_GET['id']))
	{
		$link=$_GET['id'];

		return $link;
	}
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
// main header
		// email stuff (change data below)


	?>