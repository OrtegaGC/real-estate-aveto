<!--head>
<meta http-equiv="refresh" content="120" > 
</head-->
<!-- SADRŽAJ -->
<!-- Takeover left -->
<div class="pocisti" id="takeover-wrapper">
    <?php require_once(APPPATH . 'views/includes/takeover-left.php'); ?>
    <div id="content-wrapper-home">
        <div id="content">
            <div id="potraznja" class="pocisti">
                <a href="<?php echo base_url(); ?>potraznja"> <h3><?php echo lang('home_potraznja'); ?><p class="cb"> <a href="<?php echo base_url(); ?>potraznja"> <?php echo lang('home_potraznja_sve'); ?> </a> </p></h3> </a>
                <?php foreach ($potraznja as $p_key => $p_value): ?>
                    <div class="potraznja-intro potraznja-<?php echo $p_key; ?>">
                        <p class="trazim"><?php echo lang('home_trazim'); ?>:</p>
                        <p class="naslov"><?php echo $p_value['naslov']; ?></p>
                        <p class="mjesto"><?php echo $p_value['naziv_mjesta']; ?></p>
                        <p class="potraznja-detalji"> <a href="<?php echo base_url(); ?>potraznja/detalji/<?php echo $p_value['mjestoID'] ?>/<?php echo $p_value['potraznjaID']; ?>"> <?php echo lang('home_detaljnije'); ?> </a> </p>
                    </div>
                <?php endforeach; ?>
                <div class="cb vise">
                        <!--<p class="cb"> <a href="<?php echo base_url(); ?>potraznja"> <?php echo lang('home_potraznja_sve'); ?> </a> </p>-->
                </div>
                <br>
                <br>
                <br>
                <h3><?php echo lang('ponuda'); ?></h3>
            </div>
            <!-- Banner top -->
            <?php require_once(APPPATH . 'views/includes/banner-top.php'); ?>
            <div class="content-left">
                <?php require_once(APPPATH . 'views/includes/banner-left.php'); ?>
                <div id="content-main-home">
                    <!--div class="karta">
                            <p> <?php //echo lang('home_trazilica_na_karti');  ?> </p>
                            <div id="regije">
                                    <span class="regija-0"> Zagreb </span>
                    <?php //foreach($regije as $result): ?>
                                    <span class="regija-<?php //echo $result['regijaID']; ?>"> <a href="<?php //echo base_url(); ?>oglas/regija/<?php //echo $result['regijaID'] ?>"> <?php //echo $result['naziv_regije']; ?> </a> </span>
                    <?php //endforeach; ?>
                            </div>
                    </div-->
                    <?php if (!empty($istaknutiOglasiIntro)): ?>
                        <div id="istaknuti-oglasi">
                            <div class="istaknuti-oglasi-wrapper">
                                <p class="naslov"> <?php echo lang('home_istaknuti_oglasi'); ?> </p>
                                <?php foreach ($istaknutiOglasiIntro as $i_key => $i_value): ?>
                                    <div class="istaknuti-oglas-intro oglas-<?php echo $i_key; ?>">
                                        <h3> <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $i_value[0]['mjestoID']; ?>/<?php echo $i_value[0]['oglasID']; ?>" title="<?php echo $i_value[0]['nazivObjekta']; ?>"><?php echo $i_value[0]['nazivObjekta']; ?> </a> </h3>
                                        <div class="slika-intro">
                                            <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $i_value[0]['mjestoID']; ?>/<?php echo $i_value[0]['oglasID']; ?>"> 
                                                <img src="<?php echo base_url(); ?>uploads/objekti/<?php echo $istaknuti_glavna_slika['glavna_slika'][$i_key]; ?>" width="140" height="105" alt="<?php echo $i_value[0]['nazivObjekta']; ?> <"/> 
                                            </a> 
                                        </div>
                                        <p class="tip-smjestaja"> <?php echo lang('detalji_tip_' . $i_value[0]['tipSmjestaja']); ?> </p>
                                        <div class="zvijezdice"> 
                                            <?php for ($i = 0; $i < $i_value[0]['brojZvijezdica']; $i++): ?> <img src="<?php echo base_url(); ?>includes/images/zvijezdica.png" width="16" height="16"  alt="zvijezdice"/> <?php endfor; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <?php if (!empty($najgledanijiOglasiIntro)): ?>
                        <div id="najgledaniji-oglasi">
                            <div class="najgledaniji-oglasi-wrapper pocisti">
                                <p class="naslov"> <?php echo lang('home_najgledaniji_oglasi'); ?> </p>
                                <?php foreach ($najgledanijiOglasiIntro as $n_key => $n_value): ?>
                                    <div class="najgledaniji-oglas-intro oglas-<?php echo $n_key; ?>">
                                        <h3> <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $n_value[0]['mjestoID']; ?>/<?php echo $n_value[0]['oglasID']; ?>" title="<?php echo $n_value[0]['nazivObjekta']; ?>"><?php echo $n_value[0]['nazivObjekta']; ?> </a> </h3>
                                        <div class="slika-intro">
                                            <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $n_value[0]['mjestoID']; ?>/<?php echo $n_value[0]['oglasID']; ?>"> 
                                                <img src="<?php echo base_url(); ?>uploads/objekti/<?php echo $najgledaniji_glavna_slika['glavna_slika'][$n_key]; ?>" width="140" height="105" alt="<?php echo $n_value[0]['nazivObjekta']; ?> <"/> 
                                            </a> 
                                        </div>
                                        <p class="tip-smjestaja"> <?php echo lang('detalji_tip_' . $n_value[0]['tipSmjestaja']); ?> </p>
                                        <div class="zvijezdice"> 
                                            <?php for ($i = 0; $i < $n_value[0]['brojZvijezdica']; $i++): ?> <img src="<?php echo base_url(); ?>includes/images/zvijezdica.png" width="16" height="16"  alt="zvijezdice"/> <?php endfor; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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
