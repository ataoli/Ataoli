<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
}
?>
<!--<html>
<body>
<form name="auditoria" id="auditoria" method=POST action=#>
<textarea name="consulta" id="consulta" row=4 cols=80 ></textarea>
<input type=submit value=Consultar>
</form>
</body>
</html>-->

<?
include("../librerias/conex.php");
$link=Conectarse();
$id_usuario=$_SESSION["id_usuario"];
$fecha_ahora = date('Y-m-d g:i:s');

$cadena = mysql_query("SELECT id_usuario_temporal FROM usuarios_temporal WHERE ciudad LIKE 'BUGA'", $link);
while ($row = mysql_fetch_array($cadena))
{
mysql_query("update `usuarios_temporal` SET 
`digitado`='0',
`revisado`='1',  
`digitado_por`=NULL,    
`revisado_por`='$id_usuario',  
`revisado_fecha`='$fecha_ahora'
WHERE `usuarios_temporal`.`id_usuario_temporal` = '$row[0]' LIMIT 1",$link);
mysql_query("DELETE FROM `datos_geograficos` WHERE `id` = '$row[0]' LIMIT 1",$link);
}
echo "Proceso realizado correctamente";


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