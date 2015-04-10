<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-registracija banner">
				<p class="content-title item-1"> Novi banner</p>
				<p class="info item-2"> <span class="required-item">*</span> - obavezna polja </p>
				<?php echo form_open_multipart('ci_admin/opcija/spremi_banner'); ?>
					<p class="form-label"> Naziv bannera: <span class="required-item">*</span> </p>
					<?php echo form_error('naziv_bannera'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="naziv_bannera"  value="<?php echo set_value('naziv_bannera'); ?>"/> </p>
					<p class="form-label"> Web stranica: <span class="required-item">*</span> </p>
					<?php echo form_error('web_stranica'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="web_stranica"  value="<?php echo set_value('web_stranica'); ?>"/> </p>
					<p class="form-label"> Datum isteka: <span class="required-item">*</span> </p>
					<?php echo form_error('datum_isteka'); ?>
					<p class="form-field"> <input class="type-text" type="text" name="datum_isteka" value="<?php echo set_value('datum_isteka'); ?>" /> </p>
					<p class="form-label"> Slika: <span class="required-item">*</span> </p>
					<?php echo form_error('slika'); ?>
					<?php if (isset($greska)) echo '<p class="error">'.$greska['slika'].'</p>'; ?>
					<p class="form-field"> <input class="type-upload" type="file" name="slika" /> </p>
							
					<p class="submit"> <input type="submit" name="registracija" value="Spremi banner" /> <a href="<?php echo base_url();?>ci_admin/opcija/banneri"> Odustani </a> </p>
				</form>
			</div>
		</div>
	</div>
<!-- footer -->
	
