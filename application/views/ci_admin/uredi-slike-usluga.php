<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-novi-oglas uredi uredi-oglas pocisti">
				<div class="korisnik-oglasi uredi-slike pocisti">
					<p class="content-title item-1">Uredi slike</p>
					<div class="result"></div>
					<div class="popis-slika pocisti">
						<p class="item-2">Maksimalni broj slika je 6!</p>
						<?php if (isset($greska)):?>
						<p class="error"><?php echo $greska;?></p>
						<?php endif;?>
					<?php foreach ($slike_apartman as $value):?>
						<div>
							 <img src="<?php echo base_url().'uploads/apartmani/'.$value['naziv'].'_thumb.'.$value['ext'];?>" /> 
							 <p><input type="button" class="izbrisi-sliku-oglas" name="<?php echo $this->uri->segment(4);?>" id="<?php echo $value['naziv'].'.'.$value['ext'];?>" value="Izbriši sliku" /></p>
						</div>
					<?php endforeach;?>	
						<?php if (isset($greska_slika)):?>
						<p class="error cb"><?php echo $greska_slika;?></p>
						<?php endif;?>
						<div class="form-uredi-slike cb">
							<?php echo form_open_multipart('ci_admin/opcija/spremi_promjene_slika/usluga/'.$this->uri->segment(4))."\n";?>
								<input type="file" name="slika" />
								<input type="submit" name="spremi" value="Spremi" />
							</form>
						</div>
					</div>
					<div class="loading"> <!-- Ajax loading --> </div>
					<div id="dialog-confirm" title="Potvrdite za brisanje" style="display: none;">
						<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
						<p class="dialog-item"><?php echo lang('uredi_slike_potvrda_brisanja');?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->
	
