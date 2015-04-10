<!-- head -->
<!-- SADRŽAJ -->
<script>
	var directionsDisplay;
	var rendererOptions = {
  		draggable: true
	};
	var directionsService = new google.maps.DirectionsService();

	function karta() {
		directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
		var mapOptions = {
			zoom : 2,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			center : new google.maps.LatLng(40.17887331434696, -14.765625)
		};
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		directionsDisplay.setMap(map);
		directionsDisplay.setPanel(document.getElementById('directions-panel'));

		var control = document.getElementById('control');
		control.style.display = 'block';
		map.controls[google.maps.ControlPosition.TOP_CENTER].push(control);
	}

	function calcRoute() {
		var start = document.getElementById('start').value;
		var end = document.getElementById('end').value;
		var request = {
			origin : start,
			destination : end,
			travelMode : google.maps.TravelMode.DRIVING
		};
		directionsService.route(request, function(response, status) {
			if (status == google.maps.DirectionsStatus.OK) {
				directionsDisplay.setDirections(response);
			}
		});
	}


	google.maps.event.addDomListener(window, 'load', karta);

</script>
<!-- Takeover left -->
<div class="pocisti" id="takeover-wrapper">
<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
	<div id="content-wrapper">
		<div id="content">
			<!-- Banner top -->
			<?php require_once (APPPATH . 'views/includes/banner-top.php'); ?>
			<div class="content-left content-karta">
				<div id="content-karta">
					<div id="map-canvas"></div>
					<div id="directions-panel"></div>
					<div id="control">
						<label for="start"><?php echo lang('karta_polaziste');?>:</label> <input id="start" type="text" />
						<label for="end"><?php echo lang('karta_odrediste');?>:</label> <input id="end" type="text" />
						<input type="button" value="<?php echo lang('karta_izracun_rute');?>" onclick="calcRoute();" />
					</div>
				</div>
			</div>
			<div class="content-right">
				<!-- Login -->
				<?php
				$userdata = $this -> session -> userdata('prijavljen');
				if (!$this -> session -> userdata('prijavljen')) {
					require_once (APPPATH . 'views/includes/modules/login.php');
				} else if ($this -> session -> userdata('tip') == 1) {// -- administrator
					require_once (APPPATH . 'views/includes/modules/korisnicki-izbornik-1.php');
				} else if ($this -> session -> userdata('tip') == 2) {// -- oglašivač
					require_once (APPPATH . 'views/includes/modules/korisnicki-izbornik-2.php');
				} else if ($this -> session -> userdata('tip') == 3) {// -- korisnik
					require_once (APPPATH . 'views/includes/modules/korisnicki-izbornik-3.php');
				}
				?>
				<!-- Tečajna lista -->
				<?php
					require_once (APPPATH . 'views/includes/modules/tecajna-lista.php');
				?>
				<!-- Social -->
				<?php
					require_once (APPPATH . 'views/includes/modules/social.php');
				?>
				<!-- Brojač posjeta -->
				<?php
					require_once (APPPATH . 'views/includes/modules/brojac-posjeta.php');
				?>
			</div>
			<!-- Banner bottom -->
			<?php require_once (APPPATH . 'views/includes/banner-bottom.php'); ?>
		</div>
	</div>
	<!-- Takeover right -->
<?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
</div>
