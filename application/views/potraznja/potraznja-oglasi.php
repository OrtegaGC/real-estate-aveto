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
                    <div class="korisnik-oglasi">
                        <table>
                            <tr class="leading-row">
                                <td>#</td> 
                                <td><?php echo lang('moji_oglasi_naziv_oglasa'); ?></td>
                                <td><?php echo lang('moji_oglasi_smjestaj'); ?></td>
                                <td><?php echo lang('moji_oglasi_opcije'); ?></td>
                            </tr>
                            <?php
                            $i = 1;
                            foreach ($oglasi as $o_value):
                                ?>
                                <tr>
                                    <td class="aktivan-<?php echo $o_value['aktivan']; ?>"><?php echo $i++; ?></td>
                                    <td class="aktivan-<?php echo $o_value['aktivan']; ?>"><?php echo $o_value['naslov']; ?></td>
                                    <td><a href="<?php echo base_url() ?>korisnik/usluge/<?php echo $o_value['potraznjaID']; ?>"><?php echo lang('moji_oglasi_popis_usluga'); ?></a></td>
                                    <td>
                                        <table>
                                            <tr>
                                                <td><a href="<?php echo base_url(); ?>korisnik/uredi_oglas_potraznja/<?php echo $o_value['potraznjaID']; ?>"><?php echo lang('moji_oglasi_uredi'); ?></a></td>
                                                <td><a id="<?php echo $o_value['potraznjaID']; ?>" href="#"><?php echo lang('moji_oglasi_izbrisi'); ?></a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
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
