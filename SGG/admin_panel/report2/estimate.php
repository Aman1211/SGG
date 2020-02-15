<?php
require('./fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
?>
<table>
	<tr>
		<th> REQUEST ID </th>
		<th> PRODUCT NAME</th>
		<th> HEIGHT </th>
		<th> WIDTH</th>
		<th> QTY </th>
	</tr>
</table>
<?php
$pdf->Output();
?>
