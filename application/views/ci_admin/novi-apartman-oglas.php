<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-novi-oglas form-novi-apartman">
				<?php echo form_open_multipart('ci_admin/opcija/spremi_apartman_oglas/'.$this->uri->segment(4))."\n"; ?>
					<p class="content-title item-1"> Novi apartman </p>
					<p class="form-label"> Naziv apartmana: <span class="required-item">*</span> </p>
					<?php echo form_error('naziv_apartmana'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="naziv_apartmana"  value="<?php echo set_value('naziv_apartmana'); ?>"/> </p>
					
					<p class="form-label"> Broj soba: <span class="required-item">*</span> </p>
					<?php echo form_error('broj_soba'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo set_value('broj_soba'); ?>"/> </p>
							
					<p class="form-label"> Vrsta usluge: <span class="required-item">*</span> </p>
					<?php echo form_error('vrsta_usluge'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="vrsta_usluge"  value="<?php echo set_value('vrsta_usluge'); ?>"/> </p>
							
					<p class="form-label"> Detalji smještaja: </p>
					<?php echo form_error('detalji_apartmana'); ?>
					<div class="form-field form-checkbox multi-column pocisti"> 
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pogled" <?php echo set_checkbox('detalji_apartmana', 'pogled'); ?>/> <span> Pogled na more </span> </p> 
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="internet" <?php echo set_checkbox('detalji_apartmana', 'internet'); ?>/> <span> Internet </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="perilica_rublja" <?php echo set_checkbox('detalji_apartmana', 'perilica_rublja'); ?>/> <span> Perilica rublja </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pecnica" <?php echo set_checkbox('detalji_apartmana', 'pecnica'); ?>/> <span> Pećnica </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kucni_ljubimci" <?php echo set_checkbox('detalji_apartmana', 'kucni_ljubimci'); ?>/> <span> Kućni ljubimci </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="balkon" <?php echo set_checkbox('detalji_apartmana', 'balkon'); ?>/> <span> Balkon </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="ventilator" <?php echo set_checkbox('detalji_apartmana', 'ventilator'); ?>/> <span> Ventilator </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="poseban_ulaz" <?php echo set_checkbox('detalji_apartmana', 'poseban_ulaz'); ?>/> <span> Poseban ulaz </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="hladnjak" <?php echo set_checkbox('detalji_apartmana', 'hladnjak'); ?>/> <span> Hladnjak </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinja" <?php echo set_checkbox('detalji_apartmana', 'kuhinja'); ?>/> <span> Kuhinja </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tus" <?php echo set_checkbox('detalji_apartmana', 'tus'); ?>/> <span> Tuš </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="parking" <?php echo set_checkbox('detalji_apartmana', 'parking'); ?>/> <span> Parking </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="invalidi" <?php echo set_checkbox('detalji_apartmana', 'invalidi'); ?>/> <span> Invalidi </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="klima" <?php echo set_checkbox('detalji_apartmana', 'klima'); ?>/> <span> Klima </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tv" <?php echo set_checkbox('detalji_apartmana', 'tv'); ?>/> <span> TV </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="mini_zamrzivac" <?php echo set_checkbox('detalji_apartmana', 'mini_zamrzivac'); ?>/> <span> Mini zamrzivač </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinjski_pribor" <?php echo set_checkbox('detalji_apartmana', 'kuhinjski_pribor'); ?>/> <span> Kuhinjski pribor </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="wc" <?php echo set_checkbox('detalji_apartmana', 'wc'); ?>/> <span> WC </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="bazen" <?php echo set_checkbox('detalji_apartmana', 'bazen'); ?>/> <span> Bazen </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="rostilj" <?php echo set_checkbox('detalji_apartmana', 'rostilj'); ?>/> <span> Roštilj </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="posteljina" <?php echo set_checkbox('detalji_apartmana', 'posteljina'); ?>/> <span> Posteljina </span> </p>
					</div>
							
					<div class="dodatni-podaci pocisti">
						<div>
							<p class="form-label"> Predsezona: <span class="required-item">*</span> </p>
							<?php echo form_error('predsezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="predsezona"  value="<?php echo set_value('predsezona'); ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<?php echo form_error('cijena_predsezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_predsezona"  value="<?php echo set_value('cijena_predsezona'); ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Sezona: <span class="required-item">*</span> </p>
							<?php echo form_error('sezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="sezona"  value="<?php echo set_value('sezona'); ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<?php echo form_error('cijena_sezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_sezona"  value="<?php echo set_value('cijena_sezona'); ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Postsezona: <span class="required-item">*</span> </p>
							<?php echo form_error('postsezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="postsezona"  value="<?php echo set_value('postsezona'); ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<?php echo form_error('cijena_postsezona'); ?>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_postsezona"  value="<?php echo set_value('cijena_postsezona'); ?>"/> </p>
						</div>
					</div>
							
					<p class="item-2"> Morate izabrati svih 6 slika. Dozvoljene ekstenzije su: .jpg/.jpeg, .gif i .png . </p>
					<div class="image-upload pocisti">
						<div>
							<p class="form-label"> Slika 1: </p>
							<?php echo form_error('slika_1'); ?>
							<?php if (isset($greska['slika_1'])): ?>
							<p class="error"><?php echo $greska['slika_1'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika1" /> </p>
						</div>	
							
						<div>
							<p class="form-label"> Slika 2: </p>
							<?php echo form_error('slika_2'); ?>
							<?php if (isset($greska['slika_2'])): ?>
							<p class="error"><?php echo $greska['slika_2'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_2" /> </p>
						</div>	
							
						<div>
							<p class="form-label"> Slika 3: </p>
							<?php echo form_error('slika_3'); ?>
							<?php if (isset($greska['slika_3'])): ?>
							<p class="error"><?php echo $greska['slika_3'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_3" /> </p>
						</div>
								
						<div>
							<p class="form-label"> Slika 4: </p>
							<?php echo form_error('slika_4'); ?>
							<?php if (isset($greska['slika_4'])): ?>
							<p class="error"><?php echo $greska['slika_4'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_4" /> </p>
						</div>
								
						<div>
							<p class="form-label"> Slika 5: </p>
							<?php echo form_error('slika_5'); ?>
							<?php if (isset($greska['slika_5'])): ?>
							<p class="error"><?php echo $greska['slika_5'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_5" /> </p>
						</div>
								
						<div>
							<p class="form-label"> Slika 6: </p>
							<?php echo form_error('slika_6'); ?>
							<?php if (isset($greska['slika_6'])): ?>
							<p class="error"><?php echo $greska['slika_6'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_6" /> </p>
							<input type="hidden" name="oglas_id" value="<?php echo $this->uri->segment(4); ?>" />
						</div>
					</div>
							
					<div class="submit">
						<input type="submit" name="dalje" value="Spremi" />
						<a href="<?php echo base_url(); ?>"> Odustani </a>
					</div>
				</form>	
			</div>
		</div>
	</div>
<!-- footer -->
	
