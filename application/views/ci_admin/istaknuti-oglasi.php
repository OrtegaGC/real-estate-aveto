<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="popis-oglasa pocisti">
				<div class="info"></div>
				<table>
					<tr class="leading-row">
						<td>Naziv objekta</td>
						<td>Tip smještaja</td>
						<td>Regija</td>
						<td>Mjesto</td>
						<td>Pozicija</td>
						<td>Datum isteka</td>
						<td>Opcije</td>
					</tr>
					<?php foreach($korisnici as $value): ?>
					<tr>
						<td><?php echo $value['nazivObjekta'];?></td>
						<td><?php echo lang('detalji_tip_'.$value['tipSmjestaja']);?></td>
						<td><?php echo $value['naziv_regije'];?></td>
						<td><?php echo $value['naziv_mjesta'];?></td>
						<td><?php echo $value['pozicija'];?></td>
						<td><?php echo $this->funkcija->dbOutputDate($value['datumIsteka']);?></td>
						<td> 
							<table> 
								<tr> 
									<td > <a href="<?php echo base_url();?>index.php/ci_admin/opcija/uredi_oglas/<?php echo $value['oglasID'];?>">Uredi</a> </td> 
									<td> <a class="izbrisi-oglas" id="<?php echo $value['oglasID'];?>" href="#">Izbriši</a> </td>
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
					<p class="dialog-item">Jeste li sigurni da želite izbrisati oglas?</p>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->
	
