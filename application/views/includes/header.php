<!-- HEADER -->
<div id="header-wrapper">
    <div id="header" class="pocisti">
        <div class="header-first-row pocisti">
            <div class="logo">
                <a href="<?php echo base_url(); //.'stranica/index/'.get_cookie('lang'); ?>"> <img src="<?php echo base_url(); ?>includes/images/logo.png" width="180" height="180" alt="logo"> Nekretnine Aveto </a>
            </div>
            <p class="turisticko_oglasavanje"><?php echo lang('oglasavanje_nekretnina'); ?></p>
        </div>
        <!--<img style="margin-top:-90px;margin-left: 10px;width: 330px;" src="<?php //echo base_url(); ?>includes/images/ponudapotraznja.png">-->
        <p class="ponuda_potraznja"><?php echo lang('prodaja_potraznja_najam'); ?></p>
        <div class="izbornik">
            <ul>
                <li class="first-item"> <a <?php if ($this->uri->segment(2) == 'index' OR $this->uri->segment(2) == '' AND $this->uri->segment(1) != 'potraznja'): echo 'class="active"';
endif; ?> href="<?php echo base_url(); //.'stranica/index/'.get_cookie('lang'); ?>"> <?php echo lang('com_izbornik_pocetna'); ?> </a> </li>
                <li> <a <?php if ($this->uri->segment(1) == 'potraznja'):echo 'class="active"';
endif; ?> href="<?php echo base_url(); ?>potraznja"> <?php echo lang('com_izbornik_potraznja'); ?> </a> </li>
                <li> <a <?php if ($this->uri->segment(2) == 'karta'):echo 'class="active"';
endif; ?> href="<?php echo base_url(); ?>stranica/karta/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_karta'); ?> </a> </li>
                <li> <a  <?php if ($this->uri->segment(2) == 'registracija'):echo 'class="istaknuto active"';
else: echo 'class="istaknuto"';
endif; ?> href="<?php echo base_url(); ?>stranica/registracija/<?php echo get_cookie('lang', TRUE); ?>"> <?php echo lang('com_izbornik_registracija'); ?> </a> </li>
            </ul>
        </div>
        <!-- Tražilica -->
        <br>				
<?php if ($this->uri->segment(2) == '' AND $this->uri->segment(1) != 'potraznja' OR $this->uri->segment(1) == 'trazi' OR $this->uri->segment(1) == 'oglas') {
    require_once(APPPATH . 'views/includes/trazilica.php');
} ?>
        <!--div class="jezik">
                <span> <a href="<?php echo base_url(); ?>lang/hr"> <img src="<?php echo base_url(); ?>includes/images/hr.gif" width="18" height="12" alt="hr" /> </a> </span>
                <span> <a href="<?php echo base_url(); ?>lang/en"> <img src="<?php echo base_url(); ?>includes/images/en.gif" width="18" height="12" alt="en" /> </a> </span>
                <span> <a href="<?php echo base_url(); ?>lang/de"> <img src="<?php echo base_url(); ?>includes/images/de.gif" width="18" height="12" alt="de" /> </a> </span>
                <!--<span> <a href="<?php echo base_url(); ?>lang/it"> <img src="<?php echo base_url(); ?>includes/images/it.gif" width="18" height="12" alt="it" /> </a> </span>
                <span> <a href="<?php echo base_url(); ?>lang/fr"> <img src="<?php echo base_url(); ?>includes/images/fr.gif" width="18" height="12" alt="fr" /> </a> </span>-->
        <!--/div-->
    </div>
</div>