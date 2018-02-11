<script type="text/javascript">
	var map;
	var markerCluster;
	var markers = [];
	var columns = window.jQuery('table#facilities_table thead th').length;
	var marker;

	window.jQuery(document).ready(function(){
		window.jQuery('body').removeClass("no-page-heading fluid-width no-top-content-padding no-bottom-content-padding");
		window.jQuery('body').addClass("fluid-width");
		window.jQuery('#masthead').removeClass('is-transparent');

		window.jQuery('#facilities_table').dataTable();
	});

	window.jQuery('select').on("change", function (e) { 

		var $input =window.jQuery(this);
		var option = window.jQuery('option:selected', this);
		var county = $input.val();
		var latitude = option.data('lat');
		var longitude = option.data('lng');
		
		// map.setCenter(new google.maps.LatLng(latitude, longitude));
		if (county != "") {
			window.jQuery.ajax({
				url : "<?= @base_url('Referrals/getfacilities'); ?>",
				data: {
					'county': county
				},
				method: "POST",
				beforeSend: function(){
					// console.log(form.serialize());
					// $('#filter-modal').modal('hide');
					// $('div.overlay').removeClass('hideOverlay');
				},
				success: function(){
					// $('div.overlay').addClass('hideOverlay');
				}
			})
			.done(function(res){
				clearMarkers();
				window.jQuery('#facilities_table').dataTable().fnDestroy();
				window.jQuery('#facilities_table tbody').empty();
				if (res.status == true) {
					window.jQuery('#facilities_table tbody').append(res.table);
					window.jQuery('#facilities_table').dataTable();
					map_data = res.map_data;
					var contentString = [];
					var bound = new google.maps.LatLngBounds();
					for (var i in map_data) {
						var facility = map_data[i];
						var location = new google.maps.LatLng(facility.lat, facility.lng);
						var infowindow = new google.maps.InfoWindow();
						contentString[i] = facility.contentString;
						var marker = new google.maps.Marker({
							position : location,
							map: map,
							title: facility.title,
							animation: google.maps.Animation.DROP
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
						bound.extend( new google.maps.LatLng(facility.lat, facility.lng) );
					}
					center = bound.getCenter();
					map.setZoom(8);
					map.setCenter(center);
					
				}

				window.jQuery('.view_map').on("click", function(){
					clearMarkers();
					var lat = window.jQuery(this).attr('data-lat');
					var lng = window.jQuery(this).attr('data-lng');
					var title = window.jQuery(this).attr('data-title');

					var location = new google.maps.LatLng(lat, lng);
					var marker = new google.maps.Marker({
						position : location,
						map: map,
						title: title,
						animation: google.maps.Animation.DROP
					});

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
				});
			});
		}
	});

	function toggleBounce() {
		if (marker.getAnimation() !== null) {
			marker.setAnimation(null);
		} else {
			marker.setAnimation(google.maps.Animation.BOUNCE);
		}
	}

	function initMap(){
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 7,
			center: new google.maps.LatLng(-0.0236, 37.9062),
			mapTypeId: 'roadmap'
		});

		marker =  new google.maps.Marker();
		setMarkers(map);
	}

	function setMarkers(map){
		// $.get("<?= @base_url('Mapping/getLocations/null/null/' . date('Y-m-d')); ?>", function(res){
		// 	var contentString = [];
		// 	for(var i in res){
		// 		var latlng = res[i];
		// 		var location = new google.maps.LatLng(latlng.lat, latlng.lng);
		// 		var infowindow = new google.maps.InfoWindow();
		// 		contentString[i] = latlng.contentString;
		// 		var marker = new google.maps.Marker({
		// 			position : location,
		// 			map: map,
		// 			title: latlng.title
		// 		});


		// 		google.maps.event.addListener(marker, 'click', (function(marker, i) {					
		// 			return function() {
		// 				// map.setZoom(10);
		// 				map.setCenter(marker.getPosition());
		// 				infowindow.setContent(contentString[i]);
		// 				infowindow.open(map, marker);
		// 			}
		// 		})(marker, i));
		// 		markers.push(marker);
		// 	}

			
		// });
		markerCluster = new MarkerClusterer(map, markers,{imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
	}

	function clearMarkers() {
		markerCluster.setMap(null);
		for (var i = 0; i < markers.length; i++) {
			markers[i].setMap(null);
		}
		markers = [];

	}

	
	// window.jQuery('select').select2().on('change', function(e){
	// 	console.log(e.val);
	// });
</script>