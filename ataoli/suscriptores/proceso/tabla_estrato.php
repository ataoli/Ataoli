<?
include_once("../../librerias/conex.php");
$link=Conectarse();

$consulta="CREATE TABLE `estrato` (`id_estratificacion` INT( 1 ) NOT NULL, 
`estratificacion` CHAR( 10 ) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL , 
`Descripcion_estrato` TEXT CHARACTER SET utf8 COLLATE utf8_spanish2_ci  NOT NULL, PRIMARY KEY ( `id_estratificacion` )) 
TYPE = InnoDB CHARACTER SET latin1 COLLATE latin1_swedish_ci";
mysql_query($consulta,$link);
echo "<h1>Felicitaciones, Tabla Estrato creada</h1>";

$Ingreso="INSERT INTO `estrato` ( `id_estratificacion` , `estratificacion` , `Descripcion_estrato`)
VALUES ('0', 'NINGUNO', 'No se conoce '), ('1', '1', 'Estrato Bajo-Bajo'), ('2', '2', 'Estrato Bajo'), ('3', '3', 'Estrato Medio-Bajo'), ('4', '4', 'Estrato Medio'), ('5', '5', 'Estrato Medio Alto'), ('6', '6', 'Estrato Alto')";
mysql_query($Ingreso,$link);
echo mysql_error();
echo "<h2>Felicitaciones, Registros ingresados</h2>";
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