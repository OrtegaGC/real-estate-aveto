<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="popis-oglasa pocisti">
				<div class="info"></div>
				<div class="form-field"> 
					<div class="trazilica">
						<p class="form-label"> Pretraga oglasa (upišite ime korisnika): </p>
						<input class="ime_korisnika" class="type-text" type="text" name="ime_korisnika" autocomplete="off" /> 
						<span class="reset"><img src="<?php echo base_url();?>/includes/images/minus.png" title="Izbriši" alt="remove" /></span>
						<input id="oglas_id" type="hidden" name="oglas"  value="<?php echo set_value('oglas'); ?>"/>
						<div class="loading-0"> <!-- Ajax loading --> </div>
						<div id="oglas-rezultati"></div>
					</div>
				</div>
				<div class="legenda">
					<span class="legenda-aktivan-1"></span> <span> - aktivni oglasi</span>
					<span>&nbsp;</span>
					<span class="legenda-aktivan-0"></span> <span> - neaktivni oglasi</span>
				<table>
					<tr class="leading-row">
						<td>Naziv objekta</td>
						<td>Tip smještaja</td>
						<td>Regija</td>
						<td>Mjesto</td>
						<td>Opcije</td>
					</tr>
					<?php foreach($oglasi as $value): ?>
					<tr>
						<td class="aktivan-<?php echo $value['vidljiv'];?>"><?php echo $value['nazivObjekta'];?></td>
						<td class="aktivan-<?php echo $value['vidljiv'];?>"><?php echo lang('detalji_tip_'.$value['tipSmjestaja']);?></td>
						<td class="aktivan-<?php echo $value['vidljiv'];?>"><?php echo $value['naziv_regije'];?></td>
						<td class="aktivan-<?php echo $value['vidljiv'];?>"><?php echo $value['naziv_mjesta'];?></td>
						<td> 
							<table> 
								<tr> 
									<td> <a class="aktiviraj-oglas" id="<?php echo $value['oglasID'];?>" href="#">Aktiviraj</a> </td>
									<td> <a class="deaktiviraj-oglas" id="<?php echo $value['oglasID'];?>" href="#">Deaktiviraj</a> </td>
									<td > <a href="<?php echo base_url();?>ci_admin/opcija/uredi_oglas/<?php echo $value['oglasID'];?>">Uredi</a> </td> 
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
				<div id="dialog-izbrisi" title="Potvrdite za brisanje" style="display: none;">
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
					<p class="dialog-item">Jeste li sigurni da želite izbrisati oglas?</p>
				</div>
				<div id="dialog-aktiviraj" title="Potvrdite za aktiviranje" style="display: none;">
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
					<p class="dialog-item">Jeste li sigurni da želite aktivirati oglas?</p>
				</div>
				<div id="dialog-deaktiviraj" title="Potvrdite za deaktiviranje" style="display: none;">
					<span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
					<p class="dialog-item">Jeste li sigurni da želite deaktivirati oglas?</p>
				</div>
			</div>
		</div>
	</div>
<!-- footer -->
	
