<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-novi-oglas form-dodaj-slike">
				<?php echo form_open_multipart('ci_admin/opcija/spremi_slike'); ?>
					<p class="content-title item-1"> Dodaj slike </p>
					<p class="item-2"> Morate izabrati svih 6 slika. Dozvoljene ekstenzije su: .jpg/.jpeg, .gif i .png . </p>
					<div class="image-upload pocisti">
						<div>
							<p class="form-label"> Glavna slika: </p>
							<?php echo form_error('glavna_slika'); ?>
							<?php if (isset($greska['glavna_slika'])): ?>
							<p class="error"><?php echo $greska['glavna_slika'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="glavna_slika" /> </p>
						</div>	
							
						<div>
							<p class="form-label"> Slika 1: </p>
							<?php echo form_error('slika_1'); ?>
							<?php if (isset($greska['slika_1'])): ?>
							<p class="error"><?php echo $greska['slika_1'];?></p> 
							<?php endif;?>
							<p class="form-field"> <input class="type-upload" type="file" name="slika_1" /> </p>
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
							<input type="hidden" name="oglas_id" value="<?php echo $oglas_id; ?>" />
						</div>
					</div>
					<div class="loading"> <!-- Ajax loading --> </div>
					<p id="rezultat"></p>
					<div class="submit">
						<input id="upload-images" type="submit" name="dalje" value="Sljedeći korak" />
						<a href="<?php echo base_url(); ?>"> Odustani </a>
					</div>
				</form>
			</div>
		</div>
	</div>
<!-- footer -->
	
