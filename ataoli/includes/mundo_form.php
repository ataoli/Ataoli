<?php 
//incluímos la clase ajax
require ('../../xajax/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('UTF-8');
//$xajax->decodeUTF8InputOn();
$xajax->registerFunction("generar_select");
$xajax->registerFunction("municipios");
$xajax->registerFunction("ciudades");
$xajax->processRequests();


function generar_select($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');

$pais = $formulario["cod_pais"];



include_once("config.php");
$conn = mysql_connect($Servidor,$Usuario,$Password); 
mysql_select_db($BaseDeDatos,$conn);
mysql_query ("SET NAMES 'utf8'");
if ($pais != "COL"){
$nuevo_select .= "$link<select name='distrito_ciudad' id='distrito_ciudad' onchange=\"xajax_ciudades(xajax.getFormValues('formulario'))\">"; 	
	
$ssql = "SELECT * FROM geo_ciudad WHERE  cod_pais = '$pais' GROUP BY distrito_ciudad "; 
$rs = mysql_query($ssql,$conn);

while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['distrito_ciudad'].'">' . $row['distrito_ciudad'] . '</option>/n';

}

$nuevo_select .= "</select>";
						}	ELSE {
			
$nuevo_select .= "<select name='cod_departamento' id='cod_departamento' onchange=\"xajax_municipios(xajax.getFormValues('formulario'))\">"; 	
$ssql = "SELECT * FROM geo_municipios_colombia GROUP by codigo_departamento"; 
$rs = mysql_query($ssql,$conn);
while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['codigo_departamento'].'">' . $row['nombre_departamento'] . '</option>/n';
}
$nuevo_select .= "</select>";
$borrar = "";
						  }				
$respuesta->addAssign("seleccombinado","innerHTML",$nuevo_select);
$respuesta->addAssign("selecmunicipios","innerHTML",$borrar);
return $respuesta;
}
////funcion municipios
function municipios($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$departamento = $formulario["cod_departamento"];
include_once("config.php");
$conn = mysql_connect($Servidor,$Usuario,$Password); 
mysql_select_db($BaseDeDatos,$conn);
mysql_query ("SET NAMES 'utf8'");
$nuevo_select .= "<select id='departamento' name='departamento'>";	
$ssql = "SELECT * FROM geo_municipios_colombia WHERE  codigo_departamento = '$departamento'  "; 
$rs = mysql_query($ssql,$conn);
while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['codigo_municipio'].'">' . $row['nombre_municipio'] . '</option>/n';
}
$nuevo_select .= "</select>";
$respuesta->addAssign("selecmunicipios","innerHTML",$nuevo_select);
return $respuesta;
}
////fin funcion municipios

////funcion ciudades
function ciudades($formulario){
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$distrito = $formulario["distrito_ciudad"];
include_once("config.php");
$conn = mysql_connect($Servidor,$Usuario,$Password); 
mysql_select_db($BaseDeDatos,$conn);
mysql_query ("SET NAMES 'utf8'");
$nuevo_select .= "<select id='municipio' name='municipio'>";	
$ssql = "SELECT * FROM geo_ciudad WHERE  distrito_ciudad = '$distrito'  "; 
$rs = mysql_query($ssql,$conn);
while( $row = mysql_fetch_array( $rs ) ) {
$nuevo_select .= '<option value="'.$row['id_ciudad'].'">' . $row['nombre_ciudad'] . '</option>/n';
}
$nuevo_select .= "</select>";
$respuesta->addAssign("selecmunicipios","innerHTML",$nuevo_select);
return $respuesta;
}
////fin funcion ciudades
?>
<html>
<head>

   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
   <title>Select de paises a ciudades</title>
   <?php
   //En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
   $xajax->printJavascript("../../xajax/");
   ?>
</head>

<body>

<form name="formulario" id="formulario">
Pais:<br>

<select name="cod_pais" id="cod_pais" onchange="xajax_generar_select(xajax.getFormValues('formulario'))">
<option value="999" SELECTED></option>
<?php
include_once("../librerias/conex.php"); 
$link=Conectarse(); 
if ($pais != ""){$Pais_definido=mysql_query("SELECT * FROM geo_pais WHERE id_pais = $pais",$link);
$i=0;
$pais_definido=mysql_result($Pais_definido,$i,"pais");
echo "<option value='$pais' selected >>$pais_definido<</option>";}
$Pais_Tipo=mysql_query("SELECT * FROM geo_pais",$link);
mysql_query ("SET NAMES 'utf8'");
while($row = mysql_fetch_array($Pais_Tipo)) {
     printf("<option value='%s'> %s</option>", $row["cod_pais"], $row["nom_pais"]);}
?>
</select><br>
Departamento / Estado : <div id="seleccombinado"></div>
Ciudad : <div id="selecmunicipios"></div>
</form>
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
