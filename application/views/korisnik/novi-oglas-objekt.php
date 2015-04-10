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
                    <?php echo form_open('korisnik/dodaj_slike'); ?>
                    <p class="content-title item-1"> <?php echo lang('novi_oglas_naziv_obrasca'); ?> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_zupanija'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('zupanija'); ?>
                    <p class="form-field">
                        <select id="zupanija" name="zupanija">
                            <?php foreach ($zupanija as $value): ?>
                                <option value="<?php echo $value['regijaID']; ?>" <?php echo set_select('zupanija', $value['regijaID']); ?>> <?php echo $value['naziv_regije']; ?></option>
                            <?php endforeach; ?>
                        </select> 
                    </p>
                    <p class="form-label"> <?php echo lang('novi_oglas_mjesto'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('mjesto'); ?>
                    <p class="form-field">
                    <div class="loading"> <!-- Ajax loading --> </div>
                    <select id="mjesto" name="mjesto">
                        <?php foreach ($mjesto as $value): ?>
                            <option value="<?php echo $value['mjestoID']; ?>" <?php echo set_select('mjesto', $value['mjestoID']); ?>> <?php echo $value['naziv_mjesta']; ?></option>
                        <?php endforeach; ?>
                    </select> 
                    </p>

                    <!--div id="map-wrapper">
                            <div id="map-canvas"></div>
                    </div>

                    <div id="map-options" class="pocisti">
                            <div id="firstRow" class="pocisti">
                                    <p class="buttonControls"> <input type="button" value="<?php //echo lang('novi_oglas_pocetna_pozicija'); ?>" onClick="initialize()"> </p>
                                    <p class="zoomInfo"> <?php //echo lang('novi_oglas_razina_povecanja');  ?>: <span id="zoomLevel"></span> </p>
                            </div>
                            <div id="geo-coords"> 
                    <?php //echo form_error('geo-lat'); ?>
                    <?php //echo form_error('geo-lng'); ?>
                                    <span> <?php //echo lang('novi_oglas_latitude');  ?> <span class="required-item">*</span> </span> <input type="text" name="geo-lat" id="lat" value="<?php //echo set_value('geo-lat'); ?>" /> 
                                    <span> <?php //echo lang('novi_oglas_longitude');  ?>  <span class="required-item">*</span> </span> <input type="text" name="geo-lng" id="lng" value="<?php //echo set_value('geo-lng'); ?>" />
                            </div>
                    <!--/div-->

                    <p class="form-label"> <?php echo lang('novi_oglas_naziv_objekta'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('naziv_objekta'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="naziv_objekta"  value="<?php echo set_value('naziv_objekta'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_tip_smjestaja'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('tip_smjestaja'); ?>
                    <div class="form-field form-radio pocisti"> 
                        <?php $this->load->view("includes/kategorije-radio"); ?>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_dodatne_usluge_hr'); ?>: </p>
                    <?php echo form_error('dodatne_usluge_hr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_hr"><?php echo set_value('dodatne_usluge_hr'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_dodatne_usluge_en'); ?>: </p>
                    <?php echo form_error('dodatne_usluge_en'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_en"><?php echo set_value('dodatne_usluge_en'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_dodatne_usluge_de'); ?>: </p>
                    <?php echo form_error('dodatne_usluge_de'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_de"><?php echo set_value('dodatne_usluge_de'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_dodatne_usluge_it'); ?>: </p>
                    <?php echo form_error('dodatne_usluge_it'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_it"><?php echo set_value('dodatne_usluge_it'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_dodatne_usluge_fr'); ?>: </p>
                    <?php echo form_error('dodatne_usluge_fr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="dodatne_usluge_fr"><?php echo set_value('dodatne_usluge_fr'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_broj_zvijezdica') ?> </p>
                    <?php echo form_error('broj_zvijezdica') ?>
                    <div class="form-field form-select pocisti">
                        <select name="broj_zvijezdica">
                            <option value="5" <?php echo set_select('broj_zvijezdica', '5'); ?>>5</option> 
                            <option value="4" <?php echo set_select('broj_zvijezdica', '4'); ?>>4</option>
                            <option value="3" <?php echo set_select('broj_zvijezdica', '3'); ?>>3</option>
                            <option value="2" <?php echo set_select('broj_zvijezdica', '2'); ?>>2</option>
                            <option value="1" <?php echo set_select('broj_zvijezdica', '1'); ?>>1</option>
                        </select>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_adresa'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('adresa'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="adresa"  value="<?php echo set_value('adresa'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_telefon'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('telefon'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="telefon"  value="<?php echo set_value('telefon'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_mobitel'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('mobitel'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="mobitel"  value="<?php echo set_value('mobitel'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_email'); ?>: <span class="required-item">*</span> </p>
                    <?php echo form_error('email'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="email"  value="<?php echo set_value('email'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_web_stranica'); ?>: </p>
                    <?php echo form_error('web_stranica'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="web_stranica"  value="<?php echo set_value('web_stranica'); ?>"/> </p>
                    
                    <p class="form-label"> <?php echo lang('novi_oglas_cijena_objekt'); ?>: </p>
                        <?php echo form_error('cijena_objekt'); ?>
                    <p class="form-field"> <input class="type-text" type="text" name="cijena_objekt"  value="<?php echo set_value('cijena_objekt'); ?>"/> </p>

                    <p class="form-label"> <?php echo lang('novi_oglas_jezici_koje_govori'); ?>: </p>
                    <?php echo form_error('jezici'); ?>
                    <div class="form-field form-checkbox single-column pocisti"> 
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="hr" <?php echo set_checkbox('jezici', 'hr'); ?>/> <span> <?php echo lang('novi_oglas_jezik_hr'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="en" <?php echo set_checkbox('jezici', 'en'); ?>/> <span> <?php echo lang('novi_oglas_jezik_en'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="de" <?php echo set_checkbox('jezici', 'de'); ?>/> <span> <?php echo lang('novi_oglas_jezik_de'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="it" <?php echo set_checkbox('jezici', 'it'); ?>/> <span> <?php echo lang('novi_oglas_jezik_it'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="jezici[]" value="fr" <?php echo set_checkbox('jezici', 'fr'); ?>/> <span> <?php echo lang('novi_oglas_jezik_fr'); ?> </span> </p>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_detalji_smjestaja'); ?>: </p>
                    <?php echo form_error('detalji_smjestajne_jedinice'); ?>
                    <div class="form-field form-checkbox multi-column pocisti"> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="dnevni_boravak" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'dnevni_boravak'); ?>/> <span> <?php echo lang('novi_oglas_dnevni_boravak'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="pogled" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'pogled'); ?>/> <span> <?php echo lang('novi_oglas_pogled'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="internet" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'internet'); ?>/> <span> <?php echo lang('novi_oglas_internet'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="hladovina" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'hladovina'); ?>/> <span> <?php echo lang('novi_oglas_hladovina'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="spavace_sobe" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'spavace_sobe'); ?>/> <span> <?php echo lang('novi_oglas_spavace_sobe'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="svaka_soba_balkon" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'svaka_soba_balkon'); ?>/> <span> <?php echo lang('novi_oglas_svaka_soba_balkon'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="svaka_soba_wc" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'svaka_soba_wc'); ?>/> <span> <?php echo lang('novi_oglas_svaka_soba_wc'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="svaka_soba_satelit" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'svaka_soba_satelit'); ?>/> <span> <?php echo lang('novi_oglas_svaka_soba_satelit'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="svaka_soba_pogled" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'svaka_soba_pogled'); ?>/> <span> <?php echo lang('novi_oglas_svaka_soba_pogled'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="terasa" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'terasa'); ?>/> <span> <?php echo lang('novi_oglas_terasa'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="klima" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'klima'); ?>/> <span> <?php echo lang('novi_oglas_klima'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="parking" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'parking'); ?>/> <span> <?php echo lang('novi_oglas_parking'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="travnjak" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'travnjak'); ?>/> <span> <?php echo lang('novi_oglas_travnjak'); ?> </span> </p>
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_smjestajne_jedinice[]" value="bazen" <?php echo set_checkbox('detalji_smjestajne_jedinice', 'bazen'); ?>/> <span> <?php echo lang('novi_oglas_bazen'); ?> </span> </p>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_detalji_aktivnosti_okolica'); ?>: </p>
                    <?php echo form_error('detalji_auto_kampa'); ?>
                    <div class="form-field form-checkbox multi-column pocisti"> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="blizina_mora" <?php echo set_checkbox('detalji_aktivnosti', 'blizina_mora'); ?>/> <span> <?php echo lang('novi_oglas_blizina_mora'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="blizina_plaze" <?php echo set_checkbox('detalji_aktivnosti', 'blizina_plaze'); ?>/> <span> <?php echo lang('novi_oglas_blizina_plaze'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="oblik_plaze" <?php echo set_checkbox('detalji_aktivnosti', 'oblik_plaze'); ?>/> <span> <?php echo lang('novi_oglas_oblik_plaze'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="centar_blizina" <?php echo set_checkbox('detalji_aktivnosti', 'centar_blizina'); ?>/> <span> <?php echo lang('novi_oglas_centar_blizina'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="trgovina_blizina" <?php echo set_checkbox('detalji_aktivnosti', 'trgovina_blizina'); ?>/> <span> <?php echo lang('novi_oglas_trgovina_blizina'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="fastfood_blizina" <?php echo set_checkbox('detalji_aktivnosti', 'fastfood_blizina'); ?>/> <span> <?php echo lang('novi_oglas_fastfood_blizina'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="caffebar_blizina" <?php echo set_checkbox('detalji_aktivnosti', 'caffebar_blizina'); ?>/> <span> <?php echo lang('novi_oglas_caffebar_blizina'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="setaliste_uz_more" <?php echo set_checkbox('detalji_aktivnosti', 'setaliste_uz_more'); ?>/> <span> <?php echo lang('novi_oglas_setaliste_uz_more'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="blizina_razvedena_obala" <?php echo set_checkbox('detalji_aktivnosti', 'blizina_razvedena_obala'); ?>/> <span> <?php echo lang('novi_oglas_blizina_razvedena_obala'); ?> </span> </p> 
                        <p> <input class="type-checkbox" type="checkbox" name="detalji_aktivnosti[]" value="otoci_blizina" <?php echo set_checkbox('detalji_aktivnosti', 'otoci_blizina'); ?>/> <span> <?php echo lang('novi_oglas_otoci_blizina'); ?> </span> </p> 
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_smjestaja_hr'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_smjestaja_hr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_hr"><?php echo set_value('opsirniji_opis_smjestaja_hr'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_smjestaja_en'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_smjestaja_en'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_en"><?php echo set_value('opsirniji_opis_smjestaja_en'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_smjestaja_de'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_smjestaja_de'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_de"><?php echo set_value('opsirniji_opis_smjestaja_de'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_smjestaja_it'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_smjestaja_it'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_it"><?php echo set_value('opsirniji_opis_smjestaja_it'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_smjestaja_fr'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_smjestaja_fr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_smjestaja_fr"><?php echo set_value('opsirniji_opis_smjestaja_fr'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_izleta_hr'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_izleta_hr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_hr"><?php echo set_value('opsirniji_opis_izleta_hr'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_izleta_en'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_izleta_en'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_en"><?php echo set_value('opsirniji_opis_izleta_en'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_izleta_de'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_izleta_de'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_de"><?php echo set_value('opsirniji_opis_izleta_de'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_izleta_it'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_izleta_it'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_it"><?php echo set_value('opsirniji_opis_izleta_it'); ?></textarea>
                    </div>

                    <p class="form-label"> <?php echo lang('novi_oglas_opsirniji_opis_izleta_fr'); ?>: </p>
                    <?php echo form_error('opsirniji_opis_izleta_fr'); ?>
                    <div class="form-field form-text pocisti">
                        <textarea name="opsirniji_opis_izleta_fr"><?php echo set_value('opsirniji_opis_izleta_fr'); ?></textarea>
                    </div>

                    <div class="dodatni-podaci pocisti">
                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_broj_soba'); ?>: </p>
                            <?php echo form_error('broj_soba'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_soba"  value="<?php echo set_value('broj_soba'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_broj_parkirnih_mjesta'); ?>: </p>
                            <?php echo form_error('broj_parkirnih_mjesta'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_parkirnih_mjesta"  value="<?php echo set_value('broj_parkirnih_mjesta'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_kvadratura_objekta'); ?>: </p>
                            <?php echo form_error('kvadratura_objekta'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="kvadratura_objekta"  value="<?php echo set_value('kvadratura_objekta'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_povrsina_autokampa'); ?>: </p>
                            <?php echo form_error('povrsina_autokampa'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="povrsina_autokampa"  value="<?php echo set_value('povrsina_autokampa'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_broj_kamp_jedinica'); ?>: </p>
                            <?php echo form_error('broj_kamp_jedinica'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_kamp_jedinica"  value="<?php echo set_value('broj_kamp_jedinica'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_velicina_plovila'); ?>: </p>
                            <?php echo form_error('velicina_plovila'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="velicina_plovila"  value="<?php echo set_value('velicina_plovila'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_broj_wc_jedinica'); ?>: </p>
                            <?php echo form_error('broj_wc_jedinica'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_wc_jedinica"  value="<?php echo set_value('broj_wc_jedinica'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_broj_tuseva'); ?>: </p>
                            <?php echo form_error('broj_tuseva'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="broj_tuseva"  value="<?php echo set_value('broj_tuseva'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_centar'); ?>: </p>
                            <?php echo form_error('centar'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="centar"  value="<?php echo set_value('centar'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_plaza'); ?>: </p>
                            <?php echo form_error('plaza'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="plaza"  value="<?php echo set_value('plaza'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_restoran'); ?>: </p>
                            <?php echo form_error('restoran'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="restoran"  value="<?php echo set_value('restoran'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_posta'); ?>: </p>
                            <?php echo form_error('posta'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="posta"  value="<?php echo set_value('posta'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_banka'); ?>: </p>
                            <?php echo form_error('banka'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="banka"  value="<?php echo set_value('banka'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_ljekarna'); ?>: </p>
                            <?php echo form_error('ljekarna'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="ljekarna"  value="<?php echo set_value('ljekarna'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_ambulanta'); ?>: </p>
                            <?php echo form_error('ambulanta'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="ambulanta"  value="<?php echo set_value('ambulanta'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_policija'); ?>: </p>
                            <?php echo form_error('policija'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="policija"  value="<?php echo set_value('policija'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_najblize_mjesto'); ?>: </p>
                            <?php echo form_error('najblize_mjesto'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="najblize_mjesto"  value="<?php echo set_value('najblize_mjesto'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_najblizi_grad'); ?>: </p>
                            <?php echo form_error('najblizi_grad'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="najblizi_grad"  value="<?php echo set_value('najblizi_grad'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_autobusna_stanica'); ?>: </p>
                            <?php echo form_error('autobusna_stanica'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="autobusna_stanica"  value="<?php echo set_value('autobusna_stanica'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_autobusni_kolodvor'); ?>: </p>
                            <?php echo form_error('autobusni_kolodvor'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="autobusni_kolodvor"  value="<?php echo set_value('autobusni_kolodvor'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_zracna_luka'); ?>: </p>
                            <?php echo form_error('zracna_luka'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="zracna_luka"  value="<?php echo set_value('zracna_luka'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_zeljeznicki_kolodvor'); ?>: </p>
                            <?php echo form_error('zeljeznicki_kolodvor'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="zeljeznicki_kolodvor"  value="<?php echo set_value('zeljeznicki_kolodvor'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_brodska_luka'); ?>: </p>
                            <?php echo form_error('brodska_luka'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="brodska_luka"  value="<?php echo set_value('brodska_luka'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_trgovina'); ?>: </p>
                            <?php echo form_error('trgovina'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="trgovina"  value="<?php echo set_value('trgovina'); ?>"/> </p>
                        </div>

                        <div>	
                            <p class="form-label"> <?php echo lang('novi_oglas_nogometno_igraliste'); ?>: </p>
                            <?php echo form_error('nogometno_igraliste'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="nogometno_igraliste"  value="<?php echo set_value('nogometno_igraliste'); ?>"/> </p>
                        </div>

                        <div>							
                            <p class="form-label"> <?php echo lang('novi_oglas_kosarkasko_igraliste'); ?>: </p>
                            <?php echo form_error('kosarkasko_igraliste'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="kosarkasko_igraliste"  value="<?php echo set_value('kosarkasko_igraliste'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_vaterpolo'); ?>: </p>
                            <?php echo form_error('vaterpolo'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="vaterpolo"  value="<?php echo set_value('vaterpolo'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_profesionalno_trcanje'); ?>: </p>
                            <?php echo form_error('profesionalno_trcanje'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="profesionalno_trcanje"  value="<?php echo set_value('profesionalno_trcanje'); ?>"/> </p>
                        </div>

                        <div>							
                            <p class="form-label"> <?php echo lang('novi_oglas_staza_za_trcanje'); ?>: </p>
                            <?php echo form_error('staza_za_trcanje'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="staza_za_trcanje"  value="<?php echo set_value('staza_za_trcanje'); ?>"/> </p>
                        </div>	
                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_profesionalno_ronjenje'); ?>: </p>
                            <?php echo form_error('profesionalno_ronjenje'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="profesionalno_ronjenje"  value="<?php echo set_value('profesionalno_ronjenje'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_najam_camaca'); ?>: </p>
                            <?php echo form_error('najam_camaca'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="najam_camaca"  value="<?php echo set_value('najam_camaca'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_spustanje_camca_u_more'); ?>: </p>
                            <?php echo form_error('spustanje_camca_u_more'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="spustanje_camca_u_more"  value="<?php echo set_value('spustanje_camca_u_more'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_duljina_biciklisticke_staze'); ?>: </p>
                            <?php echo form_error('duljina_biciklisticke_staze'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="duljina_biciklisticke_staze"  value="<?php echo set_value('duljina_biciklisticke_staze'); ?>"/> </p>
                        </div>

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_jedrenje_na_dasci'); ?>: </p>
                            <?php echo form_error('jedrenje_na_dasci'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="jedrenje_na_dasci"  value="<?php echo set_value('jedrenje_na_dasci'); ?>"/> </p>
                        </div>	

                        <div>
                            <p class="form-label"> <?php echo lang('novi_oglas_lunapark_za_djecu'); ?>: </p>
                            <?php echo form_error('lunapark_za_djecu'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="lunapark_za_djecu"  value="<?php echo set_value('lunapark_za_djecu'); ?>"/> </p>
                        </div>
                    </div>

                    <div class="submit">
                        <input type="submit" name="dalje" value="<?php echo lang('novi_oglas_sljedeci_korak'); ?>" />
                        <!--a href="<?php echo base_url(); ?>"> <?php echo lang('novi_oglas_odustani'); ?> </a-->
                         <input type="submit" name="novi_oglas_odustani" value="<?php echo lang('novi_oglas_odustani'); ?>" />
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