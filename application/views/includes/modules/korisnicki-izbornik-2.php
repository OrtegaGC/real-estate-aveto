<div id="korisnicki-izbornik" class="pocisti">
	<div class="module-title"> <?php echo lang('com_mod_izbornik'); ?> </div>
	<div class="korisnicki-izbornik-opcije">
		<p class="pozdrav"> <?php echo lang('com_mod_izbornik_pozdrav');?>, <strong><?php echo $this->session->userdata('korisnicko_ime');?></strong> </p>
		<p class="opcija"> <a href="<?php echo base_url();?>korisnik/oglasi"> <?php echo lang('com_mod_izbornik_2_oglasi'); ?> </a> </p>
		<p class="opcija"> <a href="<?php echo base_url();?>korisnik/novi_oglas"> <?php echo lang('com_mod_izbornik_2_novi_oglas'); ?> </a> </p>
		<p class="opcija odjava"> <a href="<?php echo base_url();?>korisnik/odjava"> <?php echo lang('com_mod_izbornik_odjava'); ?> </a> </p>
	</div>
</div>