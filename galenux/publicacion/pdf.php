<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola 2";
} 
define('FPDF_FONTPATH','../font/');
require('../includes/fpdf.php');
$control =$_REQUEST[doc];
include_once("../librerias/conex.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query("SELECT * FROM publicacion_contenido WHERE control = '$control' ",$link);

$titulo=mysql_result($sql,0,"titulo");
$encabezado=mysql_result($sql,0,"encabezado");
$contenido=utf8_decode(mysql_result($sql,0,"contenido"));
$pie=mysql_result($sql,0,"pie");
$id_usuario=mysql_result($sql,0,"id_usuario");

class PDF extends FPDF
{
//Cabecera de página
function Header()
{
global $titulo;
    //Logo
    $this->Image('../images/logo_impresion.gif',10,8,33);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    //Movernos a la derecha
    $this->Cell(80);
    //Título
    $this->Cell(30,10,$titulo,1,0,'C');
    //Salto de línea
    $this->Ln(20);
}

//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

//Creación del objeto de la clase heredada
$pdf=new PDF();
$pdf->AliasNbPages();
$pdf->AddPage('P','LETTER');
$pdf->SetLeftMargin(25);
//$pdf->SetMargins(30,30,30);
$pdf->SetFont('Times','',12);
$pdf->MultiCell(0,5,$contenido);
$pdf->Output($control,I);
?>