<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-registracija">
				<p class="content-title item-1"> Uredi korisnika</p>
				<p class="info item-2"> <span class="required-item">*</span> - obavezna polja </p>
				<?php echo form_open('ci_admin/opcija/spremi_promjene_korisnika'); ?>
					<p class="form-label"> Ime: <span class="required-item">*</span> </p>
					<?php echo form_error('ime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="ime"  value="<?php echo $korisnik[0]['ime'];?>"/> </p>
					<p class="form-label"> Prezime: <span class="required-item">*</span> </p>
					<?php echo form_error('prezime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="prezime" value="<?php echo $korisnik[0]['prezime'];?>" /> </p>
					<p class="form-label"> Korisničko ime: <span class="required-item">*</span> </p>
					<?php echo form_error('korisnicko_ime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="korisnicko_ime" value="<?php echo $korisnik[0]['korisnicko_ime'];?>" /> </p>
					<p class="form-label"> E-mail adresa: <span class="required-item">*</span> </p>
					<?php echo form_error('email'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="email" value="<?php echo $korisnik[0]['email'];?>" /> </p>
					<p>&nbsp;</p>
							
					<p class="form-label"> Adresa: </p>
					<?php echo form_error('adresa'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="adresa" value="<?php echo $korisnik[0]['adresa'];?>" /> </p>
					<p class="form-label"> Poštanski broj: </p>
					<?php echo form_error('broj_poste'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="broj_poste" value="<?php echo set_value('broj_poste'); ?>" /> </p>
					<p class="form-label"> Grad: </p>
					<?php echo form_error('grad'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="grad" value="<?php echo set_value('grad'); ?>" /> </p>
					<p class="form-label"> Država: </p>
					<?php echo form_error('drzava'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="drzava" value="<?php echo set_value('drzava'); ?>" /> </p>
					<p class="form-label"> Broj telefona: </p>
					<?php echo form_error('broj_telefona'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="broj_telefona" value="<?php echo set_value('broj_telefona'); ?>" /> </p>
					<p class="form-label"> Broj mobitela:  </p>
					<?php echo form_error('broj_mobitela'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="broj_mobitela" value="<?php echo set_value('broj_mobitela'); ?>" /> </p>
					<p class="form-label"> OIB:  </p>
					<?php echo form_error('oib'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="oib" value="<?php echo set_value('oib'); ?>" /> </p>
					<p class="form-label"> Naziv tvrtke: </p>
					<?php echo form_error('naziv_tvrtke'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="naziv_tvrtke" value="<?php echo set_value('naziv_tvrtke'); ?>" /> </p>
							
					<p class="submit"> <input type="submit" name="registracija" value="Spremi korisnika" /> <a href="<?php echo base_url();?>ci_admin/opcija/korisnici"> Odustani </a> </p>
				</form>
			</div>
		</div>
	</div>
<!-- footer -->
	
