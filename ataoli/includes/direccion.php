<?php 
function direccion($tipo){

$link=Conectarse(); 
?>
<h2>Direcci&oacute;n <?php echo $tipo; ?></h2>
<p><font color="#B2B2B2">Avenida<sup>1</sup> Carrera<sup>2</sup> 38<sup>3</sup> a<sup>4</sup> bis<sup>5</sup> Sur<sup>6</sup> #<sup>7</sup> 145<sup>8</sup> b<sup>9</sup> - 12<sup>10</sup> Oriente<sup>11</sup> Conjunto<sup>12</sup> Picadilly<sup>13</sup> Interior<sup>14</sup> 12<sup>15</sup> Apartamento<sup>16</sup> 401<sup>17</sup> Oficina<sup>18</sup> 3<sup>19</sup></font></p>
<sup><font color="00ff00">1</font></sup><select name="id_geo_tipo_via_<?php echo $tipo; ?>" size="0">
<option value="" selected >Via </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_tipo_via != ""){$Geo_tipo_via_definido=mysql_query("SELECT * FROM geo_tipo_via WHERE id_geo_tipo_via = $geo_tipo_via",$link); 
$i=0;
$geo_tipo_via_definido=mysql_result($Geo_tipo_via_definido,$i,"id_geo_tipo_via");  
echo "<option value='$geo_tipo_via_definido' selected >>$geo_tipo_via<</option>";}
$geo_tipo_via=mysql_query("SELECT * FROM geo_tipo_via ",$link);  

while($fila= mysql_fetch_array($geo_tipo_via)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_tipo_via"], $fila["geo_tipo_via"]);}


?>

</select>

<sup><font color="00ff00">2</font></sup><select name="id_geo_tipo_via_extra_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_tipo_via_extra != ""){$Geo_tipo_via_definido_extra=mysql_query("SELECT * FROM geo_tipo_via WHERE id_geo_tipo_via = $geo_tipo_via_extra",$link); 
$i=0;
$geo_tipo_via_definido_extra=mysql_result($Geo_tipo_via_definido_extra,$i,"id_geo_tipo_via");  
echo "<option value='$geo_tipo_via_definido_extra' selected >>$geo_tipo_via_extra<</option>";}
$geo_tipo_via_extra=mysql_query("SELECT * FROM geo_tipo_via ",$link);  

while($fila= mysql_fetch_array($geo_tipo_via_extra)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_tipo_via"], $fila["geo_tipo_via"]);}


?>

</select>  

<sup><font color="00ff00">3</font></sup><select name="id_geo_numero_01_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php
for ($i=0;$i<=350;$i++)
{        
       echo "<option value=$i>$i</option>";
      
}
?>
</select>


<sup><font color="00ff00">4</font></sup><select name="letra_01_<?php echo $tipo; ?>">
<option value="" selected > </option>
<option value="bis">bis</option>

<?php
$cadena = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","x","y","z");
for ($i=0;$i<=25;$i++){
 echo "<option value=$cadena[$i]>$cadena[$i]</option>";
}
?>

</select>
<sup><font color="00ff00">5</font></sup><select name="letra_03_<?php echo $tipo; ?>">
<option value="" selected > </option>
<option value="bis">bis</option>

<?php
$cadena = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","x","y","z");
for ($i=0;$i<=25;$i++){
 echo "<option value=$cadena[$i]>$cadena[$i]</option>";
}
?>
</select>

<sup><font color="00ff00">6</font></sup><select id="orientacion_01" name="orientacion_01">
<option value='' SELECTED ></option>
<option value='Sur' >Sur</option>
<option value='Norte' >Norte</option>
<option value='Este' >Oriente</option>
<option value='Oeste' >Occidente</option>
</select>

<sup><font color="00ff00">7</font></sup><select name="geo_separador_<?php echo $tipo; ?>" size="0">

<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_separador != ""){$Geo_separador_definido=mysql_query("SELECT * FROM geo_separador WHERE id_geo_separador = $geo_separador",$link); 
$i=0;
$geo_separador_definido=mysql_result($Geo_separador_Definido,$i,"id_geo_separador");  
echo "<option value='$geo_separador_definido' selected >>$geo_separador<</option>";}
$geo_separador=mysql_query("SELECT * FROM geo_separador ",$link);  

