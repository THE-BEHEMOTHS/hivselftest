<script>
	var iconBase = '<?= @$this->config->item("assets_url"); ?>icons/';
	var map;
	var x = document.getElementById("demo");
	var markers = [];
	var $ = window.jQuery;

	$('#pharmacy_table').dataTable();
	$('#pharmacy_table').on('click', '.pin-on-map', function(){
		clearMarkers();
		var latitude = $(this).attr('data-lat');
		var longitude = $(this).attr('data-lng');
		var title = $(this).attr('data-title');

		var location = new google.maps.LatLng(latitude, longitude);
		var marker = new google.maps.Marker({
			position : location,
			map: map,
			title: title,
			animation: google.maps.Animation.DROP,
			icon: iconBase + "hospital.png"
		});

		var i =0;
		google.maps.event.addListener(marker, 'click', (function(marker, i) {					
			return function() {
				// map.setZoom(10);
				toggleBounce();
				map.setZoom(14);
				map.setCenter(marker.getPosition());
				infowindow.setContent(title);
				infowindow.open(map, marker);
			}
		})(marker, i));
		markers.push(marker);
		map.setCenter(location);
	});

	window.jQuery('#county_list').change(function(){
		var county = $(this).val();

		if (county !== "") {
			$.ajax({
				url : "<?= @base_url('Map/getPharmaciesList'); ?>",
				data: {
					county: county
				},
				method: "POST",
				beforeSend: function(){

				},
				success: function(){

				}
			})
			.done(function(res){
				clearMarkers();
				$('#pharmacy_table').dataTable().fnDestroy();
				$('#pharmacy_table tbody').empty();

				$('#pharmacy_table tbody').append(res.data);
				$('#pharmacy_table').dataTable();

				var map_data = res.map_data;

				var contentString = [];
				var bound = new google.maps.LatLngBounds();
				for (var i in map_data) {
					var facility = map_data[i];
					var location = new google.maps.LatLng(facility.latitude, facility.longitude);
					var infowindow = new google.maps.InfoWindow();
					contentString[i] = facility.content_string;
					var marker = new google.maps.Marker({
						position : location,
						map: map,
						title: facility.name,
						animation: google.maps.Animation.DROP,
						icon: iconBase + "hospital.png"
					});

					google.maps.event.addListener(marker, 'click', (function(marker, i) {					
						return function() {
							// map.setZoom(10);
							map.setCenter(marker.getPosition());
							infowindow.setContent(contentString[i]);
							infowindow.open(map, marker);
						}
					})(marker, i));
					markers.push(marker);
					bound.extend(new google.maps.LatLng(facility.latitude, facility.longitude) );
				}
				center = bound.getCenter();
				map.setZoom(8);
				map.setCenter(center);
			});
		}
	});
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			center: {lat: -1.2855928, lng: 36.8147777},
			zoom: 11
		});

		var infoWindow = new google.maps.InfoWindow({map: map});

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				var marker = new google.maps.Marker({
					position: pos,
					map: map,
					icon: "https://maps.gstatic.com/intl/en_us/mapfiles/markers2/measle_blue.png",
					title: 'Hello World!'
				});
				map.setCenter(pos);
			}, function() {
			handleLocationError(true, infoWindow, map.getCenter());
			});
		} else {
		// Browser doesn't support Geolocation
		handleLocationError(false, infoWindow, map.getCenter());
		}

		setMarkers(map);
	}

	function setMarkers(map){
		window.jQuery.get('<?= @base_url(); ?>Map/getPharmacies', function(res){
			var contentString = [];
			for(var i in res){
				var pharmacy = res[i];

				var location = new google.maps.LatLng(pharmacy.latitude, pharmacy.longitude);
				var infowindow = new google.maps.InfoWindow();
				contentString[i] = pharmacy.content_string;
				var marker = new google.maps.Marker({
					position : location,
					map: map,
					title: pharmacy.name,
					icon: iconBase + "hospital.png"
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {					
					return function() {
						map.setZoom(20);
						map.setCenter(marker.getPosition());
						infowindow.setContent(contentString[i]);
						infowindow.open(map, marker);
					}
				})(marker, i));
				markers.push(marker);
			}
		});
	}

	$(document).ready(function(){
		window.jQuery('body').removeClass("no-page-heading fluid-width no-top-content-padding no-bottom-content-padding");
		window.jQuery('body').addClass("fluid-width");
		window.jQuery('#masthead').removeClass('is-transparent');
		// no-page-heading fluid-width no-top-content-padding
	});

	function clearMarkers() {
		// markerCluster.setMap(null);
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
		markers = [];

	}
</script>