<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola 2";
} 

include("../librerias/conex_oncolinux.php");
include("../includes/datos.php");
$resultado .= "
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='es' lang='es' dir='ltr'>
<head>
  <title>$empresa $aplicacion  </title>
 <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <link href='../estilos/impresion.css' rel='stylesheet' type='text/css'>
  <link rel='SHORTCUT ICON' href='../icono.ico'></head>
<body>
";

$link=Conectarse_oncolinux(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query("SELECT * FROM Usuarios WHERE ID_Usuario = '$id' LIMIT 1 ",$link);
if (mysql_num_rows($sql)!='0'){
$resultado.= "
<div align='center'>
<img src='../images/oncomedic.gif'><br>
$empresa <br>
$correo_corporativo<br>
$empresa_direccion<br>
Nit $empresa_nit<hr></div>
";
while( $row = mysql_fetch_array( $sql ) ) {
$resultado .= "<h1>Historia Clinica de:</h1>

<table border='1' width='95%'>
<tr><td><h2>Paciente</h2>
<h1>$row[Primer_Nombre] $row[Segundo_Nombre] $row[Primer_Apellido] $row[Segundo_Apellido]</h1>
</td><td><h2>Documento </h2><h1>$row[Tipo_De_Identificacion] $row[Identificacion]</h1>
</td></tr>
<tr>
	<td><h2>EPS</h2> <h1>$row[EPS] / $row[Plan_De_Beneficios]</h1></td>
	<td><h2>Fecha de nacimiento</h2><h1>$row[Fecha_De_Nacimiento]</h1></td>
</tr>
<tr>
	<td><h2>Sexo</h2><h1>$row[Sexo]</h1></td>
	<td><h2>Nombre responable</h2><h1>$row[Nombre_Responsable] $row[Parentesco_Responssable]</h1></td>
</tr>
<tr>
	<td><h2>Códigos de residencia habitual</h2><h1>Departamento $row[Codigo_Del_Departamento_De_Residencia_Habitual] Municipio: $row[Codigo_Del_Municipio_De_Residencia_Habitual] Zona: $row[Zona_De_Residencia_Habitual]</h1>
</td>
	<td><h2>Dirección</h2><h1>$row[Direccion]</h1></td>
</tr>
<tr>
	<td><h2>Teléfonos</h2><h1>$row[Telefono] $row[Telefono_Movil] $row[Telefono_Referencia]</h1></td>
	<td><h2>Profesión</h2><h1>$row[Profesion]</h1</td>
</tr>
<tr>
	<td><h2>RH</h2><h1>$row[RH]</h1></td>
	<td></td>
</tr>
";
															}
$resultado.= "</table>";		
include("../oncolinux/Resumen_Clinico.php"); 
include("../oncolinux/consultas.php"); 
}
echo $resultado;	