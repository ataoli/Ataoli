<?
//incluímos la clase ajax
require ('../../../xajax/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();
$xajax->setCharEncoding('UTF-8');
//$xajax->decodeUTF8InputOn();

function select_combinado($id_provincia){
   //función para crear el select combinado
   //debe extraer las opciones de un select a partir de un parámetro
   
   //generamos unos arrays con distintas poblaciones de varias provincias
   //estos valores en un caso práctico seguramente se extraerán de base de datos
   //no habría que cargar todos en memoria, sólo hacer el select de las poblaciones de la provincia deseada
   
include_once("../../librerias/conex.php"); 
$link=Conectarse(); 

//$sql=mysql_query("SELECT * FROM users WHERE nombre_completo != '' LIMIT 0,10",$link);
   
   
   $madrid = array("Madrid", "Las Rozas", "Móstoles", "San Sebastián de los Reyes");
   $valencia = array("Valencia", "La Eliana", "Paterna", "Cullera");
   $barcelona = array("Barcelona", "Badalona");
   $leon = array ("León", "Astorga", "Villamejil");
   $poblaciones = array($madrid, $valencia, $barcelona, $leon);
   
   //creo las distintas opciones del select
   $nuevo_select = "<select name='poblaciones'>";
   
   for ($i=0; $i<count($poblaciones[$id_provincia]); $i++){
   //for ($i=0; $i<2; $i++){
      $nuevo_select .= '<option value="' . $i . '">' . $poblaciones[$id_provincia][$i] . '</option>';
   }
   $nuevo_select .= "</select>";
   return $nuevo_select;
}

function generar_select($cod_provincia){
   //instanciamos el objeto para generar la respuesta con ajax
   $respuesta = new xajaxResponse('ISO-8859-1');
   
   if ($cod_provincia==999){
      //escribimos el select de poblaciones vacío
      $nuevo_select = '<select name="poblaciones">
                  <option value=0>Elegir provincia</option>
                  </select>
                  ';
   }else{
      $nuevo_select = select_combinado($cod_provincia);
   }
   //escribimos en la capa con id="seleccombinado"
   $respuesta->addAssign("seleccombinado","innerHTML",$nuevo_select);
   
   //tenemos que devolver la instanciación del objeto xajaxResponse
   return $respuesta;
}
   
//asociamos la función creada anteriormente al objeto xajax
$xajax->registerFunction("generar_select");

//El objeto xajax tiene que procesar cualquier petición
$xajax->processRequests();
?>

<html>
<head>
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
   <META HTTP-EQUIV="Content-Type" CONTENT="text/html;charset=UTF-8">
   <title>Validar usuario en Ajax</title>
   <?
   //En el <head> indicamos al objeto xajax se encargue de generar el javascript necesario
   $xajax->printJavascript("../../../xajax/");
   ?>
</head>

<body>

<form name="formulario">
Provincia:
<br>
<select name="provincia" onchange="xajax_generar_select(document.formulario.provincia.options[document.formulario.provincia.selectedIndex].value)">
<option value="999">Selecciona provincia</option>
<option value=0>Madrid</option>
<option value=1>Valencia</option>
<option value=2>Barcelona</option>
<option value=3>León</option>
</select>
<br>
<br>
Población: <div id="seleccombinado">
<select name="poblaciones">
<option value=0>Elegir provincia</option>
</select>
</div>
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