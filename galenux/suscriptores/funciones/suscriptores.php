<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../error.php");
// echo "hola mundo2";
} 
/// funcion usuarios_listado_alfabetico_botones
function usuarios_logueados($grupo,$titulo,$formulario,$funcion,$name){
$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");
if($_SESSION['grupo']=='9'){
$id=$_SESSION['id_usuario'];
$w="AND id='$id'";

}
$ahora = time();
$lapso ='60';////AND ping >= '$diferencia'
$diferencia = ($ahora - $lapso);
$Productos=mysql_query("SELECT * FROM users , sucursales_ocupacion, sucursales
								WHERE id_grupo = 3 
								$w 
								AND ping >= '$diferencia' 
								AND users.id = sucursales_ocupacion.id_usuario 
								AND sucursales.id_sucursal = sucursales_ocupacion.id_sucursal
								ORDER BY timestamp DESC LIMIT 1",$link);  
$usuarios = "
<select name='$name' size='0'  title='Sólo se mostrarán médicos activos en los últimos $lapso segundos'>
<option value='' selected>Especialista</option>";



while( $row = mysql_fetch_array( $Productos ) ) {

$usuarios .= "<option value='".$row['id']."' class='C".$row['id']."'>[ $row[sucursal_nombre] ] ".$row['nombre_completo']." </option>";

}
$usuarios .= "</select>
"; 
return $usuarios;
}
//$xajax->registerFunction("usuarios_logueados");

function usuarios_listado_alfabetico_botones($id_empresa,$id_grupo,$campo){
/// por seguridad la empresa se cambia a la registrada en la session
if($_SESSION['grupo']!='1'){$id_empresa= $_SESSION['id_empresa'];}else {$id_empresa='%%';}
if($_SESSION['grupo']!='1'){$id_grupo= $id_grupo;}else {$id_grupo='%%';}
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$nuevo_select .= "<div id='usuarios_listado_alfabetico'><center><a href='?page=suscriptores' title='Pacientes'>[Buscador] </a> [ ";
foreach (range ( 'A' , 'Z' ) as $letra) 
	{ 
	$letras=mysql_query("SELECT count($campo) as cantidad 
												FROM `users` 
												WHERE  $campo LIKE  '$letra%%' 
													AND id_grupo like '$id_grupo'  
													AND id_empresa like '$id_empresa'
												GROUP BY id_grupo",$link);
	if (mysql_num_rows($letras)!='0'){	
	$cantidad=mysql_result($letras,0,"cantidad"); 
	$nuevo_select .= "<a title='$cantidad'onClick=\"xajax_usuarios_listado_alfabetico('$letra','0','2','$campo')\">$letra</a> "; 
																		}else{
$nuevo_select .= "<font  color='#BFBFBF'>$letra </font>"; 																		
																		}
	} 
$nuevo_select .=" ]</center><hr></div>";

return $nuevo_select;

} 
/// fin listado_alfabetico_botones

/// funcion usuarios_listado_alfabetico
function usuarios_listado_alfabetico($letra,$id_empresa,$id_grupo,$campo){
/// por seguridad la empresa se cambia a la registrada en la session
if($_SESSION['grupo']!='1'){$id_empresa= $_SESSION['id_empresa'];}else {$id_empresa='%%';}
if($_SESSION['grupo']!='1'){$id_grupo= $id_grupo;}else {$id_grupo='%%';}
$respuesta = new xajaxResponse('utf-8');

$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$nuevo_select .= "<center><a href='?page=suscriptores' title='Pacientes'>[Buscador] </a> [ ";
foreach (range ( 'A' , 'Z' ) as $letra_top) 
	{ 
	$letras=mysql_query("SELECT count($campo) as cantidad 
												FROM `users` 
												WHERE  $campo LIKE  '$letra_top%%' 
													AND id_grupo like '$id_grupo'  
													AND id_empresa like '$id_empresa'
												GROUP BY id_grupo",$link);
	if (mysql_num_rows($letras)!='0'){	
	$cantidad=mysql_result($letras,0,"cantidad"); 
	if($letra_top == $letra){$nuevo_select .= "<font color='red' size='+1'>$letra </font>";}else{
	$nuevo_select .= "<a title='$cantidad'onClick=\"xajax_usuarios_listado_alfabetico('$letra_top','0','2','$campo')\">$letra_top</a> "; 
																														}
																		}else{
$nuevo_select .= "<font  color='#BFBFBF'>$letra_top </font>"; 																		
																		}
	} 
$nuevo_select .=" ]</center><hr><div id='usuarios_listado_alfabetico'></div>";


$sql=mysql_query("SELECT * 
									FROM users 
									WHERE  $campo LIKE  '$letra%%' 
													AND id_grupo LIKE '$id_grupo'  
													AND id_empresa LIKE '$id_empresa' 
									ORDER BY 	$campo ASC, 
														p_apellido ASC ,
														s_apellido ASC , 
														p_nombre ASC , 
														s_nombre ASC 
									",$link);

if (mysql_num_rows($sql)!='0'){
$nuevo_select .= "<table cellpadding='0' cellspacing='0' border='0' align='center'><tr><td align='center' valign='top'><b>Código</b></td><td align='center' valign='top'><b>Nombre</b></td><td align='center' valign='top'><b>Documento</b></td></tr>";

while( $row = mysql_fetch_array( $sql ) ) {
$nuevo_select .= "<tr  onMouseOver=\"uno(this,'c2f0e5');\" onMouseOut=\"dos(this,'FFFFFF');\" bgcolor='#FFFFFF'>
										<td>".$row['id']."</td>
										<td><A href='adentro.php?page=suscriptores&usuario=".$row['id']."' title='Click para seleccionar el usuario' >".$row['p_apellido']." ".$row['s_apellido']." ".$row['p_nombre']." ".$row['s_nombre']."</a></td>
										<td align='right' valign='top'>".$row['documento_numero']."</td>
									</tr>";
															}
$nuevo_select .="</table><hr>";
										}

$respuesta->addAssign("usuarios","innerHTML",$nuevo_select);
return $respuesta;
} 
/// fin listado_alfabetico

///funcion crear_editar_suscriptores
function crear_editar_suscriptores($formulario_array,$origen){
$respuesta = new xajaxResponse('utf-8');
$id_empresa = $_SESSION['id_empresa'];
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
$id = $formulario_array["id"];
$id_grupo=$formulario_array["id_grupo"];
$documento_numero=$formulario_array["documento_numero"];   
$documento_numero_2=$formulario_array["documento_numero_2"];
$documento_tipo=$formulario_array["documento_tipo"];
$estado_civil=$formulario_array["estado_civil"];
$id_cliente=$formulario_array["id_cliente"];
$plan_beneficios=$formulario_array["plan_beneficios"];
$tipo_usuario=$formulario_array["tipo_usuario"];
$genero=$formulario_array["genero"]; 

$ano= $formulario_array["ano"];
$mes= $formulario_array["mes"];
$dia= $formulario_array["dia"];
$fecha_nacimiento= "$ano-$mes-$dia";
$email=$formulario_array["email"];   
$email_2=$formulario_array["email_2"];   
$direccion=$formulario_array["direccion"];
$barrio=$formulario_array["barrio"];
$zona_residencia=$formulario_array["zona_residencia"];
$departamento=$formulario_array["cod_departamento"];  
$ciudad=$formulario_array["cod_ciudad"];   
$pais=$formulario_array["cod_pais"];  
if ($pais==''){$pais="COL";}
$genero=$formulario_array["genero"];  
$estado_civil=$formulario_array["estado_civil"];  
$escolaridad=$formulario_array["escolaridad"];   
$titulo_profesional=$formulario_array["titulo_profesional"];  
$ocupacion=$formulario_array["ocupacion"];  
$empresa=$formulario_array["empresa"]; 
$cargo=$formulario_array["cargo"];  
$telefono_fijo=$formulario_array["telefono_fijo"]; 
$telefono_fijo_1=$formulario_array["telefono_fijo_1"];  
$fax=$formulario_array["fax"]; 
$web=$formulario_array["web"];  
$telefono_celular=$formulario_array["telefono_celular"]; 
$telefono_VoIP=$formulario_array["telefono_VoIP"];     
$accion=$formulario_array["accion"];  
$responsable_nombre=$formulario_array["nombre_responsable"];  
$responsable_direccion=$formulario_array["direccion_responsable"];  
$responsable_telefono=$formulario_array["telefono_responsable"]; 
$enviar_datos=$formulario_array["enviar_datos"]; 
$timestamp = time();
$hora=date('H:i:s');
$hoy=date('Y-m-d');
list( $ano, $mes, $dia ) = explode( '-', $hoy );
$hoy_timestamp=mktime(0,0,0, $mes, $dia, $ano);
$id_anfitrion =$_SESSION['id_usuario'];
$control=$formulario_array['control']; 

if ($formulario_array["p_apellido"] != "") {$pp_apellido=$formulario_array["p_apellido"]." ";}
if ($formulario_array["s_apellido"] != "") {$ss_apellido=$formulario_array["s_apellido"]." ";}
if ($formulario_array["s_nombre"] != "") {$ss_nombre=$formulario_array["s_nombre"]." ";}
if ($formulario_array["p_nombre"] != "") {$pp_nombre=$formulario_array["p_nombre"]." "; }
  
$p_apellido=strtoupper($formulario_array["p_apellido"]); 
$s_apellido=strtoupper($formulario_array["s_apellido"]); 
$s_nombre=strtoupper($formulario_array["s_nombre"]);
$p_nombre=strtoupper($formulario_array["p_nombre"]); 
$nombre_completo=$pp_nombre.$ss_nombre.$pp_apellido.$ss_apellido; 
$nombre_completo=strtoupper($nombre_completo);
/// REPORTE INCONSISTENCIAS
/*
$inconsistencia_tipo=$formulario_array["inconsistencia_tipo"]; 
if($inconsistencia_tipo != ''){
$consulta_ultima_inconsistencia ="SELECT timestamp_fecha, consecutivo FROM 	inconsistencias WHERE timestamp_fecha = '$hoy_timestamp' 	ORDER BY consecutivo DESC LIMIT  1";
$ultimo= mysql_query($consulta_ultima_inconsistencia,$link);
if (mysql_num_rows($ultimo)!='0'){
$ultimo_consecutivo=mysql_result($ultimo,0,"consecutivo");
$consecutivo= ++$ultimo_consecutivo;
																			}else{$consecutivo='1';}
$pin = rand(1000,9999);
$inconsistencia_tipo=$formulario_array["inconsistencia_tipo"];
$primer_apellido=$formulario_array["primer_apellido"];
$segundo_apellido=$formulario_array["segundo_apellido"];
$primer_nombre=$formulario_array["primer_nombre"];
$segundo_nombre=$formulario_array["segundo_nombre"];
$tipo_documento=$formulario_array["tipo_documento"];
$numero_documento=$formulario_array["numero_documento"];
$fecha_nacimiento_errada=$formulario_array["fecha_nacimiento_errada"];
$telefono=$formulario_array["telefono"];
$direccion_residencia=$formulario_array["direccion_residencia"];
$departamento=$formulario_array["cod_departamento"];
$municipio=$formulario_array["municipio"];
$departamento_errado=$formulario_array["departamento_errado"];
$municipio_errado=$formulario_array["municipio_errado"];
$cobertura=$formulario_array["cobertura"];
$correccion_primer_apellido=$formulario_array["correccion_primer_apellido"];
$correccion_segundo_apellido=$formulario_array["correccion_segundo_apellido"];
$correccion_primer_nombre=$formulario_array["correccion_primer_nombre"];
$correccion_segundo_nombre=$formulario_array["correccion_segundo_nombre"];
$correcccion_tipo_documento=$formulario_array["correccion_tipo_documento"];
$correccion_numero_documento=$formulario_array["correccion_numero_documento"];
$correcccion_fecha_nacimiento=$formulario_array["fecha_nacimiento"];
$observaciones_inconsistencia=$formulario_array["observaciones_inconsistencia"];

$grabar_inconsistencia = " 
INSERT INTO `inconsistencias` (
`timestamp_inconsistencia` ,
`timestamp_fecha` ,
`consecutivo` ,
`inconsistencia_tipo` ,
`primer_apellido` ,
`segundo_apellido` ,
`primer_nombre` ,
`segundo_nombre` ,
`tipo_documento` ,
`numero_documento` ,
`fecha_nacimiento` ,
`direccion_residencia` ,
`telefono` ,
`departamento` ,
`municipio` ,
`cobertura` ,
`correccion_primer_apellido` ,
`correccion_segundo_apellido` ,
`correccion_primer_nombre` ,
`correccion_segundo_nombre` ,
`correccion_tipo_documento` ,
`correccion_numero_documento` ,
`correccion_fecha_nacimiento` ,
`control` ,
`id_funcionario` ,
`id_usuario` ,
`id_empresa`,
`id_cliente`,
`pin`,
`observaciones`
)
VALUES (

 '$timestamp',
 '$hoy_timestamp',
 '$consecutivo',
 '$inconsistencia_tipo',
 '$primer_apellido',
 '$segundo_apellido',
 '$primer_nombre',
 '$segundo_nombre',
 '$tipo_documento',
 '$numero_documento',
 '$fecha_nacimiento',
 '$direccion_residencia',
 '$telefono',
 '$departamento_errado',
 '$municipio_errado',
 '$cobertura',
 '$correccion_primer_apellido',
 '$correccion_segundo_apellido',
 '$correccion_primer_nombre',
 '$correccion_segundo_nombre',
 '$correccion_tipo_documento',
 '$correccion_numero_documento',
 '$fecha_nacimiento_errada',
 '$control',
 '$id_anfitrion',
 '$id',
 '$id_empresa',
 '$id_cliente',
 '$pin',
 '$observaciones_inconsistencia'
);

";
mysql_query($grabar_inconsistencia,$link);

										}
										/// FIN INCONSISTENCIAS
/// manejo del error 
*/
/// revisa que el documento no exista para usuarios nuevos
//if($id==''){
$consulta_documento = mysql_query ("SELECT documento_numero FROM users WHERE documento_numero = '$documento_numero'",$link);
if(mysql_num_rows($consulta_documento) != '0'){$capa="documento_numero"; $error = "Ya existe un usuario con ese <b>Número de documento</b>";}
else{$capa="documento_numero"; $error = "Ya existe un usuario con ese <b>Número de documento</b>";}
//						}
//if($id_cliente==''){$capa="id_cliente"; $error = "No se ha seleccionado una <b>EPS</b> o <b>Contrato</b>";}
if($id_grupo=='2'){}
if($p_nombre==''){$capa="p_nombre"; $error = "No se ha escrito el <b>Primer nombre</b> ";}
elseif($p_apellido==''){$capa="p_apellido"; $error = "No se ha escrito el <b>Primer apellido</b>";}
elseif($documento_numero==''){$capa="documento_numero"; $error = "No se ha escrito un <b>Número de documento</b>";}
elseif($documento_numero!=$documento_numero_2){$capa="documento_numero_2"; $error = "Los <b>números de documento</b> no son iguales";}
elseif($email!=$email_2){$capa="email_2"; $error = "Los <b>email</b> no son iguales";}
elseif($id=='' AND mysql_num_rows($consulta_documento) != '0'){$capa="documento_numero"; $error = "Ya existe un usuario con ese <b>Número de documento</b>";}
else{$error = '0';}
if($error !='0'){ 
								$alerta = "<img src='images/atencion.gif' alt='[!]' title='$error'>";
								$aviso = "<img src='images/atencion.gif' alt='[!]' title='$error'> $error";
								$respuesta->addAssign("$capa","innerHTML",$alerta);
								$respuesta->addAssign("error","innerHTML",$aviso);
								
								}else
								{
if($id==''){/// si es un usuario nuevo
				if($email==''){ /// si el usuario no tiene mail se genera un nombre de usuario
					$numero_aleatorio = rand(10000000,99999999);
					$nombre_usuario = $p_nombre[0].$p_nombre[1].$p_apellido[0].$p_apellido[1].$numero_aleatorio;
					$nombre_usuario = strtolower(substr($nombre_usuario, 0, 8));
											}
				else {///si el usuario tiene mail, este sera su nombre de usuario
											$nombre_usuario=$email;
							}
					/// generar password
					//include_once("suscriptores/password/generar_password.php");
					//$passwd = generar_password();
					  
    $longitud = 8;
    $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+-*%&_";
    mt_srand(microtime() * 1000000);
    for($i = 0; $i < 10; $i++)
    {
    $key = mt_rand(0,strlen($caracteres)-1);
    $password = $password . $caracteres{$key};
    }
    $passwd = $password;
					$passwd_criptado= md5($passwd);
					//$usuario_grabado .= $passwd;
					//$usuario_grabado .= $passwd_criptado;
					
					$insertar_usuario ="INSERT INTO `users` ( 
			`id` , 
			`username` , 
			`passwd` , 
			`id_grupo` , 
			`email` , 
			`entkey` , 
			`rank` , 
			`adddate` , 
			`status` , 
			`lastip` , 
			`lastdate` , 
			`p_nombre` , 
			`s_nombre` , 
			`p_apellido` , 
			`s_apellido` ,
			`nombre_completo` , 
			`fecha_nacimiento` , 
			`documento_tipo` , 
			`documento_numero` , 
			`direccion` , 
			`barrio`, 
			`zona_residencia`, 
			`control` , 
			`ciudad` , 
			`departamento` , 
			`estado` , 
			`pais` , 
			`ciudad_extranjero` , 
			`genero` , 
			`estado_civil` , 
			`escolaridad` , 
			`titulo_profesional` , 
			`ocupacion` , 
			`cargo` , 
			`empresa` , 
			`telefono_celular` , 
			`telefono_fijo` ,`telefono_fijo_1` ,`web` , 
			`skype` , 
			
			`id_cliente`, 
			`plan_beneficios`, 
			`tipo_usuario`, 
			`responsable_nombre`, 
			`responsable_direccion`, 
			`responsable_telefono` , 
			`id_empresa`  
			)
VALUES ( 
				NULL , 
				'$nombre_usuario' , 
				'$passwd_criptado' , 
				'$id_grupo' , 
				'$email' , 
				'$entkey' , 
				'$rank' , 
				'$adddate' , 
				'$status' , 
				'$lastip' , 
				'$lastdate' , 
				'$p_nombre' , 
				'$s_nombre' , 
				'$p_apellido' , 
				'$s_apellido' ,
				'$nombre_completo' , 
				'$fecha_nacimiento' , 
				'$documento_tipo' , 
				'$documento_numero' , 
				'$direccion' , 
				'$barrio' , 
				'$zona_residencia' , 
				'$control' , 
				'$ciudad' , 
				'$departamento' , 
				'$estado' , 
				'$pais' , 
				'$ciudad_extranjero' , 
				'$genero' , 
				'$estado_civil' , 
				'$escolaridad' , 
				'$titulo_profesional' , 
				'$ocupacion' , 
				'$cargo' , 
				'$empresa' , 
				'$telefono_celular' , 
				'$telefono_fijo' ,
				'$telefono_fijo_1' ,
				
				'$web' , 
				'$telefono_VoIP' , 
				
				'$id_cliente', 
				'$plan_beneficios', 
				'$tipo_usuario', 
				'$responsable_nombre', 
				'$responsable_direccion', 
				'$responsable_telefono' , 
				'$id_empresa' 
				)";
mysql_query($insertar_usuario,$link);
				
			if($enviar_datos =='1'){//// si se activa la variable $enviar_datos se le envia el passwor al nuevo usuario


include_once("includes/datos.php");
global $empresa,$url_aplicacion,$correo_corporativo,$cliente,$url_aplicacion;  
$asunto ="[GaleNUx $cliente] Bienvenido al sistema";
$cuerpo ="
<html>
<body>
<p align=left>Ha sido creada su cuenta de usuario en $cliente 
<br>A continuación, encontrará los datos necesarios para que pueda iniciar sesión en <a href='$url_aplicacion'>$cliente</a>
<br>Los datos de ingreso son su responsabilidad y debe cambiar su password frecuentemente en el siguiente enlace:
<a href='$url_aplicacion/suscriptores/password/password_perdido.php'> $url_aplicacion/suscriptores/password/password_perdido.php </a>
<br> Todas sus transacciones serán guardadas y monitoreadas conforme a la Ley 527 de 1999
 (en lo relacionado con la validez e irrefutabilidad de la informacion electronica).
 
 <br>El presente correo electrónico fué enviado a <b>$nombre_completo</b> si no corresponde por favor reportelo replicando este email.



<br>
<li>Ingreso: <a href='$url_aplicacion'>$url_aplicacion</a></li>
<li>Nombre de usuario: <b>$nombre_usuario</b></li>
<li>Password: <b>$passwd</b></li>
</ul>
<p>Saludos.<br>
$empresa
</p>
</body>
</html>
";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: $correo_corporativo";

mail($email,$asunto,$cuerpo,$headers);

								}
				
$ultimo_usuario = mysql_query ("SELECT id FROM users WHERE control = '$control' ",$link);
if (mysql_num_rows($ultimo_usuario)!=0){
$Ultimo_usuario=mysql_result($ultimo_usuario,0,"id");
$usuario_grabado .="<div align='center'><a href='adentro.php?page=suscriptores&usuario=$Ultimo_usuario&$control'>Continuar con el usuario</a></div>";
$capa_resultado ='usuarios';
									}
						}else{/// si se esta editando un usuario existente
									//nos aseguramos que el id de usuario sea valido
$consulta_usuario = mysql_query ("SELECT id FROM users WHERE id = '$id' AND id_empresa='$id_empresa' ",$link);
 
if (mysql_num_rows($consulta_usuario)!=0){
/// SI EL GRUPO ES 3 o especialista
if($id_grupo=='3' || $id_grupo=='8' || $id_grupo=='9'){
// REVISAR QUE NO EXISTA EL ESPECIALISTA
$id_especialista=$_SESSION[id_usuario];
$especialista = mysql_query ("SELECT id FROM especialistas WHERE id = '$id_especialista' ",$link);
/// si no existe el especialista
if (mysql_num_rows($especialista)==0){
 
$registro_medico=$formulario_array["registro_medico"]; 
$especialidad=$formulario_array["especialidad"]; 
$universidad_especializacion=$formulario_array["universidad_especializacion"]; 
$cargo=$formulario_array["cargo"]; 
$universidad_pregrado=$formulario_array["universidad_pregrado"]; 
mysql_query("
INSERT INTO especialistas (id_especialista, id, registro_medico, especialidad, universidad_especializacion, cargo, universidad_pregrado, activo) 
VALUES ('NULL', '$id', '$registro_medico', '$especialidad', '$universidad_especializacion', '$cargo', '$universidad_pregrado', '1')",$link);

									}
																			}
//$usuario_grabado .= mysql_result($consulta_usuario,0,"id"); 
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
`username`='$email',   
`direccion`='$direccion',  
`barrio`='$barrio',  
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
`web`='$web',  
`telefono_celular`='$telefono_celular', 
`skype`='$telefono_VoIP',  
`id_cliente`='$id_cliente',
`plan_beneficios`='$plan_beneficios',
`tipo_usuario`='$tipo_usuario',
`responsable_nombre`='$responsable_nombre',
`responsable_direccion`='$responsable_direccion',
`responsable_telefono`='$responsable_telefono'
 WHERE `users`.`id` = '$id' LIMIT 1",$link);  
///$usuario_grabado .="<div align='center'><a href='adentro.php?page=suscriptores&usuario=$id'>Continuar con el usuario</a></div>";
$capa_resultado ='formulario';
																					}else
																					{
				$usuario_grabado .= "NO ESTA AUTORIZADO[ $id_empresa ]";
																					}
									}
									
	
									if($origen != 'inicio'){
//$respuesta->outputEntitiesOff();
$respuesta->addAssign("error","innerHTML","");


//$pagina="adentro.php\?page=suscriptores\&usuario=\$id";
if($id !=''){
$respuesta->addScript("window.location='adentro.php?page=suscriptores&usuario=$id'");
}else{
$respuesta->addAssign("$capa_resultado","innerHTML",$usuario_grabado);
}
																					}
																					else{
$respuesta->addRedirect("adentro.php");
																							}
									}/// fin de si no hay error
return $respuesta;

																		}/// fin crear_editar_suscriptores



//// funcion para el formulario

function suscriptores_formulario($id,$origen) {
$respuesta = new xajaxResponse('utf-8');
$link = conectarse(); 
mysql_query("SET NAMES 'utf8'");
if ($id !=""){ ///si se pasa el id de un usuario se consulta para editar
$capa = "formulario";

$consulta_datos_usuario ="SELECT * FROM users  WHERE  (id =  '$id')";
$Usuario_Datos=mysql_query($consulta_datos_usuario,$link); 
$num=mysql_num_rows($Usuario_Datos);

if (mysql_num_rows($Usuario_Datos)!=0){

$id=mysql_result($Usuario_Datos,0,"id");  
$id_grupo=mysql_result($Usuario_Datos,0,"id_grupo");       
$nombre_completo=mysql_result($Usuario_Datos,0,"nombre_completo");   
$id_cliente=mysql_result($Usuario_Datos,0,"id_cliente");
$plan_beneficios=mysql_result($Usuario_Datos,0,"plan_beneficios");
$tipo_usuario=mysql_result($Usuario_Datos,0,"tipo_usuario");
$documento_numero=mysql_result($Usuario_Datos,0,"documento_numero");      
$p_apellido=mysql_result($Usuario_Datos,0,"p_apellido");
$s_apellido=mysql_result($Usuario_Datos,0,"s_apellido"); 
$s_nombre=mysql_result($Usuario_Datos,0,"s_nombre"); 
$p_nombre=mysql_result($Usuario_Datos,0,"p_nombre");  
//$documento_tipo=mysql_result($Usuario_Datos,0,"documento_tipo"); 
$estado_civil=mysql_result($Usuario_Datos,0,"estado_civil"); 
$genero=mysql_result($Usuario_Datos,0,"genero");  
//$fecha_nacimiento=mysql_result($Usuario_Datos,0,"fecha_nacimiento");  
/*
if ($fecha_nacimiento == "0000-00-00"){
$ano = "";
$mes = "";
$dia = "";
}
else {
$letras=array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

$fecha_nacimiento = strtotime($fecha_nacimiento);
$ano = date("Y", $fecha_nacimiento);
$mes = date("m", $fecha_nacimiento);
$dia = date("d", $fecha_nacimiento);
$mes_letras = date("n", $fecha_nacimiento);
$mes_letras = $letras[$mes_letras];
$fecha_nacimiento = "$ano $mes $dia / $mes_letras" ;
}*/
$email=mysql_result($Usuario_Datos,0,"email");  
$direccion=mysql_result($Usuario_Datos,0,"direccion");   
$barrio=mysql_result($Usuario_Datos,0,"barrio");     
//$zona_residencia=mysql_result($Usuario_Datos,0,"zona_residencia");   
$control=mysql_result($Usuario_Datos,0,"control");   
//$departamento=mysql_result($Usuario_Datos,0,"departamento");   
//$ciudad=mysql_result($Usuario_Datos,0,"ciudad");      
$ciudad_extranjero=mysql_result($Usuario_Datos,0,"ciudad_extranjero");   
$pais=mysql_result($Usuario_Datos,0,"pais");   
$estado=mysql_result($Usuario_Datos,0,"estado");   
//$genero=mysql_result($Usuario_Datos,0,"genero");   
//$estado_civil=mysql_result($Usuario_Datos,0,"estado_civil");   
$escolaridad=mysql_result($Usuario_Datos,0,"escolaridad");    
$titulo_profesional=mysql_result($Usuario_Datos,0,"titulo_profesional");   
$ocupacion=mysql_result($Usuario_Datos,0,"ocupacion");   
$empresa=mysql_result($Usuario_Datos,0,"empresa");  
$cargo=mysql_result($Usuario_Datos,0,"cargo");   
$telefono_fijo=mysql_result($Usuario_Datos,0,"telefono_fijo");  
$telefono_fijo_1=mysql_result($Usuario_Datos,0,"telefono_fijo_1");  
//$fax=mysql_result($Usuario_Datos,0,"fax");  
//$web=mysql_result($Usuario_Datos,0,"web");   
$telefono_celular=mysql_result($Usuario_Datos,0,"telefono_celular");  
$telefono_VoIP=mysql_result($Usuario_Datos,0,"skype");   
$activos=mysql_result($Usuario_Datos,0,"activos");
$responsable_nombre=mysql_result($Usuario_Datos,0,"responsable_nombre");
$responsable_direccion=mysql_result($Usuario_Datos,0,"responsable_direccion");
$responsable_telefono=mysql_result($Usuario_Datos,0,"responsable_telefono");



}///fin de datos validos
}else{////si es un usuario nuevo
$capa='usuarios';
		}

$control = md5($_SESSION[id_usuario]."-".microtime());


$suscriptores_formulario .= "
<div style='background-color: #FFFFE3; border-color: #FFA500; border-width: 2px; ' id='resultado'>
<form name='suscriptores' id='suscriptores'>		
		<input type='hidden' name='control' id='control' size='50' value='$control'>
<h1>$nombre_completo $id </h1>
	<table border='0'	style='width: 95%;' align='center' cellpadding='0' cellspacing='0'>

		<tr>
			<td colspan='2'>
			<h2>Datos b&aacute;sicos</h2>
			<hr>
			</td>
		</tr>
				<tr>
			<td colspan='2'>Grupo:<select name='id_grupo' size='0'>";


					if ($id_grupo != ""){
					$ID_grupo_definido=mysql_query("SELECT * FROM usuarios_grupo WHERE id_grupo = $id_grupo",$link); 
					
					$grupo_definido=mysql_result($ID_grupo_definido,0,"grupo_nombre");  
					$suscriptores_formulario .= "<option value='$id_grupo' selected >>$grupo_definido<</option>";
																											}
																												else {
 					$suscriptores_formulario .= "<option value='2'selected type='text'>Paciente</option>";
 																															}
					if ($_SESSION['prioridad'] >= "5"){
																				$Id_grupo=mysql_query("SELECT * FROM usuarios_grupo  WHERE inactivo != '1'",$link); 
																					while($row = mysql_fetch_array($Id_grupo)) 
																					{
					$suscriptores_formulario .= "<option value='".$row["id_grupo"]."'>".$row["grupo_nombre"]."</option>";
																		      }
																	 } 
$suscriptores_formulario .= "
					</select>
					
			</td>
		</tr>
		<tr>
			<td colspan='2'><div id='id_cliente'></div><b><font color='red'>*</font></b> Entidad: ";

 //include_once ("terceros/listado_asignacion_xajax.php"); 

  if ($id_cliente == ''){$id_cliente='0';}
$suscriptores_formulario .= $nuevo_select;/// esta es la variable en listado_asignacion_xajax.php donde esta el listado de EPS
$suscriptores_formulario .= "";
 if ($tipo_usuario == ''){$tipo_usuario='0';}
//include_once ("terceros/tipo_usuario.php"); 
$suscriptores_formulario .= "<br>Tipo de usuario: ";
//$suscriptores_formulario .= tipo_usuario("1","$tipo_usuario");
if ($plan_beneficios == ''){$plan_beneficios='0';}
$suscriptores_formulario .= "<br>Plan de beneficios: ";
//$suscriptores_formulario .= tipo_plan_beneficios("1","$plan_beneficios");

$suscriptores_formulario .= "
				
			</td>
		</tr>
		<tr>
			<td> <input type='hidden' name='id' size='5' value='$id'>
			
			<div id='p_nombre'></div><b><font color='red'>*</font></b> Primer Nombre:</td>
			<td>Segundo Nombre:</td>
		</tr>
		<tr>
			<td>
			<input type='text' name='p_nombre' size='50' value='$p_nombre'>
			</td>
			<td> 
			<input type='text' name='s_nombre' size='50' value='$s_nombre'> 
			</td>
		</tr>
		<tr>
			<td><div id='p_apellido'></div><b><font color='red'>*</font></b> Primer Apellido:</td>
			<td>Segundo Apellido:</td>
		</tr>
		<tr>
			<td>
			<input type='text' name='p_apellido' size='50' value='$p_apellido'></div>
			</td>
			<td>
			<input type='text' name='s_apellido' size='50' value='$s_apellido'>
			</td>
		</tr>

		<tr>
			<td align='center' colspan='2'><div id='documento_numero'></div> Tipo documento: <select name='documento_tipo' size='0'>
			";

if ($documento_tipo != ""){
		$Tipo_documento_definido=mysql_query("SELECT * FROM documento_tipo WHERE id_documento_tipo = $documento_tipo",$link); 

		$documento_tipo_definido=mysql_result($Tipo_documento_definido,0,"documento_tipo");  
		$suscriptores_formulario .= "<option value='$documento_tipo' selected >>$documento_tipo_definido<</option>";}
		$Tipo_documento=mysql_query("SELECT * FROM documento_tipo",$link);  
		while($row = mysql_fetch_array($Tipo_documento)) {
    $suscriptores_formulario .= "<option value='".$row["id_documento_tipo"]."'>".$row["documento_tipo"]."</option>";}
$suscriptores_formulario .= "
					</select>
				 
				<b><font color='red'>*</font></b>Número: <input type='text' name='documento_numero' id='documento_numero'  value='$documento_numero'>
				Confirmación: <input type='text' name='documento_numero_2' id='documento_numero_2' value='$documento_numero'><div id='documento_numero_2'></div>
			<tr>
				<td align='right'> Fecha de Nacimiento: (a&ntilde;o-mes-dia)</td>";
				$suscriptores_formulario .= fechador($ano,$mes,$dia,$mes_letras); 
				$suscriptores_formulario .= "
				<td>
			</tr>				
			<tr>
				<td align='right'>Genero:";
				

if ($genero=="F"){    
											$suscriptores_formulario .= "M<input type='radio' name='genero' value='M' >F<input type='radio' name='genero' value='F' checked>";
									}else {    
											$suscriptores_formulario .= "M<input type='radio' name='genero' value='M' checked>F<input type='radio' name='genero' value='F'>";
												}
$suscriptores_formulario .= "
				</td>
				<td>	Estado civil: <select name='estado_civil' size='0'>";
if ($estado_civil != ""){
$Estado_civil_definido=mysql_query("SELECT * FROM estado_civil WHERE id_estado_civil = $estado_civil",$link); 
$estado_civil_definido=mysql_result($Estado_civil_definido,0,"estado_civil");  
    $suscriptores_formulario .= "<option value='$estado_civil' selected >>$estado_civil_definido<</option>";
    										}
$Estado_civil=mysql_query("SELECT * FROM estado_civil",$link); 
while($row = mysql_fetch_array($Estado_civil)) {
    $suscriptores_formulario .= "<option value='".$row["id_estado_civil"]."'>".$row["estado_civil"]."</option>";
    																						}
    $suscriptores_formulario .= "
														</select>
				</td>
			</tr>
			<tr >
				<td align='right'>E-mail:</td> 
				<td>
				 <input type='text' name='email' id='email'  size='25' value='$email'>
				</td>
			</tr>
				<td align='right'>
				<div id='email_2'></div>Confirmar:
				</td>
				<td><input type='text'  name='email_2' id='email_2' size='25' value='$email'>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
				<input type='hidden' value='suscriptores' id='formulario' name='formulario'>";
//		include_once ("includes/mundo.php"); 
if($pais==''){
   $suscriptores_formulario .= departamentos("suscriptores","$pais","$departamento","$ciudad","suscriptores");
   }else{
   $suscriptores_formulario .= mundo("suscriptores","$pais","$departamento","$ciudad","suscriptores");}
    $suscriptores_formulario .= "    
				</td>
			</tr>
			<tr>
				<td align='right' valign='top'>Direccion:</td>
				<td><input type='text' name='direccion'  value='$direccion' size='60'>
				<br>Zona de residencia: <select name='zona_residencia' id='zona_residencia'><option value='U'>Urbana</option><option value='R'>Rural</option></select>
				<br>Barrio o vereda:<input type='text' name='barrio'  value='$barrio' size='40'>
				</td>
			</tr>
			<tr>
				<td align='right'> Tel&eacute;fono fijo 1:</td>
				<td> 
				<input type='text' name='telefono_fijo' id='telefono_fijo'  onKeyPress=\"return acceptNum(event)\" value='$telefono_fijo'>
				<div id='tele1ca'> </div>
				</td>
			</tr>
			<tr>
				<td align='right'> Tel&eacute;fono movil:</td>
				<td> 
				<input type='text' name='telefono_celular' onKeyPress=\"return acceptNum(event)\" value='$telefono_celular'>
				</td>
			</tr>
			<tr>
				<td align='right'>Nombre responsable:</td>
				<td> 
				<input type='text' name='nombre_responsable'  value='$responsable_nombre' size='50'>
				</td>
			</tr>
			<tr>
				<td align='right'>Direcci&oacute;n responsable:</td>
				<td> 
				<input type='text' name='direccion_responsable'  value='$responsable_direccion' size='50'></td>
			</tr>
			<tr>
				<td align='right'>Telefono responsable:</td>
				<td> 
				<input type='text' name='telefono_responsable'  value='$responsable_telefono'></td>
			</tr>
			<tr><td colspan='2'>
			<!-- INICIO REPORTE DE INCONSISTENCIAS --><br>
		<div name='capa_inconsistencias' id='capa_inconsistencias' align='center'>
		<h2 title='Haga click aqui si es necesario reportar una inconsistencia en la base de datos' class='cursor' onclick=\"xajax_formulario_inconsistencias('capa_inconsistencias','1')\"> >> Reporte de inconsistencias <<</h2></div>
			<!-- FIN REPORTE INCONSISTENCIAS -->
			</td></tr>
			<!-- <pre>DATOS ADICIONALES</pre> -->
			<tr>
				<td colspan='2'>
				<h2>Datos adicionales</h2><hr>
				</td>
			</tr>
			
			";

 
$suscriptores_formulario .= "
				
					<td align='right'> Escolaridad:</td>
					<td><select name='escolaridad' size='0'>
				
							";
							/*
if ($escolaridad != ""){
$Escolaridad_definido=mysql_query("SELECT * FROM escolaridad WHERE id_escolaridad = $escolaridad",$link); 

$escolaridad_definido=mysql_result($Escolaridad_definido,0,"escolaridad");  
$suscriptores_formulario .= "<option value='$escolaridad' selected >>$escolaridad_definido<</option>";}
$Escolaridad=mysql_query("SELECT * FROM escolaridad",$link); 
while($row = mysql_fetch_array($Escolaridad)) {
    $suscriptores_formulario .= "<option value='".$row["id_escolaridad"]."'>".$row["escolaridad"]."</option>";}
    */
$suscriptores_formulario .= " 
    					</select>
 					</td>
 				</tr>
 				<tr>
 					<td align='right'> Titulo profesional:</td>
 					<td> <input type='text' name='titulo_profesional' size='25'  value='$titulo_profesional'></td>
 				</tr>
 				<tr>
 					<td align='right'> Ocupaci&oacute;n:</td>
 					<td> <input type='text' name='ocupacion' size='25'  value='$ocupacion'></td>
 				</tr>
 				<tr>
 					<td align='right'> Empresa:</td>
 					<td> <input type='text' name='empresa'  value='$empresa'></td>
 				</tr>
 				<tr>
 					<td align='right'> Cargo:</td>
 					<td> <input type='text' name='cargo'  value='$cargo'></td>
 				</tr>
 				<tr>
 					<td align='right'> Tel&eacute;fono fijo 2:</td>
 					<td> <input type='text' onKeyPress=\"return acceptNum(event)\" name='telefono_fijo_1'  value='$telefono_fijo_1'></td>
 				</tr>
 				<tr>
 					<td align='right'> Fax:</td>
 					<td> <input type='text' name='fax'  onKeyPress=\"return acceptNum(event)\" value='$fax'></td>
 				</tr>
 		<!-- 		<tr>
 					<td align='right'> Tel&eacute;fono VoIP:</td>
 					<td> <input type='text' name='telefono_VoIP'  value='$telefono_VoIP'></td>
 				</tr>
 				<tr>
 					<td align='right'>Web: http://</td>
 					<td> <input type='text' name='web' size='25' value='$web'></td>
 				</tr> -->
 				<tr>
 					<td align='right'><font color='red'>Enviar mail con los datos de ingreso al email del nuevo usuario?</font></td>
 					<td><input type='radio' name='enviar_datos' value='0' checked>NO <input type='radio' name='enviar_datos' value='1' >SI</td>
 				</tr>
			</table>
 			
 			<div id='error'></div>
 			<input type='button' value='Guardar los cambios' 
 								onClick=\"xajax_crear_editar_suscriptores(xajax.getFormValues('suscriptores'),'$origen')\"/> 
 						</form>
 								
 								</center>
 								</div> <!-- FIN DEL DIV resultado -->
 								
 		";
$respuesta->addAssign("$capa","innerHTML",$suscriptores_formulario);
return $respuesta;

														
																	}
/// fin funcion formulario

//// inconsistencias
function formulario_inconsistencias($capa,$tipo){
$respuesta = new xajaxResponse('utf-8');
$link=Conectarse(); 
mysql_query("SET NAMES 'utf8'");
if($tipo =='1'){
$inconsistencias .="
	<tr>
				<td colspan='2'>
				<h2 class='cursor'>>> Reporte de inconsistencias <<</h2><hr>
				<a title='Cancela el reporte de inconsistencia' class='cursor' onclick=\"xajax_formulario_inconsistencias('capa_inconsistencias','0')\">CANCELAR</a>
				<table cellpadding='0' cellspacing='0' border='0' align='center' width='90%'>
					<tr>
						<td valign='top'>Tipo de inconsistencia:
															 <br><input type='radio' value='0' name='inconsistencia_tipo' id='inconsistencia_tipo'>El usuario no existe en la base de datos
															 <br><input type='radio' value='1' name='inconsistencia_tipo' id='inconsistencia_tipo'>Los datos no corresponden al documento de identidad

															 
						</td>
						<td align='right'>
						Datos que aparecen en la base de datos consultada
						<br>Primer apellido <input type='text' name='primer_apellido' size='50'>
						<br>Segundo apellido <input type='text' name='segundo_apellido'  size='50'>
						<br>Primer nombre <input type='text' name='primer_nombre'  size='50'>
						<br>Segundo nombre <input type='text' name='segundo_nombre'  size='50'>
						</td>
					</tr>
					<tr>
						<td align='right'>
						Tipo de documento que aparece en la base errada: 
						<select name='tipo_documento' size='0'>
			";

if ($documento_tipo != ""){
		$Tipo_documento_definido=mysql_query("SELECT * FROM documento_tipo WHERE id_documento_tipo = $documento_tipo",$link); 

		$documento_tipo_definido=mysql_result($Tipo_documento_definido,0,"documento_nombre");  
		$inconsistencias .= "<option value='$documento_tipo' selected >>$documento_tipo_definido<</option>";}
		$Tipo_documento=mysql_query("SELECT * FROM documento_tipo",$link);  
		while($row = mysql_fetch_array($Tipo_documento)) {
    $inconsistencias .= "<option value='".$row["id_documento_tipo"]."'>".$row["documento_nombre"]."</option>";}
$inconsistencias .= "
					</select>
						<br>Número de documento que aparece en la base errada: <input type='text' name='numero_documento'  size='20'>
						<br>Fecha de nacimiento que aparece en la base errada: <input type='text' name='fecha_nacimiento_errada'  size='20' title='AAAA-MM-DD'>
						<br>Teléfono que aparece en la base errada: <input type='text' name='telefono'  size='20' title=''>
						</td>
						<td valign='top' align='right'>
						Dirección que aparece en la base errada:<br> <textarea name='direccion_residencia' cols='30' rows='2'></textarea>
						<br>Departamento que aparece en la base errada: <input type='text' name='departamento_errado'  size='2'>
						<br>Municipio que aparece en la base errada: <input type='text' name='municipio_errado'  size='3'>
						</td>
					</tr>
					<tr>
						<td colspan='2'><div align='center'>Cobertura en salud que aparece en la base errada: 
						<input type='text' name='cobertura'  size='60'></div>
						</td>
					</tr>
					<tr>
						<td>
						<input type='checkbox' name='correccion_primer_apellido' value='1'>Primer apellido errado
						<br><input type='checkbox' name='correccion_segundo_apellido' value='1'>Segundo apellido errado
						<br><input type='checkbox' name='correccion_primer_nombre' value='1'>Primer nombre errado
						<br><input type='checkbox' name='correccion_segundo_nombre' value='1'>Segundo nombre errado
						</td>
						<td  valign='top'>
						<br><input type='checkbox' name='correccion_tipo_documento' value='1'>Tipo de documento errado
						<br><input type='checkbox' name='correccion_numero_documento' value='1'>Número de documento errado
						<br><input type='checkbox' name='correccion_fecha_nacimiento' value='1'>Fecha de nacimiento errada
						</td>
					</tr>
					<tr>
						<td colspan='2'>
						<div align='center'>Observaciones de la inconsistencia<br><textarea name='observaciones_inconsistencia' cols='60' rows='2'></textarea></div>
						</td>
						
					</tr>
					
				</table>
				</td>
			</tr>
			
";
}else{$inconsistencias ="<h2 title='Reportar una inconsistencia en la base de datos' class='cursor' onclick=\"xajax_formulario_inconsistencias('capa_inconsistencias','1')\"> >> Reporte de inconsistencias <<</h2>";}

$respuesta->addAssign("$capa","innerHTML",$inconsistencias);
return $respuesta;
}
$xajax->registerFunction("formulario_inconsistencias");
/// fin inconsistencias


/////LISTADO USUARIOS POR CLIENTE
function listado_usuarios_por_cliente($id_cliente){
$link=Conectarse(); 
mysql_query ("SET NAMES 'utf8'");

$Usuarios=mysql_query("SELECT * FROM users WHERE id_grupo ='2' AND id_cliente = '$id_cliente'",$link);  
$usuarios .= "
<select name='usuario'  id='usuario' size='0'  title='Se refiere a usuarios o pacientes'>
<option value='' selected>Usuario</option>";

while( $row = mysql_fetch_array( $Usuarios ) ) {

$usuarios .=  "<option value='".$row['id']."' class='C".$row['id']."'>".$row['documento_numero']." > ".$row['nombre_completo']." </option>";

}
$usuarios .=  "</select>"; 
return $usuarios ;

}


function fechador($ano,$mes,$dia,$mes_letras){

$fechador.="
<select name='ano' size='1'> 
";
if ($ano==''){ $fechador .="<option value='' selected >A&Ntilde;O</option>";}
else{ $fechador .="<option value='$ano' selected >$ano</option>";}
$fechador .="
<option value='1910'>1900</option>
<option value='1910'>1901</option>
<option value='1910'>1902</option>
<option value='1910'>1903</option>
<option value='1910'>1904</option>
<option value='1910'>1905</option>
<option value='1910'>1906</option>
<option value='1910'>1907</option>
<option value='1910'>1908</option>
<option value='1910'>1909</option>
<option value='1910'>1910</option>
<option value='1911'>1911</option>
<option value='1912'>1912</option>
<option value='1913'>1913</option>
<option value='1914'>1914</option>
<option value='1915'>1915</option>
<option value='1916'>1916</option>
<option value='1917'>1917</option>
<option value='1918'>1918</option>
<option value='1919'>1919</option>
<option value='1920'>1920</option>
<option value='1921'>1921</option>
<option value='1922'>1922</option>
<option value='1923'>1923</option>
<option value='1924'>1924</option>
<option value='1925'>1925</option>
<option value='1926'>1926</option>
<option value='1927'>1927</option>
<option value='1928'>1928</option>
<option value='1929'>1929</option>
<option value='1930'>1930</option>
<option value='1931'>1931</option>
<option value='1932'>1932</option>
<option value='1933'>1933</option>
<option value='1934'>1934</option>
<option value='1935'>1935</option>
<option value='1936'>1936</option>
<option value='1937'>1937</option>
<option value='1938'>1938</option>
<option value='1939'>1939</option>
<option value='1940'>1940</option>
<option value='1941'>1941</option>
<option value='1942'>1942</option>
<option value='1943'>1943</option>
<option value='1944'>1944</option>
<option value='1945'>1945</option>
<option value='1946'>1946</option>
<option value='1947'>1947</option>
<option value='1948'>1948</option>
<option value='1949'>1949</option>
<option value='1950'>1950</option>
<option value='1951'>1951</option>
<option value='1952'>1952</option>
<option value='1953'>1953</option>
<option value='1954'>1954</option>
<option value='1955'>1955</option>
<option value='1956'>1956</option>
<option value='1957'>1957</option>
<option value='1958'>1958</option>
<option value='1959'>1959</option>
<option value='1960'>1960</option>
<option value='1961'>1961</option>
<option value='1962'>1962</option>
<option value='1963'>1963</option>
<option value='1964'>1964</option>
<option value='1965'>1965</option>
<option value='1966'>1966</option>
<option value='1967'>1967</option>
<option value='1968'>1968</option>
<option value='1969'>1969</option>
<option value='1970'>1970</option>
<option value='1971'>1971</option>
<option value='1972'>1972</option>
<option value='1973'>1973</option>
<option value='1974'>1974</option>
<option value='1975'>1975</option>
<option value='1976'>1976</option>
<option value='1977'>1977</option>
<option value='1978'>1978</option>
<option value='1979'>1989</option>
<option value='1980'>1980</option>
<option value='1981'>1981</option>
<option value='1982'>1982</option>
<option value='1983'>1983</option>
<option value='1984'>1984</option>
<option value='1985'>1985</option>
<option value='1986'>1986</option>
<option value='1987'>1987</option>
<option value='1988'>1988</option>
<option value='1989'>1989</option>
<option value='1990'>1990</option>
<option value='1991'>1991</option>
<option value='1992'>1992</option>
<option value='1993'>1993</option>
<option value='1994'>1994</option>
<option value='1995'>1995</option>
<option value='1996'>1996</option>
<option value='1997'>1997</option>
<option value='1998'>1998</option>
<option value='1999'>1999</option>
<option value='2000'>2000</option>
<option value='2001'>2001</option>
<option value='2002'>2002</option>
<option value='2003'>2003</option>
<option value='2004'>2004</option>
<option value='2005'>2005</option>
<option value='2006'>2006</option>
<option value='2007'>2007</option>
<option value='2008'>2008</option>
<option value='2009'>2009</option>
<option value='2010'>2010</option>
</select>

<select name='mes' size='1'> 
";
if ($mes==''){ $fechador .="<option value='' selected >MES</option>";}
else{ $fechador .="<option value='$mes' selected >$mes_letras </option>";}
$fechador .="
<option value='01'>Enero</option>
<option value='02'>Febrero</option>
<option value='03'>Marzo</option>
<option value='04'>Abril</option>
<option value='05'>Mayo</option>
<option value='06'>Junio</option>
<option value='07'>Julio</option>
<option value='08'>Agosto</option>
<option value='09'>Septiembre</option>
<option value='10'>Octubre</option>
<option value='11'>Noviembre</option>
<option value='12'>Diciembre</option>
</select>

<select name='dia' size='1'> 
";
if ($dia==''){$fechado .="<option value='' selected >D&Iacute;A</option>";}
else{ $fechador .="<option value='$dia' selected >$dia</option>";}
$fechador .="
<option value='1'>01</option>
<option value='2'>02</option>
<option value='3'>03</option>
<option value='4'>04</option>
<option value='5'>05</option>
<option value='6'>06</option>
<option value='7'>07</option>
<option value='8'>08</option>
<option value='9'>09</option>
<option value='10'>10</option>
<option value='11'>11</option>
<option value='12'>12</option>
<option value='13'>13</option>
<option value='14'>14</option>
<option value='15'>15</option>
<option value='16'>16</option>
<option value='17'>17</option>
<option value='18'>18</option>
<option value='19'>19</option>
<option value='20'>20</option>
<option value='21'>21</option>
<option value='22'>22</option>
<option value='23'>23</option>
<option value='24'>24</option>
<option value='25'>25</option>
<option value='26'>26</option>
<option value='27'>27</option>
<option value='28'>28</option>
<option value='29'>29</option>
<option value='30'>30</option>
<option value='31'>31</option>
</select></td></tr>
";
return $fechador;
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