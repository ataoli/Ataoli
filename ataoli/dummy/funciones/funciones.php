<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../../error.php");

} 
/*
// la funcion se llama desde javascript ejem
// onclick = "xajax_dummy($formulario,$div)";
 
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
$resultado .= "<p> $$c = formulario['$c']; </p>"; 
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
