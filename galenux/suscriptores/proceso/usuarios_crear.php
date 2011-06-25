<?PHP session_start();
?>
<script>
function cerrarse(){
opener.actualizar();
window.close()
}
</script>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../../estilos/estilo.css" rel="stylesheet" type="text/css">
</head>
<html>
<body>
<?
   include_once("../../librerias/conex.php");
   $link=Conectarse(); 


$id=$_POST['id']; 
$id_grupo=$_POST['id_grupo'];  
$documento_numero=$_POST['documento_numero'];   
$documento_numero2=$_POST['documento_numero2'];

if ($_POST['p_apellido'] != "") {$pp_apellido=$_POST['p_apellido']." ";}
if ($_POST['s_apellido'] != "") {$ss_apellido=$_POST['s_apellido']." ";}
if ($_POST['s_nombre'] != "") {$ss_nombre=$_POST['s_nombre']." ";}
if ($_POST['p_nombre'] != "") {$pp_nombre=$_POST['p_nombre']." "; }
  
$p_apellido=strtoupper($_POST['p_apellido']); 
$s_apellido=strtoupper($_POST['s_apellido']); 
$s_nombre=strtoupper($_POST['s_nombre']);
$p_nombre=strtoupper($_POST['p_nombre']); 

$nombre_completo=$pp_nombre.$ss_nombre.$pp_apellido.$ss_apellido; 
$nombre_completo=strtoupper($nombre_completo);
$documento_tipo=$_POST['documento_tipo'];
$estado_civil=$_POST['estado_civil'];
$id_cliente=$_POST['id_cliente'];
$plan_beneficios=$_POST['plan_beneficios'];
$tipo_usuario=$_POST['tipo_usuario'];
$genero=$_POST['genero']; 
$ano=$_POST['ano']; 
$mes=$_POST['mes']; 
$dia=$_POST['dia']; 
$fecha_nacimiento= $ano."-".$mes."-".$dia;
$email=$_POST['email'];   
$email_2=$_POST['email_2'];   
$direccion=$_POST['direccion'];
$geo_tipo_via_facturacion=$_POST['geo_tipo_via_facturacion'];
$geo_numero_01_facturacion=$_POST['geo_numero_01_facturacion'];  
$letra_1_facturacion=$_POST['letra_1_facturacion'];  
$geo_separador_facturacion=$_POST['geo_separador_facturacion'];  
$geo_numero_02_facturacion=$_POST['geo_numero_02_facturacion'];  
$geo_numero_03_facturacion=$_POST['geo_numero_03_facturacion'];  
$geo_hito_01_facturacion=$_POST['geo_hito_01_facturacion'];
$geo_hito_02_facturacion=$_POST['geo_hito_02_facturacion'];  
$geo_hito_03_facturacion=$_POST['geo_hito_03_facturacion'];    
$hito_01_facturacion=$_POST['hito_01_facturacion'];
$hito_02_facturacion=$_POST['hito_02_facturacion'];  
$hito_03_facturacion=$_POST['hito_03_facturacion'];    
$geo_tipo_via_envio=$_POST['geo_tipo_via_envio'];
$geo_numero_01_envio=$_POST['geo_numero_01_envio'];  
$letra_1_envio=$_POST['letra_1_envio'];  
$geo_separador_envio=$_POST['geo_separador_envio'];  
$geo_numero_02_envio=$_POST['geo_numero_02_envio'];  
$geo_numero_03_envio=$_POST['geo_numero_03_envio'];  
$geo_hito_01_envio=$_POST['geo_hito_01_envio'];
$geo_hito_02_envio=$_POST['geo_hito_02_envio'];  
$geo_hito_03_envio=$_POST['geo_hito_03_envio'];    
$hito_01_envio=$_POST['hito_01_envio'];
$hito_02_envio=$_POST['hito_02_envio'];  
$hito_03_envio=$_POST['hito_03_envio'];
$barrio=$_POST['barrio'];
$estrato=$_POST['estrato'];
$departamento=$_POST['cod_departamento'];  
$ciudad=$_POST['cod_ciudad'];   
$ciudad_extranjero=$_POST['ciudad_extranjero'];  
$pais=$_POST['cod_pais'];  
$estado=$_POST['estado'];  
$genero=$_POST['genero'];  
$estado_civil=$_POST['estado_civil'];  
$escolaridad=$_POST['escolaridad'];   
$titulo_profesional=$_POST['titulo_profesional'];  
$ocupacion=$_POST['ocupacion'];  
$empresa=$_POST['empresa']; 
$cargo=$_POST['cargo'];  
$telefono_fijo=$_POST['telefono_fijo']; 
$telefono_fijo_1=$_POST['telefono_fijo_1'];  
$fax=$_POST['fax']; 
$web=$_POST['web'];  
$telefono_celular=$_POST['telefono_celular']; 
$telefono_VoIP=$_POST['telefono_VoIP'];  
$presentacion=$_POST['presentacion'];    
$accion=$_POST['accion'];  
$responsable_nombre=$_POST['nombre_responsable'];  
$responsable_direccion=$_POST['direccion_responsable'];  
$responsable_telefono=$_POST['telefono_responsable'];  

