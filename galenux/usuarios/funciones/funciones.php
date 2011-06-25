<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../../error.php");

} 

function generar_password(){
    $longitud = 8;
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-*%&_";
    mt_srand(microtime() * 1000000);
    for($i = 0; $i < 10; $i++)
    {
    $key = mt_rand(0,strlen($caracteres)-1);
    $password = $password . $caracteres{$key};
    }
    return $password;
}
    
function grabar_usuario($formulario,$div){

$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
$p_nombre = $formulario['primer_nombre'];
$s_nombre = $formulario['otro_nombre'];
$p_apellido = $formulario['primer_apellido'];
$s_apellido = $formulario['segundo_apellido'];
$nombre_completo = "$p_nombre $s_nombre $p_apellido $s_apellido";
$documento = $formulario['documento'];
$documento_1 = $formulario['documento_1'];
$ciudad = $formulario['id_places'];
$direccion = $formulario['direccion'];
$telefono_fijo = $formulario['telefono_fijo'];
$telefono_celular = $formulario['telefono_celular'];
$email = $formulario['email'];
$email_1 = $formulario['email_1'];
$skype = $formulario['skype'];
$gtalk = $formulario['gtalk'];
$twitter = $formulario['twitter'];
$empresa = $formulario['organizacion'];
$cargo = $formulario['cargo'];
$control	= $formulario['control'];
$telefono_fijo_1 = $formulario['telefono_organizacion'];

$password = generar_password();
$passwd_criptado= md5($passwd);
	//campos obligatorios que no estan parametrizados en la consulta

$campos_obligatorios = array( 
"p_nombre",
"p_apellido",
"documento",
"email", 
"telefono_celular", 
"empresa", 
"cargo"
);
///if ($campos_obligatorio =="")
foreach ($campos_obligatorios as $campo => $contenido)
	{
	if ($$contenido == ""){ $resultado .="<li><font color='red'>$campo // $$contenido</font></li>";

		$respuesta->addAlert('El campo ['.$contenido.'] no puede estar vacio');
		
		return $respuesta;
										}

	}	

	
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$consulta = "INSERT INTO `users` 
(`id`, `username`, `passwd`, `id_grupo`, `id_empresa`, `email`, `p_nombre`, `s_nombre`, `p_apellido`, `s_apellido`, `nombre_completo`, `documento_tipo`, `documento_numero`, `direccion`,  `control`, `ciudad`, `departamento`, `cargo`, `empresa`, `telefono_celular`, `telefono_fijo`, `telefono_fijo_1`, `skype`, `gtalk`, `twitter`) 
VALUES 
(NULL, '$username', '$passwd_criptado', '$id_grupo', '$id_empresa', '$email','$p_nombre', '$s_nombre', '$p_apellido', '$s_apellido', '$nombre_completo','$documento_tipo', '$documento_numero', '$direccion',  '$control', '$ciudad',  '$departamento', '$cargo', '$empresa', '$telefono_celular', '$telefono_fijo', '$telefono_fijo_1', '$skype', '$gtalk', '$twitter')";
$sql=mysql_query($consulta,$link);

//$resultado .= "<h1>$consulta</h1>";
include_once("includes/correos.php");
datos_nuevo_usuario($usuario, $mail, $password);
$resultado ="Se ha enviado un email a $email con los datos del nuevo usuario";
$respuesta->addAssign($div,"innerHTML",$resultado);
//$respuesta->addAlert("Se ha enviado un email a $email con los datos del nuevo usuario");

return $respuesta;
} 
$xajax->registerFunction("grabar_usuario");


