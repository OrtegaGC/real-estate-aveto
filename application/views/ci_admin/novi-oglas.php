<!-- header -->
<?php require_once (APPPATH . 'views/includes/ci_admin/modules/admin-header.php'); ?>
<div id="content-wrapper" class="pocisti">
	<?php require_once (APPPATH . 'views/includes/ci_admin/modules/izbornik.php'); ?>
	<div id="sadrzaj">
		<div class="form-novi-oglas">
			<p class="content-title item-1"> Novi oglas </p>
			<p class="info item-2"> <span class="required-item">*</span> - obavezna polja </p>
			<?php echo form_open('ci_admin/opcija/dodaj_slike'); ?>
			<p class="form-label"> Izaberite korisnika (upišite ime): <span class="required-item">*</span> </p>
			<?php echo form_error('ime_korisnika'); ?>
			<?php echo form_error('korisnik'); ?>
			<div class="form-field"> 
				<input id="ime_korisnika" class="type-text" type="text" name="ime_korisnika"  value="<?php echo set_value('ime_korisnika'); ?>" autocomplete="off" /> 
				<span class="reset"><img src="<?php echo base_url();?>/includes/images/minus.png" title="Izbriši" alt="remove" /></span>
				<input id="korisnik_id" type="hidden" name="korisnik"  value="<?php echo set_value('korisnik'); ?>"/>
				<div class="loading-0"> <!-- Ajax loading --> </div>
				<div id="korisnik-rezultati"></div>
			</div>
			<p class="form-label"> Izaberite županiju: <span class="required-item">*</span> </p>
			<?php echo form_error('zupanija'); ?>
			<p class="form-field">
				<select id="zupanija" name="zupanija">
				<?php foreach ($zupanija as $value):?>
					<option value="<?php echo $value['regijaID']; ?>" <?php echo set_select('zupanija', $value['regijaID']); ?>> <?php echo $value['naziv_regije']; ?></option>
				<?php endforeach; ?>
				</select> 
			 </p>
			 <p class="form-label"> Izaberite mjesto: <span class="required-item">*</span> </p>
			 <?php echo form_error('mjesto'); ?>
			 <p class="form-field">
				 <div class="loading"> <!-- Ajax loading --> </div>
				<select id="mjesto" name="mjesto">
				<?php foreach ($mjesto as $value):?>
					<option value="<?php echo $value['mjestoID']; ?>" <?php echo set_select('mjesto', $value['mjestoID']); ?>> <?php echo $value['naziv_mjesta']; ?></option>
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
					<?php echo form_error('geo-lat'); ?>
					<?php echo form_error('geo-lng'); ?>
					<span> Geo. dužina (latitude): <span class="required-item">*</span> </span> <input type="text" name="geo-lat" id="lat" value="<?php echo set_value('geo-lat'); ?>" /> 
					<span> Geo. širina (longitude):  <span class="required-item">*</span> </span> <input type="text" name="geo-lng" id="lng" value="<?php echo set_value('geo-lng'); ?>" />
				</div>
			</div>
							
			<p class="form-label"> Naziv objekta: <span class="required-item">*</span> </p>
			<?php echo form_error('naziv_objekta'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="naziv_objekta"  value="<?php echo set_value('naziv_objekta'); ?>"/> </p>
					
			<p class="form-label"> Tip smještaja: <span class="required-item">*</span> </p>
			<?php echo form_error('tip_smjestaja'); ?>
			<div class="form-field form-radio pocisti"> 
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_apartman" <?php echo set_radio('tip_smjestaja', 'hotel_apartman'); ?>/> <span> Hotel-apartman </span> </p> 
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_bez_domacina" <?php echo set_radio('tip_smjestaja', 'kuca_bez_domacina'); ?>/> <span> Kuća bez domaćina </span> </p> 
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="robinzonski_turizam" <?php echo set_radio('tip_smjestaja', 'robinzonski_turizam'); ?>/> <span> Robinzonski turizam </span> </p> 
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="krstarenje_brodom" <?php echo set_radio('tip_smjestaja', 'krstarenje_brodom'); ?>/> <span> Krstarenje brodom </span> </p> 
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_studio" <?php echo set_radio('tip_smjestaja', 'hotel_studio'); ?>/> <span> Hotel-studio </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_apartman" <?php echo set_radio('tip_smjestaja', 'kuca_apartman'); ?>/> <span> Kuća-apartman </span> </p>  
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="objekt_na_osami" <?php echo set_radio('tip_smjestaja', 'objekt_na_osami'); ?>/> <span> Objekt na osami </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="izlet_brodom" <?php echo set_radio('tip_smjestaja', 'izlet_brodom'); ?>/> <span> Izlet brodom </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hotel_soba" <?php echo set_radio('tip_smjestaja', 'hotel_soba'); ?>/> <span> Hotel-soba </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_studio" <?php echo set_radio('tip_smjestaja', 'kuca_studio'); ?>/> <span> Kuća-studio </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="mobilna_kuca" <?php echo set_radio('tip_smjestaja', 'mobilna_kuca'); ?>/> <span> Mobilna kuća </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_jedrilice" <?php echo set_radio('tip_smjestaja', 'najam_jedrilice'); ?>/> <span> Najam jedrilice </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="hostel" <?php echo set_radio('tip_smjestaja', 'hostel'); ?>/> <span> Hostel </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="kuca_soba" <?php echo set_radio('tip_smjestaja', 'kuca_soba'); ?>/> <span> Kuća-soba </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="auto_kamp" <?php echo set_radio('tip_smjestaja', 'auto_kamp'); ?>/> <span> Auto-kamp </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_broda" <?php echo set_radio('tip_smjestaja', 'najam_broda'); ?>/> <span> Najam Broda </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="pansion" <?php echo set_radio('tip_smjestaja', 'pansion'); ?>/> <span> Pansion </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="villa" <?php echo set_radio('tip_smjestaja', 'villa'); ?>/> <span> Villa </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="bungalov" <?php echo set_radio('tip_smjestaja', 'bungalov'); ?>/> <span> Bungalov </span> </p>
				<p> <input class="type-radio" type="radio" name="tip_smjestaja" value="najam_jahti" <?php echo set_radio('tip_smjestaja', 'najam_jahti'); ?>/> <span> Najam jahti </span> </p>
			</div>
							
			<p class="form-label"> Dodatne usluge (HR): </p>
			<?php echo form_error('dodatne_usluge_hr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="dodatne_usluge_hr"><?php echo set_value('dodatne_usluge_hr'); ?></textarea>
			</div>
							
			<p class="form-label"> Dodatne usluge (EN): </p>
			<?php echo form_error('dodatne_usluge_en'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="dodatne_usluge_en"><?php echo set_value('dodatne_usluge_en'); ?></textarea>
			</div>
							
			<p class="form-label"> Dodatne usluge (DE): </p>
			<?php echo form_error('dodatne_usluge_de'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="dodatne_usluge_de"><?php echo set_value('dodatne_usluge_de'); ?></textarea>
			</div>
							
			<p class="form-label"> Dodatne usluge (IT): </p>
			<?php echo form_error('dodatne_usluge_it'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="dodatne_usluge_it"><?php echo set_value('dodatne_usluge_it'); ?></textarea>
			</div>
							
			<p class="form-label"> Dodatne usluge (FR): </p>
			<?php echo form_error('dodatne_usluge_fr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="dodatne_usluge_fr"><?php echo set_value('dodatne_usluge_fr'); ?></textarea>
			</div>
							
			<p class="form-label"> Broj zvijezdica </p>
			<?php echo form_error('broj_zvijezdica')?>
			<div class="form-field form-select pocisti">
				<select name="broj_zvijezdica">
					<option value="5" <?php echo set_select('broj_zvijezdica', '5'); ?>>5</option> 
					<option value="4" <?php echo set_select('broj_zvijezdica', '4'); ?>>4</option>
					<option value="3" <?php echo set_select('broj_zvijezdica', '3'); ?>>3</option>
					<option value="2" <?php echo set_select('broj_zvijezdica', '2'); ?>>2</option>
					<option value="1" <?php echo set_select('broj_zvijezdica', '1'); ?>>1</option>
				</select>
			</div>
							
			<p class="form-label"> Adresa: <span class="required-item">*</span> </p>
			<?php echo form_error('adresa'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="adresa"  value="<?php echo set_value('adresa'); ?>"/> </p>
						
			<p class="form-label"> Telefon: <span class="required-item">*</span> </p>
			<?php echo form_error('telefon'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="telefon"  value="<?php echo set_value('telefon'); ?>"/> </p>
							
			<p class="form-label"> Mobitel: <span class="required-item">*</span> </p>
			<?php echo form_error('mobitel'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="mobitel"  value="<?php echo set_value('mobitel'); ?>"/> </p>
							
			<p class="form-label"> E-mail adresa: <span class="required-item">*</span> </p>
			<?php echo form_error('email'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="email"  value="<?php echo set_value('email'); ?>"/> </p>
							
			<p class="form-label"> Web stranica: </p>
			<?php echo form_error('web_stranica'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="web_stranica"  value="<?php echo set_value('web_stranica'); ?>"/> </p>
							
			<p class="form-label"> Jezici koje govori domaćin: </p>
			<?php echo form_error('jezici'); ?>
			<div class="form-field form-checkbox single-column pocisti"> 
				<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="hr" <?php echo set_checkbox('jezici', 'hr'); ?>/> <span> Hrvatski </span> </p> 
				<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="en" <?php echo set_checkbox('jezici', 'en'); ?>/> <span> Engleski </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="de" <?php echo set_checkbox('jezici', 'de'); ?>/> <span> Njemački </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="it" <?php echo set_checkbox('jezici', 'it'); ?>/> <span> Talijanski </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="fr" <?php echo set_checkbox('jezici', 'fr'); ?>/> <span> Francuski </span> </p>
			</div>
							
			<p class="form-label"> Detalji smještajne jedinice: </p>
			<?php echo form_error('detalji_smjestajne_jedinice'); ?>
			<div class="form-field form-checkbox multi-column pocisti"> 
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="pogled" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'pogled'); ?>/> <span> Pogled na more </span> </p> 
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="internet" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'internet'); ?>/> <span> Internet </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="perilica_rublja" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'perilica_rublja'); ?>/> <span> Perilica rublja </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="pecnica" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'pecnica'); ?>/> <span> Pećnica </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kucni_ljubimci" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'kucni_ljubimci'); ?>/> <span> Kućni ljubimci </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="balkon" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'balkon'); ?>/> <span> Balkon </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="ventilator" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'ventilator'); ?>/> <span> Ventilator </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="poseban_ulaz" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'poseban_ulaz'); ?>/> <span> Poseban ulaz </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="hladnjak" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'hladnjak'); ?>/> <span> Hladnjak </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kuhinja" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'kuhinja'); ?>/> <span> Kuhinja </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="tus" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'tus'); ?>/> <span> Tuš </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="parking" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'parking'); ?>/> <span> Parking </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="invalidi" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'invalidi'); ?>/> <span> Invalidi </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="klima" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'klima'); ?>/> <span> Klima </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="tv" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'tv'); ?>/> <span> TV </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="mini_zamrzivac" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'mini_zamrzivac'); ?>/> <span> Mini zamrzivač </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="kuhinjski_pribor" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'kuhinjski_pribor'); ?>/> <span> Kuhinjski pribor </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="wc" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'wc'); ?>/> <span> WC </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="bazen" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'bazen'); ?>/> <span> Bazen </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="rostilj" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'rostilj'); ?>/> <span> Roštilj </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="posteljina" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'posteljina'); ?>/> <span> Posteljina </span> </p>
			</div>
							
			<p class="form-label"> Detalji auto-kampa: </p>
			<?php echo form_error('detalji_auto_kampa'); ?>
			<div class="form-field form-checkbox multi-column pocisti"> 
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="internet" <?php echo set_checkbox('detalji_auto_kampa', 'internet'); ?>/> <span> Internet </span> </p> 
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="godisnji_pausal" <?php echo set_checkbox('detalji_auto_kampa', 'godisnji_pausal'); ?>/> <span> Godišnji paušal </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="zimski_turizam" <?php echo set_checkbox('detalji_auto_kampa', 'zimski_turizam'); ?>/> <span> Zimski turizam </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="mnogo_hlada" <?php echo set_checkbox('detalji_auto_kampa', 'mnogo_hlada'); ?>/> <span> Mnogo hlada </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="malo_hlada" <?php echo set_checkbox('detalji_auto_kampa', 'malo_hlada'); ?>/> <span> Malo hlada </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="nema_hlada" <?php echo set_checkbox('detalji_auto_kampa', 'nema_hlada'); ?>/> <span> Nema hlada </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="brojilo_za_struju" <?php echo set_checkbox('detalji_auto_kampa', 'brojilo_za_struju'); ?>/> <span> Brojilo za struju </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_tusiranje" <?php echo set_checkbox('detalji_auto_kampa', 'prostor_za_tusiranje'); ?>/> <span> Prostor za tuširanje </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="solarna_topla_voda" <?php echo set_checkbox('detalji_auto_kampa', 'solarna_topla_voda'); ?>/> <span> Solarna topla voda </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="topla_voda_bojler" <?php echo set_checkbox('detalji_auto_kampa', 'topla_voda_bojler'); ?>/> <span> Topla voda - bojler </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_toalet" <?php echo set_checkbox('detalji_auto_kampa', 'prostor_za_toalet'); ?>/> <span> Prostor za toalet </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="praonica_rublja" <?php echo set_checkbox('detalji_auto_kampa', 'praonica_rublja'); ?>/> <span> Praonica rublja </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_peglanje" <?php echo set_checkbox('detalji_auto_kampa', 'prostor_za_peglanje'); ?>/> <span> Prostor za peglanje </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prostor_za_pranje_posuda" <?php echo set_checkbox('detalji_auto_kampa', 'prostor_za_pranje_posuda'); ?>/> <span> Prostor za pranje posuđa </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="kemijski_wc" <?php echo set_checkbox('detalji_auto_kampa', 'kemijski_wc'); ?>/> <span> Kemijski wc </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="pitka_voda" <?php echo set_checkbox('detalji_auto_kampa', 'pitka_voda'); ?>/> <span> Pitka voda </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="pranje_broda" <?php echo set_checkbox('detalji_auto_kampa', 'pranje_broda'); ?>/> <span> Pranje broda </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="prikljucak_struje" <?php echo set_checkbox('detalji_auto_kampa', 'prikljucak_struje'); ?>/> <span> Priključak struje </span> </p>
				<p> <input class="type-checkbox" type="checkbox" name="detalji_auto_kampa[]" value="parking_za_brod" <?php echo set_checkbox('detalji_auto_kampa', 'parking_za_brod'); ?>/> <span> Parking za brod/trailer </span> </p>
			</div>
							
			<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (HR): </p>
			<?php echo form_error('opsirniji_opis_smjestaja_hr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_smjestaja_hr"><?php echo set_value('opsirniji_opis_smjestaja_hr'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (EN): </p>
			<?php echo form_error('opsirniji_opis_smjestaja_en'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_smjestaja_en"><?php echo set_value('opsirniji_opis_smjestaja_en'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (DE): </p>
			<?php echo form_error('opsirniji_opis_smjestaja_de'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_smjestaja_de"><?php echo set_value('opsirniji_opis_smjestaja_de'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (IT): </p>
			<?php echo form_error('opsirniji_opis_smjestaja_it'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_smjestaja_it"><?php echo set_value('opsirniji_opis_smjestaja_it'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis tipa smještaja ili autokampa (FR): </p>
			<?php echo form_error('opsirniji_opis_smjestaja_fr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_smjestaja_fr"><?php echo set_value('opsirniji_opis_smjestaja_fr'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (HR): </p>
			<?php echo form_error('opsirniji_opis_izleta_hr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_izleta_hr"><?php echo set_value('opsirniji_opis_izleta_hr'); ?></textarea>
			</div>
					
			<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (EN): </p>
			<?php echo form_error('opsirniji_opis_izleta_en'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_izleta_en"><?php echo set_value('opsirniji_opis_izleta_en'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (DE): </p>
			<?php echo form_error('opsirniji_opis_izleta_de'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_izleta_de"><?php echo set_value('opsirniji_opis_izleta_de'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (IT): </p>
			<?php echo form_error('opsirniji_opis_izleta_it'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_izleta_it"><?php echo set_value('opsirniji_opis_izleta_it'); ?></textarea>
			</div>
							
			<p class="form-label"> Opširniji opis krstarenja ili turističkog izleta (FR): </p>
			<?php echo form_error('opsirniji_opis_izleta_fr'); ?>
			<div class="form-field form-text pocisti">
				<textarea name="opsirniji_opis_izleta_fr"><?php echo set_value('opsirniji_opis_izleta_fr'); ?></textarea>
			</div>
							
			<div class="dodatni-podaci pocisti">
				<div class="column-1">
					<div>
						<p class="form-label"> Broj soba: </p>
						<?php echo form_error('broj_soba'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo set_value('broj_soba'); ?>"/> </p>
					</div>	
					
					<div>
						<p class="form-label"> Broj WC jedinica: </p>
						<?php echo form_error('broj_wc_jedinica'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="broj_wc_jedinica"  value="<?php echo set_value('broj_wc_jedinica'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Centar: </p>
						<?php echo form_error('centar'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="centar"  value="<?php echo set_value('centar'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Banka: </p>
						<?php echo form_error('banka'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="banka"  value="<?php echo set_value('banka'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Najbliže mjesto: </p>
						<?php echo form_error('najblize_mjesto'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="najblize_mjesto"  value="<?php echo set_value('najblize_mjesto'); ?>"/> </p>
					</div>	
					<div>
						<p class="form-label"> Zračna luka: </p>
						<?php echo form_error('zracna_luka'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="zracna_luka"  value="<?php echo set_value('zracna_luka'); ?>"/> </p>
					</div>
					<div>	
						<p class="form-label"> Nogometno igralište: </p>
						<?php echo form_error('nogometno_igraliste'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="nogometno_igraliste"  value="<?php echo set_value('nogometno_igraliste'); ?>"/> </p>
					</div>
					<div>							
						<p class="form-label"> Staza za trčanje: </p>
						<?php echo form_error('staza_za_trcanje'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="staza_za_trcanje"  value="<?php echo set_value('staza_za_trcanje'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Duljina biciklističke staze: </p>
						<?php echo form_error('duljina_biciklisticke_staze'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="duljina_biciklisticke_staze"  value="<?php echo set_value('duljina_biciklisticke_staze'); ?>"/> </p>
					</div>
				</div>
				
				<div class="column-2">
					<div>
						<p class="form-label"> Broj parkirnih mjesta: </p>
						<?php echo form_error('broj_parkirnih_mjesta'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="broj_parkirnih_mjesta"  value="<?php echo set_value('broj_parkirnih_mjesta'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Broj kamp jedinica: </p>
						<?php echo form_error('broj_kamp_jedinica'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="broj_kamp_jedinica"  value="<?php echo set_value('broj_kamp_jedinica'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Plaža: </p>
						<?php echo form_error('plaza'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="plaza"  value="<?php echo set_value('plaza'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Ljekarna: </p>
						<?php echo form_error('ljekarna'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="ljekarna"  value="<?php echo set_value('ljekarna'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Najbliži grad: </p>
						<?php echo form_error('najblizi_grad'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="najblizi_grad"  value="<?php echo set_value('najblizi_grad'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Željeznički kolodvor: </p>
						<?php echo form_error('zeljeznicki_kolodvor'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="zeljeznicki_kolodvor"  value="<?php echo set_value('zeljeznicki_kolodvor'); ?>"/> </p>
					</div>
					<div>							
						<p class="form-label"> Košarkaško igralište: </p>
						<?php echo form_error('kosarkasko_igraliste'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="kosarkasko_igraliste"  value="<?php echo set_value('kosarkasko_igraliste'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Profesionalno ronjenje: </p>
						<?php echo form_error('profesionalno_ronjenje'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="profesionalno_ronjenje"  value="<?php echo set_value('profesionalno_ronjenje'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Jedrenje na dasci: </p>
						<?php echo form_error('jedrenje_na_dasci'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="jedrenje_na_dasci"  value="<?php echo set_value('jedrenje_na_dasci'); ?>"/> </p>
					</div>
				</div>
				
				<div class="column-3">
					<div>
						<p class="form-label"> Kvadratura objekta: </p>
						<?php echo form_error('kvadratura_objekta'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="kvadratura_objekta"  value="<?php echo set_value('kvadratura_objekta'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Veličina plovila: </p>
						<?php echo form_error('velicina_plovila'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="velicina_plovila"  value="<?php echo set_value('velicina_plovila'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Restoran: </p>
						<?php echo form_error('restoran'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="restoran"  value="<?php echo set_value('restoran'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Ambulanta: </p>
						<?php echo form_error('ambulanta'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="ambulanta"  value="<?php echo set_value('ambulanta'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Autobusna stanica: </p>
						<?php echo form_error('autobusna_stanica'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="autobusna_stanica"  value="<?php echo set_value('autobusna_stanica'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Brodska luka: </p>
						<?php echo form_error('brodska_luka'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="brodska_luka"  value="<?php echo set_value('brodska_luka'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Vaterpolo: </p>
						<?php echo form_error('vaterpolo'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="vaterpolo"  value="<?php echo set_value('vaterpolo'); ?>"/> </p>
					</div>	
					<div>
						<p class="form-label"> Najam čamaca: </p>
						<?php echo form_error('najam_camaca'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="najam_camaca"  value="<?php echo set_value('najam_camaca'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Lunapark za djecu: </p>
						<?php echo form_error('lunapark_za_djecu'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="lunapark_za_djecu"  value="<?php echo set_value('lunapark_za_djecu'); ?>"/> </p>
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
						<p class="form-field"> <input class="type-text" type="text" name="broj_tuseva"  value="<?php echo set_value('broj_tuseva'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Pošta: </p>
						<?php echo form_error('posta'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="posta"  value="<?php echo set_value('posta'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Policija: </p>
						<?php echo form_error('policija'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="policija"  value="<?php echo set_value('policija'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Autobusni kolodvor: </p>
						<?php echo form_error('autobusni_kolodvor'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="autobusni_kolodvor"  value="<?php echo set_value('autobusni_kolodvor'); ?>"/> </p>
					</div>	
					<div>
						<p class="form-label"> Trgovina: </p>
						<?php echo form_error('trgovina'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="trgovina"  value="<?php echo set_value('trgovina'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Profesionalno trčanje: </p>
						<?php echo form_error('profesionalno_trcanje'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="profesionalno_trcanje"  value="<?php echo set_value('profesionalno_trcanje'); ?>"/> </p>
					</div>
					<div>
						<p class="form-label"> Spuštanje čamca u more: </p>
						<?php echo form_error('spustanje_camca_u_more'); ?>
						<p class="form-field"> <input class="type-text" type="text" name="spustanje_camca_u_more"  value="<?php echo set_value('spustanje_camca_u_more'); ?>"/> </p>
					</div>
				</div>
			</div>
			<div class="submit">
				<input type="submit" name="dalje" value="Sljedeći korak" />
				<a href="<?php echo base_url(); ?>"> Odustani </a>
			</div>
			</form>
		</div>
	</div>
</div>
<!-- footer -->

