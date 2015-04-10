<!-- head -->
<!-- SADRŽAJ -->

<!-- Takeover left -->
<div class="pocisti" id="takeover-wrapper">
    <?php require_once(APPPATH . 'views/includes/takeover-left.php'); ?>
    <div id="content-wrapper">
        <div id="content">
            <!-- Banner top -->
            <?php require_once(APPPATH . 'views/includes/banner-top.php'); ?>
            <div class="content-left">
                <div id="novi-oglas">
                    <?php echo form_open('korisnik/spremi_promjene/' . $this->uri->segment(3)) . "\n"; ?>
                    <p class="content-title item-1"> <?php echo lang('uredi_oglas_naziv_obrasca'); ?> </p>
                    <p class="uredi-slike"> <a href="<?php echo base_url(); ?>korisnik/uredi_slike/oglas/<?php echo $this->uri->segment(3); ?>"><?php echo lang('uredi_oglas_uredi_slike'); ?></a> </p>
                    <p class="form-label"> <?php echo lang('uredi_oglas_zupanija'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field">
                        <select id="zupanija" name="zupanija">
                            <?php foreach ($zupanija as $value): ?>
                                <option value="<?php echo $value['regijaID']; ?>" <?php if ($value['regijaID'] == $regija[0]['regijaID']) {
                                echo 'selected'; } ?>>
                                    <?php echo $value['naziv_regije']; ?>
                                </option>
<?php endforeach; ?>
                        </select> 
                    </p>
                    <p class="form-label"> <?php echo lang('uredi_oglas_mjesto'); ?>: <span class="required-item">*</span> </p>
                    <div class="loading"> <!-- Ajax loading --> </div>
                    <p class="form-field">
                        <select id="mjesto" name="mjesto">
                            <?php foreach ($mjesto as $value): ?>
                                <option value="<?php echo $value['mjestoID']; ?>" <?php if ($value['mjestoID'] == $oglas[0]['mjestoID']) {
                                echo 'selected';
                            } ?>> <?php echo $value['naziv_mjesta']; ?></option>
<?php endforeach; ?>
                        </select> 
                    </p>

                    <!--div id="map-wrapper">
                        <div id="map-canvas"></div>
                    </div>

                    <div id="map-options" class="pocisti">
                        <div id="firstRow" class="pocisti">
                            <p class="buttonControls"> <input type="button" value="<?php //echo lang('uredi_oglas_promijeni_lokaciju'); ?>" onClick="initialize()"> </p>
                            <p class="zoomInfo"> <?php //echo lang('uredi_oglas_razina_povecanja'); ?>: <span id="zoomLevel"></span> </p>
                        </div>
                        <div id="geo-coords"> 
                            <span> <?php //echo lang('uredi_oglas_latitude'); ?> <span class="required-item">*</span> </span> <input type="text" name="geo-lat" id="lat" value="<?php //echo $oglas[0]['lokacijaLatitude']; ?>" /> 
                            <span> <?php //echo lang('uredi_oglas_longitude'); ?>  <span class="required-item">*</span> </span> <input type="text" name="geo-lng" id="lng" value="<?php //echo $oglas[0]['lokacijaLongitude']; ?>" />
                        </div>
                    <!--/div-->

                    <p class="form-label"> <?php echo lang('uredi_oglas_naziv_objekta'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field"> <input class="type-text" type="text" name="naziv_objekta"  value="<?php echo $oglas[0]['nazivObjekta']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_tip_smjestaja'); ?>: <span class="required-item">*</span> </p>
                    <div class="form-field form-radio pocisti"> 
                        <?php $this->load->view("includes/kategorije-radio-uredi"); ?>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_dodatne_usluge_hr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_hr"><?php echo $oglas[0]['dodatneUslugeHr']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_dodatne_usluge_en'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_en"><?php echo $oglas[0]['dodatneUslugeEn']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_dodatne_usluge_de'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_de"><?php echo $oglas[0]['dodatneUslugeDe']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_dodatne_usluge_it'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_it"><?php echo $oglas[0]['dodatneUslugeIt']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_dodatne_usluge_fr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_fr"><?php echo $oglas[0]['dodatneUslugeFr']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_broj_zvijezdica') ?> </p>
                    <div class="form-field form-select pocisti">
                        <select name="broj_zvijezdica">
                            <option value="5" <?php if ($oglas[0]['brojZvijezdica'] == 5) {
    echo 'selected';
} ?>>5</option> 
                            <option value="4" <?php if ($oglas[0]['brojZvijezdica'] == 4) {
    echo 'selected';
} ?>>4</option>
                            <option value="3" <?php if ($oglas[0]['brojZvijezdica'] == 3) {
    echo 'selected';
} ?>>3</option>
                            <option value="2" <?php if ($oglas[0]['brojZvijezdica'] == 2) {
    echo 'selected';
} ?>>2</option>
                            <option value="1" <?php if ($oglas[0]['brojZvijezdica'] == 1) {
    echo 'selected';
} ?>>1</option>
                        </select>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_adresa'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field"> <input class="type-text" type="text" name="adresa"  value="<?php echo $oglas[0]['adresaBrojPoste']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_telefon'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field"> <input class="type-text" type="text" name="telefon"  value="<?php echo $oglas[0]['telefon']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_mobitel'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field"> <input class="type-text" type="text" name="mobitel"  value="<?php echo $oglas[0]['mobitel']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_email'); ?>: <span class="required-item">*</span> </p>
                    <p class="form-field"> <input class="type-text" type="text" name="email"  value="<?php echo $oglas[0]['email']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_web_stranica'); ?>: </p>
                    <p class="form-field"> <input class="type-text" type="text" name="web_stranica"  value="<?php echo $oglas[0]['webStranica']; ?>"/> </p>
                    
                    <p class="form-label"> <?php echo lang('uredi_oglas_cijena_objekt'); ?>: </p>
                    <p class="form-field"> <input class="type-text" type="text" name="cijena_objekt"  value="<?php echo $oglas[0]['cijenaObjekt']; ?>"/> </p>

                    <p class="form-label"> <?php echo lang('uredi_oglas_jezici_koje_govori'); ?>: </p>
                    <div class="form-field form-checkbox single-column pocisti"> 
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="hr" <?php if (isset($jezici['hr'])) {
    echo 'checked';
} ?>/> <span> <?php echo lang('uredi_oglas_jezik_hr'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="en" <?php if (isset($jezici['en'])) {
    echo 'checked';
} ?>/> <span> <?php echo lang('uredi_oglas_jezik_en'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="de" <?php if (isset($jezici['de'])) {
    echo 'checked';
} ?>/> <span> <?php echo lang('uredi_oglas_jezik_de'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="it" <?php if (isset($jezici['it'])) {
    echo 'checked';
} ?>/> <span> <?php echo lang('uredi_oglas_jezik_it'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="fr" <?php if (isset($jezici['fr'])) {
    echo 'checked';
} ?>/> <span> <?php echo lang('uredi_oglas_jezik_fr'); ?> </span> </p>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_detalji_smjestaja'); ?>: </p>
                    <div class="form-field form-checkbox multi-column pocisti"> 
                        <?php $this->load->view("includes/detalji-objekta-checkbox-uredi"); ?>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_detalji_aktivnosti_okolica'); ?>: </p>
                    <div class="form-field form-checkbox multi-column pocisti"> 
                        <?php $this->load->view("includes/detalji-aktivnosti-checkbox-uredi"); ?>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_smjestaja_hr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_hr"><?php echo $oglas[0]['opsirnijiOpisSmjestajaHr']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_smjestaja_en'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_en"><?php echo $oglas[0]['opsirnijiOpisSmjestajaEn']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_smjestaja_de'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_de"><?php echo $oglas[0]['opsirnijiOpisSmjestajaDe']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_smjestaja_it'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_it"><?php echo $oglas[0]['opsirnijiOpisSmjestajaIt']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_smjestaja_fr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_fr"><?php echo $oglas[0]['opsirnijiOpisSmjestajaFr']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_izleta_hr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_hr"><?php echo $oglas[0]['opsirnijiOpisIzletaHr']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_izleta_en'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_en"><?php echo $oglas[0]['opsirnijiOpisIzletaEn']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_izleta_de'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_de"><?php echo $oglas[0]['opsirnijiOpisIzletaDe']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_izleta_it'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_it"><?php echo $oglas[0]['opsirnijiOpisIzletaIt']; ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('uredi_oglas_opsirniji_opis_izleta_fr'); ?>: </p>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_fr"><?php echo $oglas[0]['opsirnijiOpisIzletaFr']; ?></textarea>
                    </div>
                    <div class="dodatni-podaci pocisti">
                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_broj_soba'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php if (isset($ostale_informacije['broj_soba'])) {
    echo $ostale_informacije['broj_soba'];
} ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_broj_parkirnih_mjesta'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_parkirnih_mjesta"  value="<?php if (isset($ostale_informacije['broj_parkirnih_mjesta'])) {
    echo $ostale_informacije['broj_parkirnih_mjesta'];
} ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_kvadratura_objekta'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="kvadratura_objekta"  value="<?php if (isset($ostale_informacije['kvadratura_objekta'])) {
    echo $ostale_informacije['kvadratura_objekta'];
} ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_povrsina_autokampa'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="povrsina_autokampa"  value="<?php if (isset($ostale_informacije['povrsina_autokampa'])) {
    echo $ostale_informacije['povrsina_autokampa'];
} ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_broj_kamp_jedinica'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_kamp_jedinica"  value="<?php if (isset($ostale_informacije['broj_kamp_jedinica'])) {
    echo $ostale_informacije['broj_kamp_jedinica'];
} ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_velicina_plovila'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="velicina_plovila"  value="<?php if (isset($ostale_informacije['velicina_plovila'])) {
    echo $ostale_informacije['velicina_plovila'];
} ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_broj_wc_jedinica'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_wc_jedinica"  value="<?php if (isset($ostale_informacije['broj_wc_jedinica'])) {
                    echo $ostale_informacije['broj_wc_jedinica'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_broj_tuseva'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_tuseva"  value="<?php if (isset($ostale_informacije['broj_tuseva'])) {
                    echo $ostale_informacije['broj_tuseva'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_centar'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="centar"  value="<?php if (isset($ostale_informacije['centar'])) {
                    echo $ostale_informacije['centar'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_plaza'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="plaza"  value="<?php if (isset($ostale_informacije['plaza'])) {
                    echo $ostale_informacije['plaza'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_restoran'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="restoran"  value="<?php if (isset($ostale_informacije['restoran'])) {
                    echo $ostale_informacije['restoran'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_posta'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="posta"  value="<?php if (isset($ostale_informacije['posta'])) {
                    echo $ostale_informacije['posta'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_banka'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="banka"  value="<?php if (isset($ostale_informacije['banka'])) {
                    echo $ostale_informacije['banka'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_ljekarna'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="ljekarna"  value="<?php if (isset($ostale_informacije['ljekarna'])) {
                    echo $ostale_informacije['ljekarna'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_ambulanta'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="ambulanta"  value="<?php if (isset($ostale_informacije['ambulanta'])) {
                    echo $ostale_informacije['ambulanta'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_policija'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="policija"  value="<?php if (isset($ostale_informacije['policija'])) {
                    echo $ostale_informacije['policija'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_najblize_mjesto'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="najblize_mjesto"  value="<?php if (isset($ostale_informacije['najblize_mjesto'])) {
                    echo $ostale_informacije['najblize_mjesto'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_najblizi_grad'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="najblizi_grad"  value="<?php if (isset($ostale_informacije['najblizi_grad'])) {
                    echo $ostale_informacije['najblizi_grad'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_autobusna_stanica'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="autobusna_stanica"  value="<?php if (isset($ostale_informacije['autobusna_stanica'])) {
                    echo $ostale_informacije['autobusna_stanica'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_autobusni_kolodvor'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="autobusni_kolodvor"  value="<?php if (isset($ostale_informacije['autobusni_kolodvor'])) {
                    echo $ostale_informacije['autobusni_kolodvor'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_zracna_luka'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="zracna_luka"  value="<?php if (isset($ostale_informacije['zracna_luka'])) {
                    echo $ostale_informacije['zracna_luka'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_zeljeznicki_kolodvor'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="zeljeznicki_kolodvor"  value="<?php if (isset($ostale_informacije['zeljeznicki_kolodvor'])) {
                    echo $ostale_informacije['zeljeznicki_kolodvor'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_brodska_luka'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="brodska_luka"  value="<?php if (isset($ostale_informacije['brodska_luka'])) {
                    echo $ostale_informacije['brodska_luka'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_trgovina'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="trgovina"  value="<?php if (isset($ostale_informacije['trgovina'])) {
                    echo $ostale_informacije['trgovina'];
                } ?>"/> </p>
                        </div>

                        <div>	
                            <p class="form-label"> <?php echo lang('uredi_oglas_nogometno_igraliste'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="nogometno_igraliste"  value="<?php if (isset($ostale_informacije['nogometno_igraliste'])) {
                    echo $ostale_informacije['nogometno_igraliste'];
                } ?>"/> </p>
                        </div>

                        <div>							
                            <p class="form-label"> <?php echo lang('uredi_oglas_kosarkasko_igraliste'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="kosarkasko_igraliste"  value="<?php if (isset($ostale_informacije['kosarkasko_igraliste'])) {
                    echo $ostale_informacije['kosarkasko_igraliste'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_vaterpolo'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="vaterpolo"  value="<?php if (isset($ostale_informacije['vaterpolo'])) {
                    echo $ostale_informacije['vaterpolo'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_profesionalno_trcanje'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="profesionalno_trcanje"  value="<?php if (isset($ostale_informacije['profesionalno_trcanje'])) {
                    echo $ostale_informacije['profesionalno_trcanje'];
                } ?>"/> </p>
                        </div>

                        <div>							
                            <p class="form-label"> <?php echo lang('uredi_oglas_staza_za_trcanje'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="staza_za_trcanje"  value="<?php if (isset($ostale_informacije['staza_za_trcanje'])) {
                    echo $ostale_informacije['staza_za_trcanje'];
                } ?>"/> </p>
                        </div>	
                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_profesionalno_ronjenje'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="profesionalno_ronjenje"  value="<?php if (isset($ostale_informacije['profesionalno_ronjenje'])) {
                    echo $ostale_informacije['profesionalno_ronjenje'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_najam_camaca'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="najam_camaca"  value="<?php if (isset($ostale_informacije['najam_camaca'])) {
                    echo $ostale_informacije['najam_camaca'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_spustanje_camca_u_more'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="spustanje_camca_u_more"  value="<?php if (isset($ostale_informacije['spustanje_camca_u_more'])) {
                    echo $ostale_informacije['spustanje_camca_u_more'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_duljina_biciklisticke_staze'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="duljina_biciklisticke_staze"  value="<?php if (isset($ostale_informacije['duljina_biciklisticke_staze'])) {
                    echo $ostale_informacije['duljina_biciklisticke_staze'];
                } ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_jedrenje_na_dasci'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="jedrenje_na_dasci"  value="<?php if (isset($ostale_informacije['jedrenje_na_dasci'])) {
                    echo $ostale_informacije['jedrenje_na_dasci'];
                } ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('uredi_oglas_lunapark_za_djecu'); ?>: </p>
                            <p class="form-field"> <input class="type-text" type="text" name="lunapark_za_djecu"  value="<?php if (isset($ostale_informacije['lunapark_za_djecu'])) {
                    echo $ostale_informacije['lunapark_za_djecu'];
                } ?>"/> </p>
                        </div>
                    </div>

                    <div class="submit">
                        <input type="hidden" name="oglas_id" value="<?php echo $this->uri->segment(3); ?>" />
                        <input type="submit" name="dalje" value="<?php echo lang('uredi_oglas_spremi_promjene'); ?>" />
                        <a href="<?php echo base_url(); ?>"> <?php echo lang('uredi_oglas_odustani'); ?> </a>
                    </div>
                    </form>
                </div>

            </div>
            <div class="content-right">
                <!-- Login -->
<?php
$userdata = $this->session->userdata('prijavljen');
if (!$this->session->userdata('prijavljen')) {
    require_once(APPPATH . 'views/includes/modules/login.php');
} else if ($this->session->userdata('tip') == 1) { // -- administrator
    require_once(APPPATH . 'views/includes/modules/korisnicki-izbornik-1.php');
} else if ($this->session->userdata('tip') == 2) { // -- oglašivač
    require_once(APPPATH . 'views/includes/modules/korisnicki-izbornik-2.php');
} else if ($this->session->userdata('tip') == 3) { // -- korisnik
    require_once(APPPATH . 'views/includes/modules/korisnicki-izbornik-3.php');
}
?>
                <!-- Tečajna lista -->
<?php require_once(APPPATH . 'views/includes/modules/tecajna-lista.php'); ?>
                <!-- Social -->
<?php require_once(APPPATH . 'views/includes/modules/social.php'); ?>
            </div>
            <!-- Banner bottom -->
<?php require_once(APPPATH . 'views/includes/banner-bottom.php'); ?>
        </div>
    </div>
    <!-- Takeover right -->
<?php require_once(APPPATH . 'views/includes/takeover-right.php'); ?>
</div>