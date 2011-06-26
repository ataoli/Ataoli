<?session_start();?>
<html><head>  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Recordatorio de contrase&ntilde;a</title>
 <link rel="SHORTCUT ICON" href="../../icono.ico">



<link href="../../estilos/estilo.css" rel="stylesheet" type="text/css">
</head>
<body >

<table width="80%" border="0" align="center">  
<tr>
   <td colspan="3" align="center">
   
   <br><br><img src="../../images/logo.gif"  border="0" name="GaleNUx.com" alt="GaleNUx.com" align="top"><br>
  </td>  
</tr>
<tr>
   <td colspan="3" align="center">
<br>
<?
include_once("../../librerias/conex.php");
$link=Conectarse(); 
$id = $_POST['id'];
$password = md5($_POST[password1]);
//$password = $_POST['password1'];
$entkey = $_POST['codsec'];

if ($id == "" || $password == "" || $entkey == "")
{
echo "<h1>Acceso denegado</h1>";
echo '<a href="../../index.php">Volver al inicio</a>';
}
else
{
$consulta_pass = mysql_query("SELECT * FROM `users` WHERE `control` = '$entkey' AND `id` = '$id'");
if (mysql_num_rows($consulta_pass)==0){
	echo "<h1>El ID de usuario indicado no es correcto</h1>";
	echo 'Abra nuevamente la direcci&oacute;n enviada por correo o solicite una nueva clave de seguridad <a href="informacion_recordatorio.php">aqu&iacute;</a>';
}
else{
mysql_query("UPDATE `users` SET `passwd` = '$password' WHERE `control` = '$entkey' AND `id` = '$id'  LIMIT 1",$link);
echo "<h1>Su contrase&ntilde;a ha sido cambiada</h1>";
echo '<a href="../../index.php">Volver al inicio</a>';
}
}
?>
</body>
</html>






<?php
$control_version = '0aa0b6b3207f0b3839381db1962574a2'; 
/*  ATENCION: Puede existir una versión mas reciente de este archivo en http://GaleNUx.com
    por favor compruebelo antes de modificarlo. control de versión [0aa0b6b3207f0b3839381db1962574a2]
    
    Copyright ©  13-22-2/ 17-Dic-2008 Dirección nacional de derechos de autor Colombia 
    http://GaleNUx.com Es un sistema para de información para la salud adaptado al sistema
    de salud Colombiano.
    
    Si necesita consultoría o capacitación en el manejo, instalación y/o soporte o 
    ampliación de prestaciones de GaleNUx por favor comuniquese con nosotros 
    al email praxis@galenux.com.

    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los términos de la Licencia Pública General GNU publicada 
    por la Fundación para el Software Libre, ya sea la versión 3 
    de la Licencia, o cualquier versión posterior.

    Este programa se distribuye con la esperanza de que sea útil, pero 
    SIN GARANTÍA ALGUNA; ni siquiera la garantía implícita 
    MERCANTIL o de APTITUD PARA UN PROPÓSITO DETERMINADO. 
    Consulte los detalles de la Licencia Pública General GNU para obtener 
    una información más detallada. 

    Debería haber recibido una copia de la Licencia Pública General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.
    
    POR FAVOR CONSERVE ESTA NOTA SI EDITA ESTE ARCHIVO

 */ 
?>