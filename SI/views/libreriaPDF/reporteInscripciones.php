<?php
require ('fpdf/fpdf.php');
require ('../../controllers/clases/estudiante.php');
require ('../../controllers/clases/inscripcion.php');
require ('../../controllers/clases/periodo.php');

$studentObject = new Student();
$inscriptionObject = new Inscription();
$periodObject = new  Period();

$datosInscripciones = $inscriptionObject->getInscriptions();

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
    $this->Cell(89, 8, 'REPORTE DE INSCRIPCIONES', 0, 1);
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
$pdf->Cell(40, 12, utf8_decode('Fecha°'), 0, 0, 'C', 1);
$pdf->Cell(60, 12, utf8_decode('Estudiante'), 0, 0, 'C', 1);
$pdf->Cell(20, 12, utf8_decode('Metodo'), 0, 0, 'C', 1);
$pdf->Cell(15, 12, utf8_decode('Fase'), 0, 0, 'C', 1);
$pdf->Cell(30, 12, utf8_decode('Estado'), 0, 0, 'C', 1);
$pdf->Cell(30, 12, utf8_decode('Periodo'), 0, 1, 'C', 1);
$pdf->SetFont('Arial', '', 10);

$i = 0;

foreach ($datosInscripciones as $inscripcion) {

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

  //                Fecha de la Inscripcion
  $pdf->Cell(40, 8, $inscripcion['date'], 'B', 0, 'C', 1);

  //                Correo del Estudiante

  // Obtener el ID del estudiante
  $idStudent = $inscripcion['idStudent'];

  // Obtener los datos del estudiante por el ID
  $student = $studentObject->getStudentByID($idStudent);
  $pdf->Cell(60, 8, utf8_decode($student['email']), 'B', 0, 'C', 1);

  //               Metodo de la Inscripcion

  $idProcess = $inscripcion['idProcess'];

  $process = "";

  if ($idProcess == 1)
  {
    $process = "OPSU";
  }
  elseif ($idProcess == 2)
  {
    $process = "RUSI";
  }
  else
  {
    $process = "CONVENIO";
  }

  $pdf->Cell(20, 8, utf8_decode($process), 'B', 0, 'C', 1);

  //                Fase de la Inscripcion
  $pdf->Cell(15, 8, utf8_decode($inscripcion['inscriptionPhase']), 'B', 0, 'C', 1);

  //                Estado de la Inscripcion
  $pdf->Cell(30, 8, utf8_decode($inscripcion['state']), 'B', 0, 'C', 1);

  //                Periodo de la Inscripcion

  // Obtener el ID del periodo de la inscripcion

  $idPeriod = $inscripcion['idPeriod'];

  // Obtener los datos del periodo por el ID
  $period = $periodObject->getPeriodByID($idPeriod);
  $pdf->Cell(30, 8, utf8_decode($period['name']), 'B', 1, 'C', 1);
  $pdf->Ln(0.5);

  $i++;
}

$pdf->Output();
