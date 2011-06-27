<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola mundo2";
} 
$fondo=$_SESSION['mi_bgcolor'];

?>
<script>
function mostrar(capa){
  var obj = document.getElementById(capa)
  if(obj.style.visibility== "hidden")  obj.style.visibility= "visible";
  else obj.style.visibility= "hidden";
}
</script><?php echo $_SESSION['sucursal_nombre'] ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" >

<?PHP 
///DE ACUERDO AL GRUPO SE PUEDE PRESENTAR UN MENU DIFERENTE
/// item_menu('DIRECTORIO','TITULO');
          
if (  $_SESSION['grupo'] == "8" ) { 
}

if (  $_SESSION['grupo'] == "7" ) { 


																	}

if (  $_SESSION['grupo'] == "4" ) { 



																	}
																	////GRUPO ADMINISTRADOR
if (  $_SESSION['grupo'] == "1" ) {
echo item_menu('parametrizacion','Parametrizacion');


																	}
if (  $_SESSION['grupo'] == "3" ) {


} 
if (  $_SESSION['grupo'] == "5" ) {



} 

echo item_menu('suscriptores','Usuarios');
echo item_menu('albergues','Albergues');
echo item_menu('entidades','Entidades');
?>



	
	</table>
	
	<?php include("includes/links.php"); ?>
	<hr>
	

	
	
	
	
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
