<form name="presForm" id="presForm" method="post" action="/enviar/form" onsubmit="protoSend();return false;" class="asholder">
	
	<label for="testinput"></label>
		<input style="width: 500px" type="text" id="testinput" value=""  />
	
	<br>Nuevo usuario: <input type="text" id="testid" value="" name="Documento" style="font-size: 10px; width: 100px;" />
	<input type="submit" value="Buscar!" />
</form>

<script type="text/javascript">
	var options = {
		script:"suscriptores/librerias/Usuarios_Todos_Datos_Suggest.php?json=true&limit=6&",
		varname:"input",
		json:true,
		shownoresults:false,
		maxresults:6,
		minchars:4,
		callback: function (obj) { document.getElementById('testid').value = obj.id; }
	};
	var as_json = new bsn.AutoSuggest('testinput', options);
	
	
	var options_xml = {
		script: function (input) { return "suscriptores/librerias/Usuarios_Todos_Datos_Suggest.php?input="+input+"&testid="+document.getElementById('testid').value; },
		varname:"input"
	};
	var as_xml = new bsn.AutoSuggest('testinput_xml', options_xml);
</script><?php
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