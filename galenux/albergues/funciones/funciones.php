<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../../error.php");

} 

function grabar_albergue($formulario,$div){
	//esta es una tipica funcion usando xajax
$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
$control = $formulario['control'];//*(0cbfa12ca67a4bef19b3aef079de0b40); 
$nombre = $formulario['nombre'];//*(); 
$fecha_establecimiento = $formulario['fecha_establecimiento'];//*(); 
$id_places = $formulario['id_places'];//*(27675); 
$lat = $formulario['lat'];//*(4.438261112934); 
$lon = $formulario['lon'];//*(-74.7685546875); 
$direccion = $formulario['direccion'];//*(); 
$entidad_responsable = $formulario['entidad_responsable'];//*(); 

$insertar_albergue ="INSERT INTO `albergues` 
			(`nombre`, `fecha_establecimiento`, `id_places`, `lat`, `lon`, `direccion`, `entidad_responsable`, `id_usuario`) 
VALUES ('$nombre', '$fecha_establecimiento', '$id_places', '$lat', '$lon', '$direccion', '$entidad_responsable', '$_SESSION[id_usuario]');";
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$sql=mysql_query($insertar_albergue,$link);
$id_albergue =mysql_insert_id($link);

//si sepasan los parametros por un array "$formulario" se pueden separar de forma normal
foreach($formulario as $c=>$v){ 
if (is_array($v) ){
	foreach($v as $C=>$V){
	//	$resultado .= "$$c = \$formulario['$c']['$C'];//($V) <br>"; 
	// albergues_financiacion
		if($c == 'caracteristicas' AND $V !=''){$datos_caracteristicas  .= "('$id_albergue','$_SESSION[id_usuario]','$C','$V'),";}
		if($c == 'albergues_financiacion_entidades' AND $V !=''){$datos_financiacion  .= "('$id_albergue','$V','$_SESSION[id_usuario]'),";}
		if($c == 'censo' AND $V !=''){$datos_censo  .= "('$id_albergue','$C','$V','$_SESSION[id_usuario]'),";}
		if($c == 'dato_general' AND $V !=''){$datos_generales  .= "('$id_albergue','$C','$V','$_SESSION[id_usuario]'),";}
 									}
										} 
//$resultado .= "<p>El vector con indice $c tiene el valor $v </p>"; 
/// las respuestas se cargan regularmente a la variable $resultado
//$resultado .= "$$c = \$formulario['$c'];//*($v); <br>"; 
}  
if(isset($datos_generales)){
$datos_generales = substr($datos_generales, 0, -1);
$insertar_datos_generales = "INSERT INTO  `albergues_datos_generales` (`id_albergue`, `dato`, `valor`, `id_usuario`)VALUES $datos_generales ";
$sql_datos_generales=mysql_query($insertar_datos_generales,$link);
											}
if(isset($datos_caracteristicas)){
$datos_caracteristicas = substr($datos_caracteristicas, 0, -1);
$insertar_caracteristicas = "INSERT INTO  `albergues_caracteristicas_datos` (`id_albergue`,`id_usuario`,`id_caracteristica`,`caracteristica`)VALUES $datos_caracteristicas ";
$sql_caracteristicas=mysql_query($insertar_caracteristicas,$link);
											}
if(isset($datos_financiacion)){
$datos_financiacion = substr($datos_financiacion,0,-1);
$insertar_financiacion =	"INSERT INTO `albergues_financiacion_datos` (`id_albergue`,`id_financiacion`,`id_usuario`)VALUES $datos_financiacion ";
$sql_financiacion=mysql_query($insertar_financiacion,$link);
										}
 if(isset($datos_censo)){
$datos_censo = substr($datos_censo,0,-1);
$insertar_censo =	"INSERT INTO `albergues_censo` (`id_albergue`,`grupo`,`cantidad`,`id_usuario`)VALUES $datos_censo ";
$sql_datos_generales=mysql_query($insertar_censo,$link);
										}
										
$resultado .= "($id_albergue) $nombre"; 

$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} 
/// se registra la funcion para que el xajax la tome en cuenta

$xajax->registerFunction("grabar_albergue");


