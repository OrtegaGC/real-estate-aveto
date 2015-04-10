<!-- head -->
	<!-- SADRŽAJ -->
	<?php 
		$ukupno = count($mjesta);
		$zadnji = $ukupno - 1; 
	?>
	<script type="text/javascript">
		function mjesta() {
  			var mapOptions = {
			center: new google.maps.LatLng(<?php echo $regija[0]['map_center_latitude']?>, <?php echo $regija[0]['map_center_longitude']; ?>),
        	zoom: 9,
        	mapTypeId: google.maps.MapTypeId.HYBRID
    	};
		
    	var map = new google.maps.Map(document.getElementById("map-mjesta"), mapOptions);
    	map.setTilt(45);
	
		// -- markeri
		var mjesta = [
		<?php foreach ($mjesta as $key => $value): ?>
			<?php if($key != $zadnji): ?>
			['<?php echo $value['naziv_mjesta'];?>', <?php echo $value['latitude']; ?>, <?php echo $value['longitude']; ?>, '<?php echo base_url().'potraznja/mjesto/'.$value['mjestoID']; ?>' ],
			<?php else:?>
			['<?php echo $value['naziv_mjesta'];?>', <?php echo $value['latitude']; ?>, <?php echo $value['longitude']; ?>, '<?php echo base_url().'potraznja/mjesto/'.$value['mjestoID']; ?>' ]
			<?php endif; ?>
		<?php endforeach?>
		];
		
		var marker = [];
		var image = '<?php echo base_url(); ?>includes/images/flag3_48.png';
	
		
		for (var i = 0; i < mjesta.length; i++) {
				marker[i] = new google.maps.Marker({
				map:map,
				draggable:false,
				animation: google.maps.Animation.DROP,
				position: new google.maps.LatLng(mjesta[i][1], mjesta[i][2]),
				icon: image
			});
		}
		
		function addInfoWindow(marker, message) {
        	var info = message;

        	var infoWindow = new google.maps.InfoWindow({
       	    	content: message
        	});

       		google.maps.event.addListener(marker, 'click', function () {
            	infoWindow.open(map, marker);
        	});	
    }
	
	for (var i = 0; i < mjesta.length; i++) {
		addInfoWindow(marker[i],'<a target="_top" href="'+mjesta[i][3]+'">'+mjesta[i][0]+'</a>');
	}

}
	</script>
	<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div class="breadcrumb" >
						<p> <a href="<?php echo base_url();?>potraznja"> <?php echo lang('com_breadcrumb_regije');?> </a> <span> >> </span>  <strong> <?php echo $regija[0]['naziv_regije']; ?> </strong> </p> 
					</div>
					<div id="map-mjesta"> <!-- Karta s mjestima --> </div>
					<div class="opcije-prikaza">
						<input type="button" id="prikazi-mjesta-potraznja" value="<?php echo lang('potraznja_prikazi_mjesta'); ?>"/>
						<input type="button" id="sakrij-mjesta-potraznja" value="<?php echo lang('potraznja_sakrij_mjesta'); ?>"/>
						<input type="hidden" name="regijaID" value="<?php echo $this->uri->segment(3); ?>" />
					 </div>
					<div class="loading"> <!-- Ajax loading --> </div>
					<div id="popis-mjesta" class="cf"> <!-- Popis mjesta --> </div>
				</div>
				<div class="content-right">
					<!-- Login -->
					<?php
						$userdata = $this->session->userdata('prijavljen');
						if( !$this->session->userdata('prijavljen'))
						{
							require_once(APPPATH.'views/includes/modules/login.php');
						} else if ($this->session->userdata('tip') == 1) { // -- administrator
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-1.php');
						} else if ($this->session->userdata('tip') == 2) { // -- oglašivač
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-2.php');
						} else if ($this->session->userdata('tip') == 3) { // -- korisnik
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-3.php');
						}
					?>
					<!-- Tečajna lista -->
					<?php require_once(APPPATH.'views/includes/modules/tecajna-lista.php');?>
					<!-- Social -->
					<?php require_once(APPPATH.'views/includes/modules/social.php');?>
				</div>
				<!-- Banner bottom -->
				<?php require_once(APPPATH.'views/includes/banner-bottom.php'); ?>
			</div>
		</div>
		<!-- Takeover right -->
		<?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
	</div>
