<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="popis-oglasa pocisti">
				<p> <a href="<?php echo base_url();?>ci_admin/opcija/uredi_oglas/<?php echo $this->uri->segment(4);?>">Povratak</a> </p>
				<div class="legenda">
					<table>
						<tr class="leading-row">
							<td>#</td>
							<td>Naziv usluge</td>
							<td>Opcije</td>
						</tr>
						<?php
							$i = 1; 
							foreach($usluge as $value): 
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $value['nazivApartmana'];?></td>
							<td> 
								<table> 
									<tr> 
										<td > <a href="<?php echo base_url();?>ci_admin/opcija/uredi_uslugu/<?php echo $this->uri->segment(5).'/'.$this->uri->segment(4).'/'.$value['apartmanID'];?>">Uredi</a> </td> 
										<td> <a class="izbrisi-uslugu" id="<?php echo $value['apartmanID'];?>" href="#">Izbriši</a> </td>
									<tr>
								</table>
							</td>
						</tr>
						<?php endforeach; ?>
					</table>
					<div id="dialog-izbrisi" title="Potvrdite za brisanje" style="display: none;">
						<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
						<p class="dialog-item">Jeste li sigurni da želite izbrisati uslugu?</p>
					</div>
				</div>
			</div>
		</div>
<!-- footer -->
	
