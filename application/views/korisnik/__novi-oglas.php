<!-- head -->
	<!-- SADRŽAJ -->
		<div id="content-wrapper">
			<div id="content">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<?php if($this->uri->segment(2) == 'novi_oglas'): ?>
					<div id="novi-oglas">
						<?php echo form_open('korisnik/oglas/korak/2'); ?>
							<p class="content-title item-1"> <?php echo lang('novi_oglas_naziv_obrasca'); ?> </p>
							
							<p class="form-label"> <?php echo lang('novi_oglas_zupanija'); ?>: <span class="required-item">*</span> </p>
							<?php echo form_error('zupanija'); ?>
							<p class="form-field">
								<select id="zupanija" name="zupanija">
									<?php foreach ($zupanija as $value):?>
									<option value="<?php echo $value['regijaID']; ?>"> <?php echo $value['naziv_regije'];?></option>
									<?php endforeach;?>
								</select> 
							 </p>
							 <p class="form-label"> <?php echo lang('novi_oglas_mjesto'); ?>: <span class="required-item">*</span> </p>
							 <?php echo form_error('mjesto'); ?>
							 <p class="form-field">
								<select id="mjesto" name="mjesto">
									<option><?php echo lang('novi_oglas_mjesto_2'); ?></option>
								</select> 
							 </p>
							 
							<div id="map-wrapper">
								<div id="map-canvas"></div>
							</div>
		
							<div id="map-options" class="pocisti">
								<div id="firstRow" class="pocisti">
									<p class="buttonControls"> <input type="button" value="Početna pozicija" onClick="initialize()"> </p>
									<p class="zoomInfo"> <?php echo lang('novi_oglas_razina_povecanja'); ?>: <span id="zoomLevel"></span> </p>
								</div>
								<div id="geo-coords"> 
									<span> <?php echo lang('novi_oglas_latitude'); ?></span> <input type="text" name="geo-lat" id="lat" /> 
									<span> <?php echo lang('novi_oglas_longitude'); ?> </span> <input type="text" name="geo-lng" id="lng" />
								</div>
							</div>
							<input type="submit" name="dalje" value="<?php echo lang('novi_oglas_sljedeci_korak'); ?>" />
						</form>
					</div>
					
					<?php elseif ($this->uri->segment(2) == 'oglas' && $this->uri->segment(3) == 'korak' && $this->uri->segment(4) == 2 && isset($oglas_id)): ?>
					
					<div class="form-novi-oglas">
						<?php echo form_open('index.php/korisnik/oglas/spremi'); ?>
							<input type="text" name="naziv_apartmana" />
							<input type="hidden" name="oglas_id" value="<?php echo $oglas_id[0]['oglasID']; ?>" />
							<input type="submit" name="spremi_oglas" value="<?php echo lang('novi_oglas_spremi'); ?>">
						</form>	
					</div>
					
					<?php else:?>
						<p class="warning"> <?php echo lang('novi_oglas_url_greska'); ?> </p>
					<?php endif;?>
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