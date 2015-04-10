		<script src="<?php echo base_url();?>includes/js/jq-adm-script.js"></script>
		<?php if ($this->uri->segment(3) == 'novi_oglas' OR $this->uri->segment(3) == 'dodaj_slike' OR $this->uri->segment(3) == 'uredi_oglas' OR $this->uri->segment(3) == 'spremi_promjene_oglasa'): ?>
		<script src="<?php echo base_url();?>includes/js/map.js"></script>
		<?php endif;?>
	</body>
</html>