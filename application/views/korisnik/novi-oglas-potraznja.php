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
                        <div id="novi-oglas" class="novi-oglas-potraznja">
                            <?php echo form_open('korisnik/potraznja_spremi_oglas'); ?>
                            <p class="content-title item-1"> <?php echo lang('potraznja_naziv_obrasca'); ?> </p>

                            <p class="form-label"> <?php echo lang('potraznja_zupanija'); ?>: <span class="required-item">*</span> </p>
                            <?php echo form_error('zupanija'); ?>
                            <p class="form-field">
                                <select id="zupanija" name="zupanija">
                                    <?php foreach ($zupanija as $z_value): ?>
                                        <option value="<?php echo $z_value['regijaID']; ?>"> <?php echo $z_value['naziv_regije']; ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </p>
                            <p class="form-label"> <?php echo lang('potraznja_mjesto'); ?>: <span class="required-item">*</span> </p>
                            <?php echo form_error('mjesto'); ?>
                            <div class="loading"> <!-- Ajax loading --> </div>
                            <p class="form-field">
                                <select id="mjesto" name="mjesto">
                                    <?php foreach ($mjesto as $m_value): ?>
                                        <option value="<?php echo $m_value['mjestoID']; ?>"> <?php echo $m_value['naziv_mjesta']; ?></option>
                                    <?php endforeach; ?>
                                </select> 
                            </p>

                            <p class="form-label"> <?php echo lang('potraznja_naslov') . ' (' . lang('potraznja_naslov_primjer') . ')'; ?>: <span class="required-item">*</span> </p>
                            <?php echo form_error('naslov'); ?>
                            <p class="form-field"> <input class="type-text" type="text" name="naslov"  value="<?php echo set_value('naslov'); ?>"/> </p>

                            <p class="form-label"> <?php echo lang('potraznja_tip_smjestaja'); ?>: <span class="required-item">*</span> </p>
                            <?php echo form_error('tip_smjestaja'); ?>
                            <div class="form-field form-checkbox pocisti"> 
                                <?php $this->load->view("includes/kategorije-checkbox"); ?>
                            </div>

                            <div class="kontakt-podaci multi-column pocisti">
                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_adresa'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('adresa'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="adresa"  value="<?php echo set_value('adresa'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_telefon'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('telefon'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="telefon"  value="<?php echo set_value('telefon'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_mobitel'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('mobitel'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="mobitel"  value="<?php echo set_value('mobitel'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_email'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('email'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="email"  value="<?php echo set_value('email'); ?>"/> </p>
                                </div>	
                            </div>

                            <div class="datumi multi-column pocisti">
                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_datum_postavljanja_oglasa'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('datum_postavljanja_oglasa'); ?>
                                    <p class="form-field"> <input id="from" class="type-text" type="text" name="datum_postavljanja_oglasa"  value="<?php echo set_value('datum_postavljanja_oglasa'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_datum_datum_prekida_oglasa'); ?>: <span class="required-item">*</span> </p>
                                    <?php echo form_error('datum_prekida_oglasa'); ?>
                                    <p class="form-field"> <input id="to" class="type-text" type="text" name="datum_prekida_oglasa"  value="<?php echo set_value('datum_prekida_oglasa'); ?>"/> </p>
                                </div>

                            </div>

                            <div class="form-field form-radio multi-column pocisti">
                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_objekt_broj_soba'); ?>: </p>
                                    <?php echo form_error('objekt_broj_soba'); ?>
                                    <p> 
                                        <input class="type-radio" type="radio" name="objekt_broj_soba" value="jedna_soba" <?php echo set_radio('objekt_broj_soba', 'jedna_soba'); ?>/> <span> <?php echo lang('potraznja_jedna_soba'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="objekt_broj_soba" value="dvije_sobe" <?php echo set_radio('objekt_broj_soba', 'dvije_sobe'); ?>/> <span> <?php echo lang('potraznja_dvije_sobe'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="objekt_broj_soba" value="tri_sobe" <?php echo set_radio('objekt_broj_soba', 'tri_sobe'); ?>/> <span> <?php echo lang('potraznja_tri_sobe'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="objekt_broj_soba" value="vise_soba" <?php echo set_radio('objekt_broj_soba', 'vise_soba'); ?>/> <span> <?php echo lang('potraznja_vise_soba'); ?> </span> 
                                    </p>
                                </div>
                            </div>

                            <p class="hr cb">&nbsp;</p>

                            <div class="form-radio multi-column cijena pocisti">
                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_cijena'); ?>:  </p>
                                    <?php echo form_error('min_cijena'); ?>
                                    <p class="form-field"><span><?php echo lang('potraznja_cijena_od'); ?></span> <input class="type-text" type="text" name="min_cijena"  value="<?php echo set_value('min_cijena'); ?>"/> </p>
                                </div>
                                <div>
                                    <p class="form-label">&nbsp;</p>
                                    <?php echo form_error('max_cijena'); ?>
                                    <p class="form-field" style="margin-left:10px;"><span><?php echo lang('potraznja_cijena_do'); ?></span> <input class="type-text" type="text" name="max_cijena"  value="<?php echo set_value('max_cijena'); ?>"/> </p>
                                </div>

                                <!--div> 
                                    <p>
                                        <input class="type-radio" type="radio" name="cijena_tip" value="po_osobi" <?php echo set_radio('cijena_tip', 'po_osobi'); ?>/> <span> <?php echo lang('potraznja_cijena_po_osobi'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="cijena_tip" value="maksimalna" <?php echo set_radio('cijena_tip', 'maksimalna'); ?>/> <span> <?php echo lang('potraznja_cijena_maksimalna'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="cijena_tip" value="fleksibilna" checked <?php echo set_radio('cijena_tip', 'fleksibilna'); ?>/> <span> <?php echo lang('potraznja_cijena_fleksibilna'); ?> </span> 
                                    </p>
                                    <p> 
                                        <input class="type-radio" type="radio" name="cijena_tip" value="po_danu" <?php echo set_radio('cijena_tip', 'po_danu'); ?>/> <span> <?php echo lang('potraznja_cijena_po_danu'); ?> </span> 
                                    </p>
                                </div-->
                            </div>

                            <p class="hr cb">&nbsp;</p>

                            <p class="form-label"> <?php echo lang('potraznja_objekt_moze_biti'); ?>: </p>
                            <?php echo form_error('tip_objekta'); ?>
                            <div class="form-field form-checkbox pocisti"> 
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="u_gradu" <?php echo set_checkbox('tip_objekta', 'u_gradu'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_u_gradu'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_selu" <?php echo set_checkbox('tip_objekta', 'na_selu'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_selu'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_osami" <?php echo set_checkbox('tip_objekta', 'na_osami'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_osami'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_otoku" <?php echo set_checkbox('tip_objekta', 'na_otoku'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_otoku'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="uz_more" <?php echo set_checkbox('tip_objekta', 'uz_more'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_uz_more'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="uz_rijeku" <?php echo set_checkbox('tip_objekta', 'uz_rijeku'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_uz_rijeku'); ?> </span> </p>  
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="u_sumi" <?php echo set_checkbox('tip_objekta', 'u_sumi'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_u_sumi'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_livadi" <?php echo set_checkbox('tip_objekta', 'na_livadi'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_livadi'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_planini" <?php echo set_checkbox('tip_objekta', 'na_planini'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_planini'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="svjetionik" <?php echo set_checkbox('tip_objekta', 'svjetionik'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_svjetionik'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="u_pecini" <?php echo set_checkbox('tip_objekta', 'u_pecini'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_u_pecini'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="u_sojenici" <?php echo set_checkbox('tip_objekta', 'u_sojenici'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_u_sojenici'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_stablu" <?php echo set_checkbox('tip_objekta', 'na_stablu'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_stablu'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="ukopan_u_zemlji" <?php echo set_checkbox('tip_objekta', 'ukopan_u_zemlji'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_ukopan_u_zemlji'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="ukopan_u_brdu" <?php echo set_checkbox('tip_objekta', 'ukopan_u_brdu'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_ukopan_u_brdu'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="podrum" <?php echo set_checkbox('tip_objekta', 'podrum'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_podrum'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="prizemlje" <?php echo set_checkbox('tip_objekta', 'prizemlje'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_prizemlje'); ?> </span> </p>
                                <p> <input class="type-checkbox" type="checkbox" name="tip_objekta[]" value="na_katu" <?php echo set_checkbox('tip_objekta', 'na_katu'); ?>/> <span> <?php echo lang('potraznja_lokacija_objekt_na_katu'); ?> </span> </p>
                            </div>

                            <p class="form-label"> <?php echo lang('potraznja_objekt_mora_zadovoljiti_uvjete'); ?>: </p>
                            <?php echo form_error('objekt_uvjeti'); ?>
                            <div class="form-field form-checkbox pocisti"> 
                                <p> <input class="type-checkbox" type="checkbox" name="objekt_uvjeti[]" value="mali" <?php echo set_checkbox('objekt_uvjeti', 'mali'); ?>/> <span> <?php echo lang('potraznja_uvjet_mali'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="objekt_uvjeti[]" value="srednji" <?php echo set_checkbox('objekt_uvjeti', 'srednji'); ?>/> <span> <?php echo lang('potraznja_uvjet_srednji'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="objekt_uvjeti[]" value="veliki" <?php echo set_checkbox('objekt_uvjeti', 'veliki'); ?>/> <span> <?php echo lang('potraznja_uvjet_veliki'); ?> </span> </p> 
                                <p> <input class="type-checkbox" type="checkbox" name="objekt_uvjeti[]" value="drveni" <?php echo set_checkbox('objekt_uvjeti', 'drveni'); ?>/> <span> <?php echo lang('potraznja_uvjet_drveni'); ?> </span> </p>
                            </div>

                            <p class="hr cb">&nbsp;</p>

                            <div class="form-field form-radio multi-column pocisti">
                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_dnevni_boravak'); ?>: </p>
                                    <?php echo form_error('dnevni_boravak'); ?>
                                    <p> <input class="type-radio" type="radio" name="dnevni_boravak" value="mali" <?php echo set_radio('dnevni_boravak', 'mali'); ?>/> <span> <?php echo lang('potraznja_mali'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="dnevni_boravak" value="veliki" <?php echo set_radio('dnevni_boravak', 'veliki'); ?>/> <span> <?php echo lang('potraznja_veliki'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="dnevni_boravak" value="nije_obavezno" <?php echo set_radio('dnevni_boravak', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_kuhinja'); ?>: </p>
                                    <?php echo form_error('kuhinja'); ?>
                                    <p> <input class="type-radio" type="radio" name="kuhinja" value="mala" <?php echo set_radio('kuhinja', 'mala'); ?>/> <span> <?php echo lang('potraznja_mala'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kuhinja" value="velika" <?php echo set_radio('kuhinja', 'velika'); ?>/> <span> <?php echo lang('potraznja_velika'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kuhinja" value="nije_obavezno" <?php echo set_radio('kuhinja', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_tv'); ?>: </p>
                                    <?php echo form_error('tv'); ?>
                                    <p> <input class="type-radio" type="radio" name="tv" value="mali" <?php echo set_radio('tv', 'mali'); ?>/> <span> <?php echo lang('potraznja_mali'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="tv" value="veliki" <?php echo set_radio('tv', 'veliki'); ?>/> <span> <?php echo lang('potraznja_veliki'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="tv" value="nije_obavezno" <?php echo set_radio('tv', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_satelit'); ?>: </p>
                                    <?php echo form_error('satelit'); ?>
                                    <p> <input class="type-radio" type="radio" name="satelit" value="strani" <?php echo set_radio('satelit', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_strani'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="satelit" value="domaci" <?php echo set_radio('satelit', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_domaci'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="satelit" value="nije_obavezno" <?php echo set_radio('satelit', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_tus_kada'); ?>: </p>
                                    <?php echo form_error('internet'); ?>
                                    <p> <input class="type-radio" type="radio" name="tus_kada" value="obavezno" <?php echo set_radio('tus_kada', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="tus_kada" value="nije_obavezno" <?php echo set_radio('tus_kada', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_kada'); ?>: </p>
                                    <?php echo form_error('internet'); ?>
                                    <p> <input class="type-radio" type="radio" name="kada" value="obavezno" <?php echo set_radio('kada', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kada" value="nije_obavezno" <?php echo set_radio('kada', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_pogled'); ?>: </p>
                                    <?php echo form_error('pogled'); ?>
                                    <p> <input class="type-radio" type="radio" name="pogled" value="obavezno" <?php echo set_radio('pogled', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="pogled" value="nije_obavezno" <?php echo set_radio('pogled', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_internet'); ?>: </p>
                                    <?php echo form_error('internet'); ?>
                                    <p> <input class="type-radio" type="radio" name="internet" value="obavezno" <?php echo set_radio('internet', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="internet" value="nije_obavezno" <?php echo set_radio('internet', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_hladovina'); ?>: </p>
                                    <?php echo form_error('hladovina'); ?>
                                    <p> <input class="type-radio" type="radio" name="hladovina" value="malo" <?php echo set_radio('hladovina', 'malo'); ?>/> <span> <?php echo lang('potraznja_malo'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="hladovina" value="puno" <?php echo set_radio('hladovina', 'puno'); ?>/> <span> <?php echo lang('potraznja_puno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="hladovina" value="nije_obavezno" <?php echo set_radio('hladovina', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_sunca_unaokolo'); ?>: </p>
                                    <?php echo form_error('sunca_unaokolo'); ?>
                                    <p> <input class="type-radio" type="radio" name="sunca_unaokolo" value="malo" <?php echo set_radio('sunca_unaokolo', 'malo'); ?>/> <span> <?php echo lang('potraznja_malo'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="sunca_unaokolo" value="puno" <?php echo set_radio('sunca_unaokolo', 'puno'); ?>/> <span> <?php echo lang('potraznja_puno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="sunca_unaokolo" value="nije_obavezno" <?php echo set_radio('sunca_unaokolo', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_spavace_sobe'); ?>: </p>
                                    <?php echo form_error('spavace_sobe'); ?>
                                    <p> <input class="type-radio" type="radio" name="spavace_sobe" value="jedna_soba" <?php echo set_radio('spavace_sobe', 'jedna_soba'); ?>/> <span> <?php echo lang('potraznja_jedna_soba'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="spavace_sobe" value="dvije_sobe" <?php echo set_radio('spavace_sobe', 'dvije_sobe'); ?>/> <span> <?php echo lang('potraznja_dvije_sobe'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="spavace_sobe" value="vise_soba" <?php echo set_radio('spavace_sobe', 'vise_soba'); ?>/> <span> <?php echo lang('potraznja_vise_soba'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_kreveti'); ?>: </p>
                                    <?php echo form_error('kreveti'); ?>
                                    <p> <input class="type-radio" type="radio" name="kreveti" value="jednokrevetni" <?php echo set_radio('kreveti', 'jednokrevetni'); ?>/> <span> <?php echo lang('potraznja_jednokrevetni'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kreveti" value="dvokrevetni" <?php echo set_radio('kreveti', 'dvokrevetni'); ?>/> <span> <?php echo lang('potraznja_dvokrevetni'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kreveti" value="kombinirano" <?php echo set_radio('kreveti', 'kombinirano'); ?>/> <span> <?php echo lang('potraznja_kombinirano'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_svaka_soba_balkon'); ?>: </p>
                                    <?php echo form_error('soba_balkon'); ?>
                                    <p> <input class="type-radio" type="radio" name="soba_balkon" value="obavezno" <?php echo set_radio('soba_balkon', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="soba_balkon" value="nije_obavezno" <?php echo set_radio('soba_balkon', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_svaka_soba_wc'); ?>: </p>
                                    <?php echo form_error('soba_wc'); ?>
                                    <p> <input class="type-radio" type="radio" name="soba_wc" value="obavezno" <?php echo set_radio('soba_wc', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="soba_wc" value="nije_obavezno" <?php echo set_radio('soba_wc', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_svaka_soba_tv'); ?>: </p>
                                    <?php echo form_error('soba_tv'); ?>
                                    <p> <input class="type-radio" type="radio" name="soba_tv" value="obavezno" <?php echo set_radio('soba_tv', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="soba_tv" value="nije_obavezno" <?php echo set_radio('soba_tv', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_svaka_soba_satelit'); ?>: </p>
                                    <?php echo form_error('soba_satelit'); ?>
                                    <p> <input class="type-radio" type="radio" name="soba_satelit" value="obavezno" <?php echo set_radio('soba_satelit', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="soba_satelit" value="nije_obavezno" <?php echo set_radio('soba_satelit', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_svaka_soba_pogled'); ?>: </p>
                                    <?php echo form_error('soba_pogled'); ?>
                                    <p> <input class="type-radio" type="radio" name="soba_pogled" value="obavezno" <?php echo set_radio('soba_pogled', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="soba_pogled" value="nije_obavezno" <?php echo set_radio('soba_pogled', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_terasa'); ?>: </p>
                                    <?php echo form_error('terasa'); ?>
                                    <p> <input class="type-radio" type="radio" name="terasa" value="obavezno" <?php echo set_radio('terasa', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="terasa" value="nije_obavezno" <?php echo set_radio('terasa', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>


                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_klima'); ?>: </p>
                                    <?php echo form_error('klima'); ?>
                                    <p> <input class="type-radio" type="radio" name="klima" value="obavezno" <?php echo set_radio('klima', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="klima" value="nije_obavezno" <?php echo set_radio('klima', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_ventilator'); ?>: </p>
                                    <?php echo form_error('ventilator'); ?>
                                    <p> <input class="type-radio" type="radio" name="ventilator" value="obavezno" <?php echo set_radio('ventilator', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="ventilator" value="nije_obavezno" <?php echo set_radio('ventilator', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_parking'); ?>: </p>
                                    <?php echo form_error('parking'); ?>
                                    <p> <input class="type-radio" type="radio" name="parking" value="obavezno" <?php echo set_radio('parking', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="parking" value="nije_obavezno" <?php echo set_radio('parking', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_travnjak'); ?>: </p>
                                    <?php echo form_error('travnjak'); ?>
                                    <p> <input class="type-radio" type="radio" name="travnjak" value="obavezno" <?php echo set_radio('travnjak', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="travnjak" value="nije_obavezno" <?php echo set_radio('travnjak', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_bazen'); ?>: </p>
                                    <?php echo form_error('bazen'); ?>
                                    <p> <input class="type-radio" type="radio" name="bazen" value="obavezno" <?php echo set_radio('bazen', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="bazen" value="nije_obavezno" <?php echo set_radio('bazen', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <p class="hr cb">&nbsp;</p>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_udaljenost_do_mora'); ?>: </p>
                                    <?php echo form_error('udaljenost_more'); ?>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_mora" value="50_100" <?php echo set_radio('udaljenost_do_mora', '50_100'); ?>/> <span> <?php echo lang('potraznja_udaljenost_50_100'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_mora" value="200_400" <?php echo set_radio('udaljenost_do_mora', '200_400'); ?>/> <span> <?php echo lang('potraznja_udaljenost_200_400'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_mora" value="500" <?php echo set_radio('udaljenost_do_mora', '500'); ?>/> <span> <?php echo lang('potraznja_udaljenost_500'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_udaljenost_do_plaze'); ?>: </p>
                                    <?php echo form_error('udaljenost_plaza'); ?>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_plaze" value="50_100" <?php echo set_radio('udaljenost_do_plaze', '50_100'); ?>/> <span> <?php echo lang('potraznja_udaljenost_50_100'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_plaze" value="200_400" <?php echo set_radio('udaljenost_do_plaze', '200_400'); ?>/> <span> <?php echo lang('potraznja_udaljenost_200_400'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="udaljenost_do_plaze" value="500" <?php echo set_radio('udaljenost_do_plaze', '500'); ?>/> <span> <?php echo lang('potraznja_udaljenost_500'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_oblik_plaze'); ?>: </p>
                                    <?php echo form_error('oblik_plaze'); ?>
                                    <p> <input class="type-radio" type="radio" name="oblik_plaze" value="pjescana" <?php echo set_radio('oblik_plaze', 'pjescana'); ?>/> <span> <?php echo lang('potraznja_pjescana'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="oblik_plaze" value="kamenita" <?php echo set_radio('oblik_plaze', 'kamenita'); ?>/> <span> <?php echo lang('potraznja_kamenita'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="oblik_plaze" value="mjesovita" <?php echo set_radio('oblik_plaze', 'mjesovita'); ?>/> <span> <?php echo lang('potraznja_mjesovita'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_plaza_s_hladom'); ?>: </p>
                                    <?php echo form_error('plaza_hlada'); ?>
                                    <p> <input class="type-radio" type="radio" name="plaza_hlad" value="malo" <?php echo set_radio('plaza_hlad', 'malo'); ?>/> <span> <?php echo lang('potraznja_malo'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="plaza_hlad" value="puno" <?php echo set_radio('plaza_hlad', 'puno'); ?>/> <span> <?php echo lang('potraznja_puno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="plaza_hlad" value="nije_obavezno" <?php echo set_radio('plaza_hlad', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <p class="hr cb">&nbsp;</p>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_centar_u_blizini'); ?>: </p>
                                    <?php echo form_error('restoran'); ?>
                                    <p> <input class="type-radio" type="radio" name="centar" value="obavezno" <?php echo set_radio('centar', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="centar" value="nije_obavezno" <?php echo set_radio('centar', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_restoran_u_blizini'); ?>: </p>
                                    <?php echo form_error('restoran'); ?>
                                    <p> <input class="type-radio" type="radio" name="restoran" value="obavezno" <?php echo set_radio('restoran', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="restoran" value="nije_obavezno" <?php echo set_radio('restoran', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_trgovina_u_blizini'); ?>: </p>
                                    <?php echo form_error('trgovina'); ?>
                                    <p> <input class="type-radio" type="radio" name="trgovina" value="obavezno" <?php echo set_radio('trgovina', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="trgovina" value="nije_obavezno" <?php echo set_radio('trgovina', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_fast_food_u_blizini'); ?>: </p>
                                    <?php echo form_error('fast_food'); ?>
                                    <p> <input class="type-radio" type="radio" name="fast_food" value="obavezno" <?php echo set_radio('fast_food', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="fast_food" value="nije_obavezno" <?php echo set_radio('fast_food', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_caffe_bar_u_blizini'); ?>: </p>
                                    <?php echo form_error('caffe_bar'); ?>
                                    <p> <input class="type-radio" type="radio" name="caffe_bar" value="obavezno" <?php echo set_radio('caffe_bar', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="caffe_bar" value="nije_obavezno" <?php echo set_radio('caffe_bar', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_setaliste_uz_more'); ?>: </p>
                                    <?php echo form_error('setaliste'); ?>
                                    <p> <input class="type-radio" type="radio" name="setaliste" value="obavezno" <?php echo set_radio('setaliste', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="setaliste" value="nije_obavezno" <?php echo set_radio('setaliste', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_razvedena_obala'); ?>: </p>
                                    <?php echo form_error('razvedena_obala'); ?>
                                    <p> <input class="type-radio" type="radio" name="razvedena_obala" value="obavezno" <?php echo set_radio('razvedena_obala', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="razvedena_obala" value="nije_obavezno" <?php echo set_radio('razvedena_obala', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_otoci_u_blizini'); ?>: </p>
                                    <?php echo form_error('otoci'); ?>
                                    <p> <input class="type-radio" type="radio" name="otoci" value="obavezno" <?php echo set_radio('otoci', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="otoci" value="nije_obavezno" <?php echo set_radio('otoci', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_vez_za_camac'); ?>: </p>
                                    <?php echo form_error('vez_za_camac'); ?>
                                    <p> <input class="type-radio" type="radio" name="vez_za_camac" value="obavezno" <?php echo set_radio('vez_za_camac', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="vez_za_camac" value="nije_obavezno" <?php echo set_radio('vez_za_camac', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>

                                <div> 
                                    <p class="form-label"> <?php echo lang('potraznja_kucni_ljubimci'); ?>: </p>
                                    <?php echo form_error('kucni_ljubimci'); ?>
                                    <p> <input class="type-radio" type="radio" name="kucni_ljubimci" value="obavezno" <?php echo set_radio('kucni_ljubimci', 'obavezno'); ?>/> <span> <?php echo lang('potraznja_obavezno'); ?> </span> </p>
                                    <p> <input class="type-radio" type="radio" name="kucni_ljubimci" value="nije_obavezno" <?php echo set_radio('kucni_ljubimci', 'nije_obavezno'); ?>/> <span> <?php echo lang('potraznja_nije_obavezno'); ?> </span> </p>
                                </div>
                            </div>

                            <p class="hr cb">&nbsp;</p>

                            <div class="dodatni-podaci pocisti">

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_centar'); ?>: </p>
                                    <?php echo form_error('udaljenost_centar'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_centar"  value="<?php echo set_value('udaljenost_centar'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_plaza'); ?>: </p>
                                    <?php echo form_error('udaljenost_plaza'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_plaza"  value="<?php echo set_value('udaljenost_plaza'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_restoran'); ?>: </p>
                                    <?php echo form_error('udaljenost_restoran'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_restoran"  value="<?php echo set_value('udaljenost_restoran'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_posta'); ?>: </p>
                                    <?php echo form_error('udaljenost_posta'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_posta"  value="<?php echo set_value('udaljenost_posta'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_banka'); ?>: </p>
                                    <?php echo form_error('udaljenost_banka'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_banka"  value="<?php echo set_value('udaljenost_banka'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_ljekarna'); ?>: </p>
                                    <?php echo form_error('udaljenost_ljekarna'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_ljekarna"  value="<?php echo set_value('udaljenost_ljekarna'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_ambulanta'); ?>: </p>
                                    <?php echo form_error('udaljenost_ambulanta'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_ambulanta"  value="<?php echo set_value('udaljenost_ambulanta'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_policija'); ?>: </p>
                                    <?php echo form_error('udaljenost_policija'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_policija"  value="<?php echo set_value('udaljenost_policija'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_najblize_mjesto'); ?>: </p>
                                    <?php echo form_error('udaljenost_najblize_mjesto'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_najblize_mjesto"  value="<?php echo set_value('udaljenost_najblize_mjesto'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_najblizi_grad'); ?>: </p>
                                    <?php echo form_error('udaljenost_najblizi_grad'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_najblizi_grad"  value="<?php echo set_value('udaljenost_najblizi_grad'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_autobusna_stanica'); ?>: </p>
                                    <?php echo form_error('udaljenost_autobusna_stanica'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_autobusna_stanica"  value="<?php echo set_value('udaljenost_autobusna_stanica'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_autobusni_kolodvor'); ?>: </p>
                                    <?php echo form_error('udaljenost_autobusni_kolodvor'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_autobusni_kolodvor"  value="<?php echo set_value('udaljenost_autobusni_kolodvor'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_zracna_luka'); ?>: </p>
                                    <?php echo form_error('udaljenost_zracna_luka'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_zracna_luka"  value="<?php echo set_value('udaljenost_zracna_luka'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_zeljeznicki_kolodvor'); ?>: </p>
                                    <?php echo form_error('udaljenost_zeljeznicki_kolodvor'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_zeljeznicki_kolodvor"  value="<?php echo set_value('udaljenost_zeljeznicki_kolodvor'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_brodska_luka'); ?>: </p>
                                    <?php echo form_error('udaljenost_brodska_luka'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_brodska_luka"  value="<?php echo set_value('udaljenost_brodska_luka'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_trgovina'); ?>: </p>
                                    <?php echo form_error('udaljenost_trgovina'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_trgovina"  value="<?php echo set_value('udaljenost_trgovina'); ?>"/> </p>
                                </div>

                                <div>	
                                    <p class="form-label"> <?php echo lang('potraznja_nogometno_igraliste'); ?>: </p>
                                    <?php echo form_error('udaljenost_nogometno_igraliste'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_nogometno_igraliste"  value="<?php echo set_value('udaljenost_nogometno_igraliste'); ?>"/> </p>
                                </div>

                                <div>							
                                    <p class="form-label"> <?php echo lang('potraznja_kosarkasko_igraliste'); ?>: </p>
                                    <?php echo form_error('udaljenost_kosarkasko_igraliste'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_kosarkasko_igraliste"  value="<?php echo set_value('udaljenost_kosarkasko_igraliste'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_vaterpolo'); ?>: </p>
                                    <?php echo form_error('udaljenost_vaterpolo'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_vaterpolo"  value="<?php echo set_value('udaljenost_vaterpolo'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_profesionalno_trcanje'); ?>: </p>
                                    <?php echo form_error('udaljenost_profesionalno_trcanje'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_profesionalno_trcanje"  value="<?php echo set_value('udaljenost_profesionalno_trcanje'); ?>"/> </p>
                                </div>

                                <div>							
                                    <p class="form-label"> <?php echo lang('potraznja_staza_za_trcanje'); ?>: </p>
                                    <?php echo form_error('udaljenost_staza_za_trcanje'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_staza_za_trcanje"  value="<?php echo set_value('udaljenost_staza_za_trcanje'); ?>"/> </p>
                                </div>	
                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_profesionalno_ronjenje'); ?>: </p>
                                    <?php echo form_error('udaljenost_profesionalno_ronjenje'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_profesionalno_ronjenje"  value="<?php echo set_value('udaljenost_profesionalno_ronjenje'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_najam_camaca'); ?>: </p>
                                    <?php echo form_error('udaljenost_najam_camaca'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_najam_camaca"  value="<?php echo set_value('udaljenost_najam_camaca'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_spustanje_camca_u_more'); ?>: </p>
                                    <?php echo form_error('udaljenost_spustanje_camca_u_more'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_spustanje_camca_u_more"  value="<?php echo set_value('udaljenost_spustanje_camca_u_more'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_duljina_biciklisticke_staze'); ?>: </p>
                                    <?php echo form_error('udaljenost_duljina_biciklisticke_staze'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_duljina_biciklisticke_staze"  value="<?php echo set_value('udaljenost_duljina_biciklisticke_staze'); ?>"/> </p>
                                </div>

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_jedrenje_na_dasci'); ?>: </p>
                                    <?php echo form_error('udaljenost_jedrenje_na_dasci'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_jedrenje_na_dasci"  value="<?php echo set_value('udaljenost_jedrenje_na_dasci'); ?>"/> </p>
                                </div>	

                                <div>
                                    <p class="form-label"> <?php echo lang('potraznja_lunapark_za_djecu'); ?>: </p>
                                    <?php echo form_error('udaljenost_lunapark_za_djecu'); ?>
                                    <p class="form-field"> <input class="type-text" type="text" name="udaljenost_lunapark_za_djecu"  value="<?php echo set_value('udaljenost_lunapark_za_djecu'); ?>"/> </p>
                                </div>
                            </div>

                            <div class="submit">
                                <input type="submit" name="spremi" value="<?php echo lang('potraznja_spremi'); ?>" />
                                <a href="<?php echo base_url(); ?>"> <?php echo lang('potraznja_odustani'); ?> </a>
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