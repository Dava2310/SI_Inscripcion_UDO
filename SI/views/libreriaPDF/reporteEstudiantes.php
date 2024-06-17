<?php
require ('fpdf/fpdf.php');
require ('../../controllers/clases/estudiante.php');

$studentObject = new Student();
$datos = $studentObject->getStudents();

date_default_timezone_set('America/Caracas');

class PDF extends FPDF
{
  
  function Header()
  {
    $this->Image('img/waves.png', -10, -1, 110);
    $this->Image('../../assets/img/logo.png', 140, 15, 40);
    $this->SetY(50);
    $this->SetX(132);

    $this->SetFont('Arial', 'B', 12);
    $this->Cell(89, 8, 'REPORTE DE ESTUDIANTES', 0, 1);
    $this->SetY(55);
    $this->SetX(142);
    $this->SetFont('Arial', 'I', 10);
    $this->Cell(40, 10, utf8_decode('Sistema P.R.O.N.E'));

    $this->Ln(20);

  }

  function Footer()
  {
    $this->SetFont('helvetica', 'B', 8);
    $this->SetY(-15);
    $this->Cell(95, 5, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'L');
    $this->Cell(95, 5, date('d/m/Y | g:i:a'), 00, 1, 'R');
    $this->Line(10, 287, 200, 287);
    $this->Cell(0, 5, utf8_decode("UDO Monagas © Todos los derechos reservados."), 0, 0, "C");

  }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(5);
$pdf->SetRightMargin(5);

$pdf->SetX(5);
$pdf->SetFillColor(25, 132, 151);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(12, 12, utf8_decode('ID°'), 0, 0, 'C', 1);
$pdf->Cell(35, 12, utf8_decode('Nombre'), 0, 0, 'C', 1);
$pdf->Cell(35, 12, utf8_decode('Apellido'), 0, 0, 'C', 1);
$pdf->Cell(30, 12, utf8_decode('Nacionalidad'), 0, 0, 'C', 1);
$pdf->Cell(30, 12, utf8_decode('TLF'), 0, 0, 'C', 1);
$pdf->Cell(50, 12, utf8_decode('Correo'), 0, 1, 'C', 1);
$pdf->SetFont('Arial', '', 10);

$i = 0;

foreach ($datos as $estudiante) {

  $pdf->SetX(5);//posicionamos en x

  //-------------INTERCALAMOS COLOR LOS PARES DE UN COLOR Y LOS QUE NO DE OTRO

  if ($i % 2 == 0) {
    $pdf->SetFillColor(232, 232, 232);
    $pdf->SetDrawColor(65, 61, 61);
  } else {
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetDrawColor(65, 61, 61);
  }

  //--------------------------------TERMINAMOS DE PINTAR----------------------------

  //                          DATOS

  $pdf->Cell(12, 8, $estudiante['ID'], 'B', 0, 'C', 1);
  $pdf->Cell(35, 8, utf8_decode($estudiante['name']), 'B', 0, 'C', 1);
  $pdf->Cell(35, 8, utf8_decode($estudiante['lastName']), 'B', 0, 'C', 1);
  $pdf->Cell(30, 8, utf8_decode($estudiante['nationality']), 'B', 0, 'C', 1);
  $pdf->Cell(30, 8, utf8_decode($estudiante['phoneNumber']), 'B', 0, 'C', 1);
  $pdf->Cell(50, 8, utf8_decode($estudiante['email']), 'B', 1, 'C', 1);
  $pdf->Ln(0.5);

  $i++;
}

$pdf->Output();
