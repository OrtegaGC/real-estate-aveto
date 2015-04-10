<div id="izbornik" class="pocisti">
	<ul class="izbornik">
		<li> <a <?php if ($this->uri->segment(3) == 'index'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin">Početna</a> </li>
		<li> 
			<a <?php if ($this->uri->segment(3) == 'korisnici'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/korisnici">Korisnici</a> 
			<ul <?php if ($this->uri->segment(3) == 'korisnici'):echo 'class="sub-active"'; elseif ($this->uri->segment(3) == 'novi_korisnik'): echo 'class="sub-active"'; else: echo 'class="sub-inactive"'; endif; ?>>
				<li> <a <?php if ($this->uri->segment(3) == 'novi_korisnik'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/novi_korisnik">Novi korisnik</a> </li>
			</ul>
		</li>
		<li> <a <?php if ($this->uri->segment(3) == 'oglasi'): echo 'class="active"'; elseif ($this->uri->segment(3) == 'uredi_oglas'): echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/oglasi">Oglasi</a> 
			<ul <?php if ($this->uri->segment(3) == 'oglasi'): echo 'class="sub-active"'; 
						elseif ($this->uri->segment(3) == 'uredi_oglas'): echo 'class="sub-active"'; 
						elseif ($this->uri->segment(3) == 'novi_oglas'): echo 'class="sub-active"'; 
						elseif ($this->uri->segment(3) == 'novi_apartman'): echo 'class="sub-active"'; 
						elseif ($this->uri->segment(3) == 'istaknuti_oglasi'): echo 'class="sub-active"'; 
						else: echo 'class="sub-inactive"'; endif; ?>>
				<li> <a <?php if ($this->uri->segment(3) == 'novi_oglas'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/novi_oglas">Novi oglas</a> </li>
				<li> <a <?php if ($this->uri->segment(3) == 'novi_apartman'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/novi_apartman">Novi apartman</a> </li>
				<li> <a <?php if ($this->uri->segment(3) == 'istaknuti_oglasi'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/istaknuti_oglasi">Istaknuti oglasi</a> </li>
			</ul>
		</li>
		<li> 
			<a <?php if ($this->uri->segment(3) == 'banneri'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/banneri">Banneri</a> 
			<ul <?php if ($this->uri->segment(3) == 'banneri'):echo 'class="sub-active"'; elseif ($this->uri->segment(3) == 'novi_banner'): echo 'class="sub-active"'; else: echo 'class="sub-inactive"'; endif;  ?>>
				<li> <a <?php if ($this->uri->segment(3) == 'novi_banner'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/novi_banner">Novi banner</a> </li>
			</ul>
		</li>
		<li> <a <?php if ($this->uri->segment(3) == 'ccache'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/ccache">Očisti cache</a> </li>
		<li> <a <?php if ($this->uri->segment(3) == 'postavke'):echo 'class="active"'; endif; ?> href="<?php echo base_url();?>ci_admin/opcija/postavke">Postavke</a> </li>
		<li> <a target="_blank" href="<?php echo base_url();?>">Pregled stranice</a> </li>
		<li class="last-item"> <a href="<?php echo base_url();?>ci_admin/opcija/odjava">Odjava</a> </li>
	</ul>
</div>