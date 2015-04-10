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
                <div id="korisnicke-stranice">
                    <div class="korisnik-oglasi uredi-slike pocisti">
                        <p class="content-title item-1"><?php echo lang('uredi_slike_naziv_obrasca'); ?></p>
                        <div class="result"></div>
                        <div class="popis-slika pocisti">
                            <p class="item-2"><?php echo lang('uredi_slike_napomena_1'); ?></p>
                            <?php if (isset($greska)): ?>
                                <p class="error"><?php echo $greska; ?></p>
                            <?php endif; ?>

                            <?php if (!empty($slike_objekt)): ?>
                                <?php foreach ($slike_objekt as $value): ?>
                                    <div id="uredi-slike-wrapper">
                                        <img src="<?php echo base_url() . 'uploads/objekti/' . $value['naziv'] . '_thumb.' . $value['ext']; ?>" /> 
                                        <p><input type="button" class="izbrisi-sliku-oglas" name="<?php echo $this->uri->segment(4); ?>" id="<?php echo $value['naziv'] . '.' . $value['ext']; ?>" value="<?php echo lang('uredi_slike_izbrisi_sliku'); ?>" /></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if (isset($greska_slika)): ?>
                                <p class="error cb"><?php echo $greska_slika; ?></p>
                            <?php endif; ?>
                            <div class="form-uredi-slike cb">
                                <?php echo form_open_multipart('korisnik/spremi_promjene_slika/oglas/' . $this->uri->segment(4)) . "\n"; ?>
                                <!-- added by stiiv - id -->
                                <input type="file" name="slika" />
                                <input type="submit" name="spremi" value="Spremi" />
                                </form>
                            </div>
                            <div class="form-uredi-slike cb">
                                <button id="addSlikaBtn" style="display:none;clear:left;">Add more</button>
                            </div>
                        </div>
                        <div class="loading"> <!-- Ajax loading --> </div>
                        <div id="dialog-confirm" title="Potvrdite za brisanje" style="display: none;">
                            <span class="ui-icon ui-icon-alert" style="float: left; margin-right: 5px;"></span>
                            <p class="dialog-item"><?php echo lang('uredi_slike_potvrda_brisanja'); ?></p>
                        </div>
                    </div>
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