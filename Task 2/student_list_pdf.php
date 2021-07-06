<?php
require "php/config.php";
require_once "php/functions.php";
$user = new login_registration_class();

		require('plugins/fpdf/fpdf.php');
		require('plugins/fpdf/rotation.php');


class PDF extends PDF_Rotate
{
	
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
		$pdf->Write(5, 'Student List');
		$pdf->Ln();

		$pdf->Ln(2);			


$pdf-> Cell(5);
		$pdf->SetFont('Times','B',8);
		$pdf->Cell(8,6,'SL',1);
		$pdf->Cell(20,6,'Student ID',1);
		$pdf->Cell(40,6,'Student Name',1);
		$pdf->Cell(40,6,'Contact',1);
		$pdf->Cell(40,6,'Email',1);
		$pdf->Cell(22,6,'Picture',1);
		$pdf->Ln();

					$qry = $user->get_all_student();
					
 
					$sl=1;
					while($rec = $qry->fetch_assoc())
                     {
						$pdf-> Cell(5);
						$pdf->SetFont('Times','',8);
						$pdf->Cell(8,20,$sl,1);
						$pdf->Cell(20,20,$rec['st_id'],1);
						$pdf->Cell(40,20,$rec['name'],1);
						$pdf->Cell(40,20,$rec['contact'],1);
						$pdf->Cell(40,20,$rec['email'],1);
						$image1='img/student/'.$rec['img'];
						$pdf->Cell( 22, 20, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(),22, 20), 1, 0, 'L', false);

						$sl++;
						$pdf->Ln();
						}      
                

		
		$pdf->Ln();
		$pdf->Ln();	
		
		$pdf->Output();



?>

