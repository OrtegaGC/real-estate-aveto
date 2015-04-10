<!-- head -->
	<!-- SADRŽAJ -->
			<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content" class="content-registracija pocisti">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div class="form-registracija">
						<p class="content-title item-1"> <?php echo lang('registracija_naziv_obrasca'); ?> </p>
						<p class="info item-2"> <span class="required-item">*</span> <?php echo lang('registracija_obavezna_polja'); ?> </p>
						<?php echo form_open('korisnik/spremi'); ?>
							<div class="item-3">
								<p class="form-label"><?php echo lang('registracija_tip_korisnika'); ?>: <span class="required-item">*</span> </p>
								<?php echo form_error('tip_korisnika'); ?>
								<div class="form-field form-radio pocisti">
									<p> <span> <?php echo lang('registracija_oglasivac'); ?>: </span> <input type="radio" name="tip_korisnika" value="2"  <?php echo set_radio('tip_korisnika', '2'); ?> />  </p>
									<p> <span> <?php echo lang('registracija_korisnik_usluga'); ?>: </span> <input type="radio" name="tip_korisnika" value="3" <?php echo set_radio('tip_korisnika', '3'); ?> /> </p>
								</div>
							</div>
							<br>
							<p class="form-label"> <?php echo lang('registracija_ime'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('ime'); ?>
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="ime"  value="<?php echo set_value('ime'); ?>"/> </p>
							<p class="form-label"> <?php echo lang('registracija_prezime'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('prezime'); ?>
							<p class="form-field"> <input class="type-text" type="text" style="width:250px;" name="prezime" value="<?php echo set_value('prezime'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_korisnicko_ime'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('korisnicko_ime'); ?>
							<p class="form-field"> <input class="type-text" type="text" style="width:250px;" name="korisnicko_ime" value="<?php echo set_value('korisnicko_ime'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_lozinka'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('lozinka'); ?> 
							<p class="form-field"> <input class="type-text" type="password" style="width:250px;" name="lozinka" /> </p>
							<p class="form-label"> <?php echo lang('registracija_potvrda_lozinke'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('potvrda_lozinke'); ?> 
							<p class="form-field"> <input class="type-text" type="password" style="width:250px;" name="potvrda_lozinke" /> </p>
							<p class="form-label"> <?php echo lang('registracija_email'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('email'); ?> 
							<p class="form-field"> <input class="type-text" type="text" name="email" style="width:250px;" value="<?php echo set_value('email'); ?>" /> </p>
							<p>&nbsp;</p>
							
							<p class="form-label"> <?php echo lang('registracija_adresa'); ?>: </p>
							<?php echo form_error('adresa'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="adresa" value="<?php echo set_value('adresa'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_postanski_broj'); ?>: </span> </p>
							<?php echo form_error('broj_poste'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="broj_poste" value="<?php echo set_value('broj_poste'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_grad'); ?>: </span> </p>
							<?php echo form_error('grad'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="grad" value="<?php echo set_value('grad'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_drzava'); ?>: </span> </p>
							<?php echo form_error('drzava'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="drzava" value="<?php echo set_value('drzava'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_broj_telefona'); ?>: </span> </p>
							<?php echo form_error('broj_telefona'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="broj_telefona" value="<?php echo set_value('broj_telefona'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_broj_mobitela'); ?>: </span> </p>
							<?php echo form_error('broj_mobitela'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="broj_mobitela" value="<?php echo set_value('broj_mobitela'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_oib'); ?>: </span> </p>
							<?php echo form_error('oib'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="oib" value="<?php echo set_value('oib'); ?>" /> </p>
							<p class="form-label"> <?php echo lang('registracija_tvrtka'); ?>: </span> </p>
							<?php echo form_error('naziv_tvrtke'); ?> 
							<p class="form-field"> <input class="type-text" style="width:250px;" type="text" name="naziv_tvrtke" value="<?php echo set_value('naziv_tvrtke'); ?>" /> </p>
							
							<p class="form-field uvjeti-koristenja"> <?php echo lang('registracija_uvjeti_1'); ?> <a target="_blank" href="<?php echo base_url();?>index.php/stranica/uvjeti_koristenja/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('registracija_uvjeti_2'); ?> </a> <input class="type-checkbox" type="checkbox" name="uvjeti_koristenja" /> <span class="required-item">*</span> </p>
							<?php echo form_error('uvjeti_koristenja'); ?> 
							<p class="submit"> <input type="submit" name="registracija" value="<?php echo lang('registracija_registracija'); ?>" /> <a href="<?php echo base_url(); ?>"> <?php echo lang('registracija_odustani'); ?> </a> </p>
						</form>
					</div>
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
