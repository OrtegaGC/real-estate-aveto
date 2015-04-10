<!-- head -->
	<!-- SADRŽAJ -->
		<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div id="novi-oglas">
						<?php echo form_open_multipart('korisnik/spremi_slike_objekt'); ?>
							<p class="content-title item-1"> <?php echo lang('novi_oglas_dodaj_slike'); ?> </p>
							<p class="item-2"> <?php echo lang('com_info_slike');?> </p>
							<div class="image-upload pocisti">
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_glavna_slika'); ?>: </p>
									<?php echo form_error('glavna_slika'); ?>
									<?php if (isset($greska['glavna_slika'])): ?>
									<p class="error"><?php echo $greska['glavna_slika'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="glavna_slika" /> </p>
								</div>	
							
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_1'); ?>: </p>
									<?php echo form_error('slika_1'); ?>
									<?php if (isset($greska['slika_1'])): ?>
									<p class="error"><?php echo $greska['slika_1'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_1" /> </p>
								</div>	
							
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_2'); ?>: </p>
									<?php echo form_error('slika_2'); ?>
									<?php if (isset($greska['slika_2'])): ?>
									<p class="error"><?php echo $greska['slika_2'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_2" /> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_3'); ?>: </p>
									<?php echo form_error('slika_3'); ?>
									<?php if (isset($greska['slika_3'])): ?>
									<p class="error"><?php echo $greska['slika_3'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_3" /> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_4'); ?>: </p>
									<?php echo form_error('slika_4'); ?>
									<?php if (isset($greska['slika_4'])): ?>
									<p class="error"><?php echo $greska['slika_4'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_4" /> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_5'); ?>: </p>
									<?php echo form_error('slika_5'); ?>
									<?php if (isset($greska['slika_5'])): ?>
									<p class="error"><?php echo $greska['slika_5'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_5" /> </p>
									<input type="hidden" name="oglas_id" value="<?php echo $oglas_id; ?>" />
								</div>
							</div>
							<div class="loading"> <!-- Ajax loading --> </div>
							<p id="rezultat"></p>
							<div class="submit">
								<input id="upload-images" type="submit" name="dalje" value="<?php echo lang('novi_oglas_sljedeci_korak'); ?>" />
								<a href="<?php echo base_url(); ?>"> <?php echo lang('novi_oglas_odustani'); ?> </a>
							</div>
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