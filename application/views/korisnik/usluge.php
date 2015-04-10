<!-- head -->
	<!-- SADRŽAJ -->
	<!-- Takeover left -->
	<div class="pocisti" id="takeover-wrapper">
		<?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
		<div id="content-wrapper">
			<div id="content">
				<!-- Banner top -->
				<?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
				<div class="content-left">
					<div id="korisnicke-stranice">
						<p> <a href="<?php echo base_url();?>korisnik/oglasi"><?php echo lang('com_breadcrumb_povratak');?></a> </p>
						<div class="korisnik-oglasi">
							<table>
								<tr class="leading-row">
									<td>#</td> 
									<td><?php echo lang('moji_oglasi_naziv_usluge');?></td>
									<td><?php echo lang('moji_oglasi_opcije');?></td>
								</tr>
								<?php
									$i = 1;
									foreach ($usluge as $u_value):
								?>
								<tr>
									<td><?php echo $i++;?></td>
									<td><?php echo $u_value['nazivApartmana'];?></td>
									<td>
										<table>
											<tr>
												<td><a href="<?php echo base_url();?>korisnik/uredi_uslugu/<?php echo $this->uri->segment(3);?>/<?php echo $u_value['apartmanID']; ?>"><?php echo lang('moji_oglasi_uredi');?></a></td>
												<td><a id="<?php echo $u_value['apartmanID']; ?>" href="#"><?php echo lang('moji_oglasi_izbrisi');?></a></td>
											</tr>
										</table>
									</td>
								</tr>
								<?php endforeach;?>
							</table>
						</div>
					</div>
				</div>
				<div class="content-right">
					<!-- Login -->
					<?php
						$userdata = $this->session->userdata('prijavljen');
						if( !$this->session->userdata('prijavljen'))
						{
							require_once(APPPATH.'views/includes/modules/login.php');
						} else if ($this->session->userdata('tip') == 1) { // -- administrator
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-1.php');
						} else if ($this->session->userdata('tip') == 2) { // -- oglašivač
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-2.php');
						} else if ($this->session->userdata('tip') == 3) { // -- korisnik
							require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-3.php');
						}
					?>
					<!-- Tečajna lista -->
					<?php require_once(APPPATH.'views/includes/modules/tecajna-lista.php');?>
					<!-- Social -->
					<?php require_once(APPPATH.'views/includes/modules/social.php');?>
				</div>
				<!-- Banner bottom -->
				<?php require_once(APPPATH.'views/includes/banner-bottom.php'); ?>
			</div>
		</div>
		<!-- Takeover right -->
		<?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
	</div>