function crear_usuario($div){
	//esta es una tipica funcion usando xajax
$id_empresa= $_SESSION['id_empresa'];
$control = md5(rand(1,99999999).microtime());
$respuesta = new xajaxResponse('utf-8');
$localizacion = combo_select('id','places','departamento','ciudad','');
$resultado .= "
<form id='formulario_crear_usuario' name= 'formulario_crear_usuario'>
<input type='hidden' name='control' id='control' value='$control'>
<label>Crear un nuevo usuario</label>
<fieldset>
<legend>Datos personales</legend>
<label>Primer nombre: <input type='text' name='primer_nombre' id='primer_nombre' placeholder='Primer nombre' title='Primer nombre'></label>
<label>Otros nombres: <input type='text' name='otro_nombre' id='otro_nombre'  placeholder='Otros nombres' title='Otros nombres'></label>
<label>Primer apellido: <input type='text' name='primer_apellido' id='primer_apellido'  placeholder='Primer apellido' title='Primer apellido'></label>
<label>Segundo apellido: <input type='text' name='segundo_apellido' id='segundo_apellido'  placeholder='Segundo apellido' title='Segundo apellido'></label>
<label>Documento de identidad: <input onchange=\"xajax_campos_iguales((document.getElementById('documento').value),(document.getElementById('documento_1').value),'revisa_documento'); \" type='text' name='documento' id='documento'  placeholder='Documento de identidad' title='Documento de identidad'></label>
<label>Comprobar documento: <input placeholder='Comprobar documento'  onchange=\"xajax_campos_iguales((document.getElementById('documento').value),(document.getElementById('documento_1').value),'revisa_documento'); \"  type='text' name='documento_1' id='documento_1' title='Comprobar documento'>
<div style='display: inline' id='revisa_documento'></div></label>

</fieldset>
<fieldset>
<legend>Datos de contacto</legend>
$localizacion 
<label>Dirección: <input type='text' name='direccion' id='direccion' title='direccion' placeholder='Dirección'></label>
<label>Teléfono fijo: <input type='text' name='telefono_fijo' id='telefono_fijo' title='telefono_fijo' placeholder='Teléfono fijo'></label>
<label>Teléfono celular: <input type='text' name='telefono_celular' id='telefono_celular' title='telefono_celular' placeholder='Teléfono celular'></label>
<label>Correo electrónico: <input type='email' placeholder='Correo electŕonico' name='email' id='email' title='email' onchange=\"xajax_campos_iguales((document.getElementById('email').value),(document.getElementById('email_1').value),'revisa_email'); \" ></label>
<label>Comprobar correo: <input type='email' placeholder='revisa email' name='email_1' id='email_1' title='Digite nuevamente su correo electrónico'  onchange=\"xajax_campos_iguales((document.getElementById('email').value),(document.getElementById('email_1').value),'revisa_email'); \">
<div style='display: inline' id='revisa_email'></div></label>
<label>Skype: <input type='text' name='skype' id='skype' title='skype' placeholder='Skype'></label>
<label>Gtalk<input type='email' name='gtalk' id='gtalk' title='gtalk' placeholder='Gtalk'></label>
<label>Twitter<input type='text' name='twitter' id='twitter' title='twitter' placeholder='Twitter'></label>
<!-- <label><input type='text' name='' id='' title='' placeholder=''></label> -->
</fieldset>

<fieldset>
<legend>Datos de la institución</legend>
<label>Organización: <input type='text' name='organizacion' id='organizacion' title='Nombre de la organización' placeholder='Nombre de la organización'></label>
<label>Cargo que ocupa: <input type='text' name='cargo' id='cargo' title='cargo o responsabilidad que ocupa' placeholder='cargo o responsabilidad'></label>
<label>Teléfono: <input type='text' name='telefono_organizacion' id='telefono_organizacion' title='Telélefono de la Organizacion' placeholder='Teléfono de la Organización'></label>
</fieldset>
<input type='button' value='Grabar' onclick=\"xajax_grabar_usuario(xajax.getFormValues('formulario_crear_usuario'),'$div');\" >
</form>

";

$respuesta->addAssign($div,"innerHTML",$resultado);

return $respuesta;
} 
/// se registra la funcion para que el xajax la tome en cuenta
$xajax->registerFunction("crear_usuario");


/*

function campos_iguales($campo_1,$campo_2,$div){
$respuesta = new xajaxResponse('utf-8');
if ($campo_1 != $campo_2)
{ $resultado = "<img src='images/atencion.gif' title='Los campos no coinciden' alt='[!]'>";}
else{$resultado = "<img src='images/check.gif' title='Los campos no coinciden' alt='[!]'>";}
$respuesta->addAssign($div,"innerHTML",$resultado);
return $respuesta;
}
$xajax->registerFunction("campos_iguales");
*/
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