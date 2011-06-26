<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola 2";
}
include_once("librerias/conex.php"); 
function dummy22($variable_array){
//creo el xajaxResponse para generar una salida
$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
$Valor = $variable_array["id_evento"];
foreach($variable_array as $c=>$v){ 
if (is_array($v) ){foreach($v as $C=>$V){$resultado .= "<p> $$c = formulario['$c']['$C']; </p>";  }
										
$nuevo_select .= "<p> $$c = formulario['$c']; </p>"; 
} 
$nuevo_select .= "<p>El vector con indice $c tiene el valor $v </p>"; 
}  
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");

//$sql=mysql_query("SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10",$link);
///$Documento=mysql_result($grupo,0,"documento_numero");
$nuevo_select = "<h1>$Valor , $variable_array</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$nuevo_select .= "".$row['id']."".$row['nombre_completo']."<br>";
//															}
//										}
$nuevo_select .= "<h1>Los dummys</h1>";
$respuesta->addAssign("capa_dummy","innerHTML",$nuevo_select);

return $respuesta;
} 
//is_numeric($valor)
//$xajax->registerFunction("dummy2");
function limpiar_caracteres($valor){
$b=array("(",")",".","+","{","}","]","á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","/","[",";",":","¡","!","¿","?","'",'"',"  ","   ");
$c=array("","","","","","","","a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","","","","","","","","","",""," "," ");
$resultado=str_replace($b,$c,$valor);
return $resultado ;
}

function geocoder_validar($bloque){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$revisar = "SELECT * FROM geo_abreviaturas WHERE hito LIKE  '%%$bloque%%' LIMIT 0,10";
$sql=mysql_query($revisar,$link);
if (mysql_num_rows($sql)!='0'){
$tipo=mysql_result($sql,0,"tipo");
$abreviatura=mysql_result($sql,0,"abreviatura");
$hito=mysql_result($sql,0,"hito");

$resultado = array($tipo,$abreviatura,$hito);
										}else{$resultado = '0';}
										

return  $resultado;

}


function geocoder_cruces($via){
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$revisar = "SELECT * FROM geo_abreviaturas WHERE abreviatura !=  '$via' AND tipo = 'T' AND cruce > 0 GROUP BY abreviatura ORDER BY cruce DESC LIMIT 0,10";
$sql=mysql_query($revisar,$link);
if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$resultado[] = "$row[hito]";
														}
//$resultado = array($tipo,$abreviatura,$hito);
										}else{$resultado = '0';}

return  $resultado;

}


function geocoder_direccion($direccion){
$direccion = limpiar_caracteres($direccion);
$direccion = limpiar_caracteres($direccion);
$respuesta = new xajaxResponse('utf-8');
$resultado .= "$direccion<hr>";
$bloques = explode(" ", $direccion); 
		Foreach ($bloques as $clave=>$valor)
			{
			$siguiente = $bloques[$clave+1];
			$validar = geocoder_validar($valor);
			if($validar != '0' ){
									//$via_cruce .= $validar[1];
			if($validar[0] == "T"){
					$cruces =geocoder_cruces($validar[1]);
						Foreach($cruces as $indice => $via)
						{
						$via_cruce[] = "$via";
						}            
											}				
			Foreach($validar as $titulo => $contenido){

				
				if($validar[0] == "T"){
					   $via_principal = $validar[2];
					   $numero_via_principal = $siguiente;
						$cualidad = "Sobre la $validar[2] $siguiente  ";
												}
				elseif($validar[0] == 'N'){
						
						$numero = explode("-",$siguiente);
						$cruce= $numero[0];
						$distancia = $numero[1];
			//			$cualidad = "A $distancia metros de la $via_cruce $cruce";
					
													}
				else {$cualidad ='';}
				
																	}
			//	$resultado .= "$cualidad  ";
									}else {$validado = '';}
   
			}
			Foreach($via_cruce as $indice => $via)
						{
					$resultado .= "$via_principal $numero_via_principal $via $cruce <br>";
						} 
//$resultado .= $contenido;
return $resultado;

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$revisar = "SELECT * FROM geo_abreviaturas WHERE hito LIKE  '%%$direccion%%' LIMIT 0,10";
$sql=mysql_query($sql,$link);
///$Documento=mysql_result($grupo,0,"documento_numero");
$nuevo_select = "<h1>$Valor , $variable_array</h1>";

if (mysql_num_rows($sql)!='0'){
while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= "$row[hito]<br>";
															}
										}
//$respuesta->addAssign("capa_dummy","innerHTML",$nuevo_select);
//return $respuesta;
} 
//is_numeric($valor)
$xajax->registerFunction("geocoder_validar");