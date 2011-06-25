<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 

//if($_SESSION['grupo']!='1'){
$id_empresa= $_SESSION['id_empresa'];
//}else {$id_empresa='%%';}

mysql_query("SET NAMES 'utf8'");
$Usuario_Datos=mysql_query("
SELECT 	users.id, 
			users.id_grupo,
			users.documento_numero,
			users.fecha_nacimiento, 
			users.nombre_completo ,
			users.id_cliente 
			
FROM users 
WHERE  (users.id =  '$usuario')
AND id_empresa LIKE '$id_empresa'

",$link);
//echo "[ <a href='?page=suscriptores'><b>BUSCAR OTRO USUARIO</b></a> ]";
//echo "";
echo "<div name='asignacion_turnos' id='asignacion_turnos'>"; 

if (mysql_num_rows($Usuario_Datos)!=0){//// se comprueba el usuario si existe se sigue
$id=mysql_result($Usuario_Datos,0,"id");
$id_grupo=mysql_result($Usuario_Datos,0,"id_grupo");
$id_cliente=mysql_result($Usuario_Datos,0,"id_cliente");

/// incluir los datos del usuario
include_once("suscriptores/presentacion/usuarios_datos.php");
 usuario_datos($id,"$id_grupo");
echo $nuevo_select;



				}//// fin de la comprobacion de usuario

  
		else {/// si no es un usuario valido se alerta
		echo "<h1><img src='images/atencion.gif' border='0' alt='[!]'> El id $usuario  no existe o no cuenta con permisos para consultarlo</h1>";
		
				}
				echo"</div>";
   ?>
   </td></tr>

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