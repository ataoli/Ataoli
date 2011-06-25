<?php 
session_start();  
include("../../librerias/conex.php");
   $link=Conectarse();
   
$input = $_REQUEST['input'];
$id_empresa = $_SESSION['id_empresa'];
//nombre_completo LIKE '%".$input."%' OR
//id_empresa = '$id_empresa' AND 
mysql_query("SET NAMES 'utf8'");
$qr=mysql_query("SELECT documento_numero, nombre_completo, id FROM users WHERE   documento_numero LIKE '".$input."%' OR nombre_completo LIKE '%".$input."%' LIMIT 50 ",$link);
			while($row=mysql_fetch_array($qr))
{$aResults[] = array( "id"=>($row['id']) ,"value"=>($row['documento_numero']." ".$row['nombre_completo']), "info"=>("") );

				}

header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");	
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 						
header ("Cache-Control: no-cache, must-revalidate"); 	
header ("Pragma: no-cache");

	if (isset($_REQUEST['json']))
	{

		header("Content-Type: application/json");	
		echo "{\"results\": [";
		$arr = array();
		for ($i=0;$i<count($aResults);$i++)
		{
			$arr[] = "{\"id\": \"".$aResults[$i]['id']."\", \"value\": \"".$aResults[$i]['value']."\", \"info\": \"".$aResults[$i]['info']."\"}";
		}

		echo implode(", ", $arr);

		echo "]}";

	}

	else

	{

		header("Content-Type: text/xml");

		echo "<?xml version=\"1.0\" encoding=\"utf-8\" ?><results>";

		for ($i=0;$i<count($aResults);$i++)
		{

			echo "<rs id=\"".$aResults[$i]['id']."\" info=\"".$aResults[$i]['info']."\">".$aResults[$i]['value']."</rs>";

		}

		echo "</results>";

	}
	
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