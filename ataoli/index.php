<?php
session_start();
// Comprobamos si existe la variable
if ( isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: adentro.php");
} 
include_once("librerias/conex.php"); 
$link=Conectarse(); 
$usuario=$_SESSION['usuario'];
include_once("includes/datos.php");
  // No almacenar en el cache del navegador esta página.
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");             		// Expira en fecha pasada
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");		// Siempre página modificada
		header("Cache-Control: no-cache, must-revalidate");           		// HTTP/1.1
		header("Pragma: no-cache");  
		 
include_once("includes/datos.php");                                 		// HTTP/1.0
?>
<html xmlns="http://www.w3.org/1999/xhtml"xml:lang="es" lang="es" dir="ltr">
<head>  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Administracion de Usuarios <?php echo $empresa; ?></title>

 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link rel="SHORTCUT ICON" href="icono.ico">
<link href="estilos/estilo.css" rel="stylesheet" type="text/css">
</head>
<body onload="DetectBrowser();" >
<div id="example"></div>

<script type="text/javascript">
 function DetectBrowser() {
	var navegador = navigator.appName 
	if (navegador == "Microsoft Internet Explorer") {
		direccion=("explorer.html");
		window.location=direccion;
	}
}
</script>
<?php  echo $_SESSION['usuario_login']; ?>
<form id="form_index" action="includes/control.php" method="POST">
<table width="80%" border="0" align="center">  
<tr>
   <td colspan="3" align="center">
   
   <br><br><img src="images/logo.jpg"  border="0" title="<?php echo $empresa; ?>" alt="<?php echo $empresa; ?>" align="top"><br>
  </td>  
</tr>
<tr>
    <td colspan="2" align="center" 
	<?php if ($_REQUEST["errorusuario"]=="si"){?>
		bgcolor=red><span style="color:ffffff"><b>Datos incorrectos</b></span>
	<?php } elseif($_REQUEST["errorusuario"]=="inactivo"){ 
		echo "bgcolor=red><span style='color:ffffff'><b>Usuario inactivo</b></span>"; 
		} else { ?>
		bgcolor=#cccccc>Por favor ingrese los siguientes datos:
	<?php } ?>
	</td>
</tr>

<tr>
    <td align="center" colspan="2"><br><div align="center"><h3>Nombre:<input type="Text" name="usuario" size="20" maxlength="50"> Clave:<input type="password" name="clave" size="12" maxlength="50"> <input type="Submit" value="Entrar"></h3></td>
</tr>
<tr><td align="center" colspan="2"><a href="suscriptores/password/password_perdido.php">He perdido mi contrase&ntilde;a</a></tr>
<tr>
    <td colspan="2" align="center" valign="bottom">
    <table border='0' width='100%'>
    <tr>
    <td></td>
    <td width='100%' >.</td>
    <td><a href='http://qwerty.com.co'  border='0'><img src="images/qwerty.png"  border="0" title="http://qwerty.com.co" alt="QWERTY LTDA">    </a></td>
    </tr></table>
	<hr>

    </td>
</tr>
</table>

</form>
<br>

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
