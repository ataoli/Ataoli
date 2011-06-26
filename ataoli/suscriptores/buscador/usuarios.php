<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: includes/error.php");
// echo "hola mundo2";
} 



$campos_formulario_usuario .= "
<div align='center'>
	
	<strong>Documento: </strong><br>
	<input style='width: 50%' type='text' id='30' name='30' value='' onclick=\"this.value=''; 
																																						document.getElementById('usuario').value=''	
	\" /> 

";	
$campos_formulario_usuario .="
<script type='text/javascript'>
	var options = {
		script:'suscriptores/buscador/test.php?json=true&limit=6&',
		varname:'input',
		json:true,
		minchars:3,
		maxchars:20,
		shownoresults:'true',
		noresults:'No hay usuarios con ese crititerio de busqueda',
		timeout:5000,
		
		
		callback: function (obj) { document.getElementById('usuario').value = obj.id; }
	};
	var as_json = new bsn.AutoSuggest('30', options);
	

</script>";
																			
echo $campos_formulario_usuario;


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