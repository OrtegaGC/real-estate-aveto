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
						<?php echo form_open('korisnik/spremi_promjene_usluge/'.$this->uri->segment(3).'/'.$this->uri->segment(4))."\n"; ?>
							<p class="content-title item-1"> <?php echo lang('uredi_oglas_naziv_obrasca_uredi_usluge'); ?> </p>
							<p class="uredi-slike"> <a href="<?php echo base_url();?>korisnik/uredi_slike/usluga/<?php echo $this->uri->segment(3).'/'.$this->uri->segment(4);?>"><?php echo lang('uredi_oglas_uredi_slike');?></a> </p>
							<p class="form-label"> <?php echo lang('uredi_oglas_naziv_apartmana'); ?>: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="naziv_apartmana"  value="<?php echo $apartman[0]['nazivApartmana']; ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('uredi_oglas_broj_soba'); ?>: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo $apartman[0]['brojSoba']; ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('uredi_oglas_vrsta_usluge'); ?>: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="vrsta_usluge"  value="<?php echo $apartman[0]['vrstaUsluge']; ?>"/> </p>
							
							<p class="form-label"> <?php echo lang('uredi_oglas_detalji_smjestaja'); ?>: </p>
							<div class="form-field form-checkbox multi-column pocisti"> 
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pogled" <?php if (isset($detalji_apartmana['pogled'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_pogled'); ?> </span> </p> 
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="internet" <?php if (isset($detalji_apartmana['internet'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_internet'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="perilica_rublja" <?php if (isset($detalji_apartmana['perilica_rublja'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_perilica_rublja'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pecnica" <?php if (isset($detalji_apartmana['pecnica'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_pecnica'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kucni_ljubimci" <?php if (isset($detalji_apartmana['kucni_ljubimci'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_kucni_ljubimci'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="balkon" <?php if (isset($detalji_apartmana['balkon'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_balkon'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="ventilator" <?php if (isset($detalji_apartmana['ventilator'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_ventilator'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="poseban_ulaz" <?php if (isset($detalji_apartmana['poseban_ulaz'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_poseban_ulaz'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="hladnjak" <?php if (isset($detalji_apartmana['hladnjak'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_hladnjak'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinja" <?php if (isset($detalji_apartmana['kuhinja'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_kuhinja'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tus" <?php if (isset($detalji_apartmana['tus'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_tus'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="parking" <?php if (isset($detalji_apartmana['parking'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_parking'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="invalidi" <?php if (isset($detalji_apartmana['invalidi'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_invalidi'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="klima" <?php if (isset($detalji_apartmana['klima'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_klima'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tv" <?php if (isset($detalji_apartmana['tv'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_tv'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="mini_zamrzivac" <?php if (isset($detalji_apartmana['mini_zamrzivac'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_mini_zamrzivac'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinjski_pribor" <?php if (isset($detalji_apartmana['kuhinjski_pribor'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_kuhinjski_pribor'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="wc" <?php if (isset($detalji_apartmana['wc'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_wc'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="bazen" <?php if (isset($detalji_apartmana['bazen'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_bazen'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="rostilj" <?php if (isset($detalji_apartmana['rostilj'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_rostilj'); ?> </span> </p>
								<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="posteljina" <?php if (isset($detalji_apartmana['posteljina'])) { echo 'checked'; } ?>/> <span> <?php echo lang('uredi_oglas_posteljina'); ?> </span> </p>
							</div>
							
							<div class="dodatni-podaci pocisti">
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_predsezona'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="predsezona"  value="<?php echo $apartman[0]['predsezona']; ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_predsezona"  value="<?php echo $apartman[0]['cijenaPredsezona']; ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_sezona'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="sezona"  value="<?php echo $apartman[0]['sezona']; ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_sezona"  value="<?php echo $apartman[0]['cijenaSezona'];?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_postsezona'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="postsezona"  value="<?php echo $apartman[0]['postsezona']; ?>"/> </p>
								</div>
								
								<div>
									<p class="form-label"> <?php echo lang('uredi_oglas_cijena'); ?>: <span class="required-item">*</span> </p>
									<p class="form-field"> <input class="type-text" type="text" name="cijena_postsezona"  value="<?php echo $apartman[0]['cijenaPostsezona']; ?>"/> </p>
								</div>
							</div>
							
							<div class="submit">
								<input type="hidden" name="oglas_id" value="<?php echo $this->uri->segment(3);?>" />
								<input type="hidden" name="apartman_id" value="<?php echo $this->uri->segment(4);?>" />
								<input type="submit" name="dalje" value="<?php echo lang('uredi_oglas_spremi_promjene'); ?>" />
								<a href="<?php echo base_url(); ?>"> <?php echo lang('uredi_oglas_odustani'); ?> </a>
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