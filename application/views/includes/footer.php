		<div id="to-top">
			<a href="#top"></a>
		</div>
		<div class="cb" id="footer-wrapper">
			<div class="izbornik-footer">
				<ul>
					<li class="first-item"> <a <?php if ($this->uri->segment(2) == 'prezentacija'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/prezentacija/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_prezentacija'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'o_nama'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/o_nama/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_o_nama'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'kontakt'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/kontakt/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_kontakt'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'upute_koristenja'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/upute_koristenja/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_upute_koristenja'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'uvjeti_koristenja'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/uvjeti_koristenja/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_uvjeti_koristenja'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'cijena'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/cijena/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_cijena'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'posao'):echo 'class="active"'; endif; ?> href="http://www.group-mobicash.com.hr/posao.php"> <?php echo lang('com_izbornik_posao'); ?> </a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'zarada'):echo 'class="active"'; endif; ?> href="http://www.group-mobicash.com.hr/zarada.php"><?php echo lang('com_dodatna_zarada');?></a> </li>
					<li> <a <?php if ($this->uri->segment(2) == 'poslovnice'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>stranica/poslovnice/<?php echo get_cookie('lang', TRUE); ?>"><?php echo lang('com_izbornik_poslovnice');?></a> </li>
				</ul>
			</div>
			<div class="copyright">
				<p> Copyright © 2012 Croatia-Aveto. All Rights Reserved. </p>
			</div>
		</div>
		
		<script src="<?php echo base_url();?>includes/js/jq-script.js"></script>
		<script src="<?php echo base_url();?>includes/js/jq-tecajna-lista.js"></script>
		<script src="<?php echo base_url();?>includes/js/jq-lightbox-0.5.js"></script>
		<script src="<?php echo base_url();?>includes/js/map.js"></script>
	</body>
</html>