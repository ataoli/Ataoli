<?php
session_start();
// Comprobamos si existe la variable
if ( !isset ( $_SESSION['grupo'] ) ) {
 // Si no existe 
 header("Location: ../error.php");

} 
//include_once("laboratorio/osm.php");
?>
<script src='http://openlayers.org/dev/OpenLayers.js'></script> 
<script src='laboratorio/osm.js'></script> 

<div id="albergues_contenedor">
<?php  ?>
<div id="albergue_crear">
<li class='tab' onclick="xajax_crear_albergue('albergue_presentacion')" class="cursor">Crear albergue</li>
</div>
<div id="albergues_buscador">
</div>
<div id="albergue_presentacion"></div>

</div>