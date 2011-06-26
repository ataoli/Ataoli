<?php 
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: error.php");
// echo "hola mundo2";
}
?>

<table width="85%" border="0" align=center title="Situe el puntero sobre un campo para recibir ayuda">  
	<tr> 
		<td colspan="3">
		
			
		
<script type="text/javascript">

function Verificar()  {
    if (document.buscador.usuario.value==""){
    alert("Este campo no puede estar vacio, seleccione un ID de usuario para continuar")
    document.buscador.usuario.focus();
    return false;
  															}
							}

</script>
	 <?php  	if ($_SESSION['prioridad'] <= "2"){ 
	 include_once ("suscriptores_buscador_procesar.php"); 
	 } else { 
	 if (isset($_REQUEST['usuario'])) {
			$usuario = $_REQUEST['usuario'];
			include_once("suscriptores_buscador_procesar.php");

													}
			else{
			//// buscador por documento
			echo "<form  method='post'  id='buscador' name='buscador' onsubmit=\"return Verificar(this.form)\" autocomplete='off' >";
			 echo suggestivo('documento','users','id','documento_numero','1','Buscar un usuario por documento');	 
			 ////buscador por nombre
			 
			 echo suggestivo('usuario','users','id','nombre_completo','1','Buscar un usuario por nombre o apellido');	 
							?>
			
					<!-- 	Código: <input type='input' name='usuario' id='usuario' size='25' TITLE='Escriba el ID de Usuario' onKeyPress="return acceptNum(event)"> -->
			<!-- <input type="submit" name="boton" value="Buscar usuario"  size='25' title="Buscar un usuario">  -->
			<hr><div align='center'><input type='button' value='CREAR un nuevo usuario' onclick="xajax_wait('formulario');xajax_suscriptores_formulario('','$origen')"></div>
			</form>
			
			<?php }
			?>
			
		</td>
	</tr>
</table>

<?php	 } 
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