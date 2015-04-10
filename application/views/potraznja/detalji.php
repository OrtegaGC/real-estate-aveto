<!-- head -->
<!-- SADRŽAJ -->
<div class="pocisti" id="takeover-wrapper">
    <?php require_once(APPPATH . 'views/includes/takeover-left.php'); ?>
    <div id="content-wrapper">
        <div id="content">
            <!-- Banner top -->
            <?php require_once(APPPATH . 'views/includes/banner-top.php'); ?>
            <div class="content-left">
                <div class="breadcrumb" >
                    <p> <a href="<?php echo base_url(); ?>potraznja"> <?php echo lang('com_breadcrumb_regije'); ?> </a> <span> >> </span>  
                        <a href="<?php echo base_url(); ?>potraznja/regija/<?php echo $regija[0]['regijaID']; ?>"> <?php echo $regija[0]['naziv_regije']; ?> </a> <span> >> </span> 
                        <a href="<?php echo base_url(); ?>potraznja/mjesto/<?php echo $mjesto[0]['mjestoID']; ?>"><?php echo $mjesto[0]['naziv_mjesta']; ?> </a> <span> >> </span> 
                        <strong> <?php echo $potraznja[0]['naslov'] ?> </strong>
                    </p>
                </div>

                <div id="detalji-oglasa-potraznja" class="pocisti">
                    <?php if (isset($info)): ?>
                        <p class="item-2"><?php echo $info; ?></p>
                    <?php endif; ?>
                    <h3><?php echo $potraznja[0]['naslov']; ?></h3>
                    <h4><?php echo $potraznja[0]['naziv_mjesta']; ?></h4>
                    <p class="opis"><?php echo lang('detalji_potraznja_tip_smjestaja'); ?></p>
                    <ul class="detalji-smjestaja-potraznja">
                        <?php foreach ($kategorija as $k_key => $k_value): ?>
                            <li> <?php echo lang('detalji_potraznja_' . $k_value); ?> </li>
                        <?php endforeach; ?>
                    </ul>

                    <p class="opis"><?php echo lang('detalji_potraznja_period_boravka'); ?></p>
                    <p><?php echo lang('detalji_potraznja_datum_dolaska'); ?>: <span class="datumi"><?php echo $this->funkcija->dbOutputDate($potraznja[0]['datumPostavljanja']); ?></span></p>
                    <p><?php echo lang('detalji_potraznja_datum_odlaska'); ?>: <span class="datumi"><?php echo $this->funkcija->dbOutputDate($potraznja[0]['datumPrekida']); ?></span></p>

                    <?php if ($sobe != ''): ?>
                        <p class="opis"><?php echo lang('detalji_potraznja_broj_osoba'); ?></p>
                        <ul class="detalji-smjestaja-potraznja">
                            <li><?php echo lang('detalji_potraznja_' . $sobe['objekt_broj_soba']); ?></li>
                        </ul>
                    <?php endif; ?>

                    <?php if ($min_cijena != '' || $max_cijena != ''): ?>
                        <p class="opis"><?php echo lang('detalji_potraznja_cijena'); ?></p>
                        <ul class="detalji-smjestaja-potraznja">
                            <?php if($max_cijena != '') { echo '<li>'.lang('detalji_potraznja_max_cijena').': <span>'.$max_cijena.' €</span></li>'; } ?>
                            <?php if($min_cijena != '') { echo '<li>'.lang('detalji_potraznja_min_cijena').': <span>'.$min_cijena.' €</span></li>'; } ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($tip_objekta != ''): ?>
                        <p class="opis"><?php echo lang('detalji_potraznja_objekt_moze_biti'); ?></p>
                        <ul class="detalji-smjestaja-potraznja">
                            <?php foreach ($tip_objekta as $to_key => $to_value): ?>
                                <li> <?php echo lang('detalji_potraznja_lokacija_objekt_' . $to_value); ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($objekt_uvjeti != ''): ?>
                        <p class="opis"><?php echo lang('detalji_potraznja_objekt_mora_zadovoljiti_uvjete'); ?></p>
                        <ul class="detalji-smjestaja-potraznja">
                            <?php foreach ($objekt_uvjeti as $tb_key => $tb_value): ?>
                                <li> <?php echo lang('detalji_potraznja_objekt_uvjeti_' . $tb_value); ?> </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <p class="hr">&nbsp;</p>
                    <div class="column-1">
                        <?php if ($opcije_soba != ''): ?>
                            <p class="opis"><?php echo lang('detalji_potraznja_detalji_sobe'); ?></p>
                            <ul class="detalji-smjestaja-potraznja">
                                <?php foreach ($opcije_soba as $os_key => $os_value): ?>
                                    <li> <?php echo lang('detalji_potraznja_' . $os_key); ?>: <span><?php echo lang('detalji_potraznja_' . $os_value); ?></span> </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if (!isset($info)): ?>
                            <div class="kontakt-podaci">
                                <p class="naslov"><?php echo lang('detalji_potraznja_kontakt_podaci'); ?></p>
                                <p class="opis"><?php echo lang('detalji_potraznja_mobitel') . ': <span>' . $potraznja[0]['mobitel']; ?></span></p>
                                <p class="opis"><?php echo lang('detalji_potraznja_telefon') . ': <span>' . $potraznja[0]['telefon']; ?></span></p>
                                <p class="opis"><?php echo lang('detalji_potraznja_email') . ': <span>' . $potraznja[0]['email']; ?></span></p>
                            </div>
                        <?php endif; ?>
                        <p><?php echo lang('detalji_potraznja_datum_objave') . ': <span class="datumi">' . $this->funkcija->dbOutputDate($potraznja[0]['datumObjave']); ?></span></p>
                        <!-- Facebook share -->
                        <?php require_once(APPPATH . 'views/includes/fb-share.php'); ?>
                    </div>
                    <div class="column-2">
                        <?php if ($opcije_smjestaj != ''): ?>
                            <p class="opis"><?php echo lang('detalji_potraznja_detalji_smjestaja'); ?></p>
                            <ul class="detalji-smjestaja-potraznja">
                                <?php foreach ($opcije_smjestaj as $os_key => $os_value): ?>
                                    <li> <?php echo lang('detalji_potraznja_' . $os_key); ?>: <span><?php echo lang('detalji_potraznja_' . $os_value); ?></span> </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if ($opcije_udaljenost != ''): ?>
                            <p class="opis"><?php echo lang('detalji_potraznja_ostali_detalji'); ?></p>
                            <ul class="detalji-smjestaja-potraznja">
                                <?php foreach ($opcije_udaljenost as $ou_key => $ou_value): ?>
                                    <li> <?php echo lang('detalji_potraznja_' . $ou_key); ?>: <span><?php echo $ou_value; ?></span> </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
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
