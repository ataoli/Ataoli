<?php 
$link=Conectarse(); 
$id_usuario=$_SESSION['id_usuario'];
/// para praxis se modifica con el color favorito solo del especialista logueado
//$css_especialistas=mysql_query("SELECT color, id	FROM especialistas ",$link);
$css_especialistas=mysql_query("SELECT color, id	FROM especialistas WHERE id='$id_usuario' ",$link);
if (mysql_num_rows($css_especialistas)!='0'){
$mi_bgcolor=mysql_result($css_especialistas,0,"color");
$_SESSION['mi_bgcolor']=$mi_bgcolor;				}else{$_SESSION['mi_bgcolor']="c2f0e5";}
?>
<style type="text/css">
option {font-family: verdana; font-size: 10px; color: green}
<?php 

		
   while($row = mysql_fetch_array($css_especialistas)) {
 echo "  option.C".$row["id"]." {background-color: #".$row["color"]."} \n";
 echo "  .FC".$row["id"]." {color: #".$row["color"]."} \n";
 echo "  .BC".$row["id"]." {background-color: #".$row["color"]."} \n";
   														}
							
?>
			SELECT{ font-family: verdana; font-size: 10px; color: green; background-color:;}
</style>

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