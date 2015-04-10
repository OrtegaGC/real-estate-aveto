<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="popis-korisnika pocisti">
				<div class="info"></div>
				<div class="filter">
					<p class="opis">Prikaži registrirane korisnike u periodu:</p>
					<div class="datumi">
						<label for="datum_od">Od: </label><input id="datum_od" type="text" name="datum_od" value="<?php echo $this->uri->segment(6);?>" />
						<label for="datum_do">Do: </label><input id="datum_do" type="text" name="datum_do" value="<?php echo $this->uri->segment(7);?>" />
						<a id="filtriraj" href="<?php echo base_url()?>ci_admin/opcija/korisnici/filter/datum">Filtriraj</a>
					</div>
				</div>
				<table>
					<tr class="leading-row">
						<td>Ime</td>
						<td>Prezime</td>
						<td>Korisničko ime</td>
						<td>E-mail</td>
						<td>Tip korisnika</td>
						<td>Opcije</td>
					</tr>
					<?php foreach($korisnici as $value): ?>
					<tr>
						<td><?php echo $value['ime'];?></td>
						<td><?php echo $value['prezime'];?></td>
						<td><?php echo $value['korisnicko_ime'];?></td>
						<td><?php echo $value['email'];?></td>
						<td class="tip-<?php echo $value['tipID']?>"><?php echo $value['naziv'];?></td>
						<td> 
							<table> 
								<tr> 
									<td > <a href="<?php echo base_url();?>ci_admin/opcija/uredi_korisnika/<?php echo $value['korisnikID'];?>">Uredi</a> </td> 
									<td> <a class="izbrisi-korisnika" id="<?php echo $value['korisnikID'];?>" href="#">Izbriši</a> </td>
								<tr>
							</table>
						</td>
					</tr>
					<?php endforeach; ?>
				</table>
				<div id="pagination">
				<?php echo $this->pagination->create_links(); ?>
				</div>
				<div id="dialog-confirm" title="Potvrdite za brisanje" style="display: none;">
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
					<p class="dialog-item">Jeste li sigurni da želite izbrisati korisnika?</p>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->
	
