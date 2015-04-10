<div class="trazilica cb">
	<?php echo form_open('trazi/upit');?>
	<div class="upit">
		<p class="form-field">
			<label for="upit" class="form-label"> <?php echo lang('home_trazilica_upit'); ?>: </label> <input id="upit" class="type-text" type="text" name="upit" value="<?php echo set_value('upit'); ?>"/> 
		</p>
	</div>
	<div class="dropdown">
		<select id="zupanija-trazilica" name="zupanija">
			<option value="0"><?php echo lang('home_trazilica_zupanija');?></option>
		<?php foreach ($regije as $value):?>
			<option value="<?php echo $value['regijaID']; ?>"> <?php echo $value['naziv_regije'];?></option>
		<?php endforeach;?>
		</select> 
	</div>
	<div class="dropdown">
		<div class="loading-0"> <!-- Ajax loading --> </div>
		<select id="mjesto-trazilica" name="mjesto" disabled="disabled">
			<option value="0"><?php echo lang('home_trazilica_mjesto');?></option>
		</select> 
	</div>
	<div class="form-field form-trazilica form-checkbox pocisti cb">
		<?php include_once 'kategorije-checkbox.php'; ?>
		<div class="submit cb">
			<input type="submit" name="trazi" value="<?php echo lang('home_trazilica_trazi'); ?>" />
		</div>
	</div>
	</form>
</div>