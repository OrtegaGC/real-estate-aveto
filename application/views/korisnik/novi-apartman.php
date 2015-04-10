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
						<?php echo form_open_multipart('korisnik/spremi_apartman/'.$this->uri->segment(3)); ?>
							<p class="content-title item-1"> <?php echo lang('novi_oglas_naziv_obrasca'); ?> </p>
							<p class="form-label"> <?php echo lang('novi_oglas_naziv_apartmana'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('naziv_apartmana'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="naziv_apartmana"  value="<?php echo set_value('naziv_apartmana'); ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('novi_oglas_broj_soba'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('broj_soba'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo set_value('broj_soba'); ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('novi_oglas_vrsta_usluge'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('vrsta_usluge'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="vrsta_usluge"  value="<?php echo set_value('vrsta_usluge'); ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('novi_oglas_detalji_smjestaja'); ?>: </p>
							<?php echo form_error('detalji_apartmana'); ?>
							<div class="form-field form-checkbox multi-column pocisti"> 
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pogled" <?php echo set_checkbox('detalji_apartmana', 'pogled'); ?>/> <span> <?php echo lang('novi_oglas_pogled'); ?> </span> </p> 
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="internet" <?php echo set_checkbox('detalji_apartmana', 'internet'); ?>/> <span> <?php echo lang('novi_oglas_internet'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="perilica_rublja" <?php echo set_checkbox('detalji_apartmana', 'perilica_rublja'); ?>/> <span> <?php echo lang('novi_oglas_perilica_rublja'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pecnica" <?php echo set_checkbox('detalji_apartmana', 'pecnica'); ?>/> <span> <?php echo lang('novi_oglas_pecnica'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kucni_ljubimci" <?php echo set_checkbox('detalji_apartmana', 'kucni_ljubimci'); ?>/> <span> <?php echo lang('novi_oglas_kucni_ljubimci'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="balkon" <?php echo set_checkbox('detalji_apartmana', 'balkon'); ?>/> <span> <?php echo lang('novi_oglas_balkon'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="ventilator" <?php echo set_checkbox('detalji_apartmana', 'ventilator'); ?>/> <span> <?php echo lang('novi_oglas_ventilator'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="poseban_ulaz" <?php echo set_checkbox('detalji_apartmana', 'poseban_ulaz'); ?>/> <span> <?php echo lang('novi_oglas_poseban_ulaz'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="hladnjak" <?php echo set_checkbox('detalji_apartmana', 'hladnjak'); ?>/> <span> <?php echo lang('novi_oglas_hladnjak'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinja" <?php echo set_checkbox('detalji_apartmana', 'kuhinja'); ?>/> <span> <?php echo lang('novi_oglas_kuhinja'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tus" <?php echo set_checkbox('detalji_apartmana', 'tus'); ?>/> <span> <?php echo lang('novi_oglas_tus'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="parking" <?php echo set_checkbox('detalji_apartmana', 'parking'); ?>/> <span> <?php echo lang('novi_oglas_parking'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="invalidi" <?php echo set_checkbox('detalji_apartmana', 'invalidi'); ?>/> <span> <?php echo lang('novi_oglas_invalidi'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="klima" <?php echo set_checkbox('detalji_apartmana', 'klima'); ?>/> <span> <?php echo lang('novi_oglas_klima'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tv" <?php echo set_checkbox('detalji_apartmana', 'tv'); ?>/> <span> <?php echo lang('novi_oglas_tv'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="mini_zamrzivac" <?php echo set_checkbox('detalji_apartmana', 'mini_zamrzivac'); ?>/> <span> <?php echo lang('novi_oglas_mini_zamrzivac'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinjski_pribor" <?php echo set_checkbox('detalji_apartmana', 'kuhinjski_pribor'); ?>/> <span> <?php echo lang('novi_oglas_kuhinjski_pribor'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="wc" <?php echo set_checkbox('detalji_apartmana', 'wc'); ?>/> <span> <?php echo lang('novi_oglas_wc'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="bazen" <?php echo set_checkbox('detalji_apartmana', 'bazen'); ?>/> <span> <?php echo lang('novi_oglas_bazen'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="rostilj" <?php echo set_checkbox('detalji_apartmana', 'rostilj'); ?>/> <span> <?php echo lang('novi_oglas_rostilj'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="posteljina" <?php echo set_checkbox('detalji_apartmana', 'posteljina'); ?>/> <span> <?php echo lang('novi_oglas_posteljina'); ?> </span> </p>
							</div>
							
							<div class="dodatni-podaci pocisti">
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_predsezona'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('predsezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="predsezona"  value="<?php echo set_value('predsezona'); ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('cijena_predsezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_predsezona"  value="<?php echo set_value('cijena_predsezona'); ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_sezona'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('sezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="sezona"  value="<?php echo set_value('sezona'); ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('cijena_sezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_sezona"  value="<?php echo set_value('cijena_sezona'); ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_postsezona'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('postsezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="postsezona"  value="<?php echo set_value('postsezona'); ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<?php echo form_error('cijena_postsezona'); ?>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_postsezona"  value="<?php echo set_value('cijena_postsezona'); ?>"/> </p>
								</div>
							</div>
							
							<p class="item-2"> <?php echo lang('com_info_slike');?> </p>
							<div class="image-upload pocisti">
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_1'); ?>: </p>
									<?php echo form_error('slika_1'); ?>
									<?php if (isset($greska['slika_1'])): ?>
									<p class="error"><?php echo $greska['slika_1'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika1" /> </p>
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
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('novi_oglas_slika_6'); ?>: </p>
									<?php echo form_error('slika_6'); ?>
									<?php if (isset($greska['slika_6'])): ?>
									<p class="error"><?php echo $greska['slika_6'];?></p> 
									<?php endif;?>
									<p class="form-field"> <input class="type-upload" type="file" name="slika_6" /> </p>
									<input type="hidden" name="oglas_id" value="<?php echo $this->uri->segment(3); ?>" />
								</div>
							</div>
							
							<div class="submit">
								<input type="submit" name="dalje" value="<?php echo lang('novi_oglas_spremi'); ?>" />
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