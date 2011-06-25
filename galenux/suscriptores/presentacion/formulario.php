<?
include("../../librerias/conex.php");
$link=Conectarse();

?>
<table border="0" <?php if ($activos != "S"){echo "";}?>	style="width: 100%;"  cellpadding="0" cellspacing="0">

<h1><? echo $nombre_completo; ?></h1>
<tr><td align="right"> Grupo:</td><td>
																	<select name="id_grupo" size="0">
<?php 

																	if ($id_grupo != ""){
																	$ID_grupo_definido=mysql_query("SELECT * FROM usuarios_grupo WHERE id_grupo = $id_grupo",$link); 
																	
																	$grupo_definido=mysql_result($ID_grupo_definido,0,"grupo_nombre");  
																	echo "<option value='$id_grupo' selected >>$grupo_definido<</option>";
																											}
																												else {
 																				echo"<option value='0'selected type='text'>Sin asignar</option>";
 																															}
if ($_SESSION['prioridad'] >= "5"){
																				$Id_grupo=mysql_query("SELECT * FROM usuarios_grupo",$link); 
																					while($row = mysql_fetch_array($Id_grupo)) 
																					{
																		      printf("<option value='%s'> %s</option>", $row["id_grupo"], $row["grupo_nombre"]);
																		      }
																	 } 
?>
																	  </select>
															</td></tr>

<hr>

<tr><td><h2>Datos b&aacute;sicos</h2><hr></td><td></td></tr>
<tr><td colspan='2'>
<?
include_once ("../../terceros/listado_asignacion.php"); 
 echo "<br>EPS o aseguradora: ";
  if ($id_cliente == ''){$id_cliente='0';}
listado("1","$id_cliente");
 if ($tipo_usuario == ''){$tipo_usuario='0';}
include_once ("../../terceros/tipo_usuario.php"); 
 echo "<br>Tipo de usuario: ";
tipo_usuario("1","$tipo_usuario");
if ($plan_beneficios == ''){$plan_beneficios='0';}
 echo "<br>Plan de beneficios: ";
tipo_plan_beneficios("1","$plan_beneficios");
?>
</td></tr>
<tr><td>Primer Nombre:</td><td>Segundo Nombre:</td></tr>
<tr><td><input type="text" name="p_nombre" size="25" value="<? echo $p_nombre; ?>"></td><td> <input type="text" name="s_nombre" size="25" value="<? echo $s_nombre; ?>"> </td></tr>
<tr><td>Primer Apellido:</td><td>Segundo Apellido:</td></tr>
<tr><td><input type="text" name="p_apellido" size="25" value="<? echo $p_apellido; ?>"></td><td><input type="text" name="s_apellido" size="25" value="<? echo $s_apellido; ?>"></td></tr>
<tr><td>Tipo documento:</td><td>Documento: / Confirmacion</td></tr>
<tr><td><select name="documento_tipo" size="0">
<?php 
if ($documento_tipo != ""){$Tipo_documento_definido=mysql_query("SELECT * FROM documento_tipo WHERE id_documento_tipo = $documento_tipo",$link); 
$i=0;
$documento_tipo_definido=mysql_result($Tipo_documento_definido,$i,"documento_tipo");  
echo "<option value='$documento_tipo' selected >>$documento_tipo_definido<</option>";}
$Tipo_documento=mysql_query("SELECT * FROM documento_tipo",$link);  

while($row = mysql_fetch_array($Tipo_documento)) {
      printf("<option value='%s'> %s</option>", $row["id_documento_tipo"], $row["documento_tipo"]);}
?>
</select></td><td>

<input type="text" name="documento_numero" id="documento_numero"  value="<? echo $documento_numero; ?>">

<input type="text" name="documento_numero2" id="documento_numero2" value="<? echo $documento_numero; ?>">
<div id="documca"> </div>

