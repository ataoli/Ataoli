<?php 
//conecto con la base de datos
//selecciono la BBDD


$usuario=$_POST['usuario'];
$clave=md5($_POST['clave']);
if ($usuario == ''){header("Location: ../index.php?errorusuario=si");}
if ($clave == ''){header("Location: ../index.php?errorusuario=si");}
else{
include_once("config.php");
$conn = mysql_connect($Servidor,$Usuario,$Password); 
mysql_select_db($BaseDeDatos,$conn);
mysql_query("SET NAMES 'utf8'");
$sgrupo = "SELECT * 
						FROM $sql_tabla, usuarios_grupo 
						WHERE $sql_tabla.username='$usuario' 
						AND $sql_tabla.id_grupo = usuarios_grupo.id_grupo 
						AND passwd='$clave'
						LIMIT 1"; 
$grupo = mysql_query($sgrupo,$conn);
if (mysql_num_rows($grupo)!=0){


$Documento=mysql_result($grupo,0,"documento_numero");
$Prioridad=mysql_result($grupo,0,"prioridad");
$Grupo_Funcionario=mysql_result($grupo,0,"id_grupo");
$Primer_Nombre_Funcionario=mysql_result($grupo,0,"p_nombre");
$Segundo_Nombre_Funcionario=mysql_result($grupo,0,"s_nombre");
$Primer_Apellido_Funcionario=mysql_result($grupo,0,"p_apellido");
$Segundo_Apellido_Funcionario=mysql_result($grupo,0,"s_apellido");
$nombre_completo=mysql_result($grupo,0,"nombre_completo");
$empresa_heredada=mysql_result($grupo,0,"id_empresa");
$User_Name=mysql_result($grupo,0,"username");
$id_usuario=mysql_result($grupo,0,"id");
$email=mysql_result($grupo,0,"email");
/// se busca si pertenece a una empresa agrupada
$empresa_grupo=mysql_query("SELECT * FROM empresa_grupo WHERE id_usuario = '$id_usuario' LIMIT 1",$conn);
if (mysql_num_rows($empresa_grupo)=='0'){ 
													/// si el usuario NO esta en un grupo de empresa se busca su propia empresa 
		$sql=mysql_query("SELECT * FROM empresa WHERE empresa_responsable = '$id_usuario' LIMIT 1",$conn);
						////si tiene su empresa creada se asigna valor a las variables de $id_empresa y $razon_social
						if (mysql_num_rows($sql)!='0'){
						$id_empresa=mysql_result($sql,0,"id_empresa");
						$razon_social=mysql_result($sql,0,"razon_social");	
																}
																/// si No tiene una empresa propia se toma la heredada
																else{$id_empresa = $empresa_heredada;}
														}
														 /// si ESTA EN UN grupo de empresa  se retoma el $id_empresa 												
												else {
														$id_empresa=mysql_result($empresa_grupo,0,"id_empresa");	
														
														}
														/// se hace una busqueda en las empresas para averiguar la $razon_social
														$razon_social_consulta=mysql_query("SELECT * FROM empresa WHERE id_empresa = '$id_empresa' LIMIT 1",$conn);
											 			//// si se halla algo en la consulta
														if (mysql_num_rows($razon_social_consulta)!='0'){
														/// se establece el valor de $razon_social
														$razon_social=mysql_result($razon_social_consulta,0,"razon_social");	
																															}
if ($Grupo_Funcionario=="0") {header("Location: ../index.php?errorusuario=inactivo");}
else {

    session_start();
   //  session_register("6ffgf5rdgfcdgdf"); $usuarios_sesion
	$_SESSION[$usuarios_sesion]= "$usuarios_sesion";
	$_SESSION["id_usuario"]= "$id_usuario";
	//temporalmente se establece la empresa manual como "1"
	$_SESSION["razon_social"]= "$razon_social";
	$_SESSION["empresa"]= "1";
	$_SESSION["nombre_completo"]= "$nombre_completo";
	$_SESSION["documento_login"]= "$Documento";
	$_SESSION["autentificado"]= "SI";
	$_SESSION['Funcionario'] = "$User_Name";
	$_SESSION['usuario'] = "$User_Name";
	$_SESSION['contrasena'] = "$clave";
	$_SESSION['prioridad'] = "$Prioridad";
	$_SESSION['grupo'] = "$Grupo_Funcionario";
	$_SESSION['id_empresa'] = "$id_empresa";
	$_SESSION['Primer_Nombre_Funcionario'] = "$Primer_Nombre_Funcionario";
	$_SESSION['Segundo_Nombre_Funcionario'] = "$Segundo_Nombre_Funcionario";
	$_SESSION['Primer_Apellido_Funcionario'] = "$Primer_Apellido_Funcionario";
	$_SESSION['Segundo_Apellido_Funcionario'] = "$Segundo_Apellido_Funcionario";
	$_SESSION['email'] = "$email";
 	include_once("registrar_acceso.php");
 	registrar_acceso($id_usuario);
	header ("Location: ../adentro.php"); 
}
}else {
    //si no existe le mando otra vez a la portada
    header("Location: ../index.php?errorusuario=si");
}
mysql_free_result($rs);
mysql_close($conn);
}
?> 
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