if ($_SESSION['prioridad'] < "3"){} 
else { 
if ($accion == "crear"){

$consulta_documento = mysql_query ("select documento_numero from users where documento_numero = '$documento_numero'",$link);
if (mysql_num_rows($consulta_documento) > 0){
echo "<h1 align=center>Ya existe un suscriptor con ese mismo n&uacute;mero de c&eacute;dula</h1>";
echo "<p align=center><a href=../presentacion/crear_usuario.php>Clic para volver</a></p>";
exit();
}

include_once("crear_nombreusuario.php");
$username = crear_nombre($p_nombre, $p_apellido);
include_once("../password/generar_password.php");
$passwd = generar_password();
$passwd_criptado= md5($passwd);
mysql_query("SET NAMES 'utf8'");
mysql_query("INSERT INTO `users` ( `id` , `username` , `passwd` , `id_grupo` , `email` , `entkey` , `rank` , `adddate` , `status` , `lastip` , `lastdate` , `p_nombre` , `s_nombre` , `p_apellido` , `s_apellido` ,`nombre_completo` , `fecha_nacimiento` , `documento_tipo` , `documento_numero` , `direccion` , `barrio`, `estrato` , `ciudad` , `departamento` , `estado` , `pais` , `ciudad_extranjero` , `genero` , `estado_civil` , `escolaridad` , `titulo_profesional` , `ocupacion` , `cargo` , `empresa` , `telefono_celular` , `telefono_fijo` ,`telefono_fijo_1` ,`fax` ,`web` , `telefono_VoIP` , `fotografia` , `fotografia_tipo_archivo` , `presentacion` , `compartir_informacion`, `id_cliente`, `plan_beneficios`, `tipo_usuario`, `responsable_nombre`, `responsable_direccion`, `responsable_telefono`  )
VALUES ( NULL , '$username' , '$passwd_criptado' , '$id_grupo' , '$email' , '$entkey' , '$rank' , '$adddate' , '$status' , '$lastip' , '$lastdate' , '$p_nombre' , '$s_nombre' , '$p_apellido' , '$s_apellido' ,'$nombre_completo' , '$fecha_nacimiento' , '$documento_tipo' , '$documento_numero' , '$direccion' , '$barrio' , '$estrato' , '$ciudad' , '$departamento' , '$estado' , '$pais' , '$ciudad_extranjero' , '$genero' , '$estado_civil' , '$escolaridad' , '$titulo_profesional' , '$ocupacion' , '$cargo' , '$empresa' , '$telefono_celular' , '$telefono_fijo' ,'$telefono_fijo_1' ,'$fax' ,'$web' , '$telefono_VoIP' , '$fotografia' , '$fotografia_tipo_archivo' , '$presentacion' , '$compartir_informacion' , '$id_cliente', '$plan_beneficios', '$tipo_usuario', '$responsable_nombre', '$responsable_direccion', '$responsable_telefono' )",$link);

//Esto lo podemos volver una funcion, se me ocurrio asi  pero se puede hacer algo para mejorarlo
$consulta_recien_ingresado=mysql_query('SELECT id, entkey, username FROM users WHERE username=\''.$username.'\' AND p_nombre=\''.$p_nombre.'\' ',$link);
if (mysql_num_rows($consulta_recien_ingresado)==0){echo "<h1>Algo fue mal, el usuario no se creo correctamente</h1>";}
else{
$auxiliar_crear = mysql_fetch_array($consulta_recien_ingresado);
$id = $auxiliar_crear['id'];

include_once("crear_entkey.php");
$entkey = crear_entkey($id);
mysql_query('UPDATE users SET entkey=\''.$entkey.'\' WHERE id=\''.$id.'\'');

}
}
}

if($accion == "editar") {
   mysql_query("SET NAMES 'utf8'");
   mysql_query("UPDATE `users` SET 
`id_grupo`='$id_grupo',  
`documento_numero`='$documento_numero',     
`p_apellido`='$p_apellido', 
`s_apellido`='$s_apellido', 
`s_nombre`='$s_nombre',
`p_nombre`='$p_nombre', 
`nombre_completo`='$nombre_completo', 
`documento_tipo`='$documento_tipo',
`estado_civil`='$estado_civil',
`genero`='$genero', 
`fecha_nacimiento`='$fecha_nacimiento', 
`email`='$email',   
`direccion`='$direccion',  
`barrio`='$barrio',  
`estrato`='$estrato',  
`pais`='$pais', 
`departamento`='$departamento',  
`ciudad`='$ciudad',   
`ciudad_extranjero`='$ciudad_extranjero',  
`pais`='$pais',  
`estado`='$estado',  
`genero`='$genero',  
`estado_civil`='$estado_civil',  
`escolaridad`='$escolaridad',   
`titulo_profesional`='$titulo_profesional',  
`ocupacion`='$ocupacion',  
`empresa`='$empresa', 
`cargo`='$cargo',  
`telefono_fijo`='$telefono_fijo',
`telefono_fijo_1`='$telefono_fijo_1',
`fax`='$fax',
`web`='$web',  
`telefono_celular`='$telefono_celular', 
`telefono_VoIP`='$telefono_VoIP',  
`presentacion`='$presentacion',
`id_cliente`='$id_cliente',
`plan_beneficios`='$plan_beneficios',
`tipo_usuario`='$tipo_usuario',
`responsable_nombre`='$responsable_nombre',
`responsable_direccion`='$responsable_direccion',
`responsable_telefono`='$responsable_telefono'
 WHERE `users`.`id` = $id LIMIT 1",$link);   

}

include_once("../../librerias/conex.php");
$link=Conectarse(); 
$consulta_registro_ingresado=mysql_query('SELECT id, entkey, username FROM users WHERE id=\''.$id.'\'',$link);
if (mysql_num_rows($consulta_registro_ingresado)==0){
echo "<h2>No se guardo correctamente el usuario creado o los cambios efectuados a uno existente</h2>";
echo "<p align=center><button name='button' onclick=cerrarse(); type='submit' TITLE='Pulse para Continuar'value='Actualizar'>CERRAR</button>";
}
else {
$auxiliar_mostrar = mysql_fetch_array($consulta_registro_ingresado);
include_once("mostrar_informacion_usuario.php");
imprimir_informacion_usuario($auxiliar_mostrar['id'],$auxiliar_mostrar['username']);
if ($email != NULL and $accion == "crear"){
echo "¿Desea enviar un correo al nuevo suscriptor con los datos de su nueva cuenta?";
?>
<form id="Formulario_crear_usuario" method="post" action='../proceso/recordar.php'>
<input type='hidden' name='accion' id='accion' value='<? echo $accion ?>'>
<input type='hidden' name='mail' id='mail' value='<? echo $email ?>'>
<input type='hidden' name='usuario' id='usuario' value='<? echo $username ?>'>
<input type='hidden' name='password' id='password' value='<? echo $passwd ?>'>
<p align=center><input type='submit'  value='SI'>
</form>
<input type='button' onclick=cerrarse(); value='NO'></p>
<?
}
else if($email != NULL and $accion == "editar"){
echo "¿Desea enviar un correo al suscriptor con los datos de su cuenta?";
?>
<form id="Formulario_editar_usuario" method="post" action='../proceso/recordar.php'>
<input type='hidden' name='accion' id='accion' value='<? echo $accion ?>'>
<input type='hidden' name='id' id='id' value='<? echo $id ?>'>
<p align=center><input type='submit'  value='SI'>
</form>
<input type='button' onclick=cerrarse(); value='NO'></p>
<?
}
else{}

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