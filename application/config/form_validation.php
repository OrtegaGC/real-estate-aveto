<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config = array(
    'novi_oglas_objekt' => array(
        array(
            'field' => 'zupanija',
            'label' => 'lang:novi_oglas_zupanija',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'mjesto',
            'label' => 'lang:novi_oglas_mjesto',
            'rules' => 'required|xss_clean'
        ),
        /* commented out by stiiv March 11th 2015
          array(
          'field' => 'geo-lat',
          'label' => 'lang:novi_oglas_latitude',
          'rules' => 'required|max_length[32]|decimal|xss_clean'
          ),
          array(
          'field' => 'geo-lng',
          'label' => 'lang:novi_oglas_longitude',
          'rules' => 'required|max_length[32]|decimal|xss_clean'
          ), */
        array(
            'field' => 'naziv_objekta',
            'label' => 'lang:novi_oglas_naziv_objekta',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num'
        ),
        array(
            'field' => 'tip_smjestaja',
            'label' => 'lang:novi_oglas_tip_smjestaja',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'dodatne_usluge_hr',
            'label' => 'lang:novi_oglas_dodatne_usluge_hr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'dodatne_usluge_en',
            'label' => 'lang:novi_oglas_dodatne_usluge_en',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'dodatne_usluge_de',
            'label' => 'lang:novi_oglas_dodatne_usluge_de',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'dodatne_usluge_it',
            'label' => 'lang:novi_oglas_dodatne_usluge_it',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'dodatne_usluge_fr',
            'label' => 'lang:novi_oglas_dodatne_usluge_fr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'broj_zvijezdica',
            'label' => 'lang:novi_oglas_broj_zvijezdica',
            'rules' => 'required|xss_clean|numeric'
        ),
        array(
            'field' => 'adresa',
            'label' => 'lang:novi_oglas_adresa',
            'rules' => 'required|max_length[128]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'telefon',
            'label' => 'lang:novi_oglas_telefon',
            'rules' => 'required|max_length[16]|xss_clean|callback_broj_telefona'
        ),
        array(
            'field' => 'mobitel',
            'label' => 'lang:novi_oglas_mobitel',
            'rules' => 'required|max_length[16]|xss_clean|callback_broj_telefona'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:novi_oglas_email',
            'rules' => 'required|max_length[64]|valid_email|xss_clean'
        ),
        array(
            'field' => 'web_stranica',
            'label' => 'lang:novi_oglas_web_stranica',
            'rules' => 'max_length[64]|prep_url|xss_clean'
        ),
        array(
            'field' => 'cijena_objekt',
            'label' => 'lang:novi_oglas_cijena_objekt',
            'rules' => 'max_length[64]|numeric|xss_clean'
        ),
        array(
            'field' => 'jezici',
            'label' => 'lang:novi_oglas_jezici_koje_govori',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'detalji_smjestajne_jedinice',
            'label' => 'lang:novi_oglas_detalji_smjestajne_jedinice',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'detalji_aktivnosti_okolica',
            'label' => 'lang:novi_oglas_detalji_aktivnosti_okolica',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_hr',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_hr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_en',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_en',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_de',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_de',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_it',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_it',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_fr',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_fr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_izleta_hr',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_hr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_izleta_en',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_en',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_izleta_de',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_de',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_izleta_it',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_it',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'opsirniji_opis_izleta_fr',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_fr',
            'rules' => 'xss_clean|callback_text_string'
        ),
        array(
            'field' => 'broj_soba',
            'label' => 'lang:novi_oglas_broj_soba',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'broj_parkirnih_mjesta',
            'label' => 'lang:novi_oglas_broj_parkirnih_mjesta',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'kvadratura_objekta',
            'label' => 'lang:novi_oglas_kvadratura_objekta',
            'rules' => 'max_length[10]|xss_clean' // callback
        ),
        array(
            'field' => 'povrsina_autokampa',
            'label' => 'lang:novi_oglas_povrsina_autokampa',
            'rules' => 'max_length[10]|xss_clean' // callback
        ),
        array(
            'field' => 'broj_kamp_jedinica',
            'label' => 'lang:novi_oglas_broj_kamp_jedinica',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'velicina_plovila',
            'label' => 'lang:novi_oglas_velicina_plovila',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'broj_wc_jedinica',
            'label' => 'lang:novi_oglas_broj_wc_jedinica',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'broj_tuseva',
            'label' => 'lang:novi_oglas_broj_tuseva',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'centar',
            'label' => 'lang:novi_oglas_centar',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'plaza',
            'label' => 'lang:novi_oglas_plaza',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'restoran',
            'label' => 'lang:novi_oglas_restoran',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'posta',
            'label' => 'lang:novi_oglas_posta',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'banka',
            'label' => 'lang:novi_oglas_banka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'ljekarna',
            'label' => 'lang:novi_oglas_ljekarna',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'ambulanta',
            'label' => 'lang:novi_oglas_ambulanta',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'policija',
            'label' => 'lang:novi_oglas_policija',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najblize_mjesto',
            'label' => 'lang:novi_oglas_najblize_mjesto',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najblizi_grad',
            'label' => 'lang:novi_oglas_najblizi_grad',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'autobusna_stanica',
            'label' => 'lang:novi_oglas_autobusna_stanica',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'autobusni_kolodvor',
            'label' => 'lang:novi_oglas_autobusni_kolodvor',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'zracna_luka',
            'label' => 'lang:novi_oglas_zracna_luka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'zeljeznicki_kolodvor',
            'label' => 'lang:novi_oglas_zeljeznicki_kolodvor',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'brodska_luka',
            'label' => 'lang:novi_oglas_brodska_luka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'trgovina',
            'label' => 'lang:novi_oglas_trgovina',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'nogometno_igraliste',
            'label' => 'lang:novi_oglas_nogometno_igraliste',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'kosarkasko_igraliste',
            'label' => 'lang:novi_oglas_kosarkasko_igraliste',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'vaterpolo',
            'label' => 'lang:novi_oglas_vaterpolo',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'odbojka_na_pijesku',
            'label' => 'lang:novi_oglas_odbojka_na_pijesku',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'staza_za_trcanje',
            'label' => 'lang:novi_oglas_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'profesionalno_ronjenje',
            'label' => 'lang:novi_oglas_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najam_camaca',
            'label' => 'lang:novi_oglas_najam_camaca',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'spustanje_camca_u_more',
            'label' => 'lang:novi_oglas_spustanje_camca_u_more',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'duljina_biciklisticke_staze',
            'label' => 'lang:novi_oglas_duljina_biciklisticke_staze',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'jedrenje_na_dasci',
            'label' => 'lang:novi_oglas_jedrenje_na_dasci',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'lunapark_za_djecu',
            'label' => 'lang:novi_oglas_lunapark_za_djecu',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        )
    ), // -- novi aparman
    'novi_oglas_apartman' => array(
        array(
            'field' => 'naziv_apartmana',
            'label' => 'lang:novi_oglas_naziv_apartmana',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num'
        ),
        array(
            'field' => 'broj_soba',
            'label' => 'lang:novi_oglas_broj_soba',
            'rules' => 'required|max_length[2]|numeric|xss_clean'
        ),
        array(
            'field' => 'detalji_apartmana',
            'label' => 'lang:novi_oglas_detalji_smjestajne_jedinice',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'vrsta_usluge',
            'label' => 'lang:novi_oglas_vrsta_usluge',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'predsezona',
            'label' => 'lang:novi_oglas_predsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_predsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'sezona',
            'label' => 'lang:novi_oglas_sezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_sezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'postsezona',
            'label' => 'lang:novi_oglas_postsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_postsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        )
    ), // -- novi oglas potražnja
    'novi_oglas_potraznja' => array(
        array(
            'field' => 'zupanija',
            'label' => 'lang:potraznja_zupanija',
            'rules' => 'required'
        ),
        array(
            'field' => 'mjesto',
            'label' => 'lang:potraznja_mjesto',
            'rules' => 'required'
        ),
        array(
            'field' => 'naslov',
            'label' => 'lang:potraznja_naslov',
            'rules' => 'required|max_length[128]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_num'
        ),
        array(
            'field' => 'tip_smjestaja',
            'label' => 'lang:potraznja_tip_smjestaja',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'adresa',
            'label' => 'lang:potraznja_adresa',
            'rules' => 'required|max_length[128]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_num_dash'
        ),
        array(
            'field' => 'telefon',
            'label' => 'lang:potraznja_telefon',
            'rules' => 'required|min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'mobitel',
            'label' => 'lang:potraznja_mobitel',
            'rules' => 'required|min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:potraznja_email',
            'rules' => 'required|max_length[64]|valid_email|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'datum_postavljanja_oglasa',
            'label' => 'lang:potraznja_datum_dolaska',
            'rules' => 'required|max_length[16]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'datum_prekida_oglasa',
            'label' => 'lang:potraznja_datum_odlaska',
            'rules' => 'required|max_length[16]|xss_clean|prep_for_form|encode_php_tags'
        ),
        /*
          array(
          'field' => 'rezervni_datum_dolaska',
          'label' => 'lang:potraznja_rezervni_datum_dolaska',
          'rules' => 'max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_rezervni_datum_dolaska'
          ),
          array(
          'field' => 'rezervni_datum_odlaska',
          'label' => 'lang:potraznja_rezervni_datum_odlaska',
          'rules' => 'max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_rezervni_datum_odlaska'
          ), */
        array(
            'field' => 'objekt_broj_soba',
            'label' => 'lang:potraznja_objekt_broj_soba',
            'rules' => 'xss_clean'
        ),/*
        array(
            'field' => 'odrasla_osoba_18',
            'label' => 'lang:potraznja_odrasla_osoba_18',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'mlada_osoba_18',
            'label' => 'lang:potraznja_mlada_osoba_18',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'djeca_12',
            'label' => 'lang:potraznja_djeca_12',
            'rules' => 'xss_clean'
        ),*/
        array(
            'field' => 'min_cijena',
            'label' => 'lang:potraznja_cijena_od',
            'rules' => 'numeric|max_length[16]|xss_clean'
        ),
        array(
            'field' => 'max_cijena',
            'label' => 'lang:potraznja_cijena_do',
            'rules' => 'numeric|max_length[16]|xss_clean'
        ),/*
        array(
            'field' => 'cijena_tip',
            'label' => 'lang:potraznja_cijena',
            'rules' => 'xss_clean'
        ),*/
        array(
            'field' => 'tip_objekta',
            'label' => 'lang:tip_objekta',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'objekt_uvjeti',
            'label' => 'lang:objekt_mora_zadovoljiti_uvjete',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'dnevni_boravak',
            'label' => 'lang:potraznja_dnevni_boravak',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'kuhinja',
            'label' => 'lang:potraznja_kuhinja',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'dnevni_boravak',
            'label' => 'lang:potraznja_dnevni_boravak',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'tv',
            'label' => 'lang:potraznja_tv',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'satelit',
            'label' => 'lang:potraznja_satelit',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'tus_kada',
            'label' => 'lang:potraznja_tus_kada',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'kada',
            'label' => 'lang:potraznja_kada',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'pogled',
            'label' => 'lang:potraznja_pogled',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'internet',
            'label' => 'lang:potraznja_internet',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'hladovina',
            'label' => 'lang:potraznja_hladovina',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'sunca_unaokolo',
            'label' => 'lang:potraznja_sunca_unaokolo',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'spavace_sobe',
            'label' => 'lang:potraznja_spavace_sobe',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'kreveti',
            'label' => 'lang:potraznja_kreveti',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'soba_balkon',
            'label' => 'lang:potraznja_soba_balkon',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'soba_wc',
            'label' => 'lang:potraznja_soba_wc',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'soba_tv',
            'label' => 'lang:potraznja_soba_tv',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'soba_satelit',
            'label' => 'lang:potraznja_soba_satelit',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'soba_pogled',
            'label' => 'lang:potraznja_soba_pogled',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'terasa',
            'label' => 'lang:potraznja_terasa',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'klima',
            'label' => 'lang:potraznja_klima',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'ventilator',
            'label' => 'lang:ventilator',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'parking',
            'label' => 'lang:potraznja_parking',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'travnjak',
            'label' => 'lang:potraznja_travnjak',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'bazen',
            'label' => 'lang:potraznja_bazen',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'udaljenost_do_mora',
            'label' => 'lang:potraznja_udaljenost_do_mora',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'udaljenost_do_plaze',
            'label' => 'lang:potraznja_udaljenost_do_plaze',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'oblik_plaze',
            'label' => 'lang:potraznja_oblik_plaze',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'centar',
            'label' => 'lang:potraznja_centar_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'restoran',
            'label' => 'lang:potraznja_restoran_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'trgovina',
            'label' => 'lang:potraznja_trgovina_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'fast_food',
            'label' => 'lang:potraznja_fast_food_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'caffe_bar',
            'label' => 'lang:potraznja_caffe_bar_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'setaliste',
            'label' => 'lang:potraznja_setaliste_uz_more',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'razvedena_obala',
            'label' => 'lang:potraznja_razvedena_obala',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'otoci',
            'label' => 'lang:potraznja_otoci_u_blizini',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'vez_za_camac',
            'label' => 'lang:potraznja_vez_za_camac',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'kucni_ljubimci',
            'label' => 'lang:potraznja_kucni_ljubimci',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'udaljenost_centar',
            'label' => 'lang:potraznja_centar',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_plaza',
            'label' => 'lang:potraznja_plaza',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_restoran',
            'label' => 'lang:potraznja_restoran',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_posta',
            'label' => 'lang:potraznja_posta',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_banka',
            'label' => 'lang:potraznja_banka',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_ljekarna',
            'label' => 'lang:potraznja_ljekarna',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_ambulanta',
            'label' => 'lang:potraznja_ambulanta',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_policija',
            'label' => 'lang:potraznja_policija',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_najblize_mjesto',
            'label' => 'lang:potraznja_najblize_mjesto',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_najblizi_grad',
            'label' => 'lang:potraznja_najblizi_grad',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_autobusna_stanica',
            'label' => 'lang:potraznja_autobusna_stanica',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_autobusni_kolodvor',
            'label' => 'lang:potraznja_autobusni_kolodvor',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_zracna_luka',
            'label' => 'lang:potraznja_zracna_luka',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_zeljeznicki_kolodvor',
            'label' => 'lang:potraznja_zeljeznicki_kolodvor',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_brodska_luka',
            'label' => 'lang:potraznja_brodska_luka',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_trgovina',
            'label' => 'lang:potraznja_trgovina',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_nogometno_igraliste',
            'label' => 'lang:potraznja_nogometno_igraliste',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_kosarkasko_igraliste',
            'label' => 'lang:potraznja_kosarkasko_igraliste',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_vaterpolo',
            'label' => 'lang:potraznja_vaterpolo',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_odbojka_na_pijesku',
            'label' => 'lang:potraznja_odbojka_na_pijesku',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_staza_za_trcanje',
            'label' => 'lang:potraznja_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_profesionalno_ronjenje',
            'label' => 'lang:potraznja_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_najam_camaca',
            'label' => 'lang:potraznja_najam_camaca',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_spustanje_camca_u_more',
            'label' => 'lang:potraznja_spustanje_camca_u_more',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_duljina_biciklisticke_staze',
            'label' => 'lang:potraznja_duljina_biciklisticke_staze',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_jedrenje_na_dasci',
            'label' => 'lang:potraznja_jedrenje_na_dasci',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        ),
        array(
            'field' => 'udaljenost_lunapark_za_djecu',
            'label' => 'lang:potraznja_lunapark_za_djecu',
            'rules' => 'max_length[10]|xss_clean|prep_for_form|encode_php_tags|callback_udaljenost'
        )
    ),
    'registracija' => array(
        array(
            'field' => 'tip_korisnika',
            'label' => 'lang:registracija_tip_korisnika',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'ime',
            'label' => 'lang:registracija_ime',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_space'
        ),
        array(
            'field' => 'prezime',
            'label' => 'lang:registracija_prezime',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_space'
        ),
        array(
            'field' => 'korisnicko_ime',
            'label' => 'lang:registracija_korisnicko_ime',
            'rules' => 'required|alpha_dash|max_length[24]|callback_username_check|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'lozinka',
            'label' => 'lang:registracija_lozinka',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'potvrda_lozinke',
            'label' => 'lang:registracija_potvrda_lozinke',
            'rules' => 'required|matches[lozinka]|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:registracija_email',
            'rules' => 'required|max_length[48]|valid_email|xss_clean|prep_for_form|encode_php_tags|callback_email_check'
        ),
        array(
            'field' => 'adresa',
            'label' => 'lang:registracija_adresa',
            'rules' => 'max_length[48]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_num_dash'
        ),
        array(
            'field' => 'broj_poste',
            'label' => 'lang:registracija_postanski_broj',
            'rules' => 'numeric|exact_length[5]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'grad',
            'label' => 'lang:grad',
            'rules' => 'max_length[24]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_space'
        ),
        array(
            'field' => 'drzava',
            'label' => 'lang:registracija_drzava',
            'rules' => 'alpha|max_length[24]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_space'
        ),
        array(
            'field' => 'broj_telefona',
            'label' => 'lang:registracija_broj_telefona',
            'rules' => 'min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'broj_mobitela',
            'label' => 'lang:registracija_broj_mobitela',
            'rules' => 'min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'oib',
            'label' => 'lang:registracija_oib',
            'rules' => 'numeric|exact_length[11]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'naziv_tvrtke',
            'label' => 'lang:registracija_tvrtka',
            'rules' => 'max_length[32]|xss_clean|prep_for_form|encode_php_tags|callback_alpha_num_dash'
        ),
        array(
            'field' => 'uvjeti_koristenja',
            'label' => 'lang:registracija_uvjeti_koristenja',
            'rules' => 'callback_user_agreement|xss_clean|prep_for_form|encode_php_tags'
        )
    ),
    'prijava' => array(
        array(
            'field' => 'prijava_korisnicko_ime',
            'label' => 'lang:com_mod_login_korisnicko_ime',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'prijava_lozinka',
            'label' => 'lang:com_mod_login_lozinka',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags'
        )
    ),
    'trazi' => array(
        array(
            'field' => 'upit',
            'label' => 'lang:trazi_upit',
            'rules' => 'xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'zupanija',
            'label' => 'lang:trazi_zupanija',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'mjesto',
            'label' => 'lang:trazi_mjesto',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'tip_smjestaja',
            'label' => 'lang:trazi_tip_smjestaja',
            'rules' => 'xss_clean'
        )
    ),
    'zaboravljena_lozinka' => array(
        array(
            'field' => 'email',
            'label' => 'lang:zaboravljena_lozinka_email_label',
            'rules' => 'required|max_length[48]|valid_email|callback_zaboravljena_lozinka_email_check|xss_clean|prep_for_form|encode_php_tags'
        )
    ),
    'administrator_novi_korisnik' => array(
        array(
            'field' => 'tip_korisnika',
            'label' => 'Tip korisnika',
            'rules' => 'required|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'ime',
            'label' => 'Ime',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'prezime',
            'label' => 'Prezime',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'korisnicko_ime',
            'label' => 'Korisničko ime',
            'rules' => 'required|max_length[24]|callback_username_check|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'lozinka',
            'label' => 'Lozinka',
            'rules' => 'required|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'potvrda_lozinke',
            'label' => 'Potvrda lozinke',
            'rules' => 'required|matches[lozinka]|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'email',
            'label' => 'E-mail adresa',
            'rules' => 'required|max_length[48]|valid_email|callback_email_check|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'adresa',
            'label' => 'Adresa',
            'rules' => 'max_length[48]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'broj_poste',
            'label' => 'Poštanski broj',
            'rules' => 'numeric|exact_length[5]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'grad',
            'label' => 'Grad',
            'rules' => 'alpha|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'drzava',
            'label' => 'Država',
            'rules' => 'alpha|max_length[24]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'broj_telefona',
            'label' => 'Broj telefona',
            'rules' => 'min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'broj_mobitela',
            'label' => 'Broj mobitela',
            'rules' => 'min_length[6]|max_length[16]|xss_clean|prep_for_form|encode_php_tags|callback_broj_telefona'
        ),
        array(
            'field' => 'oib',
            'label' => 'OIB',
            'rules' => 'numeric|exact_length[11]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'naziv_tvrtke',
            'label' => 'Tvrtka/obrt',
            'rules' => 'max_length[32]|xss_clean|prep_for_form|encode_php_tags'
        )
    ),
    'administrator_novi_oglas' => array(
        array(
            'field' => 'zupanija',
            'label' => 'lang:novi_oglas_zupanija',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'mjesto',
            'label' => 'lang:novi_oglas_mjesto',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'ime_korisnika',
            'label' => 'Ime korisnika',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'korisnik',
            'label' => 'Korisnik',
            'rules' => 'numeric|required|xss_clean'
        ),
        array(
            'field' => 'geo-lat',
            'label' => 'lang:novi_oglas_latitude',
            'rules' => 'required|max_length[32]|decimal|xss_clean'
        ),
        array(
            'field' => 'geo-lng',
            'label' => 'lang:novi_oglas_longitude',
            'rules' => 'required|max_length[32]|decimal|xss_clean'
        ),
        array(
            'field' => 'naziv_objekta',
            'label' => 'lang:novi_oglas_naziv_objekta',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num'
        ),
        array(
            'field' => 'tip_smjestaja',
            'label' => 'lang:novi_oglas_tip_smjestaja',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'dodatne_usluge_hr',
            'label' => 'lang:novi_oglas_dodatne_usluge_hr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'dodatne_usluge_en',
            'label' => 'lang:novi_oglas_dodatne_usluge_en',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'dodatne_usluge_de',
            'label' => 'lang:novi_oglas_dodatne_usluge_de',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'dodatne_usluge_it',
            'label' => 'lang:novi_oglas_dodatne_usluge_it',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'dodatne_usluge_fr',
            'label' => 'lang:novi_oglas_dodatne_usluge_fr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'broj_zvijezdica',
            'label' => 'lang:novi_oglas_broj_zvijezdica',
            'rules' => 'required|xss_clean|numeric'
        ),
        array(
            'field' => 'adresa',
            'label' => 'lang:novi_oglas_adresa',
            'rules' => 'required|max_length[128]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'telefon',
            'label' => 'lang:novi_oglas_telefon',
            'rules' => 'required|max_length[16]|xss_clean|callback_broj_telefona'
        ),
        array(
            'field' => 'mobitel',
            'label' => 'lang:novi_oglas_mobitel',
            'rules' => 'required|max_length[16]|xss_clean|callback_broj_telefona'
        ),
        array(
            'field' => 'email',
            'label' => 'lang:novi_oglas_email',
            'rules' => 'required|max_length[64]|valid_email|xss_clean'
        ),
        array(
            'field' => 'web_stranica',
            'label' => 'lang:novi_oglas_web_stranica',
            'rules' => 'max_length[64]|prep_url|xss_clean'
        ),
        array(
            'field' => 'jezici',
            'label' => 'lang:novi_oglas_jezici_koje_govori',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'detalji_smjestajne_jedinice',
            'label' => 'lang:novi_oglas_detalji_smjestajne_jedinice',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'detalji_auto_kampa',
            'label' => 'lang:novi_oglas_detalji_auto_kampa',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_hr',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_hr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_en',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_en',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_de',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_de',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_it',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_it',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_smjestaja_fr',
            'label' => 'lang:novi_oglas_opsirniji_opis_smjestaja_fr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_izleta_hr',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_hr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_izleta_en',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_en',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_izleta_de',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_de',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_izleta_it',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_it',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'opsirniji_opis_izleta_fr',
            'label' => 'lang:novi_oglas_opsirniji_opis_izleta_fr',
            'rules' => 'xss_clean' // -- callback
        ),
        array(
            'field' => 'broj_soba',
            'label' => 'lang:novi_oglas_broj_soba',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'broj_parkirnih_mjesta',
            'label' => 'lang:novi_oglas_broj_parkirnih_mjesta',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'kvadratura_objekta',
            'label' => 'lang:novi_oglas_kvadratura_objekta',
            'rules' => 'max_length[10]|xss_clean' // callback
        ),
        array(
            'field' => 'povrsina_autokampa',
            'label' => 'lang:novi_oglas_povrsina_autokampa',
            'rules' => 'max_length[10]|xss_clean' // callback
        ),
        array(
            'field' => 'broj_kamp_jedinica',
            'label' => 'lang:novi_oglas_broj_kamp_jedinica',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'velicina_plovila',
            'label' => 'lang:novi_oglas_velicina_plovila',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'broj_wc_jedinica',
            'label' => 'lang:novi_oglas_broj_wc_jedinica',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'broj_tuseva',
            'label' => 'lang:novi_oglas_broj_tuseva',
            'rules' => 'numeric|max_length[10]|xss_clean'
        ),
        array(
            'field' => 'centar',
            'label' => 'lang:novi_oglas_centar',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'plaza',
            'label' => 'lang:novi_oglas_plaza',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'restoran',
            'label' => 'lang:novi_oglas_restoran',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'posta',
            'label' => 'lang:novi_oglas_posta',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'banka',
            'label' => 'lang:novi_oglas_banka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'ljekarna',
            'label' => 'lang:novi_oglas_ljekarna',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'ambulanta',
            'label' => 'lang:novi_oglas_ambulanta',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'policija',
            'label' => 'lang:novi_oglas_policija',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najblize_mjesto',
            'label' => 'lang:novi_oglas_najblize_mjesto',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najblizi_grad',
            'label' => 'lang:novi_oglas_najblizi_grad',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'autobusna_stanica',
            'label' => 'lang:novi_oglas_autobusna_stanica',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'autobusni_kolodvor',
            'label' => 'lang:novi_oglas_autobusni_kolodvor',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'zracna_luka',
            'label' => 'lang:novi_oglas_zracna_luka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'zeljeznicki_kolodvor',
            'label' => 'lang:novi_oglas_zeljeznicki_kolodvor',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'brodska_luka',
            'label' => 'lang:novi_oglas_brodska_luka',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'trgovina',
            'label' => 'lang:novi_oglas_trgovina',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'nogometno_igraliste',
            'label' => 'lang:novi_oglas_nogometno_igraliste',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'kosarkasko_igraliste',
            'label' => 'lang:novi_oglas_kosarkasko_igraliste',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'vaterpolo',
            'label' => 'lang:novi_oglas_vaterpolo',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'odbojka_na_pijesku',
            'label' => 'lang:novi_oglas_odbojka_na_pijesku',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'staza_za_trcanje',
            'label' => 'lang:novi_oglas_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'profesionalno_ronjenje',
            'label' => 'lang:novi_oglas_staza_za_trcanje',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'najam_camaca',
            'label' => 'lang:novi_oglas_najam_camaca',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'spustanje_camca_u_more',
            'label' => 'lang:novi_oglas_spustanje_camca_u_more',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'duljina_biciklisticke_staze',
            'label' => 'lang:novi_oglas_duljina_biciklisticke_staze',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'jedrenje_na_dasci',
            'label' => 'lang:novi_oglas_jedrenje_na_dasci',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        ),
        array(
            'field' => 'lunapark_za_djecu',
            'label' => 'lang:novi_oglas_lunapark_za_djecu',
            'rules' => 'max_length[10]|xss_clean|callback_udaljenost'
        )
    ),
    'administrator_novi_apartman_oglas' => array(
        array(
            'field' => 'naziv_apartmana',
            'label' => 'lang:novi_oglas_naziv_apartmana',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num'
        ),
        array(
            'field' => 'broj_soba',
            'label' => 'lang:novi_oglas_broj_soba',
            'rules' => 'required|numeric|max_length[2]|xss_clean'
        ),
        array(
            'field' => 'detalji_apartmana',
            'label' => 'lang:novi_oglas_detalji_smjestajne_jedinice',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'vrsta_usluge',
            'label' => 'lang:novi_oglas_vrsta_usluge',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'predsezona',
            'label' => 'lang:novi_oglas_predsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_predsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'sezona',
            'label' => 'lang:novi_oglas_sezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_sezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'postsezona',
            'label' => 'lang:novi_oglas_postsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_postsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        )
    ),/*
    'administrator_novi_apartman' => array(
        array(
            'field' => 'naziv_apartmana',
            'label' => 'lang:novi_oglas_naziv_apartmana',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num'
        ),
        array(
            'field' => 'broj_soba',
            'label' => 'lang:novi_oglas_broj_soba',
            'rules' => 'required|numeric|max_length[2]|xss_clean'
        ),
        array(
            'field' => 'ime_korisnika',
            'label' => 'Ime korisnika',
            'rules' => 'required|xss_clean'
        ),
        array(
            'field' => 'oglas',
            'label' => 'Oglas',
            'rules' => 'required|numeric|xss_clean'
        ),
        array(
            'field' => 'detalji_apartmana',
            'label' => 'lang:novi_oglas_detalji_smjestajne_jedinice',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'vrsta_usluge',
            'label' => 'lang:novi_oglas_vrsta_usluge',
            'rules' => 'required|max_length[32]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'predsezona',
            'label' => 'lang:novi_oglas_predsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_predsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'sezona',
            'label' => 'lang:novi_oglas_sezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_sezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        ),
        array(
            'field' => 'postsezona',
            'label' => 'lang:novi_oglas_postsezona',
            'rules' => 'required|max_length[64]|xss_clean|callback_alpha_num_dash'
        ),
        array(
            'field' => 'cijena_postsezona',
            'label' => 'lang:novi_oglas_cijena',
            'rules' => 'required|max_length[16]|xss_clean|callback_cijena'
        )
    ),*/
    'administrator_novi_banner' => array(
        array(
            'field' => 'naziv_bannera',
            'label' => 'Naziv bannera',
            'rules' => 'required|max_length[64]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'web_stranica',
            'label' => 'Web stranica',
            'rules' => 'required|max_length[255]|xss_clean|prep_url|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'datum_isteka',
            'label' => 'Datum isteka',
            'rules' => 'required|max_length[12]|xss_clean|prep_for_form|encode_php_tags'
        ),
        array(
            'field' => 'slika',
            'label' => 'Slika',
            'rules' => 'xss_clean'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validation.php */