while($fila= mysql_fetch_array($geo_separador)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_separador"], $fila["geo_separador_nombre"]);}

?>

</select> 

<sup><font color="00ff00">8</font></sup><select name="id_geo_numero_02_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?PHP
for ($i=0;$i<=350;$i++)
{        
       echo "<option value=$i>$i</option>";
      
}
?>
</select>

<sup><font color="00ff00">9</font></sup><select name="letra_02_<?php echo $tipo; ?>">
<option value="" selected > </option>
<option value="bis">bis</option>

<?php
$cadena = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","w","x","y","z");
for ($i=0;$i<=25;$i++){
 echo "<option value=$cadena[$i]>$cadena[$i]</option>";
}
?>
</select>
-
<sup><font color="00ff00">10</font></sup><select name="id_geo_numero_03_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php
for ($i=0;$i<=350;$i++)
{        
       echo "<option value=$i>$i</option>";
      
}
?>
</select>

<sup><font color="00ff00">11</font></sup><select id="orientacion_02" name="orientacion_02">
<option value='' SELECTED ></option>
<option value='Sur' >Sur</option>
<option value='Norte' >Norte</option>
<option value='Este' >Oriente</option>
<option value='Oeste' >Occidente</option>

</select>
<br>

<sup><font color="00ff00">12</font></sup><select name="id_geo_hito_01_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_hito_via != ""){$Geo_hito_definido=mysql_query("SELECT * FROM geo_hitos WHERE id_geo_hito = $geo_hito",$link); 
$i=0;
$geo_hito_definido=mysql_result($Geo_hito_definido,$i,"id_geo_hito");  
echo "<option value='$geo_hito_definido' selected >>$geo_hito<</option>";}
$geo_hito=mysql_query("SELECT * FROM geo_hitos ",$link);  

while($fila= mysql_fetch_array($geo_hito)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_hito"], $fila["geo_hito"]);}

?>
</select> 
<sup><font color="00ff00">13</font></sup><input type="text" name="hito_01_<?php echo $tipo; ?>" id="hito_01_<?php echo $tipo; ?>" value="">
 
<sup><font color="00ff00">14</font></sup><select name="id_geo_hito_02_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_hito_via != ""){$Geo_hito_definido=mysql_query("SELECT * FROM geo_hitos WHERE id_geo_hito = $geo_hito",$link); 
$i=0;
$geo_hito_definido=mysql_result($Geo_hito_definido,$i,"id_geo_hito");  
echo "<option value='$geo_hito_definido' selected >>$geo_hito<</option>";}
$geo_hito=mysql_query("SELECT * FROM geo_hitos ",$link);  

while($fila= mysql_fetch_array($geo_hito)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_hito"], $fila["geo_hito"]);}

?>
</select> 

<sup><font color="00ff00">15</font></sup><input type="text" name="hito_02_<?php echo $tipo; ?>" id="hito_02_<?php echo $tipo; ?>" value="">
<br>
<sup><font color="00ff00">16</font></sup><select name="id_geo_hito_03_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_hito_via != ""){$Geo_hito_definido=mysql_query("SELECT * FROM geo_hitos WHERE id_geo_hito = $geo_hito",$link); 
$i=0;
$geo_hito_definido=mysql_result($Geo_hito_definido,$i,"id_geo_hito");  
echo "<option value='$geo_hito_definido' selected >>$geo_hito<</option>";}
$geo_hito=mysql_query("SELECT * FROM geo_hitos ",$link);  

while($fila= mysql_fetch_array($geo_hito)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_hito"], $fila["geo_hito"]);}

?>
</select> 
<sup><font color="00ff00">17</font></sup><input type="text" name="hito_04_<?php echo $tipo; ?>" id="hito_04_<?php echo $tipo; ?>" value=""><br>
<sup><font color="00ff00">18</font></sup><select name="id_geo_hito_04_<?php echo $tipo; ?>" size="0">
<option value="" selected > </option>
<?php 
mysql_query ("SET NAMES 'utf8'");
if ($geo_hito_via != ""){$Geo_hito_definido=mysql_query("SELECT * FROM geo_hitos WHERE id_geo_hito = $geo_hito",$link); 
$i=0;
$geo_hito_definido=mysql_result($Geo_hito_definido,$i,"id_geo_hito");  
echo "<option value='$geo_hito_definido' selected >>$geo_hito<</option>";}
$geo_hito=mysql_query("SELECT * FROM geo_hitos ",$link);  

while($fila= mysql_fetch_array($geo_hito)) {
      printf("<option value='%s'> %s</option>", $fila["id_geo_hito"], $fila["geo_hito"]);}

?>
</select> 
<sup><font color="00ff00">19</font></sup><input type="text" name="hito_04_<?php echo $tipo; ?>" id="hito_04_<?php echo $tipo; ?>" value="">
<br>
<?php } ?><?php
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
