<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 

//registramos la función creada anteriormente al objeto xajax

$xajax->registerFunction("impresion_ctc");
$xajax->registerFunction("impresion_ordenes");
$xajax->registerFunction("impresion_medicamentos");
$xajax->processRequests();


///NOMBRE DE LA FUNCION: impresion_medicamentos

function impresion_medicamentos($variable_array){ 
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$receta = $variable_array["receta"];
$id = $variable_array["id_usuario"];
$id_turno = $variable_array["id_turno"];

include_once("../librerias/conex_pop.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($receta == ''){$nuevo_select .= "<center>No se ha seleccionado un medicamento <img src='../images/atencion.gif' alt='!'></center><hr>";}
else {
$nuevo_select .="<form name='formula'  method='post' id='formula' action='formula.php'><ol>";
foreach ($receta as $clave => $valor)
	{
//$nuevo_select .= "<li>$clave : $valor</li>";	

$sql=mysql_query("SELECT * FROM recetas, medicamentos 
							WHERE id_receta='$clave' 
							AND recetas.id_medicamento = medicamentos.id_medicamento",$link);

if (mysql_num_rows($sql)>'0'){
while( $row = mysql_fetch_array( $sql ) ) {
																					$nuevo_select .= "<li><input type='checkbox' name='receta[$clave]' id='receta[$clave]' value='$clave' checked>".$row['medicamento_nombre']."</li> ";
																					}
														}
	}
$nuevo_select .="</ol><input type='hidden' name='id_usuario' id='id_usuario' value='$id'><input type='hidden' name='id_turno' id='id_turno' value='$id_turno'>";	
$nuevo_select .="<center><br><input type='submit' value ='Imprimir estos medicamentos' ></center></form><hr>";	
		}
//include_once("librerias/conex.php"); 

//$respuesta->addScript("abrir('impresion/imprimir_receta.php','crear',700,800,100,0,1)");
$respuesta->addAssign("impresion","innerHTML",$nuevo_select);
//
return $respuesta;
} 


///NOMBRE DE LA FUNCION: impresion_medicamentos

function impresion_ordenes($variable_array){ 
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$orden = $variable_array["orden"];
$id = $variable_array["id_usuario"];
$id_turno = $variable_array["id_turno"];


include_once("../librerias/conex_pop.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($orden == ''){$nuevo_select .= "<center>No se ha seleccionado una orden <img src='../images/atencion.gif' alt='!'></center><hr>";}
else {
$nuevo_select .="<form name='formula'  method='post' id='formula' action='orden.php'><ol>";
foreach ($orden as $clave => $valor)
	{
//$nuevo_select .= "<li>$clave : $valor</li>";	

$sql=mysql_query("SELECT * FROM ordenes, cups 
							WHERE id_orden='$clave' 
							AND ordenes.id_tipo_orden = cups.codigo",$link);

if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= "<li title='".$row['observaciones']."'><input type='checkbox' name='orden[$clave]' id='orden[$clave]' value='$clave' checked>".$row['descripcion']."</li> ";
	
															}
										}
	}
$nuevo_select .="</ol><input type='hidden' name='id_usuario' id='id_usuario' value='$id'><input type='hidden' name='id_turno' id='id_turno' value='$id_turno'>";	
$nuevo_select .="<center><br><input type='submit' value ='Imprimir esta Orden' ></center></form><hr>";	
		}
//include_once("librerias/conex.php"); 

//$respuesta->addScript("abrir('impresion/imprimir_receta.php','crear',700,800,100,0,1)");
$respuesta->addAssign("impresion","innerHTML",$nuevo_select);
//
return $respuesta;
} 

/// fin imprimir ordenes



///NOMBRE DE LA FUNCION: impresion_ctc

function impresion_ctc($variable_array){ 
//creo el xajaxResponse para generar una salida
$respuesta = new xajaxResponse('ISO-8859-1');
$orden = $variable_array["orden"];
$id = $variable_array["id_usuario"];
$id_turno = $variable_array["id_turno"];

include_once("../librerias/conex_pop.php"); 
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($orden == ''){$nuevo_select .= "<center>No se ha seleccionado una orden <img src='../images/atencion.gif' alt='!'></center><hr>";}
else {
$nuevo_select .="<form name='formula'  method='post' id='formula' action='ctc.php'><ol>";
foreach ($orden as $clave => $valor)
	{
	

$sql=mysql_query("SELECT * FROM recetas_no_pos, medicamentos 
							WHERE id_receta_no_pos='$clave' 
							AND medicamentos.id_medicamento = recetas_no_pos.id_medicamento",$link);

if (mysql_num_rows($sql)>'0'){
while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= "<li title='".$row['observaciones']."'><input type='checkbox' name='orden[$clave]' id='orden[$clave]' value='$clave' checked>".$row['medicamento_nombre']."<br> ".$row['concentracion_forma']."</li> ";
	
															}
										}
	}
$nuevo_select .="</ol><input type='hidden' name='id_usuario' id='id_usuario' value='$id'><input type='hidden' name='id_turno' id='id_turno' value='$id_turno'>";	
$nuevo_select .="<center><br><input type='submit' value ='Imprimir formulario' ></center></form><hr>";	
		}
//include_once("librerias/conex.php"); 

//$respuesta->addScript("abrir('impresion/imprimir_receta.php','crear',700,800,100,0,1)");
$respuesta->addAssign("impresion","innerHTML",$nuevo_select);
//
return $respuesta;
} 

/// fin imprimir_ctc

?><?php
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