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
                <div class="breadcrumb" >
                    <p> <a href="<?php echo base_url(); ?>"> <?php echo lang('com_breadcrumb_regije'); ?> </a> <span> >> </span>  
                        <a href="<?php echo base_url(); ?>oglas/regija/<?php echo $regija[0]['regijaID']; ?>"> <?php echo $regija[0]['naziv_regije']; ?> </a> <span> >> </span> 
                        <strong> <?php echo $mjesto[0]['naziv_mjesta']; ?> </strong>
                    </p>
                </div>

                <div id="popis-oglasa" class="pocisti">
                    <?php foreach ($oglas as $key => $value): ?>
                        <div class="oglas-intro">
                            <h3> <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $this->uri->segment(3); ?>/<?php echo $value['oglasID']; ?>"><?php echo $value['nazivObjekta']; ?> </a> </h3>
                            <p> <?php echo lang('detalji_tip_' . $value['tipSmjestaja']); ?> </p>
                            <div class="zvijezdice"> <?php for ($i = 0; $i < $value['brojZvijezdica']; $i++): ?> <img src="<?php echo base_url(); ?>includes/images/zvijezdica.png" width="16" height="16"  alt="zvijezdice"/> <?php endfor; ?></div>
                            <div class="slika-intro"> 
                                <a href="<?php echo base_url(); ?>oglas/detalji/<?php echo $this->uri->segment(3); ?>/<?php echo $value['oglasID']; ?>"> 
                                    <img src="<?php echo base_url(); ?>uploads/objekti/<?php echo $glavna_slika[$key]; ?>"/> 
                                </a>
                            </div>
                            <!-- Facebook share -->
                            <?php require(APPPATH . 'views/includes/fb-share.php'); ?>
                        </div>
                    <?php endforeach; ?>
                    <div id="pagination">
                        <?php echo $this->pagination->create_links(); ?>
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
