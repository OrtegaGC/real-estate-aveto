<!-- head -->
        <!-- SADRŽAJ -->
                        <!-- Takeover left -->
<div class="pocisti" id="takeover-wrapper">
        <?php require_once(APPPATH.'views/includes/takeover-left.php'); ?>
    <div id="content-wrapper">
        <div id="content">
            <!-- Banner top -->
                        <?php require_once(APPPATH.'views/includes/banner-top.php'); ?>
            <div class="content-left">
                <div id="content-rezultati-pretrage">
                    <div class="info"> 
                        <p> <?php echo lang('trazi_rezultat'); ?>: 
                            <?php if ($upit['upit'] != ''):?> <span> <?php echo $upit['upit']?> </span> <?php endif;?> 
                            <?php if ($upit['zupanija'] == '0') { echo '<span>'.lang('trazi_sve_zupanije'); } else { echo '<span>'.$query_info['nazivZupanije'][0]['naziv_regije'].'</span>'; } ?> 
                            <?php if (isset($upit['mjesto'])):?> 
                                <?php if ($upit['mjesto'] != '0' AND  $upit['mjesto'] != ''):?>
                                <span> >> <?php echo $query_info['nazivMjesta'][0]['naziv_mjesta'];?> > </span>
                                <?php endif;?>
                            <?php endif;?>
                            <?php if (isset($upit['tip_smjestaja']) AND empty($upit['tip_smjestaja']) != TRUE):?>
                            
                            <?php foreach ($upit['tip_smjestaja'] as $u_value):?>
                            <span> <?php echo lang('detalji_tip_'.$u_value);?>; </span>
                            <?php endforeach;?>
                            <?php else: ?>
                            <span> <?php echo lang('trazi_svi_tipovi_smjestaja');?> </span>
                            <?php endif;?>
                        </p> 
                    </div>
                    <div class="rezultati pocisti">
                        <?php if ($ukupno == '0'):?>
                            <p class="item-2"><?php echo lang('trazi_nema_rezultata');?></p>
                        <?php else: ?>
                            <p class="item-2"> <?php echo lang('trazi_ukupno').': <span>'.$ukupno;?></span> </p>
                        <?php foreach ($query_result as $r_key => $r_value):?>
                            <div class="rezultati-pretrage-oglas-intro oglas-<?php echo $r_key;?>">
                                <h3> <a href="<?php echo base_url();?>oglas/detalji/<?php echo $r_value['mjestoID'];?>/<?php echo $r_value['oglasID'];?>" title="<?php echo $r_value['nazivObjekta'];?>"><?php echo $r_value['nazivObjekta'];?> </a> </h3>
                                <div class="slika-intro">
                                    <a href="<?php echo base_url();?>oglas/detalji/<?php echo $r_value['mjestoID'];?>/<?php echo $r_value['oglasID'];?>"> 
                                        <img src="<?php echo base_url();?>uploads/objekti/<?php echo $trazi_slika['glavna_slika'][$r_key];?>" width="140" height="105" alt="<?php echo $r_value['nazivObjekta'];?> <"/> 
                                    </a> 
                                </div>
                                <p class="tip-smjestaja"> <?php echo lang('detalji_tip_'.$r_value['tipSmjestaja']);?> </p>
                                <div class="zvijezdice"> 
                                    <?php for($i=0; $i < $r_value['brojZvijezdica']; $i++):?> <img src="<?php echo base_url();?>includes/images/zvijezdica.png" width="16" height="16"  alt="zvijezdice"/> <?php endfor;?>
                                </div>
                            </div>
                        <?php endforeach; endif;?>
                    </div>
                    <div id="pagination">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <!-- Login -->
                <?php
                        $userdata = $this->session->userdata('prijavljen');
                        if( !$this->session->userdata('prijavljen'))
                        {
                            require_once(APPPATH.'views/includes/modules/login.php');
                        } else if ($this->session->userdata('tip') == 1) { // -- administrator
                            require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-1.php');
                        } else if ($this->session->userdata('tip') == 2) { // -- oglašivač
                            require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-2.php');
                        } else if ($this->session->userdata('tip') == 3) { // -- korisnik
                            require_once(APPPATH.'views/includes/modules/korisnicki-izbornik-3.php');
                        }
                ?>
                <!-- Tečajna lista -->
                <?php require_once(APPPATH.'views/includes/modules/tecajna-lista.php');?>
                <!-- Social -->
                <?php require_once(APPPATH.'views/includes/modules/social.php');?>
            </div>
            <!-- Banner bottom -->
            <?php require_once(APPPATH.'views/includes/banner-bottom.php'); ?>
        </div>
    </div>
    <!-- Takeover right -->
        <?php require_once(APPPATH.'views/includes/takeover-right.php'); ?>
</div>
