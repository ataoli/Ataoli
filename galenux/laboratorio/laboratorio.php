<!DOCTYPE html> 
<html> 
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    <title>OpenLayers Basic Single WMS Example</title> 
         <link rel="stylesheet" href="http://openlayers.org/dev/theme/default/style.css" type="text/css"> 
        <link rel="stylesheet" href="http://openlayers.org/dev/examples/style.css" type="text/css"> 
        <script src="http://openlayers.org/dev/OpenLayers.js"></script> 
    <script type="text/javascript"> 
        var map, layer;
        function init(){
            map = new OpenLayers.Map( 'map');
            layer = new OpenLayers.Layer.OSM( "Simple OSM Map");
            map.addLayer(layer);
            map.setCenter(
                new OpenLayers.LonLat(-71.147, 42.472).transform(
                    new OpenLayers.Projection("EPSG:4326"),
                    map.getProjectionObject()
                ), 12
            );    
        }
    </script> 
  </head> 
  <body onload="init()"> 

    <div id="map" class="smallmap"></div> 

  </body> 
</html> 