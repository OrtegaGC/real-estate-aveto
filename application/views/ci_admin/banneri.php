<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="popis-korisnika pocisti">
				<div class="info"></div>
				<table>
					<tr class="leading-row">
						<td>Naziv</td>
						<td>Web stranica</td>
						<td>Datum objave</td>
						<td>Datum isteka</td>
						<td>Opcije</td>
					</tr>
					<?php foreach($banneri as $value): ?>
					<tr>
						<td><?php echo $value['naziv'];?></td>
						<td><?php echo $value['webStranica'];?></td>
						<td><?php echo $this->funkcija->dbOutputDate($value['datumObjave']);?></td>
						<td><?php echo $this->funkcija->dbOutputDate($value['datumIsteka']);?></td>
						<td> 
							<table> 
								<tr> 
									<td > <a href="<?php echo base_url();?>ci_admin/opcija/uredi_banner/<?php echo $value['bannerID'];?>">Uredi</a> </td> 
									<td> <a class="izbrisi-banner" id="<?php echo $value['bannerID'];?>" href="#">Izbriši</a> </td>
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
					<p class="dialog-item">Jeste li sigurni da želite izbrisati banner?</p>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->
	
