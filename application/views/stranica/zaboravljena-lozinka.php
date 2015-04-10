<!-- head -->
	<!-- SADRŽAJ -->
		<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content">
				<!-- Banner top -->
				<?php require_once (APPPATH . 'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div class="form-registracija form-zaboravljena-lozinka">
						<?php echo form_open('korisnik/zaboravljena_lozinka'); ?>
							<p class="info item-2"> <?php echo lang('zaboravljena_lozinka_info'); ?> </p>
							<p class="form-label"> <?php echo lang('zaboravljena_lozinka_email'); ?>: </p>
							<?php echo form_error('email'); ?> 
							<p class="form-field"> <input class="type-text" type="text" name="email" value="<?php echo set_value('email'); ?>" /> </p>
							<p class="submit"> <input type="submit" name="posalji" value="<?php echo lang('zaboravljena_lozinka_posalji'); ?>" /> <a href="<?php echo base_url(); ?>"> <?php echo lang('zaboravljena_lozinka_odustani'); ?> </a> </p>
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
				<?php require_once (APPPATH . 'views/includes/banner-bottom.php'); ?>
			</div>
		</div>
		<!-- Takeover right -->
		<?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
	</div>
