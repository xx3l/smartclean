var get =  decodeURI(window.location.search)
		  .replace('?', '')
		  .split('&')
		  .map(param => param.split('='))
		  .reduce((values, [ key, value ]) => {
			values[ key ] = value
			return values
		  }, {})

function GetMap() {
    map = new OpenLayers.Map("OSMap");
    var mapnik = new OpenLayers.Layer.OSM();
    map.addLayer(mapnik);
//104.2707, 52.289
	var lat;
	if(!get['lat']) lat = 104.2707; else lat=get['lat'];

	var lon;
	if(!get['lon']) lon = 52.289; else lon=get['lon'];

	var map_id = get['map_id'];
	if(!map_id) map_id = 1;
	//alert(map_id);
	
    map.setCenter(new OpenLayers.LonLat(lat,lon).transform(
            new OpenLayers.Projection("EPSG:4326"), 
            new OpenLayers.Projection("EPSG:900913") 
          ), 16 
        );

    var layerMarkers = new OpenLayers.Layer.Markers("Markers");
    map.addLayer(layerMarkers);

	layerMarkers.clearMarkers();
		
    var size = new OpenLayers.Size(1400, 500);
    var offset = new OpenLayers.Pixel(0,0);
	
	
	var a = new Object;
	a.x = 0;
	a.y = 499;
	var position = map.getLonLatFromViewPortPx(a);
	var b = new Object;
	b.x = 1399;
	b.y = 0;
	var position2 = map.getLonLatFromViewPortPx(b);
	var coord = new Object;
	coord.x = 0;
	coord.y = 0;
	var position3 = map.getLonLatFromViewPortPx(coord);

	position1 = position.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
	position2 = position2.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
	var path = 'image.php?x=1400&y=500&lon1='+position1.lon+'&lat1='+position1.lat+'&lon2='+position2.lon+'&lat2='+position2.lat+'&map_id='+map_id+'&tr=1';
	
	var Ways = new OpenLayers.Icon(path, size, offset);

    layerMarkers.addMarker(
        new OpenLayers.Marker(position3, Ways)
	);

    map.events.register('moveend', map, function (e) {   
		layerMarkers.clearMarkers();
		
        var size = new OpenLayers.Size(1400, 500);
        var offset = new OpenLayers.Pixel(0,0);
		console.log(size);
	
		var a = new Object;
		a.x = 0;
		a.y = 499;
		var position = map.getLonLatFromViewPortPx(a);
		var b = new Object;
		b.x = 1399;
		b.y = 0;
		var position2 = map.getLonLatFromViewPortPx(b);
		var coord = new Object;
		coord.x = 0;
		coord.y = 0;
		var position3 = map.getLonLatFromViewPortPx(coord);

		position1 = position.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
		position2 = position2.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
		var path = 'image.php?x=1400&y=500&lon1='+position1.lon+'&lat1='+position1.lat+'&lon2='+position2.lon+'&lat2='+position2.lat+'&map_id='+map_id+'&tr=1';
	    var Ways = new OpenLayers.Icon(path, size, offset);
		console.log(path);
        layerMarkers.addMarker(
            new OpenLayers.Marker(position3, Ways)
		);
    }); 
}

