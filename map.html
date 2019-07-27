<html>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script>

function tile2long(x,z) {
 return (x/Math.pow(2,z)*360-180);
}
function tile2lat(y,z) {
 var n=Math.PI-2*Math.PI*y/Math.pow(2,z);
 return (180/Math.PI*Math.atan(0.5*(Math.exp(n)-Math.exp(-n))));
}

function GetMap() {
    map = new OpenLayers.Map("OSMap");//инициализация карты
    var mapnik = new OpenLayers.Layer.OSM();//создание слоя карты
    map.addLayer(mapnik);//добавление слоя

    map.setCenter(new OpenLayers.LonLat(104.2707, 52.289) //(широта, долгота)
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // переобразование в WGS 1984
            new OpenLayers.Projection("EPSG:900913") // переобразование проекции
          ), 16 // масштаб
        );
	//alert(JSON.stringify(map.calculateBounds()));
    var layerMarkers = new OpenLayers.Layer.Markers("Markers");//создаем новый слой маркеров
    map.addLayer(layerMarkers);//добавляем этот слой к карте
    map.events.register('click', map, function (e) {    
        var size = new OpenLayers.Size(1400, 500);//размер картинки для маркера
        var offset = new OpenLayers.Pixel(0,0); //смещение картинки для маркера
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
		//var position2 = map.getLonLatFromViewPortPx(b);
		
	
		
		 position1 = position.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
		position2 = position2.transform(new OpenLayers.Projection("EPSG:900913"), new OpenLayers.Projection("EPSG:4326"));
		var path = 'http://h.webmakerz.ru/image.php?x=1400&y=500&lon1='+position1.lon+'&lat1='+position1.lat+'&lon2='+position2.lon+'&lat2='+position2.lat+'';
	    var icon = new OpenLayers.Icon(path, size, offset);//картинка для маркера

		 


 	 console.log('http://h.webmakerz.ru/image.php?x=1400&y=500&lon1='+position1.lon+'&lat1='+position1.lat+'&lon2='+position2.lon+'&lat2='+position2.lat);
        layerMarkers.addMarker(//добавляем маркер к слою маркеров
            new OpenLayers.Marker(position3, //координаты вставки маркера
            icon));//иконка маркера
    }); //добавление событие клика по карте
}
 </script>
 <body onload="GetMap();">
    <h2>OpenStreetMap</h2>
    <div id="OSMap" style="position:absolute; width:1400px; height:500px;"></div>
 </body>
 
</html>