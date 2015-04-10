<div id="login" class="pocisti">
	<div class="module-title"> <?php echo $this->lang->line('com_mod_login'); ?> </div>
	<div class="login-content">
			<?php echo form_open('korisnik/prijava'); ?>
			<p class="form-label"> <?php echo lang('com_mod_login_korisnicko_ime'); ?>  </p>
			<?php echo form_error('prijava_korisnicko_ime'); ?>
			<p class="form-field"> <input class="type-text" type="text" name="prijava_korisnicko_ime"/> </p>
			<p class="form-label"> <?php echo lang('com_mod_login_lozinka'); ?>  </p>
			<?php echo form_error('prijava_lozinka'); ?>
			<p class="form-field"> <input class="type-text" type="password" name="prijava_lozinka"/> </p>
			<p class="form-links"> <a class="istaknuto" href="<?php echo base_url();?>stranica/registracija"> <?php echo lang('com_mod_login_registracija');?></a> </p>
			<p class="form-links"> <a href="<?php echo base_url();?>stranica/zaboravljena_lozinka"> <?php echo lang('com_mod_login_zaboravljena_lozinka');?></a> </p>
			<p class="submit"> <input type="submit" name="prijava" value="<?php echo lang('com_mod_login_prijava'); ?>" /> </p>
		</form>
	</div>
</div>
