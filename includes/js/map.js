function initialize() {

    var mapOptions = {
		center: new google.maps.LatLng(44.467612, 16.406476),
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
		
    var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		
	// -- prikazivanje 'zoom levela' prilikom povećavanja/smanjivanja karte
	google.maps.event.addListener(map, 'zoom_changed', function() {
		var zoomLevel = map.getZoom();
		//map.setCenter(myLatLng);
		//infowindow.setContent('Zoom: ' + zoomLevel);
		document.getElementById("zoomLevel").innerHTML = zoomLevel;
	});
		
	// -- prikazivanje 'zoom levela' po defaultu
	var zoomLevel = map.getZoom();
	document.getElementById("zoomLevel").innerHTML = zoomLevel;
		
	// -- prikazivanje koordinata u input elementu 'onclick' na mapu
	google.maps.event.addListener(map, "click", function(event) {
		var lat = event.latLng.lat();
		var lng = event.latLng.lng();
		var elemLat = document.getElementById("lat");
		var elemLng = document.getElementById("lng");
		elemLat.value = lat;
		elemLng.value = lng;
	});
	
	var marker;

	function placeMarker(location) {
		if ( marker ) {
			marker.setPosition(location);
		} else {
				marker = new google.maps.Marker({
				draggable:true,
				animation: google.maps.Animation.DROP,
				position: location,
				map: map
			});
		}
  
	}
	
	google.maps.event.addListener(map, 'click', function(event) {
		placeMarker(event.latLng);
	});

}
	
// -- END of uredi() funkcije

