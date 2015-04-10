<!-- head -->
<!-- SADRŽAJ -->
<!--script type="text/javascript">
                function objekt() {
                        var myLatlng = new google.maps.LatLng(<?php //echo $oglas[0]['lokacijaLatitude']; ?>, <?php //echo $oglas[0]['lokacijaLongitude']; ?>);
                        var mapOptions = {
                                zoom : 9,
                                center : myLatlng,
                                mapTypeId : google.maps.MapTypeId.ROADMAP
                        }
                        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                        var marker = new google.maps.Marker({
                                position : myLatlng,
                                map : map,
                                title : '<?php //echo $oglas[0]['nazivObjekta'] ?>'
                        });
                }


                google.maps.event.addDomListener(window, 'load', initialize); 
</script-->
<script type="text/javascript">
    $(document).ready(function () {
        // edited by stiiv
        var baseUrl = "<?php echo base_url(); ?>";
        console.log(baseUrl);
        $(function () {
            $('#gallery a').lightBox({
                imageLoading: baseUrl+"includes/images/lightbox-ico-loading.gif",
                imageBtnClose: baseUrl+"includes/images/lightbox-btn-close.gif",
                imageBtnPrev: baseUrl+"includes/images/lightbox-btn-prev.gif",
                imageBtnNext: baseUrl+"includes/images/lightbox-btn-next.gif"
            });
        });


        /*$(function () {
            $('#gallery-apartman a').lightBox();
        });*/

    });

</script>
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
                        <a href="<?php echo base_url(); ?>oglas/mjesto/<?php echo $mjesto[0]['mjestoID']; ?>"><?php echo $mjesto[0]['naziv_mjesta']; ?> </a> <span> >> </span> 
                        <strong class="border"> <?php echo $oglas[0]['nazivObjekta'] ?> </strong>
                    </p>
                </div>

                <div id="detalji-oglasa" class="pocisti">
                    <div class="left">
                        <h3 class="border"><?php echo $oglas[0]['nazivObjekta']; ?></h3>
                        <p class="opis"><?php echo lang('detalji_tip_smjestaja'); ?></p>
                        <p class="tip-smjestaja border"><?php echo lang('detalji_tip_' . $oglas[0]['tipSmjestaja']); ?></p>
                        <p class="opis"><?php echo lang('detalji_adresa'); ?></p>
                        <p class="border"><?php echo $oglas[0]['adresaBrojPoste']; ?></p>
                        <p class="opis"><?php echo lang('detalji_telefon'); ?></p>
                        <p class="border"><?php echo $oglas[0]['telefon']; ?></p>
                        <p class="opis"><?php echo lang('detalji_mobitel'); ?></p>
                        <p class="border"><?php echo $oglas[0]['mobitel']; ?></p>
                        <p class="opis"><?php echo lang('detalji_email_adresa'); ?></p>
                        <p class="border"><?php echo $oglas[0]['email']; ?></p>
                        <div class="zvijezdice">
                            <p class="opis"><?php echo lang('detalji_broj_zvijezdica'); ?></p>
                            <?php for ($i = 0; $i < $oglas[0]['brojZvijezdica']; $i++): ?> <img src="<?php echo base_url(); ?>includes/images/zvijezdica.png" width="16" height="16"  alt="zvijezdice"/> <?php endfor; ?>
                        </div>

                        <?php if ($oglas[0]['webStranica'] != ''): ?>
                            <p class="opis"><?php echo lang('detalji_web'); ?></p>
                            <p class="border"> <a target="_blank" href="<?php echo $oglas[0]['webStranica']; ?>"><?php echo $oglas[0]['webStranica']; ?></a> </p>
                        <?php endif; ?>
                            
                        <?php if ($oglas[0]['cijenaObjekt'] != ''): ?>
                            <p class="opis"><?php echo lang('detalji_cijena_objekt'); ?></p>
                            <p class="border"><?php echo $oglas[0]['cijenaObjekt']; ?> €</p>
                        <?php endif; ?>

                        <?php if (!empty($jezici)): ?>
                            <p class="opis"><?php echo lang('detalji_jezici_domacin'); ?></p>
                            <ul class="jezici border">
                                <?php foreach ($jezici as $j_key => $j_value): ?>
                                    <li><?php echo lang('detalji_jezik_' . $j_value['jezik']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ($oglas[0]['opsirnijiOpisSmjestajaHr'] != '' OR $oglas[0]['opsirnijiOpisSmjestajaEn'] != '' OR $oglas[0]['opsirnijiOpisSmjestajaDe'] != '' OR $oglas[0]['opsirnijiOpisSmjestajaIt'] != '' OR $oglas[0]['opsirnijiOpisSmjestajaHr'] != ''): ?>
                            <div class="dodatne-usluge border">
                                <p class="opis"><?php echo lang('detalji_opsirniji_opis_smjestaja'); ?> (<?php require_once(APPPATH . 'views/includes/modules/zastavice-opis-smjestaja.php'); ?>)</p>
                                <div class="opis-usluga">
                                    <?php if ($oglas[0]['opsirnijiOpisSmjestajaHr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/hr.gif" width="18" height="12" alt="hr" /> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisSmjestajaHr']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisSmjestajaEn'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/en.gif" width="18" height="12" alt="en"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisSmjestajaEn']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisSmjestajaDe'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/de.gif" width="18" height="12" alt="de"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisSmjestajaDe']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisSmjestajaIt'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/it.gif" width="18" height="12" alt="it"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisSmjestajaIt']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisSmjestajaFr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/fr.gif" width="18" height="12" alt="fr"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisSmjestajaFr']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['opsirnijiOpisIzletaHr'] != '0' OR $oglas[0]['opsirnijiOpisIzletaEn'] != '0' OR $oglas[0]['opsirnijiOpisIzletaDe'] != '0' OR $oglas[0]['opsirnijiOpisIzletaIt'] != '0' OR $oglas[0]['opsirnijiOpisIzletaFr'] != '0'): ?>
                            <div class="dodatne-usluge border">
                                <p class="opis"><?php echo lang('detalji_opsirniji_opis_izleta'); ?> (<?php require_once(APPPATH . 'views/includes/modules/zastavice-opis-izleta.php'); ?>)</p>
                                <div class="opis-usluga">
                                    <?php if ($oglas[0]['opsirnijiOpisIzletaHr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/hr.gif" width="18" height="12" alt="hr" /> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisIzletaHr']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisIzletaEn'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/en.gif" width="18" height="12" alt="en"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisIzletaEn']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisIzletaDe'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/de.gif" width="18" height="12" alt="de"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisIzletaDe']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisIzletaIt'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/it.gif" width="18" height="12" alt="it"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisIzletaIt']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['opsirnijiOpisIzletaFr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/fr.gif" width="18" height="12" alt="fr"> </span>
                                        <p><?php echo $oglas[0]['opsirnijiOpisIzletaFr']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="right">
                        <?php if ($oglas[0]['dodatneUslugeHr'] != '' OR $oglas[0]['dodatneUslugeEn'] != '' OR $oglas[0]['dodatneUslugeDe'] != '' OR $oglas[0]['dodatneUslugeIt'] != '' OR $oglas[0]['dodatneUslugeFr'] != ''): ?>
                            <div class="dodatne-usluge border">
                                <p class="opis"><?php echo lang('detalji_dodatne_usluge'); ?> (<?php require_once(APPPATH . 'views/includes/modules/zastavice-opis-usluga.php'); ?>)</p>
                                <div class="opis-usluga">
                                    <?php if ($oglas[0]['dodatneUslugeHr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/hr.gif" width="18" height="12" alt="hr" /> </span>
                                        <p><?php echo $oglas[0]['dodatneUslugeHr']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['dodatneUslugeEn'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/en.gif" width="18" height="12" alt="en"> </span>
                                        <p><?php echo $oglas[0]['dodatneUslugeEn']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['dodatneUslugeDe'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/de.gif" width="18" height="12" alt="de"> </span>
                                        <p><?php echo $oglas[0]['dodatneUslugeDe']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['dodatneUslugeIt'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/it.gif" width="18" height="12" alt="it"> </span>
                                        <p><?php echo $oglas[0]['dodatneUslugeIt']; ?></p>
                                    <?php endif; ?>
                                    <?php if ($oglas[0]['dodatneUslugeFr'] != ''): ?>
                                        <span class="zastavice"><img src="<?php echo base_url(); ?>includes/images/fr.gif" width="18" height="12" alt="fr"> </span>
                                        <p><?php echo $oglas[0]['dodatneUslugeFr']; ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($detalji_objekta)): ?>
                            <p class="opis"><?php echo lang('detalji_detalji_objekta'); ?></p>
                            <ul class="detalji-objekta border">
                                <?php foreach ($detalji_objekta as $d_key => $d_value): ?>
                                    <li><?php echo lang('detalji_detalji_objekta_' . $d_value['detalji_objekt']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (!empty($detalji_aktivnosti_okolica)): ?>
                            <p class="opis"><?php echo lang('detalji_detalji_aktivnosti_okolica'); ?></p>
                            <ul class="detalji-kampa border">
                                <?php foreach ($detalji_aktivnosti_okolica as $da_key => $da_value): ?>
                                    <li><?php echo lang('detalji_detalji_aktivnosti_okolica_' . $da_value['detalji_kamp']); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                    <p class="space cb"> </p>
                    <div class="content-controls">
                        <input class="active" id="show-details" type="button" value="+" />
                        <input id="hide-details" type="button" value="-" />
                    </div>
                    <div class="ostale-informacije cb pocisti">
                        <?php if ($oglas[0]['kvadraturaObjekta'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_kvadratura_objekta'); ?></p>
                                <p><?php echo $oglas[0]['kvadraturaObjekta']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brojSpavacihSoba'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_broj_spavacih_soba'); ?></p>
                                <p><?php echo $oglas[0]['brojSpavacihSoba']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brojParkirnihMjesta'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_broj_parkirnih_mjesta'); ?></p>
                                <p><?php echo $oglas[0]['brojParkirnihMjesta']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['povrsinaAutokampa'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_povrsina_autokampa'); ?></p>
                                <p><?php echo $oglas[0]['povrsinaAutokampa']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brojKampJedinica'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_broj_kamp_jedinica'); ?></p>
                                <p><?php echo $oglas[0]['brojKampJedinica']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brojWcJedinica'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_broj_wc_jedinica'); ?></p>
                                <p><?php echo $oglas[0]['brojWcJedinica']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brojTuseva'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_broj_tuseva'); ?></p>
                                <p><?php echo $oglas[0]['brojTuseva']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['velicinaPlovila'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_velicina_plovila'); ?></p>
                                <p><?php echo $oglas[0]['velicinaPlovila']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['centar'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_centar'); ?></p>
                                <p><?php echo $oglas[0]['centar']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['restoran'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_restoran'); ?></p>
                                <p><?php echo $oglas[0]['restoran']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['trgovina'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_trgovina'); ?></p>
                                <p><?php echo $oglas[0]['trgovina']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['posta'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_posta'); ?></p>
                                <p><?php echo $oglas[0]['posta']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['banka'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_banka'); ?></p>
                                <p><?php echo $oglas[0]['banka']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['ljekarna'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_ljekarna'); ?></p>
                                <p><?php echo $oglas[0]['ljekarna']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['ambulanta'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_ambulanta'); ?></p>
                                <p><?php echo $oglas[0]['ambulanta']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['policija'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_policija'); ?></p>
                                <p><?php echo $oglas[0]['policija']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['najblizeMjesto'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_najblize_mjesto'); ?></p>
                                <p><?php echo $oglas[0]['najblizeMjesto']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['najbliziGrad'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_najblizi_grad'); ?></p>
                                <p><?php echo $oglas[0]['najbliziGrad']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['autobusnaStanica'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_autobusna_stanica'); ?></p>
                                <p><?php echo $oglas[0]['autobusnaStanica']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['autobusniKolodvor'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_autobusni_kolodvor'); ?></p>
                                <p><?php echo $oglas[0]['autobusniKolodvor']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['zeljeznickiKolodvor'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_zeljeznicki_kolodvor'); ?></p>
                                <p><?php echo $oglas[0]['zeljeznickiKolodvor']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['zracnaLuka'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_zracna_luka'); ?></p>
                                <p><?php echo $oglas[0]['zracnaLuka']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['brodskaLuka'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_brodska_luka'); ?></p>
                                <p><?php echo $oglas[0]['brodskaLuka']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['nogometnoIgraliste'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_nogometno_igraliste'); ?></p>
                                <p><?php echo $oglas[0]['nogometnoIgraliste']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['kosarkaskoIgraliste'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_kosarkasko_igraliste'); ?></p>
                                <p><?php echo $oglas[0]['kosarkaskoIgraliste']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['vaterpolo'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_vaterpolo'); ?></p>
                                <p><?php echo $oglas[0]['vaterpolo']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['stazaZaTrcanje'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_staza_za_trcanje'); ?></p>
                                <p><?php echo $oglas[0]['stazaZaTrcanje']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['profesionalnoTrcanje'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_profesionalno_trcanje'); ?></p>
                                <p><?php echo $oglas[0]['profesionalno_trcanje']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['duljinaBiciklistickeStaze'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_duljina_biciklisticke_staze'); ?></p>
                                <p><?php echo $oglas[0]['duljinaBiciklistickeStaze']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['jedrenjeNaDasci'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_jedrenje_na_dasci'); ?></p>
                                <p><?php echo $oglas[0]['jedrenjeNaDasci']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['profesionalnoRonjenje'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_profesionalno_ronjenje'); ?></p>
                                <p><?php echo $oglas[0]['profesionalnoRonjenje']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['najamCamaca'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_najam_camaca'); ?></p>
                                <p><?php echo $oglas[0]['najamCamaca']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['spustanjeCamca'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_spustanje_camca_u_more'); ?></p>
                                <p><?php echo $oglas[0]['spustanjeCamca']; ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($oglas[0]['lunapark'] != ''): ?>
                            <div>
                                <p class="opis"><?php echo lang('detalji_lunapark_za_djecu'); ?></p>
                                <p><?php echo $oglas[0]['lunapark']; ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <?php if($slike): // added check by stiiv ?>
                    <div id="gallery">
                            <ul>
                                <?php foreach ($slike as $key => $value): ?>
                                    <li>
                                        <a href="<?php echo base_url(); ?>uploads/objekti/<?php echo $value['naziv'] . '.' . $value['ext']; ?>" title="<?php echo $oglas[0]['nazivObjekta'] ?>">
                                            <img class="slika-<?php echo $key; ?>" src="<?php echo base_url(); ?>uploads/objekti/<?php echo $value['naziv'] . '_thumb.' . $value['ext']; ?>" alt="<?php echo $oglas[0]['nazivObjekta'] ?>" title="<?php echo $oglas[0]['nazivObjekta'] ?>" />
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <!--div class="content-controls">
                        <input class="active" id="show-map" type="button" value="+" />
                        <input id="hide-map" type="button" value="-" />
                    </div>
                    <div class="detalji-map-wrapper">
                        <div id="map-canvas"></div>
                    </div-->
                    <?php //if (count($popis_apartmana) > 1):?>
                    <!--div class="tabs cb">
                        <?php //foreach ($popis_apartmana as $pa_key => $pa_value): ?>
                            <?php //if ($pa_key == 0): ?>
                                <input type="button" class="tab active" id="<?php //echo $pa_value['apartmanID']; ?>" value="<?php //echo $pa_value['nazivApartmana'] ?>" />
                            <?php //else: ?>
                                <input type="button" class="tab" id="<?php //echo $pa_value['apartmanID']; ?>" value="<?php //echo $pa_value['nazivApartmana'] ?>" />
                            <?php //endif; ?>
                        <?php //endforeach; ?>
                    </div-->
                    <?php //endif;?>
                    
                    <div class="loading"></div>
                    <p class="broj-pregleda cb"><?php echo lang('detalji_ukupno_pregleda'); ?>: <?php echo $posjeti[0]['ukupno']; ?></p>
                    <!-- Facebook share -->
                    <?php require_once(APPPATH . 'views/includes/fb-share.php'); ?>
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