<tr><td>E-mail:</td><td>Rectificar E-mail: </td></tr>
<tr ><td><input type="text" name="email" id="email"  size="25" value="<? echo $email; ?>"></td><td> <input type="text"  name="email_2" id="email_2" size="25" value="<? echo $email; ?>"></td></tr>
<tr><td></td><td><input type="hidden" value="<? echo $formulario ?>" id="formulario" name="formulario">
<?php include_once ("../../includes/mundo.php"); mundo("$formulario"); ?>
</td></tr>
<!-- <tr><td align="right">Pa&iacute;s:</td><td><input type="text"  name="pais" size="20" value="<? echo $pais; ?>"></td></tr>
<tr><td align="right">Departamento/Estado:</td><td> <input type="text" name="departamento"  value="<? echo $departamento; ?>"></td></tr>
<tr><td align="right">Municipio:</td><td> <input type="text" name="ciudad"  value="<? echo $ciudad; ?>"></td></tr> -->
<tr><td align="right">Direccion:</td><td> <input type="text" name="direccion"  value="<? echo $direccion; ?>" size="40"></td></tr>
<tr><td align="right"> Tel&eacute;fono fijo 1:</td><td> <input type="text" name="telefono_fijo" id="telefono_fijo"  onKeyPress="return acceptNum(event)" value=" <? echo $telefono_fijo; ?>"><div id="tele1ca"> </div></td></tr>
<tr><td align="right"> Tel&eacute;fono movil:</td><td> <input type="text" name="telefono_celular" onKeyPress="return acceptNum(event)" value="<? echo $telefono_celular; ?>"></td></tr>
<tr><td align="right">Nombre responsable:</td><td> <input type="text" name="nombre_responsable"  value="<? echo $responsable_nombre; ?>"></td></tr>
<tr><td align="right">Direcci&oacute;n responsable:</td><td> <input type="text" name="direccion_responsable"  value="<? echo $responsable_direccion; ?>"></td></tr>
<tr><td align="right">Telefono responsable:</td><td> <input type="text" name="telefono_responsable"  value="<? echo $responsable_telefono; ?>"></td></tr>

<tr><td><h2>Datos adicionales</h2><hr></td> <td></td></tr>


<tr><td align="right">Genero:
<?php 
if ($genero=="F"){echo "M<input type='radio' name='genero' value='M' > 
F<input type='radio' name='genero' value='F' checked>";}else {echo "M<input type='radio' name='genero' value='M' checked> 
F<input type='radio' name='genero' value='F'>";}
?>
</td><td>
Estado civil: <select name="estado_civil" size="0">
<?php 
if ($estado_civil != ""){
$Estado_civil_definido=mysql_query("SELECT * FROM estado_civil WHERE id_estado_civil = $estado_civil",$link); 
$i=0;
$estado_civil_definido=mysql_result($Estado_civil_definido,$i,"estado_civil");  
echo "<option value='$estado_civil' selected >>$estado_civil_definido<</option>";}
$Estado_civil=mysql_query("SELECT * FROM estado_civil",$link); 
while($row = mysql_fetch_array($Estado_civil)) {
      printf("<option value='%s'> %s</option>", $row["id_estado_civil"], $row["estado_civil"]);}
?>
</select></td></tr>
<tr><td align="right"> Fecha de Nacimiento: (a&ntilde;o-mes-dia)</td><td>
<?
include_once("fechador.php"); 
?>

<tr><td align="right"> Escolaridad:</td><td><select name="escolaridad" size="0">
<?php 
if ($escolaridad != ""){
$Escolaridad_definido=mysql_query("SELECT * FROM escolaridad WHERE id_escolaridad = $escolaridad",$link); 
$i=0;
$escolaridad_definido=mysql_result($Escolaridad_definido,$i,"escolaridad");  
echo "<option value='$escolaridad' selected >>$escolaridad_definido<</option>";}
$Escolaridad=mysql_query("SELECT * FROM escolaridad",$link); 
while($row = mysql_fetch_array($Escolaridad)) {
      printf("<option value='%s'> %s</option>", $row["id_escolaridad"], $row["escolaridad"]);}
?> </select>
 </td></tr>
<tr><td align="right"> Titulo profesional:</td><td> <input type="text" name="titulo_profesional" size="25"  value="<? echo $titulo_profesional; ?>"></td></tr>
<tr><td align="right"> Ocupaci&oacute;n:</td><td> <input type="text" name="ocupacion" size="25"  value="<? echo $ocupacion; ?>"></td></tr>
<tr><td align="right"> Empresa:</td><td> <input type="text" name="empresa"  value="<? echo $empresa; ?>"></td></tr>
<tr><td align="right"> Cargo:</td><td> <input type="text" name="cargo"  value="<? echo $cargo; ?>"></td></tr>
<tr><td align="right"> Tel&eacute;fono fijo 2:</td><td> <input type="text" onKeyPress="return acceptNum(event)" name="telefono_fijo_1"  value="<? echo $telefono_fijo_1; ?>"></td></tr>
<tr><td align="right"> Fax:</td><td> <input type="text" name="fax"  onKeyPress="return acceptNum(event)" value="<? echo $fax; ?>"></td></tr>
<tr><td align="right"> Tel&eacute;fono VoIP:</td><td> <input type="text" name="telefono_VoIP"  value="<? echo $telefono_VoIP; ?>"></td></tr>
<tr><td align="right">Web: http://</td><td> <input type="text" name="web" size="25" value="<? echo $web; ?>"></td></tr>


</table>
 <center>Observaciones:<br><textarea name="presentacion" rows="5" cols="75"><? echo $presentacion; ?></textarea>
<hr>

<input type="submit" value="Guardar los cambios"/> </center>
</form><?php
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