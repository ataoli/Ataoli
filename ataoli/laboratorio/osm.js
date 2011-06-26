            OpenLayers.Control.Click = OpenLayers.Class(OpenLayers.Control, {                
                defaultHandlerOptions: {
                    'single': true,
                    'double': false,
                    'pixelTolerance': 0,
                    'stopSingle': false,
                    'stopDouble': false
                },
 
                initialize: function(options) {
                    this.handlerOptions = OpenLayers.Util.extend(
                        {}, this.defaultHandlerOptions
                    );
                    OpenLayers.Control.prototype.initialize.apply(
                        this, arguments
                    ); 
                    this.handler = new OpenLayers.Handler.Click(
                        this, {
                            'click': this.trigger
                        }, this.handlerOptions
                    );
                }, 
 
                   trigger: function(e) {

                
                    var lonlat = map.getLonLatFromViewPortPx(e.xy);
                     lonlat.transform(
           new OpenLayers.Projection("EPSG:900913"),
            new OpenLayers.Projection("EPSG:4326"));
                    alert("Las coordenadas son:" + lonlat.lat + " N, " +  + lonlat.lon + " ");
                   document.getElementById("lat").value= lonlat.lat;
                   document.getElementById("lon").value= lonlat.lon;
                   // mostrar('pop_fondo');
                    //mostrar('pop');
                    
                    //xajax_poi_form('pop',lonlat.lat,lonlat.lon);
                  
			
                    
                }
 
            });

            var map;
            function init(){
            ////
             map = new OpenLayers.Map( 'map');
            layer = new OpenLayers.Layer.OSM( "Simple OSM Map");
            map.addLayer(layer);
            map.setCenter(
                new OpenLayers.LonLat(-72, 4).transform(
                    new OpenLayers.Projection("EPSG:4326"),
                    map.getProjectionObject()
                ), 5
            ); 
               //  map.setCenter(new OpenLayers.LonLat(-72,4), 5);
               
                
                var click = new OpenLayers.Control.Click();
                map.addControl(click);
                click.activate();

 
 
            }