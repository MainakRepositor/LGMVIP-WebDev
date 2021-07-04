<?php
require "php/config.php";
require_once "php/functions.php";
$user = new login_registration_class();

		require('plugins/fpdf/fpdf.php');
		require('plugins/fpdf/rotation.php');


class PDF extends PDF_Rotate
{
	function Header()
	{
		//Put the watermark
		//$this->SetFont('Arial','B',50);
		//$this->SetTextColor(255,192,203);
		//$this->RotatedText(65,190,'A p p r o v e d',45);
	}
	function RotatedText($x, $y, $txt, $angle)
	{
		//Text rotated around its origin
		$this->Rotate($angle,$x,$y);
		$this->Text($x,$y,$txt);
		$this->Rotate(0);
	}
}

//$pdf = new FPDF();
$pdf=new PDF();
$pdf->AddPage();



$iubat='Student Management System' ;				

		
		
		$pdf->Image('img/logo.png',10,9,17);
		$pdf->Ln();
		$pdf-> Cell(20);
		$pdf->SetFont('Times','',14);
		$pdf->Write(5, $iubat);
		$pdf->Ln();
		$pdf-> Cell(22);
        $pdf->SetFont('Times','',10);
        $pdf->Write(4,'Developed by Mainak Chaudhuri');
		
		$pdf-> Cell(20);
		$pdf->SetFont('Times','',8);
		$pdf->Write(5, '__________________________________________________________________________________________________________________________________');
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf-> Cell(85);
		$pdf->SetFont('Times','U',10);
		$pdf->Write(5, 'Faculty List');
		$pdf->Ln();

		$pdf->Ln(2);			


$pdf-> Cell(5);
		$pdf->SetFont('Times','B',8);
		$pdf->Cell(8,6,'SL',1);
		$pdf->Cell(40,6,'Faculty Name',1);
		$pdf->Cell(40,6,'Contact',1);
		$pdf->Cell(40,6,'Email',1);
		$pdf->Cell(40,6,'Education',1);
		$pdf->Ln();

					$qry = $user->get_faculty();
					
 
					$sl=1;
					while($rec = $qry->fetch_assoc())
                     {
						$pdf-> Cell(5);
						$pdf->SetFont('Times','',8);
						$pdf->Cell(8,20,$sl,1);
						$pdf->Cell(40,20,$rec['name'],1);
						$pdf->Cell(40,20,$rec['contact'],1);
						$pdf->Cell(40,20,$rec['email'],1);
						$pdf->Cell(40,20,$rec['education'],1);
						
						$sl++;
						$pdf->Ln();
						}      
                

		
		$pdf->Ln();
		$pdf->Ln();	
		
		$pdf->Output();



?>

