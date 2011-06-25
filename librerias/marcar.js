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
                    alert("You clicked near " + lonlat.lat + " N, " +
                                              + lonlat.lon + " E");
                }
 
            });
            var map;
            function init(){
                map = new OpenLayers.Map('map');
 
                var ol_wms = new OpenLayers.Layer.WMS( "OpenLayers WMS",
                    "http://vmap0.tiles.osgeo.org/wms/vmap0?", {layers: 'basic'} );
 
            var jpl_wms = new OpenLayers.Layer.WMS( "NASA Global Mosaic",
                "http://t1.hypercube.telascience.org/cgi-bin/landsat7", 
                {layers: "landsat7"});
 
                jpl_wms.setVisibility(false);
 
                map.addLayers([ol_wms, jpl_wms]);
                map.addControl(new OpenLayers.Control.LayerSwitcher());
                // map.setCenter(new OpenLayers.LonLat(0, 0), 0);
                map.zoomToMaxExtent();
                
                var click = new OpenLayers.Control.Click();
                map.addControl(click);
                click.activate();
 
            }