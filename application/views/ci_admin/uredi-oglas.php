<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<script type="text/javascript">
			function uredi() {
				var myLatlng = new google.maps.LatLng(<?php echo $oglas[0]['lokacijaLatitude'];?>, <?php echo $oglas[0]['lokacijaLongitude'];?>);
				var mapOptions = {
					zoom : 9,
					center : myLatlng,
					mapTypeId : google.maps.MapTypeId.ROADMAP
				}
				var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

				var marker = new google.maps.Marker({
					position : myLatlng,
					map : map,
					title : '<?php echo $oglas[0]['nazivObjekta']?>'
				});
				
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
			}


			google.maps.event.addDomListener(window, 'load', initialize); 
	</script>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-novi-oglas uredi uredi-oglas pocisti">
				<p class="content-title item-1"> Uredi oglas </p>
				<p class="uredi-slike"> 
					<a href="<?php echo base_url();?>ci_admin/opcija/usluge/<?php echo $this->uri->segment(4).'/'.$oglas[0]['korisnikID'];?>">Popis usluga</a> | 
					<a href="<?php echo base_url();?>ci_admin/opcija/uredi_slike/oglas/<?php echo $oglas[0]['korisnikID'].'/'.$this->uri->segment(4);?>">Uredi slike</a> 
				</p>
				<p class="info item-2"> <span class="required-item">*</span> - obavezna polja </p>
				<?php echo form_open('ci_admin/opcija/spremi_promjene_oglasa/'.$this->uri->segment(4))."\n"; ?>
				<p class="form-label"> Izaberite korisnika (upišite ime): <span class="required-item">*</span> </p>
				<div class="form-field"> 
					<input id="ime_korisnika" class="type-text" type="text" name="ime_korisnika" value ="<?php echo $korisnik[0]['ime'].' '.$korisnik[0]['prezime'].'('.$korisnik[0]['korisnicko_ime'].')';?>" autocomplete="off" /> 
					<span class="reset"><img src="<?php echo base_url();?>/includes/images/minus.png" title="Izbriši" alt="remove" /></span>
					<input id="korisnik_id" type="hidden" name="korisnik"  value="<?php echo $oglas[0]['korisnikID']; ?>"/>
					<div class="loading-0"> <!-- Ajax loading --> </div>
					<div id="korisnik-rezultati"></div>
				</div>
				<p class="form-label"> Izaberite županiju: <span class="required-item">*</span> </p>
				<?php echo form_error('zupanija'); ?>
				<div class="form-field">
					<select id="zupanija" name="zupanija">
					<?php foreach ($zupanija as $value):?>
						<option value="<?php echo $value['regijaID']; ?>" <?php if ($value['regijaID'] == $regija[0]['regijaID']) {echo 'selected'; }?>> <?php echo $value['naziv_regije']; ?></option>
					<?php endforeach; ?>
					</select> 
				 </div>
				 <p class="form-label"> Izaberite mjesto: <span class="required-item">*</span> </p>
			 	<p class="form-field">
					 <div class="loading"> <!-- Ajax loading --> </div>
					<select id="mjesto" name="mjesto">
					<?php foreach ($mjesto as $value):?>
						<option value="<?php echo $value['mjestoID']; ?>" <?php if ($value['mjestoID'] == $oglas[0]['mjestoID']) { echo 'selected'; }?>> <?php echo $value['naziv_mjesta']; ?></option>
					<?php endforeach; ?>
					</select> 
				</p>
							 
				<div id="map-wrapper">
					<div id="map-canvas"></div>
				</div>
		
				<div id="map-options" class="pocisti">
					<div id="firstRow" class="pocisti">
						<p class="buttonControls"> <input type="button" value="Početna pozicija" onClick="initialize()"> </p>
						<p class="zoomInfo"> Razina povećanja: <span id="zoomLevel"></span> </p>
					</div>
					<div id="geo-coords"> 
						<span> Geo. dužina (latitude): <span class="required-item">*</span> </span> <input type="text" name="geo-lat" id="lat" value="<?php echo $oglas[0]['lokacijaLatitude']; ?>" /> 
						<span> Geo. širina (longitude):  <span class="required-item">*</span> </span> <input type="text" name="geo-lng" id="lng" value="<?php echo $oglas[0]['lokacijaLongitude']; ?>" />
					</div>
				</div>
							
				<p class="form-label"> Naziv objekta: <span class="required-item">*</span> </p>
				<p class="form-field"> <input class="type-text" type="text" name="naziv_objekta"  value="<?php echo $oglas[0]['nazivObjekta']; ?>"/> </p>
					
				<p class="form-label"> Tip smještaja: <span class="required-item">*</span> </p>
				<div class="form-field form-radio pocisti"> 
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_apartman" <?php if ($oglas[0]['tipSmjestaja'] == 'hotel_apartman') { echo 'checked'; } ?>/> <span> Hotel-apartman </span> </p> 
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_bez_domacina" <?php if ($oglas[0]['tipSmjestaja'] == 'kuca_bez_domacina') { echo 'checked'; } ?>/> <span> Kuća bez domaćina </span> </p> 
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="robinzonski_turizam" <?php if ($oglas[0]['tipSmjestaja'] == 'robinzonski_turizam') { echo 'checked'; } ?>/> <span> Robinzonski turizam </span> </p> 
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="krstarenje_brodom" <?php if ($oglas[0]['tipSmjestaja'] == 'krstarenje_brodom') { echo 'checked'; } ?>/> <span> Krstarenje brodom </span> </p> 
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_studio" <?php if ($oglas[0]['tipSmjestaja'] == 'hotel_studio') { echo 'checked'; } ?>/> <span> Hotel-studio </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_apartman" <?php if ($oglas[0]['tipSmjestaja'] == 'kuca_apartman') { echo 'checked'; } ?>/> <span> Kuća-apartman </span> </p>  
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="objekt_na_osami" <?php if ($oglas[0]['tipSmjestaja'] == 'objekt_na_osami') { echo 'checked'; } ?>/> <span> Objekt na osami </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="izlet_brodom" <?php if ($oglas[0]['tipSmjestaja'] == 'izlet_brodom') { echo 'checked'; } ?>/> <span> Izlet brodom </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_soba" <?php if ($oglas[0]['tipSmjestaja'] == 'hotel_soba') { echo 'checked'; } ?>/> <span> Hotel-soba </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_studio" <?php if ($oglas[0]['tipSmjestaja'] == 'kuca_studio') { echo 'checked'; } ?>/> <span> Kuća-studio </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="mobilna_kuca" <?php if ($oglas[0]['tipSmjestaja'] == 'mobilna_kuca') { echo 'checked'; } ?>/> <span> Mobilna kuća </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_jedrilice" <?php if ($oglas[0]['tipSmjestaja'] == 'najam_jedrilice') { echo 'checked'; } ?>/> <span> Najam jedrilice </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hostel" <?php if ($oglas[0]['tipSmjestaja'] == 'hostel') { echo 'checked'; } ?>/> <span> Hostel </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_soba" <?php if ($oglas[0]['tipSmjestaja'] == 'kuca_soba') { echo 'checked'; } ?>/> <span> Kuća-soba </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="auto_kamp" <?php if ($oglas[0]['tipSmjestaja'] == 'auto_kamp') { echo 'checked'; } ?>/> <span> Auto-kamp </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_broda" <?php if ($oglas[0]['tipSmjestaja'] == 'najam_broda') { echo 'checked'; } ?>/> <span> Najam Broda </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="pansion" <?php if ($oglas[0]['tipSmjestaja'] == 'pansion') { echo 'checked'; } ?>/> <span> Pansion </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="villa" <?php if ($oglas[0]['tipSmjestaja'] == 'villa') { echo 'checked'; } ?>/> <span> Villa </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="bungalov" <?php if ($oglas[0]['tipSmjestaja'] == 'bungalov') { echo 'checked'; } ?>/> <span> Bungalov </span> </p>
					<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_jahti" <?php if ($oglas[0]['tipSmjestaja'] == 'najam_jahti') { echo 'checked'; } ?>/> <span> Najam jahti </span> </p>
				</div>
							
				<p class="form-label"> Dodatne usluge (HR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="dodatne_usluge_hr"><?php echo $oglas[0]['dodatneUslugeHr']; ?></textarea>
				</div>
							
				<p class="form-label"> Dodatne usluge (EN): </p>
				<div class="form-field form-text pocisti">
					<textarea name="dodatne_usluge_en"><?php echo $oglas[0]['dodatneUslugeEn']; ?></textarea>
				</div>
							
				<p class="form-label"> Dodatne usluge (DE): </p>
				<div class="form-field form-text pocisti">
					<textarea name="dodatne_usluge_de"><?php echo $oglas[0]['dodatneUslugeDe']; ?></textarea>
				</div>
							
				<p class="form-label"> Dodatne usluge (IT): </p>
				<div class="form-field form-text pocisti">
					<textarea name="dodatne_usluge_it"><?php echo $oglas[0]['dodatneUslugeIt']; ?></textarea>
				</div>
							
				<p class="form-label"> Dodatne usluge (FR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="dodatne_usluge_fr"><?php echo $oglas[0]['dodatneUslugeFr']; ?></textarea>
				</div>
							
				<p class="form-label"> Broj zvijezdica </p>
				<div class="form-field form-select pocisti">
					<select name="broj_zvijezdica">
						<option value="5" <?php if ($oglas[0]['brojZvijezdica'] == 5) { echo 'selected'; } ?>>5</option> 
						<option value="4" <?php if ($oglas[0]['brojZvijezdica'] == 4) { echo 'selected'; } ?>>4</option>
						<option value="3" <?php if ($oglas[0]['brojZvijezdica'] == 3) { echo 'selected'; } ?>>3</option>
						<option value="2" <?php if ($oglas[0]['brojZvijezdica'] == 2) { echo 'selected'; } ?>>2</option>
						<option value="1" <?php if ($oglas[0]['brojZvijezdica'] == 1) { echo 'selected'; } ?>>1</option>
					</select>
				</div>
							
				<p class="form-label"> Adresa: <span class="required-item">*</span> </p>
				<p class="form-field"> <input class="type-text" type="text" name="adresa"  value="<?php echo $oglas[0]['adresaBrojPoste']; ?>"/> </p>
						
				<p class="form-label"> Telefon: <span class="required-item">*</span> </p>
				<p class="form-field"> <input class="type-text" type="text" name="telefon"  value="<?php echo $oglas[0]['telefon']; ?>"/> </p>
							
				<p class="form-label"> Mobitel: <span class="required-item">*</span> </p>
				<p class="form-field"> <input class="type-text" type="text" name="mobitel"  value="<?php echo $oglas[0]['mobitel']; ?>"/> </p>
							
				<p class="form-label"> E-mail adresa: <span class="required-item">*</span> </p>
				<p class="form-field"> <input class="type-text" type="text" name="email"  value="<?php echo $oglas[0]['email']; ?>"/> </p>
							
				<p class="form-label"> Web stranica: </p>
				<p class="form-field"> <input class="type-text" type="text" name="web_stranica"  value="<?php echo $oglas[0]['webStranica']; ?>"/> </p>
							
				<p class="form-label"> Jezici koje govori domaćin: </p>
				<div class="form-field form-checkbox single-column pocisti"> 
					<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="hr" <?php if (isset($jezici['hr'])) { echo 'checked'; } ?>/> <span> Hrvatski </span> </p> 
					<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="en" <?php if (isset($jezici['en'])) { echo 'checked'; } ?>/> <span> Engleski </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="de" <?php if (isset($jezici['de'])) { echo 'checked'; } ?>/> <span> Njemački </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="it" <?php if (isset($jezici['it'])) { echo 'checked'; } ?>/> <span> Talijanski </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="fr" <?php if (isset($jezici['fr'])) { echo 'checked'; } ?>/> <span> Francuski </span> </p>
				</div>
							
				<p class="form-label"> Detalji smještajne jedinice: </p>
				<div class="form-field form-checkbox multi-column pocisti"> 
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="pogled" <?php if (isset($detalji_smjestajne_jedinice['pogled'])) { echo 'checked'; } ?>/> <span> Pogled na more </span> </p> 
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="internet" <?php if (isset($detalji_smjestajne_jedinice['internet'])) { echo 'checked'; } ?>//> <span> Internet </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="perilica_rublja" <?php if (isset($detalji_smjestajne_jedinice['perilica_rublja'])) { echo 'checked'; } ?>/> <span> Perilica rublja </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="pecnica" <?php if (isset($detalji_smjestajne_jedinice['pecnica'])) { echo 'checked'; } ?>/> <span> Pećnica </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kucni_ljubimci" <?php if (isset($detalji_smjestajne_jedinice['kucni_ljubimci'])) { echo 'checked'; } ?>/> <span> Kućni ljubimci </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="balkon" <?php if (isset($detalji_smjestajne_jedinice['balkon'])) { echo 'checked'; } ?>/> <span> Balkon </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="ventilator" <?php if (isset($detalji_smjestajne_jedinice['ventilator'])) { echo 'checked'; } ?>/> <span> Ventilator </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="poseban_ulaz" <?php if (isset($detalji_smjestajne_jedinice['poseban_ulaz'])) { echo 'checked'; } ?>/> <span> Poseban ulaz </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="hladnjak" <?php if (isset($detalji_smjestajne_jedinice['hladnjak'])) { echo 'checked'; } ?>/> <span> Hladnjak </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kuhinja" <?php if (isset($detalji_smjestajne_jedinice['kuhinja'])) { echo 'checked'; } ?>/> <span> Kuhinja </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="tus" <?php if (isset($detalji_smjestajne_jedinice['tus'])) { echo 'checked'; } ?>/> <span> Tuš </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="parking" <?php if (isset($detalji_smjestajne_jedinice['parking'])) { echo 'checked'; } ?>/> <span> Parking </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="invalidi" <?php if (isset($detalji_smjestajne_jedinice['invalidi'])) { echo 'checked'; } ?>/> <span> Invalidi </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="klima" <?php if (isset($detalji_smjestajne_jedinice['klima'])) { echo 'checked'; } ?>/> <span> Klima </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="tv" <?php if (isset($detalji_smjestajne_jedinice['tv'])) { echo 'checked'; } ?>/> <span> TV </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="mini_zamrzivac" <?php if (isset($detalji_smjestajne_jedinice['mini_zamrzivac'])) { echo 'checked'; } ?>/> <span> Mini zamrzivač </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kuhinjski_pribor" <?php if (isset($detalji_smjestajne_jedinice['kuhinjsk_pribor'])) { echo 'checked'; } ?>/> <span> Kuhinjski pribor </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="wc" <?php if (isset($detalji_smjestajne_jedinice['wc'])) { echo 'checked'; } ?>/> <span> WC </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="bazen" <?php if (isset($detalji_smjestajne_jedinice['bazen'])) { echo 'checked'; } ?>/> <span> Bazen </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="rostilj" <?php if (isset($detalji_smjestajne_jedinice['rostilj'])) { echo 'checked'; } ?>/> <span> Roštilj </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="posteljina" <?php if (isset($detalji_smjestajne_jedinice['posteljina'])) { echo 'checked'; } ?>/> <span> Posteljina </span> </p>
				</div>
							
				<p class="form-label"> Detalji auto-kampa: </p>
				<div class="form-field form-checkbox multi-column pocisti"> 
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="internet" <?php if (isset($detalji_autokampa['internet'])) { echo 'checked'; } ?>/> <span> Internet </span> </p> 
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="godisnji_pausal" <?php if (isset($detalji_autokampa['godisnji_pausal'])) { echo 'checked'; } ?>/> <span> Godišnji paušal </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="zimski_turizam" <?php if (isset($detalji_autokampa['zimski_turizam'])) { echo 'checked'; } ?>/> <span> Zimski turizam </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="mnogo_hlada" <?php if (isset($detalji_autokampa['mnogo_hlada'])) { echo 'checked'; } ?>/> <span> Mnogo hlada </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="malo_hlada" <?php if (isset($detalji_autokampa['malo_hlada'])) { echo 'checked'; } ?>/> <span> Malo hlada </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="nema_hlada" <?php echo set_checkbox('detalji_auto_kampa', 'nema_hlada'); ?>/> <span> Nema hlada </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="brojilo_za_struju" <?php if (isset($detalji_autokampa['brojilo_za_struju'])) { echo 'checked'; } ?>/> <span> Brojilo za struju </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_tusiranje" <?php if (isset($detalji_autokampa['prostor_za_tusiranje'])) { echo 'checked'; } ?>/> <span> Prostor za tuširanje </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="solarna_topla_voda" <?php if (isset($detalji_autokampa['solarna_topla_voda'])) { echo 'checked'; } ?>/> <span> Solarna topla voda </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="topla_voda_bojler" <?php if (isset($detalji_autokampa['topla_voda_bojler'])) { echo 'checked'; } ?>/> <span> Topla voda - bojler </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_toalet" <?php if (isset($detalji_autokampa['prostor_za_toalet'])) { echo 'checked'; } ?>/> <span> Prostor za toalet </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="praonica_rublja" <?php if (isset($detalji_autokampa['praonica_rublja'])) { echo 'checked'; } ?>/> <span> Praonica rublja </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_peglanje" <?php if (isset($detalji_autokampa['prostor_za_peglanje'])) { echo 'checked'; } ?>/>/> <span> Prostor za peglanje </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_pranje_posuda" <?php if (isset($detalji_autokampa['prostor_za_pranje_posuda'])) { echo 'checked'; } ?>/> <span> Prostor za pranje posuđa </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="kemijski_wc" <?php if (isset($detalji_autokampa['kemijski_wc'])) { echo 'checked'; } ?>/> <span> Kemijski wc </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="pitka_voda" <?php if (isset($detalji_autokampa['pitka_voda'])) { echo 'checked'; } ?>/> <span> Pitka voda </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="pranje_broda" <?php if (isset($detalji_autokampa['pranje_broda'])) { echo 'checked'; } ?>/> <span> Pranje broda </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prikljucak_struje" <?php if (isset($detalji_autokampa['prikljucak_struje'])) { echo 'checked'; } ?>/> <span> Priključak struje </span> </p>
					<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="parking_za_brod" <?php if (isset($detalji_autokampa['parking_za_brod'])) { echo 'checked'; } ?>/> <span> Parking za brod/trailer </span> </p>
				</div>
							
				<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (HR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_smjestaja_hr"><?php echo $oglas[0]['opsirnijiOpisSmjestajaHr']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (EN): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_smjestaja_en"><?php echo $oglas[0]['opsirnijiOpisSmjestajaEn']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (DE): </p>
				<?php echo form_error('opsirniji_opis_smjestaja_de'); ?>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_smjestaja_de"><?php echo $oglas[0]['opsirnijiOpisSmjestajaDe']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (IT): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_smjestaja_it"><?php echo $oglas[0]['opsirnijiOpisSmjestajaIt']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (FR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_smjestaja_fr"><?php echo $oglas[0]['opsirnijiOpisSmjestajaFr']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (HR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_izleta_hr"><?php echo $oglas[0]['opsirnijiOpisIzletaHr']; ?></textarea>
				</div>
					
				<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (EN): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_izleta_en"><?php echo $oglas[0]['opsirnijiOpisIzletaEn']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (DE): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_izleta_de"><?php echo $oglas[0]['opsirnijiOpisIzletaDe']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (IT): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_izleta_it"><?php echo $oglas[0]['opsirnijiOpisIzletaIt']; ?></textarea>
				</div>
							
				<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (FR): </p>
				<div class="form-field form-text pocisti">
					<textarea name="opsirniji_opis_izleta_fr"><?php echo $oglas[0]['opsirnijiOpisIzletaFr']; ?></textarea>
				</div>
							
				<div class="dodatni-podaci pocisti">
					<div class="column-1">
						<div>
							<p class="form-label"> Broj soba: </p>
							<?php echo form_error('broj_soba'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php if (isset($ostale_informacije['broj_soba'])) { echo $ostale_informacije['broj_soba']; } ?>"/> </p>
						</div>	
					
						<div>
							<p class="form-label"> Broj WC jedinica: </p>
							<?php echo form_error('broj_wc_jedinica'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_wc_jedinica"  value="<?php if (isset($ostale_informacije['broj_wc_jedinica'])) { echo $ostale_informacije['broj_wc_jedinica']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Centar: </p>
							<?php echo form_error('centar'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="centar"  value="<?php if (isset($ostale_informacije['centar'])) { echo $ostale_informacije['centar']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Banka: </p>
							<?php echo form_error('banka'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="banka"  value="<?php if (isset($ostale_informacije['banka'])) { echo $ostale_informacije['banka']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Najbliže mjesto: </p>
							<?php echo form_error('najblize_mjesto'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="najblize_mjesto"  value="<?php if (isset($ostale_informacije['najblize_mjesto'])) { echo $ostale_informacije['najblize_mjesto']; } ?>"/> </p>
						</div>	
						<div>
							<p class="form-label"> Zračna luka: </p>
							<?php echo form_error('zracna_luka'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="zracna_luka"  value="<?php if (isset($ostale_informacije['zracna_luka'])) { echo $ostale_informacije['zracna_luka']; } ?>"/> </p>
						</div>
						<div>	
							<p class="form-label"> Nogometno igralište: </p>
							<?php echo form_error('nogometno_igraliste'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="nogometno_igraliste"  value="<?php if (isset($ostale_informacije['nogometno_igraliste'])) { echo $ostale_informacije['nogometno_igraliste']; } ?>"/> </p>
						</div>
						<div>							
							<p class="form-label"> Staza za trčanje: </p>
							<?php echo form_error('staza_za_trcanje'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="staza_za_trcanje"  value="<?php if (isset($ostale_informacije['staza_za_trcanje'])) { echo $ostale_informacije['staza_za_trcanje']; } ?>"/> </p>
						</div>
					<div>
						<p class="form-label"> Duljina biciklističke staze: </p>
						<?php echo form_error('duljina_biciklisticke_staze'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="duljina_biciklisticke_staze"  value="<?php if (isset($ostale_informacije['duljina_biciklisticke_staze'])) { echo $ostale_informacije['duljina_biciklisticke_staze']; } ?>"/> </p>
					</div>
				</div>
				
					<div class="column-2">
						<div>
							<p class="form-label"> Broj parkirnih mjesta: </p>
							<?php echo form_error('broj_parkirnih_mjesta'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_parkirnih_mjesta"  value="<?php if (isset($ostale_informacije['broj_parkirnih_mjesta'])) { echo $ostale_informacije['broj_parkirnih_mjesta']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Broj kamp jedinica: </p>
							<?php echo form_error('broj_kamp_jedinica'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_kamp_jedinica"  value="<?php if (isset($ostale_informacije['broj_kamp_jedinica'])) { echo $ostale_informacije['broj_kamp_jedinica']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Plaža: </p>
							<?php echo form_error('plaza'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="plaza"  value="<?php if (isset($ostale_informacije['plaza'])) { echo $ostale_informacije['plaza']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Ljekarna: </p>
							<?php echo form_error('ljekarna'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="ljekarna"  value="<?php if (isset($ostale_informacije['ljekarna'])) { echo $ostale_informacije['ljekarna']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Najbliži grad: </p>
							<?php echo form_error('najblizi_grad'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="najblizi_grad"  value="<?php if (isset($ostale_informacije['najblizi_grad'])) { echo $ostale_informacije['najblizi_grad']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Željeznički kolodvor: </p>
							<?php echo form_error('zeljeznicki_kolodvor'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="zeljeznicki_kolodvor"  value="<?php if (isset($ostale_informacije['zeljeznicki_kolodvor'])) { echo $ostale_informacije['zeljeznicki_kolodvor']; } ?>"/> </p>
						</div>
						<div>							
							<p class="form-label"> Košarkaško igralište: </p>
							<?php echo form_error('kosarkasko_igraliste'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="kosarkasko_igraliste"  value="<?php if (isset($ostale_informacije['kosarkasko_igraliste'])) { echo $ostale_informacije['kosarkasko_igraliste']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Profesionalno ronjenje: </p>
							<?php echo form_error('profesionalno_ronjenje'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="profesionalno_ronjenje"  value="<?php if (isset($ostale_informacije['profesionalno_ronjenje'])) { echo $ostale_informacije['profesionalno_ronjenje']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Jedrenje na dasci: </p>
							<?php echo form_error('jedrenje_na_dasci'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="jedrenje_na_dasci"  value="<?php if (isset($ostale_informacije['profesionalno_ronjenje'])) { echo $ostale_informacije['profesionalno_ronjenje']; } ?>"/> </p>
						</div>
					</div>
				
					<div class="column-3">
						<div>
							<p class="form-label"> Kvadratura objekta: </p>
							<?php echo form_error('kvadratura_objekta'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="kvadratura_objekta"  value="<?php if (isset($ostale_informacije['kvadratura_objekta'])) { echo $ostale_informacije['kvadratura_objekta']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Veličina plovila: </p>
							<?php echo form_error('velicina_plovila'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="velicina_plovila"  value="<?php if (isset($ostale_informacije['velicina_plovila'])) { echo $ostale_informacije['velicina_plovila']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Restoran: </p>
							<?php echo form_error('restoran'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="restoran"  value="<?php if (isset($ostale_informacije['restoran'])) { echo $ostale_informacije['restoran']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Ambulanta: </p>
							<?php echo form_error('ambulanta'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="ambulanta"  value="<?php if (isset($ostale_informacije['ambulanta'])) { echo $ostale_informacije['ambulanta']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Autobusna stanica: </p>
							<?php echo form_error('autobusna_stanica'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="autobusna_stanica"  value="<?php if (isset($ostale_informacije['autobusna_stanica'])) { echo $ostale_informacije['autobusna_stanica']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Brodska luka: </p>
							<?php echo form_error('brodska_luka'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="brodska_luka"  value="<?php if (isset($ostale_informacije['brodska_luka'])) { echo $ostale_informacije['brodska_luka']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Vaterpolo: </p>
							<?php echo form_error('vaterpolo'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="vaterpolo"  value="<?php if (isset($ostale_informacije['vaterpolo'])) { echo $ostale_informacije['vaterpolo']; } ?>"/> </p>
						</div>	
						<div>
							<p class="form-label"> Najam čamaca: </p>
							<?php echo form_error('najam_camaca'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="najam_camaca"  value="<?php if (isset($ostale_informacije['najam_camaca'])) { echo $ostale_informacije['najam_camaca']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Lunapark za djecu: </p>
							<?php echo form_error('lunapark_za_djecu'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="lunapark_za_djecu"  value="<?php if (isset($ostale_informacije['lunapark_za_djecu'])) { echo $ostale_informacije['lunapark_za_djecu']; } ?>"/> </p>
						</div>
					</div>
				
					<div class="column-4">
						<div>
							<p class="form-label"> Površina autokampa: </p>
							<?php echo form_error('povrsina_autokampa'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="povrsina_autokampa"  value="<?php echo set_value('povrsina_autokampa'); ?>"/> </p>
						</div>
					
						<div>
							<p class="form-label"> Broj tuševa: </p>
							<?php echo form_error('broj_tuseva'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_tuseva"  value="<?php if (isset($ostale_informacije['broj_tuseva'])) { echo $ostale_informacije['broj_tuseva']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Pošta: </p>
							<?php echo form_error('posta'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="posta"  value="<?php if (isset($ostale_informacije['posta'])) { echo $ostale_informacije['posta']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Policija: </p>
							<?php echo form_error('policija'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="policija"  value="<?php if (isset($ostale_informacije['policija'])) { echo $ostale_informacije['policija']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Autobusni kolodvor: </p>
							<?php echo form_error('autobusni_kolodvor'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="autobusni_kolodvor"  value="<?php if (isset($ostale_informacije['autobusni_kolodvor'])) { echo $ostale_informacije['autobusni_kolodvor']; } ?>"/> </p>
						</div>	
						<div>
							<p class="form-label"> Trgovina: </p>
							<?php echo form_error('trgovina'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="trgovina"  value="<?php if (isset($ostale_informacije['trgovina'])) { echo $ostale_informacije['trgovina']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Profesionalno trčanje: </p>
							<?php echo form_error('profesionalno_trcanje'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="profesionalno_trcanje"  value="<?php if (isset($ostale_informacije['profesionalno_trcanje'])) { echo $ostale_informacije['profesionalno_trcanje']; } ?>"/> </p>
						</div>
						<div>
							<p class="form-label"> Spuštanje čamca u more: </p>
							<?php echo form_error('spustanje_camca_u_more'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="spustanje_camca_u_more"  value="<?php if (isset($ostale_informacije['spustanje_camca_u_more'])) { echo $ostale_informacije['spustanje_camca_u_more']; } ?>"/> </p>
						</div>
					</div>
				</div>
				<div class="submit">
					<input type="submit" name="dalje" value="Spremi promjene" />
					<a href="<?php echo base_url(); ?>"> Odustani </a>
				</div>
				</form>
			</div>
		</div>
	</div>
<!-- footer -->
	
