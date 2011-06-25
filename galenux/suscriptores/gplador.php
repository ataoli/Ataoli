<?php 
/*  ATENCION: Puede existir una version mas reciente de este archivo en http://GaleNUx.com
    por favor compruebelo antes de modificarlo. 
    
    Copyright (c) 13-22-2/ 17-Dic-2008 Direccion nacional de derechos de autor Colombia 
    http://GaleNUx.com Es un sistema para de informacion para la salud adaptado al sistema
    de salud Colombiano.
    
    Si necesita consultoria o capacitacion en el manejo, instalacion y/o soporte o 
    ampliacion de prestaciones de GaleNUx por favor comuniquese con nosotros 
    al email praxis@galenux.com.

    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los terminos de la Licencia Publica General GNU publicada 
    por la Fundacion para el Software Libre, ya sea la version 3 
    de la Licencia, o cualquier version posterior.

    Este programa se distribuye con la esperanza de que sea util, pero 
    SIN GARANTIA ALGUNA; ni siquiera la garantia implicita 
    MERCANTIL o de APTITUD PARA UN PROPOSITO DETERMINADO. 
    Consulte los detalles de la Licencia Publica General GNU para obtener 
    una informacion mas detallada. 

    Deberia haber recibido una copia de la Licencia Publica General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.
    
    POR FAVOR CONSERVE ESTA NOTA SI EDITA ESTE ARCHIVO

 */ 
$raiz =  "/var/www/ruta/";
$ext =  "php";
echo "<h1> El GPLador! </h1>";

$version=md5('1.09');
echo "Version : $version";
echo "<ol>";
$licencia = "<?php
\$control_version = '$version'; 
/*  ATENCION: Puede existir una version mas reciente de este archivo en http://GaleNUx.com
    por favor compruebelo antes de modificarlo. control de version [$version]
    
    Copyright (c) 13-22-2/ 17-Dic-2008 Direccion nacional de derechos de autor Colombia 
    http://GaleNUx.com Es un sistema para de informacion para la salud adaptado al sistema
    de salud Colombiano.
    
    Si necesita consultoria o capacitacion en el manejo, instalacion y/o soporte o 
    ampliacion de prestaciones de GaleNUx por favor comuniquese con nosotros 
    al email praxis@galenux.com.

    Este programa es software libre: usted puede redistribuirlo y/o modificarlo 
    bajo los terminos de la Licencia Publica General GNU publicada 
    por la Fundacion para el Software Libre, ya sea la version 3 
    de la Licencia, o cualquier version posterior.

    Este programa se distribuye con la esperanza de que sea util, pero 
    SIN GARANTIA ALGUNA; ni siquiera la garantia implicita 
    MERCANTIL o de APTITUD PARA UN PROPOSITO DETERMINADO. 
    Consulte los detalles de la Licencia Publica General GNU para obtener 
    una informacion mas detallada. 

    Deberia haber recibido una copia de la Licencia Publica General GNU 
    junto a este programa. 
    En caso contrario, consulte <http://www.gnu.org/licenses/>.
    
    POR FAVOR CONSERVE ESTA NOTA SI EDITA ESTE ARCHIVO

 */ 
?>";
GPLador($raiz,$ext,$version,$licencia);

function GPLador($ruta,$ext,$version,$licencia){

   // abrir un directorio y listarlo recursivo
   if (is_dir($ruta)) {
      if ($dh = opendir($ruta)) {
         while (($file = readdir($dh)) !== false) {
            //esta linea la utilizariamos si queremos listar todo lo que hay en el directorio
            //mostraria tanto archivos como directorios
            //echo "<br>Nombre de archivo: $file : Es un: " . filetype($ruta . $file);
            if (is_dir($ruta . $file) && $file!="." && $file!=".."){
               //solo si el archivo es un directorio, distinto que "." y ".."
              // echo "<br>Directorio: $ruta$file";
               GPLador($ruta . $file . "/",$ext,$version,$licencia);
            }else{
            $path = $ruta.$file;
            $partes_ruta = pathinfo($path);
            $extension =$partes_ruta[extension];
            /// solo muestra los archivos de la extencion seleccionada 
            if($extension == $ext){
            echo "<li>$ruta$file</li>";
             $contenido = file_get_contents($path);
            
				  $contenido = $contenido.$licencia;
				  file_put_contents($path,$contenido);
            								}
            		}
         }
      closedir($dh);
      }
   }else
      echo "<br>No es ruta valida";
} 

  					
  ?> 