function crear_albergue($div){
	//esta es una tipica funcion usando xajax
$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
$localizacion = combo_select('id','places','departamento','ciudad','');
$entidad = "".suggestivo("entidad_responsable",'entidades','id_cliente','razon_social','1','Entidad que administra')."";		
$financiacion = opciones('','albergues_financiacion_entidades','id','nombre','descripcion','Entidades que financian');
//suggestivo("id_cliente[$fila]",'clientes','id_cliente','razon_social','1','Buscar tercero');	 
$caracteristicas = categorias($tipo,'albergues_caracteristicas_clase','albergues_caracteristicas','id','nombre','descripcion',$titulo);
//include_once("laboratorio/osm.php");
//require("laboratorio/osm.js");
//$resultado = mapa();

$resultado .= "
      
        <link rel='stylesheet' href='estilos/map.css' type='text/css'> 
     

<form id='formulario_crear' name= 'formulario_crear'>

<!-- <legend>Incluir un nuevo albergue</legend> -->
<input type='hidden' name='control' id='control' value='$control'>

<fieldset>
<legend>Datos generales del albergue</legend>
<label>Nombre: <input type='text' name='nombre' id='nombre' placeholder='Nombre del albergue' title='Nombre del albergue' value=''></label>
<label>Fecha de establecimiento: <input type='date' name='fecha_establecimiento' id='fecha_establecimiento'  placeholder='Fecha de establecimiento del albergue' title='Fecha de establecimiento del albergue'></label>
$localizacion
<fieldset title='Puede seleccionar las coordenadas haciendo click en el mapa'>
 <div id='map' class='smallmap'></div> 
<legend>Coordenadas GPS / WGS84</legend>
<label>Latitud <input type='text' id='lat' name='lat' value=''><label>
<label>Longitud <input type='text' id='lon' name='lon' value=''><label>
</fieldset>
<label title='Zona donde se encuentra el albergue'>Zona: <input type='radio' name='dato_general[zona]' value='urbano' checked>Urbana<input type='radio' name='dato_general[zona]' value='rural'>Rural</label>
<label>Dirección: <input type='text' name='direccion' id='direccion' title='direccion' placeholder='Dirección'></label>
<label>Teléfono fijo: <input type='text' name='dato_general[telefono_fijo]' id='dato_general[telefono_fijo]' title='telefono_fijo' placeholder='Teléfono fijo'></label>
<label>Teléfono celular: <input type='text' name='dato_general[telefono_celular]' id='dato_general[telefono_fijo]' title='telefono_celular' placeholder='Teléfono celular'></label>
<label>Correo electrónico: <input type='email' placeholder='dato_general[email]' name='dato_general[email]' id='email' title='email'  ></label>
$entidad
</fieldset>


$financiacion 


<fieldset title='Censo a la fecha'>
<legend>Ocupación etárea</legend>
<table border='0'><th>Edad</th><th>Mujeres</th><th>Hombres</th>
						<tr><td>Menos de 1</td>
									<td><input  name='censo[]'  id='censo[]'  type='number' size='4'/></td>
									<td><input  name='censo[]'  id='censo[]'  type='number' size='4'/></td></tr>
						<tr><td>Entre 1 y 5</td>
									<td><input   name='censo[]'  id='censo[]'  type='number' size='4'/></td>
									<td><input  name ='censo[]'  id='censo[]' type='number' size='4'/></td></tr>
						<tr><td>Entre 6 y 12</td>
									<td><input   name='censo[]'  id='censo[]'   type='number' size='4'/></td>
									<td><input   name ='censo[]'  id='censo[]'   type='number' size='4'/></td></tr>
						<tr><td>Entre 13 y 17</td>
									<td><input  name='censo[]'  id='censo[]'   type='number' size='4'/></td>
									<td><input  name='censo[]'  id='censo[]'  type='number' size='4'/></td></tr>
						<tr><td>Entre 18 y 59</td>
									<td><input   name='censo[]'  id='censo[]'  type='number' size='4'/></td>
									<td><input   name='censo[]'   id='censo[]' type='number' size='4'/></td></tr>
						<tr><td>60 o m&aacute;s</td>
									<td><input   name='censo[]'  id='censo[]'  type='number' size='4'/></td>
									<td><input  name='censo[]'  id='censo[]' type='number' size='4'/></td></tr>
</table>
</fieldset>
<fieldset>
<legend>Características del albergue</legend>
$caracteristicas
</fieldset>
</form>
<div id='grabado'name='grabado'>
<li class='action submit'>
<input type='submit' value='Grabar' onclick=\"xajax_grabar_albergue(xajax.getFormValues('formulario_crear'),'grabado');\" >
</li>
</div>
";

$respuesta->addAssign($div,"innerHTML",$resultado);
$respuesta->addScript("init();");

return $respuesta;
} 
/// se registra la funcion para que el xajax la tome en cuenta
$xajax->registerFunction("crear_albergue");



// la funcion se llama desde javascript ejem
// onclick = "xajax_dummy($formulario,$div)";
 /*
function dummy($formulario,$div){
	//esta es una tipica funcion usando xajax
$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
//$clave = $formulario["clave"];
//si sepasan los parametros por un array "$formulario" se pueden separar de forma normal
foreach($formulario as $c=>$v){ 
if (is_array($v) ){foreach($v as $C=>$V){$resultado .= "<p> $$c = \$formulario['$c']['$C']; </p>";  }
										} 
//$resultado .= "<p>El vector con indice $c tiene el valor $v </p>"; 
/// las respuestas se cargan regularmente a la variable $resultado
$resultado .= "$$c = \$formulario['$c']; <br>"; 
}  
///se pueden hacer alguno includes
//include("includes/datos.php");
//$link=Conectarse(); 
//mysql_query("SET NAMES 'utf8'");
$consulta = "SELECT * FROM d9_users WHERE nombre_completo != '' LIMIT 0,10";
//$sql=mysql_query($consulta,$link);
///$Documento=mysql_result($grupo,0,"documento_numero");
$resultado .= "<h1>$Valor , $formulario, $clave</h1>";

//if (mysql_num_rows($sql)!='0'){
//while( $row = mysql_fetch_array( $sql ) ) {
//$resultado .= "$row[id]<br>";
//															}
//										}
$resultado .= "<h1>Los dummys</h1>";

/// se asigna $resultado a la $respuesta y "innerHTML" es puesto en el $div que es 
//regularmente el id de un <div> dentro de cual se mostrara el resultado
//per puede ser cualquier elemento HTML
$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} 
/// se registra la funcion para que el xajax la tome en cuenta
$xajax->registerFunction("dummy");
*/
?>