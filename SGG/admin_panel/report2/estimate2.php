<?php
//SHOW A DATABASE ON A PDF FILE
//CREATED BY: Carlos Vasquez S.
//E-MAIL: cvasquez@cvs.cl
//CVS TECNOLOGIA E INNOVACION
//SANTIAGO, CHILE

require('fpdf.php');

//Connect to your databasew
include('../db.php');

//Select the P.roducts you want to show in your PDF file
$result=mysqli_query($conn,"select Area_name,City_name from area a,city c where a.City_id=c.City_id");
$number_of_products = mysqli_num_rows($result);

//Initialize the 3 columns and the total
$column_code = "";
$column_name = "";



//For each row, add the field to the corresponding column
while($row = mysqli_fetch_array($result))
{
    $code = $row["Area_name"];

    $real_price = $row["City_name"];


    $column_code = $column_code.$code."\n";
    $column_name = $column_name.$real_price."\n";

    //Sum all the Prices (TOTAL)
}
mysqli_close($conn);

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.

//Create a new PDF file

class pdf extends fpdf{
    function Header()
{
    // Logo
    $this->Image('sgg.jpg',10,-1,30);
    // Arial bold 15
   global $title;
$title="SHREE GURUKRUPA GLASS TRADERS";
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    //3 width of title and position
    $w =200;
    $this->SetX(35);
    // Colors of frame, background and text
    $this->SetDrawColor(0,0,0);
    $this->SetFillColor(126,192,238);
    $this->SetTextColor(0,0,0);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,15,$title,1,1,'C',true);
    // Line break
    $this->Ln(10);
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);      
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'@ALL RIGHT RESERVED Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}
$pdf=new pdf();
$pdf->AddPage();

//Fields Name position
$Y_Fields_Name_position =25;
//Table position, under Fields Name
$Y_Table_Position = 32;

//First create each Field Name
//Gray color filling each Field Name box
$pdf->SetFillColor(50,45,150);
//Bold Font for Field Name
$pdf->SetFont('Arial','B',12);
$pdf->SetY($Y_Fields_Name_position);
$pdf->SetX(45);
$pdf->Cell(50,6,'CODE',1,0,'L',1);
$pdf->SetX(70);
$pdf->Cell(100,6,'NAME',1,0,'L',1);
$pdf->Ln();

//Now show the 3 columns
$pdf->SetFont('Arial','',12);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(45);
$pdf->MultiCell(50,6,$column_code);
$pdf->SetY($Y_Table_Position);
$pdf->SetX(70);
$pdf->MultiCell(100,6,$column_name,1);
$pdf->SetY($Y_Table_Position);

//Create lines (boxes) for each ROW (Product)
//If you don't use the following code, you don't create the lines separating each row
$i = 0;
$pdf->SetY($Y_Table_Position);
while ($i < $number_of_products)
{
    $pdf->SetX(45);
    $pdf->MultiCell(120,6,'',1);
    $i = $i +1;
}

$pdf->Output();
?>