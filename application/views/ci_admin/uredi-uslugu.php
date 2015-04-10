<!-- header -->
	<?php require_once(APPPATH.'views/includes/ci_admin/modules/admin-header.php'); ?>
	<div id="content-wrapper" class="pocisti">
		<?php require_once(APPPATH.'views/includes/ci_admin/modules/izbornik.php'); ?>
		<div id="sadrzaj">
			<div class="form-novi-oglas uredi uredi-oglas pocisti">
				<?php echo form_open('ci_admin/opcija/spremi_promjene_usluge/'.$this->uri->segment(5).'/'.$this->uri->segment(6))."\n"; ?>
					<p class="content-title item-1"> Uredi uslugu </p>
					<p class="uredi-slike"> <a href="<?php echo base_url();?>ci_admin/opcija/uredi_slike/usluga/<?php echo $this->uri->segment(5).'/'.$this->uri->segment(6).'/'.$this->uri->segment(4);?>">Uredi slike</a> </p>
					<p class="form-label"> Naziv apartmana: <span class="required-item">*</span> </p>
					<p class="form-field"> <input class="type-text" type="text" name="naziv_apartmana"  value="<?php echo $apartman[0]['nazivApartmana']; ?>"/> </p>
							
					<p class="form-label"> Broj soba: <span class="required-item">*</span> </p>
					<p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo $apartman[0]['brojSoba']; ?>"/> </p>
							
					<p class="form-label"> Vrsta usluge: <span class="required-item">*</span> </p>
					<p class="form-field"> <input class="type-text" type="text" name="vrsta_usluge"  value="<?php echo $apartman[0]['vrstaUsluge']; ?>"/> </p>
							
					<p class="form-label"> Detalji smještaja: </p>
					<div class="form-field form-checkbox multi-column pocisti"> 
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pogled" <?php if (isset($detalji_apartmana['pogled'])) { echo 'checked'; } ?>/> <span> Pogled na more </span> </p> 
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="internet" <?php if (isset($detalji_apartmana['internet'])) { echo 'checked'; } ?>/> <span> Internet </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="perilica_rublja" <?php if (isset($detalji_apartmana['perilica_rublja'])) { echo 'checked'; } ?>/> <span> Perilica rublja </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="pecnica" <?php if (isset($detalji_apartmana['pecnica'])) { echo 'checked'; } ?>/> <span> Pećnica </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kucni_ljubimci" <?php if (isset($detalji_apartmana['kucni_ljubimci'])) { echo 'checked'; } ?>/> <span> Kućni ljubimci </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="balkon" <?php if (isset($detalji_apartmana['balkon'])) { echo 'checked'; } ?>/> <span> Balkon </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="ventilator" <?php if (isset($detalji_apartmana['ventilator'])) { echo 'checked'; } ?>/> <span> Ventilator </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="poseban_ulaz" <?php if (isset($detalji_apartmana['poseban_ulaz'])) { echo 'checked'; } ?>/> <span> Poseban ulaz </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="hladnjak" <?php if (isset($detalji_apartmana['hladnjak'])) { echo 'checked'; } ?>/> <span> Hladnjak </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinja" <?php if (isset($detalji_apartmana['kuhinja'])) { echo 'checked'; } ?>/> <span> Kuhinja </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tus" <?php if (isset($detalji_apartmana['tus'])) { echo 'checked'; } ?>/> <span> Tuš </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="parking" <?php if (isset($detalji_apartmana['parking'])) { echo 'checked'; } ?>/> <span> Parking </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="invalidi" <?php if (isset($detalji_apartmana['invalidi'])) { echo 'checked'; } ?>/> <span> Invalidi </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="klima" <?php if (isset($detalji_apartmana['klima'])) { echo 'checked'; } ?>/> <span> Klima </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="tv" <?php if (isset($detalji_apartmana['tv'])) { echo 'checked'; } ?>/> <span> TV </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="mini_zamrzivac" <?php if (isset($detalji_apartmana['mini_zamrzivac'])) { echo 'checked'; } ?>/> <span> Mini zamrzivač </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="kuhinjski_pribor" <?php if (isset($detalji_apartmana['kuhinjski_pribor'])) { echo 'checked'; } ?>/> <span> Kuhinjski pribor </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="wc" <?php if (isset($detalji_apartmana['wc'])) { echo 'checked'; } ?>/> <span> WC </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="bazen" <?php if (isset($detalji_apartmana['bazen'])) { echo 'checked'; } ?>/> <span> Bazen </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="rostilj" <?php if (isset($detalji_apartmana['rostilj'])) { echo 'checked'; } ?>/> <span> Roštilj </span> </p>
						<p> <input class="type-checkbox" type="checkbox" name="detalji_apartmana[]" value="posteljina" <?php if (isset($detalji_apartmana['posteljina'])) { echo 'checked'; } ?>/> <span> Posteljina </span> </p>
					</div>
							
					<div class="dodatni-podaci pocisti">
						<div>
							<p class="form-label"> Predsezona: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="predsezona"  value="<?php echo $apartman[0]['predsezona']; ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_predsezona"  value="<?php echo $apartman[0]['cijenaPredsezona']; ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Sezona: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="sezona"  value="<?php echo $apartman[0]['sezona']; ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_sezona"  value="<?php echo $apartman[0]['cijenaSezona'];?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Postsezona: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="postsezona"  value="<?php echo $apartman[0]['postsezona']; ?>"/> </p>
						</div>
								
						<div>
							<p class="form-label"> Cijena: <span class="required-item">*</span> </p>
							<p class="form-field"> <input class="type-text" type="text" name="cijena_postsezona"  value="<?php echo $apartman[0]['cijenaPostsezona']; ?>"/> </p>
						</div>
					</div>
							
					<div class="submit">
						<input type="hidden" name="oglas_id" value="<?php echo $this->uri->segment(3);?>" />
						<input type="hidden" name="apartman_id" value="<?php echo $this->uri->segment(4);?>" />
						<input type="submit" name="dalje" value="Spremi promjene" />
						<a href="<?php echo base_url(); ?>/ci_admin/opcija/oglasi"> Odustani </a>
					</div>
				</form>	
			</div>
		</div>
	</div>
<!-- footer -->
	
