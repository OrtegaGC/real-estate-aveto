<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-registracija">
				<p class="content-title item-1"> Novi korisnik</p>
				<p class="info item-2"> <span class="required-item">*</span> - obavezna polja </p>
				<?php echo form_open('ci_admin/opcija/spremi_korisnika'); ?>
					<div class="item-3">
						<p class="form-label">Tip korisnika: <span class="required-item">*</span> </p>
						<?php echo form_error('tip_korisnika'); ?>
						<div class="form-field form-radio pocisti">
							<p> <span> Administrator: </span> <input type="radio" name="tip_korisnika" value="1"  <?php echo set_radio('tip_korisnika', '1'); ?> />  </p>
							<p> <span> Oglašivač: </span> <input type="radio" name="tip_korisnika" value="2"  <?php echo set_radio('tip_korisnika', '2'); ?> />  </p>
							<p> <span> Korisnik usluga: </span> <input type="radio" name="tip_korisnika" value="3" <?php echo set_radio('tip_korisnika', '3'); ?> /> </p>
						</div>
					</div>
					<p class="form-label"> Ime: <span class="required-item">*</span> </p>
					<?php echo form_error('ime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="ime"  value="<?php echo set_value('ime'); ?>"/> </p>
					<p class="form-label"> Prezime: <span class="required-item">*</span> </p>
					<?php echo form_error('prezime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="prezime" value="<?php echo set_value('prezime'); ?>" /> </p>
					<p class="form-label"> Korisničko ime: <span class="required-item">*</span> </p>
					<?php echo form_error('korisnicko_ime'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="korisnicko_ime" value="<?php echo set_value('korisnicko_ime'); ?>" /> </p>
					<p class="form-label"> Lozinka: <span class="required-item">*</span> </p>
					<?php echo form_error('lozinka'); ?> 
					<p class="form-field"> <input class="type-text" type="password" name="lozinka" /> </p>
					<p class="form-label"> Potvrda lozinke: <span class="required-item">*</span> </p>
					<?php echo form_error('potvrda_lozinke'); ?> 
					<p class="form-field"> <input class="type-text" type="password" name="potvrda_lozinke" /> </p>
					<p class="form-label"> E-mail adresa: <span class="required-item">*</span> </p>
					<?php echo form_error('email'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="email" value="<?php echo set_value('email'); ?>" /> </p>
					<p>&nbsp;</p>
							
					<p class="form-label"> Adresa: </p>
					<?php echo form_error('adresa'); ?> 
					<p class="form-field"> <input class="type-text" type="text" name="adresa" value="<?php echo set_value('adresa'); ?>" /> </p>
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
	
