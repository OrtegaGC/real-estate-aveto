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
                <div id="potraznja-najnoviji">
                    <?php foreach ($najnoviji as $p_key => $p_value): ?>
                        <div class="potraznja-intro potraznja-<?php echo $p_key; ?>">
                            <p class="trazim"><?php echo lang('potraznja_trazim'); ?>:</p>
                            <p class="naslov"><?php echo $p_value['naslov']; ?></p>
                            <p class="mjesto"><?php echo $p_value['naziv_mjesta']; ?></p>
                            <p class="potraznja-detalji"> <a href="<?php echo base_url(); ?>potraznja/detalji/<?php echo $p_value['mjestoID']; ?>/<?php echo $p_value['potraznjaID']; ?>"> <?php echo lang('potraznja_detaljnije'); ?> </a> </p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!--div id="content-potraznja-home">
                    <div class="karta">
                        <p> <?php echo lang('potraznja_trazilica_na_karti'); ?> </p>
                        <div id="regije">
                            <span class="regija-0"> Zagreb </span>
                            <?php foreach ($regije as $result): ?>
                                <span class="regija-<?php echo $result['regijaID']; ?>"> <a href="<?php echo base_url(); ?>potraznja/regija/<?php echo $result['regijaID'] ?>"> <?php echo $result['naziv_regije']; ?> </a> </span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div-->
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
                <!-- Brojač posjeta -->
                <?php require_once(APPPATH . 'views/includes/modules/brojac-posjeta.php'); ?>
            </div>
            <!-- Banner bottom -->
            <?php require_once(APPPATH . 'views/includes/banner-bottom.php'); ?>
        </div>
    </div>
    <!-- Takeover right -->
    <?php require_once(APPPATH . 'views/includes/takeover-right.php'); ?>
</div>
