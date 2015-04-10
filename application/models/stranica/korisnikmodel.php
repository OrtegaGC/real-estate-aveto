<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Korisnikmodel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('funkcija');
    }

    //-- 
    private function dbInputString($data, $delimiter) {
        $result = '';
        switch ($delimiter) {
            case 1:
                if ($data != '') {
                    foreach ($data as $d_value) {
                        $result .= $d_value . ';';
                    }
                }
                return $result;
                break;
            case 2:
                foreach ($data as $d_value) {
                    if ($this->input->post($d_value) != '') {
                        $result .= $d_value . ':' . $this->input->post($d_value) . ';';
                    }
                }
                return $result;
                break;

            default:
                return $result;
                break;
        }
    }

    public function korisnikPrijava() {
        $this->db->cache_off();
        $korisnicko_ime = $this->input->post('prijava_korisnicko_ime');
        $lozinka = $this->input->post('prijava_lozinka');
        $this->db->select('korisnikID, tipID, korisnicko_ime, lozinka');
        $this->db->from('korisnik');
        $this->db->where('korisnicko_ime', $korisnicko_ime);

        $query = $this->db->get();
        $result = $query->result_array();
        if (empty($result)) {
            return FALSE;
        } else {
            //if ( $korisnicko_ime == $result[0]['korisnicko_ime'] && crypt($lozinka, $result[0]['lozinka']) == $result[0]['lozinka'] ) // -- stara metoda provjere
            // -- nova metoda provjere
            $pass_array = explode(':', $result[0]['lozinka']);
            $hash_pass = $pass_array[0];
            $hash_salt = $pass_array[1];
            if ($korisnicko_ime == $result[0]['korisnicko_ime'] && $hash_pass == md5($lozinka . $hash_salt)) {
                $userData = array(
                    'ID' => $result[0]['korisnikID'],
                    'korisnicko_ime' => $result[0]['korisnicko_ime'],
                    'tip' => $result[0]['tipID'],
                    'match' => TRUE
                );
                return $userData;
            } else {
                return FALSE;
            }
        }
    }

    // -- zaboravljena lozinka
    public function zaboravljenaLozinka($email, $lozinka) {
        $data['lozinka'] = $lozinka;
        $this->db->where('email', $email);
        $this->db->update('korisnik', $data);
        $this->db->cache_delete('korisnik', 'prijava');
    }

    // -- zadnji oglas
    public function zadnjiOglas($korisnikID) {
        $this->db->cache_off();
        $this->db->select('temp_oglas.oglasID');
        $this->db->from('temp_oglas');
        $this->db->join('oglas', 'temp_oglas.oglasID = oglas.oglasID');
        $this->db->join('korisnik', 'oglas.korisnikID = korisnik.korisnikID');
        $this->db->where('oglas.korisnikID', $korisnikID);
        $this->db->where('zavrsen', 0);
        $this->db->order_by('oglasID', 'desc');
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->result_array();
    }

    // -- spremanje oglasa
    public function spremiOglas() {
        $data_ostale_informacije = array('kvadratura_objekta', 'broj_soba', 'broj_parkirnih_mjesta', 'povrsina_autokampa',
            'broj_kamp_jedinica', 'broj_wc_jedinica', 'broj_tuseva', 'velicina_plovila',
            'centar', 'plaza', 'restoran', 'posta', 'banka', 'ljekarna',
            'ambulanta', 'policija', 'najblize_mjesto', 'najblizi_grad', 'autobusna_stanica', 'autobusni_kolodvor',
            'zracna_luka', 'zeljeznicki_kolodvor', 'brodska_luka', 'trgovina', 'nogometno_igraliste', 'kosarkasko_igraliste',
            'vaterpolo', 'profesionalno_trcanje', 'staza_za_trcanje', 'profesionalno_ronjenje', 'najam_camaca', 'spustanje_camca_u_more',
            'duljina_biciklisticke_staze', 'jedrenje_na_dasci', 'lunapark_za_djecu'
        );

        $ostale_informacije = $this->dbInputString($data_ostale_informacije, 2);
        $detalji_aktivnosti_okolica = $this->dbInputString($this->input->post('detalji_aktivnosti'), 1);

        $data = array(
            'korisnikID' => $this->session->userdata('ID'),
            'mjestoID' => $this->input->post('mjesto'),
            'lokacijaLatitude' => $this->input->post('geo-lat'),
            'lokacijaLongitude' => $this->input->post('geo-lng'),
            'nazivObjekta' => $this->input->post('naziv_objekta'),
            'tipSmjestaja' => $this->input->post('tip_smjestaja'),
            'dodatneUslugeHr' => $this->input->post('dodatne_usluge_hr'),
            'dodatneUslugeEn' => $this->input->post('dodatne_usluge_en'),
            'dodatneUslugeDe' => $this->input->post('dodatne_usluge_de'),
            'dodatneUslugeIt' => $this->input->post('dodatne_usluge_it'),
            'dodatneUslugeFr' => $this->input->post('dodatne_usluge_fr'),
            'brojZvijezdica' => $this->input->post('broj_zvijezdica'),
            'adresaBrojPoste' => $this->input->post('adresa'),
            'telefon' => $this->input->post('telefon'),
            'mobitel' => $this->input->post('mobitel'),
            'email' => $this->input->post('email'),
            'webStranica' => $this->input->post('web_stranica'),
            'jeziciDomacin' => '',
            'detaljiSmjestajneJedinice' => '',
            'detaljiAktivnostiOkolica' => $detalji_aktivnosti_okolica,
            'opsirnijiOpisSmjestajaHr' => $this->input->post('opsirniji_opis_smjestaja_hr'),
            'opsirnijiOpisSmjestajaEn' => $this->input->post('opsirniji_opis_smjestaja_en'),
            'opsirnijiOpisSmjestajaDe' => $this->input->post('opsirniji_opis_smjestaja_de'),
            'opsirnijiOpisSmjestajaIt' => $this->input->post('opsirniji_opis_smjestaja_it'),
            'opsirnijiOpisSmjestajaFr' => $this->input->post('opsirniji_opis_smjestaja_fr'),
            'opsirnijiOpisIzletaHr' => $this->input->post('opsirniji_opis_izlet_hr'),
            'opsirnijiOpisIzletaEn' => $this->input->post('opsirniji_opis_izlet_en'),
            'opsirnijiOpisIzletaDe' => $this->input->post('opsirniji_opis_izlet_de'),
            'opsirnijiOpisIzletaIt' => $this->input->post('opsirniji_opis_izlet_it'),
            'opsirnijiOpisIzletaFr' => $this->input->post('opsirniji_opis_izlet_fr'),
            'kvadraturaObjekta' => $this->input->post('kvadratura_objekta'),
            'brojSpavacihSoba' => $this->input->post('broj_soba'),
            'brojParkirnihMjesta' => $this->input->post('broj_parkirnih_mjesta'),
            'povrsinaAutokampa' => $this->input->post('povrsina_autokampa'),
            'brojKampJedinica' => $this->input->post('broj_kamp_jedinica'),
            'brojWcJedinica' => $this->input->post('broj_wc_jedinica'),
            'brojTuseva' => $this->input->post('broj_tuseva'),
            'velicinaPlovila' => $this->input->post('velicina_plovila'),
            'centar' => $this->input->post('centar'),
            'plaza' => $this->input->post('plaza'),
            'restoran' => $this->input->post('restoran'),
            'trgovina' => $this->input->post('trgovina'),
            'posta' => $this->input->post('posta'),
            'banka' => $this->input->post('banka'),
            'ljekarna' => $this->input->post('ljekarna'),
            'ambulanta' => $this->input->post('ambulanta'),
            'policija' => $this->input->post('policija'),
            'najblizeMjesto' => $this->input->post('najblize_mjesto'),
            'najbliziGrad' => $this->input->post('najblizi_grad'),
            'autobusnaStanica' => $this->input->post('autobusna_stanica'),
            'autobusniKolodvor' => $this->input->post('autobusni_kolodvor'),
            'zeljeznickiKolodvor' => $this->input->post('zeljeznicki_kolodvor'),
            'zracnaLuka' => $this->input->post('zracna_luka'),
            'brodskaLuka' => $this->input->post('brodska_luka'),
            'nogometnoIgraliste' => $this->input->post('nogometno_igraliste'),
            'kosarkaskoIgraliste' => $this->input->post('kosarkasko_igraliste'),
            'vaterpolo' => $this->input->post('vaterpolo'),
            'stazaZaTrcanje' => $this->input->post('staza_za_trcanje'),
            'profesionalnoRonjenje' => $this->input->post('profesionalno_ronjenje'),
            'profesionalnoTrcanje' => $this->input->post('profesionalno_trcanje'),
            'duljinaBiciklistickeStaze' => $this->input->post('duljina_biciklisticke_staze'),
            'jedrenjeNaDasci' => $this->input->post('jedrenje_na_dasci'),
            'najamCamaca' => $this->input->post('najam_camaca'),
            'spustanjeCamca' => $this->input->post('spustanje_camca_u_more'),
            'lunapark' => $this->input->post('lunapark_za_djecu'),
            'ostaleInformacije' => $ostale_informacije,
            'slike' => '-',
            'datumObjave' => $this->funkcija->dbInputDate(),
            'aktivan' => 1,
            'vidljiv' => 1
        );

        $jezici = $this->input->post('jezici');
        $detalji_smjestajne_jedinice = $this->input->post('detalji_smjestajne_jedinice');
        $detalji_aktivnosti_okolica = $this->input->post('detalji_aktivnosti_okolica');

        if (!empty($jezici)) {
            foreach ($this->input->post('jezici') as $value) {
                $data['jeziciDomacin'] .= $value . ';';
            }
        }

        if (!empty($detalji_smjestajne_jedinice)) {
            foreach ($this->input->post('detalji_smjestajne_jedinice') as $value) {
                $data['detaljiSmjestajneJedinice'] .= $value . ';';
            }
        }

        if (!empty($detalji_aktivnosti_okolica)) {
            foreach ($this->input->post('detalji_aktivnosti_okolica') as $key => $value) {
                $data['detaljiAktivnostiOkolica'] .= $value . ';';
            }
        }

        $this->db->insert('oglas', $data);
    }

    // -- spremanje slika za objekt
    public function spremiSlikeObjekt($slike, $oglasID) {
        $data = array('slike' => $slike);

        $this->db->where('oglasID', $oglasID);
        $this->db->update('oglas', $data);
    }

    // -- spremanje apartmana
    public function spremiApartman($slike, $oglasID) {
        $detalji_apartmana = '';
        $detalji_apartmana_post = $this->input->post('detalji_apartmana');

        if (!empty($detalji_apartmana_post)) {
            foreach ($detalji_apartmana_post as $da_value) {
                $detalji_apartmana .= $da_value . ';';
            }
        }

        $data = array(
            'oglasID' => $oglasID,
            'nazivApartmana' => $this->input->post('naziv_apartmana'),
            'brojSoba' => $this->input->post('broj_soba'),
            'vrstaUsluge' => $this->input->post('vrsta_usluge'),
            'detaljiApartmana' => $detalji_apartmana,
            'predsezona' => $this->input->post('predsezona'),
            'sezona' => $this->input->post('sezona'),
            'postsezona' => $this->input->post('postsezona'),
            'cijenaPredsezona' => $this->input->post('cijena_predsezona'),
            'cijenaSezona' => $this->input->post('cijena_sezona'),
            'cijenaPostsezona' => $this->input->post('cijena_postsezona'),
            'slike' => $slike
        );

        $this->db->insert('apartman', $data);
    }

    // -- spremanje promjena oglasa
    public function spremiPromjeneOglasa($oglas_id) {
        $data_ostale_informacije = array('kvadratura_objekta', 'broj_soba', 'broj_parkirnih_mjesta', 'povrsina_autokampa',
            'broj_kamp_jedinica', 'broj_wc_jedinica', 'broj_tuseva', 'velicina_plovila',
            'centar', 'plaza', 'restoran', 'posta', 'banka', 'ljekarna',
            'ambulanta', 'policija', 'najblize_mjesto', 'najblizi_grad', 'autobusna_stanica', 'autobusni_kolodvor',
            'zracna_luka', 'zeljeznicki_kolodvor', 'brodska_luka', 'trgovina', 'nogometno_igraliste', 'kosarkasko_igraliste',
            'vaterpolo', 'profesionalno_trcanje', 'staza_za_trcanje', 'profesionalno_ronjenje', 'najam_camaca', 'spustanje_camca_u_more',
            'duljina_biciklisticke_staze', 'jedrenje_na_dasci', 'lunapark_za_djecu'
        );

        $ostale_informacije = $this->dbInputString($data_ostale_informacije, 2);
        $detalji_aktivnosti_okolica = $this->dbInputString($this->input->post('detalji_aktivnosti'), 1);

        $data = array(
            'mjestoID' => $this->input->post('mjesto'),
            'lokacijaLatitude' => $this->input->post('geo-lat'),
            'lokacijaLongitude' => $this->input->post('geo-lng'),
            'nazivObjekta' => $this->input->post('naziv_objekta'),
            'tipSmjestaja' => $this->input->post('tip_smjestaja'),
            'dodatneUslugeHr' => $this->input->post('dodatne_usluge_hr'),
            'dodatneUslugeEn' => $this->input->post('dodatne_usluge_en'),
            'dodatneUslugeDe' => $this->input->post('dodatne_usluge_de'),
            'dodatneUslugeIt' => $this->input->post('dodatne_usluge_it'),
            'dodatneUslugeFr' => $this->input->post('dodatne_usluge_fr'),
            'brojZvijezdica' => $this->input->post('broj_zvijezdica'),
            'adresaBrojPoste' => $this->input->post('adresa'),
            'telefon' => $this->input->post('telefon'),
            'mobitel' => $this->input->post('mobitel'),
            'email' => $this->input->post('email'),
            'webStranica' => $this->input->post('web_stranica'),
            'cijenaObjekt' => $this->input->post('cijena_objekt'),
            'jeziciDomacin' => '',
            'detaljiSmjestajneJedinice' => '',
            'detaljiAktivnostiOkolica' => $detalji_aktivnosti_okolica,
            'opsirnijiOpisSmjestajaHr' => $this->input->post('opsirniji_opis_smjestaja_hr'),
            'opsirnijiOpisSmjestajaEn' => $this->input->post('opsirniji_opis_smjestaja_en'),
            'opsirnijiOpisSmjestajaDe' => $this->input->post('opsirniji_opis_smjestaja_de'),
            'opsirnijiOpisSmjestajaIt' => $this->input->post('opsirniji_opis_smjestaja_it'),
            'opsirnijiOpisSmjestajaFr' => $this->input->post('opsirniji_opis_smjestaja_fr'),
            'opsirnijiOpisIzletaHr' => $this->input->post('opsirniji_opis_izlet_hr'),
            'opsirnijiOpisIzletaEn' => $this->input->post('opsirniji_opis_izlet_en'),
            'opsirnijiOpisIzletaDe' => $this->input->post('opsirniji_opis_izlet_de'),
            'opsirnijiOpisIzletaIt' => $this->input->post('opsirniji_opis_izlet_it'),
            'opsirnijiOpisIzletaFr' => $this->input->post('opsirniji_opis_izlet_fr'),
            'kvadraturaObjekta' => $this->input->post('kvadratura_objekta'),
            'brojSpavacihSoba' => $this->input->post('broj_soba'),
            'brojParkirnihMjesta' => $this->input->post('broj_parkirnih_mjesta'),
            'povrsinaAutokampa' => $this->input->post('povrsina_autokampa'),
            'brojKampJedinica' => $this->input->post('broj_kamp_jedinica'),
            'brojWcJedinica' => $this->input->post('broj_wc_jedinica'),
            'brojTuseva' => $this->input->post('broj_tuseva'),
            'velicinaPlovila' => $this->input->post('velicina_plovila'),
            'centar' => $this->input->post('centar'),
            'plaza' => $this->input->post('plaza'),
            'restoran' => $this->input->post('restoran'),
            'trgovina' => $this->input->post('trgovina'),
            'posta' => $this->input->post('posta'),
            'banka' => $this->input->post('banka'),
            'ljekarna' => $this->input->post('ljekarna'),
            'ambulanta' => $this->input->post('ambulanta'),
            'policija' => $this->input->post('policija'),
            'najblizeMjesto' => $this->input->post('najblize_mjesto'),
            'najbliziGrad' => $this->input->post('najblizi_grad'),
            'autobusnaStanica' => $this->input->post('autobusna_stanica'),
            'autobusniKolodvor' => $this->input->post('autobusni_kolodvor'),
            'zeljeznickiKolodvor' => $this->input->post('zeljeznicki_kolodvor'),
            'zracnaLuka' => $this->input->post('zracna_luka'),
            'brodskaLuka' => $this->input->post('brodska_luka'),
            'nogometnoIgraliste' => $this->input->post('nogometno_igraliste'),
            'kosarkaskoIgraliste' => $this->input->post('kosarkasko_igraliste'),
            'vaterpolo' => $this->input->post('vaterpolo'),
            'stazaZaTrcanje' => $this->input->post('staza_za_trcanje'),
            'profesionalnoRonjenje' => $this->input->post('profesionalno_ronjenje'),
            'profesionalnoTrcanje' => $this->input->post('profesionalno_trcanje'),
            'duljinaBiciklistickeStaze' => $this->input->post('duljina_biciklisticke_staze'),
            'jedrenjeNaDasci' => $this->input->post('jedrenje_na_dasci'),
            'najamCamaca' => $this->input->post('najam_camaca'),
            'spustanjeCamca' => $this->input->post('spustanje_camca_u_more'),
            'lunapark' => $this->input->post('lunapark_za_djecu'),
            'ostaleInformacije' => $ostale_informacije
        );

        $jezici = $this->input->post('jezici');
        $detalji_smjestajne_jedinice = $this->input->post('detalji_smjestajne_jedinice');
        $detalji_aktivnosti_okolica = $this->input->post('detalji_aktivnosti_okolica');

        if (!empty($jezici)) {
            foreach ($this->input->post('jezici') as $value) {
                $data['jeziciDomacin'] .= $value . ';';
            }
        }

        if (!empty($detalji_smjestajne_jedinice)) {
            foreach ($this->input->post('detalji_smjestajne_jedinice') as $value) {
                $data['detaljiSmjestajneJedinice'] .= $value . ';';
            }
        }

        if (!empty($detalji_aktivnosti_okolica)) {
            foreach ($this->input->post('detalji_aktivnosti_okolica') as $key => $value) {
                $data['detaljiAktivnostiOkolica'] .= $value . ';';
            }
        }

        $this->db->where('oglasID', $oglas_id);
        $this->db->update('oglas', $data);
    }

    // -- spremanje apartmana
    public function spremiPromjeneUsluge($apartman_id) {
        $detalji_apartmana = '';
        $detalji_apartmana_post = $this->input->post('detalji_apartmana');

        if (!empty($detalji_apartmana_post)) {
            foreach ($detalji_apartmana_post as $da_value) {
                $detalji_apartmana .= $da_value . ';';
            }
        }

        $data = array(
            'nazivApartmana' => $this->input->post('naziv_apartmana'),
            'brojSoba' => $this->input->post('broj_soba'),
            'vrstaUsluge' => $this->input->post('vrsta_usluge'),
            'detaljiApartmana' => $detalji_apartmana,
            'predsezona' => $this->input->post('predsezona'),
            'sezona' => $this->input->post('sezona'),
            'postsezona' => $this->input->post('postsezona'),
            'cijenaPredsezona' => $this->input->post('cijena_predsezona'),
            'cijenaSezona' => $this->input->post('cijena_sezona'),
            'cijenaPostsezona' => $this->input->post('cijena_postsezona')
        );

        $this->db->where('apartmanID', $apartman_id);
        $this->db->update('apartman', $data);
    }

    // -- spremanje promjena slika apartman(usluga)/oglas
    public function spremiPromjeneSlika($tip, $tip_id, $slike) {
        switch ($tip) {
            case 'objekt':
                $data['slike'] = $slike;
                $this->db->where('oglasID', $tip_id);
                $this->db->update('oglas', $data);
                break;
            case 'apartman':
                $data['slike'] = $slike;
                $this->db->where('apartmanID', $tip_id);
                $this->db->update('apartman', $data);
                break;

            default:
                return FALSE;
                break;
        }
    }

    // -- spremi oglas potražnja 
    public function spremiOglasPotraznja() {
        $data_sobe = array('objekt_broj_soba');
        $data_udaljenost = array('udaljenost_centar', 'udaljenost_plaza', 'udaljenost_restoran', 'udaljenost_posta', 'udaljenost_banka', 'udaljenost_ljekarna',
            'udaljenost_ambulanta', 'udaljenost_policija', 'udaljenost_najblize_mjesto', 'udaljenost_najblizi_grad', 'udaljenost_autobusna_stanica', 'udaljenost_autobusni_kolodvor',
            'udaljenost_zracna_luka', 'udaljenost_zeljeznicki_kolodvor', 'udaljenost_brodska_luka', 'udaljenost_trgovina', 'udaljenost_nogometno_igraliste', 'udaljenost_kosarkasko_igraliste',
            'udaljenost_vaterpolo', 'udaljenost_profesionalno_trcanje', 'udaljenost_staza_za_trcanje', 'udaljenost_profesionalno_ronjenje', 'udaljenost_najam_camaca', 'udaljenost_spustanje_camca_u_more',
            'udaljenost_duljina_biciklisticke_staze', 'udaljenost_jedrenje_na_dasci', 'udaljenost_lunapark_za_djecu'
        );
        $data_opcije_soba = array('dnevni_boravak', 'kuhinja', 'tv', 'satelit', 'tus_kada', 'kada', 'pogled', 'internet', 'hladovina',
            'sunca_unaokolo', 'spavace_sobe', 'kreveti', 'soba_balkon', 'soba_wc', 'soba_tv', 'soba_satelit', 'soba_pogled',
            'terasa', 'klima', 'ventilator', 'parking', 'travnjak', 'bazen'
        );
        $data_opcije_smjestaj = array('udaljenost_do_mora', 'udaljenost_do_plaze', 'oblik_plaze', 'plaza_hlad', 'centar', 'restoran', 'trgovina',
            'fast_food', 'caffe_bar', 'setaliste', 'razvedena_obala', 'otoci', 'vez_za_camac', 'kucni_ljubimci'
        );
        $tip_smjestaja_post = $this->input->post('tip_smjestaja');
        $tip_objekta_post = $this->input->post('tip_objekta');
        $objekt_uvjeti_post = $this->input->post('objekt_uvjeti');
        $tip_smjestaja = $this->dbInputString($tip_smjestaja_post, 1);
        $datum_postavljanja = $this->funkcija->dbInputDate($this->input->post('datum_postavljanja'));
        $datum_prekida = $this->funkcija->dbInputDate($this->input->post('datum_prekida'));

        /*$rezervni_datum_dolaska_post = $this->input->post('rezervni_datum_dolaska');
        $rezervni_datum_odlaska_post = $this->input->post('rezervni_datum_odlaska');
        if ($rezervni_datum_dolaska_post != '' AND $rezervni_datum_odlaska_post != '') {
            $rezervni_datum_dolaska = $this->funkcija->dbInputDate($this->input->post('rezervni_datum_dolaska'));
            $rezervni_datum_odlaska = $this->funkcija->dbInputDate($this->input->post('rezervni_datum_odlaska'));
        } else {
            $rezervni_datum_dolaska = NULL;
            $rezervni_datum_odlaska = NULL;
        }*/
        $broj_soba = $this->dbInputString($data_sobe, 2);
        $min_cijena_post = $this->input->post('min_cijena');
        $max_cijena_post = $this->input->post('max_cijena');
        
        $min_cijena = ($min_cijena_post != '') ? $min_cijena_post : '';
        $max_cijena = ($max_cijena_post != '') ? $max_cijena_post : '';

        $tip_objekta = $this->dbInputString($tip_objekta_post, 1);
        $objekt_uvjeti = $this->dbInputString($objekt_uvjeti_post, 1);
        $opcije_soba = $this->dbInputString($data_opcije_soba, 2);
        $opcije_smjestaj = $this->dbInputString($data_opcije_smjestaj, 2);
        $udaljenost = $this->dbInputString($data_udaljenost, 2);
        $data = array(
            'korisnikID' => $this->session->userdata('ID'),
            'naslov' => $this->input->post('naslov'),
            'mjestoID' => $this->input->post('mjesto'),
            'kategorija' => $tip_smjestaja,
            'adresa' => $this->input->post('adresa'),
            'telefon' => $this->input->post('telefon'),
            'mobitel' => $this->input->post('mobitel'),
            'email' => $this->input->post('email'),
            'datumPostavljanja' => $datum_postavljanja,
            'datumPrekida' => $datum_prekida,
            'sobe' => $broj_soba,
            'min_cijena' => $min_cijena,
            'max_cijena' => $max_cijena,
            'tipObjekta' => $tip_objekta,
            'objektUvjeti' => $objekt_uvjeti,
            'opcijeSoba' => $opcije_soba,
            'opcijeSmjestaj' => $opcije_smjestaj,
            'opcijeUdaljenost' => $udaljenost,
            'datumObjave' => $this->funkcija->dbInputDate()
        );

        $this->db->insert('potraznja', $data);
    }

    // -- brisanje slike apartmana
    public function izbrisiSlikuApartman($slike, $apartman_id) {
        $data['slike'] = $slike;

        $this->db->where('apartmanID', $apartman_id);
        $this->db->update('apartman', $data);
    }

    // -- brisanje slike oglasa/apartmana(usluga)
    public function izbrisiSliku($tip, $slike, $tip_id) {
        switch ($tip) {
            case 'oglas':
                $data['slike'] = $slike;
                $this->db->where('oglasID', $tip_id);
                $this->db->update('oglas', $data);
                break;
            case 'apartman':
                $data['slike'] = $slike;
                $this->db->where('apartmanID', $tip_id);
                $this->db->update('apartman', $data);
                break;

            default:
                return FALSE;
                break;
        }
    }

    // -- popis regija(padajući izbornik)
    public function popisRegija() {
        $query = $this->db->get('regija');
        return $query->result_array();
    }

    // -- popis mjesta(padajući izbornik) - defaultni
    /*
     * regijaID
     * 1 - Dubrovačko-neretvanska
     * 2 - Istarska
     * 3 - Ličko-senjska
     * 4 - Primorsko-goranska
     * 5 - Šibensko-kninska
     * 6 - Splitsko-dalmatinska
     * 7 - Zadarska
     */
    public function pocetniPopisMjesta($id = 1) {
        $this->db->select('mjestoID, naziv_mjesta');
        $this->db->from('mjesto');
        $this->db->where('regijaID', $id);
        $this->db->order_by("naziv_mjesta", "asc");
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- popis mjesta(padajući izbornik)
    public function popisMjesta($id) {
        $this->db->select('mjestoID, naziv_mjesta');
        $this->db->from('mjesto');
        $this->db->where('regijaID', $id);
        $this->db->order_by("naziv_mjesta", "asc");
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- brojač posjeta
    public function brojacPosjeta($tip, $tipID = 0) {
        $data = array(
            'tip' => $tip,
            'ipAdresa' => $this->input->ip_address(),
            'preglednik' => $this->input->user_agent(),
            'vrijeme' => $this->funkcija->dbInputDatetime(),
            'tipID' => $tipID
        );

        $this->db->insert('stats', $data);
    }

    // -- ukupno pregleda oglasa/bannera
    public function ukupnoPregleda($tip, $tipID) {
        $this->db->cache_off();
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('stats');
        $this->db->where('tip', $tip);
        $this->db->where('tipID', $tipID);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function popisRobota() {
        $this->db->cache_off();
        $this->db->select('naziv');
        $this->db->from('robots');
        $query = $this->db->get();
        return $query->result_array();
    }

    // -- ukupno posjeta (stranica/oglas/banner)
    public function ukupnoPosjeta($tip, $robots = FALSE) {
        if ($robots == TRUE) {
            $this->db->cache_off();
            $this->db->select('COUNT(*) AS ukupno');
            $this->db->from('stats');
            $this->db->where('tip', $tip);
            $query_1 = $this->db->get();
            $ukupno = $query_1->result_array();
            $this->db->cache_off();
            $query_2 = $this->db->query('SELECT COUNT( * ) AS ukupnoDanas FROM stats WHERE tip="stranica" AND DATE( vrijeme ) = DATE( NOW( ) ) ');
            $ukupno_danas = $query_2->result_array();
            $result['ukupno'] = $ukupno[0]['ukupno'];
            $result['ukupnoDanas'] = $ukupno_danas[0]['ukupnoDanas'];
            return $result;
        } else {
            $result = $this->popisRobota();
            $bots_str = $result[0]['naziv'];
            $bots_arr = explode(';', $bots_str);
            $this->db->cache_off();
            $this->db->select('COUNT(*) AS ukupno');
            $this->db->from('stats');
            $this->db->where('tip', $tip);
            foreach ($bots_arr as $b_value) {
                $this->db->not_like('preglednik', $b_value);
            }
            $query_1 = $this->db->get();
            $ukupno = $query_1->result_array();
            $and = '';
            foreach ($bots_arr as $b_value) {
                $and .= "AND preglednik NOT LIKE '%$b_value%' ";
            }
            $query_string = 'SELECT COUNT( * ) AS ukupnoDanas FROM stats WHERE tip="stranica" AND DATE( vrijeme ) = DATE( NOW( ) ) ' . $and;
            $query_2 = $this->db->query($query_string);
            $ukupno_danas = $query_2->result_array();
            $result['ukupno'] = $ukupno[0]['ukupno'];
            $result['ukupnoDanas'] = $ukupno_danas[0]['ukupnoDanas'];
            return $result;
        }
    }

    // -- ukupno posjeta danas
    public function ukupnoPosjetaDanas() {
        $this->db->cache_off();
        $query = $this->db->query('SELECT COUNT( * ) AS ukupnoDanas FROM stats WHERE tip="stranica" AND DATE( vrijeme ) = DATE( NOW( ) ) ');
        return $query->result_array();
    }

    // -- vrijeme posjeta
    public function vrijemePregleda($tip, $oglasID) {
        $this->db->cache_off();
        $this->db->select('vrijeme');
        $this->db->from('stats');
        $this->db->where('tip', $tip);
        $this->db->where('tipID', $oglasID);
        $this->db->where('ipAdresa', $this->input->ip_address());
        $this->db->where('preglednik', $this->input->user_agent());
        $this->db->limit(1);
        $this->db->order_by('ID', 'desc');

        $query = $this->db->get();

        $result = $query->result_array();
        if (!empty($result)) {
            $timestamp = human_to_unix($result[0]['vrijeme']);
            $exp = $timestamp + 60; // -- 1 minuta
            $now = now();

            if ($now < $exp) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // -- status uplate
    public function statusUplate($korisnik_id) {
        $this->db->cache_off();
        $where = 'DATE(istek.datumIsteka) >= DATE(NOW())';
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('uplata');
        $this->db->join('korisnik', 'korisnik.korisnikID=uplata.korisnikID');
        $this->db->join('istek', 'istek.tipID=uplata.tipID');
        $this->db->where('uplata.tip', 'oglas');
        $this->db->where('uplata.korisnikID', $korisnik_id);
        $this->db->where($where);

        $query = $this->db->get();
        return $query->result_array();
    }

    // -- moji oglasi
    public function mojiOglasi($korisnik_id) {
        $this->db->cache_off();
        //$this->db->select('oglasID, nazivObjekta, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
        $this->db->select('oglasID, nazivObjekta, aktivan, vidljiv');
        $this->db->from('oglas');
        $this->db->where('korisnikID', $korisnik_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    // -- vlasnik oglasa
    public function vlasnikOglasa($korisnik_id, $oglas_id) {
        $this->db->cache_off();
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('oglas');
        $this->db->where('korisnikID', $korisnik_id);
        $this->db->where('oglasID', $oglas_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // -- provjera da li usluga (apartman) pripadaju oglasu
    public function uslugaOglas($apartman_id, $oglas_id) {
        $this->db->cache_off();
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('apartman');
        $this->db->where('apartmanID', $apartman_id);
        $this->db->where('oglasID', $oglas_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    // -- 
    public function oglasUsluge($korisnik_id, $oglas_id) {
        $this->db->cache_off();
        $where = ('oglas.oglasID = apartman.oglasID');
        $this->db->select('apartmanID, nazivApartmana');
        $this->db->from('apartman, oglas');
        $this->db->where('korisnikID', $korisnik_id);
        $this->db->where($where);
        $this->db->where('oglas.oglasID', $oglas_id);

        $query = $this->db->get();
        return $query->result_array();
    }

    // -- regija
    public function regijaID($mjesto_id) {
        $this->db->cache_off();
        $this->db->select('regijaID');
        $this->db->from('mjesto');
        $this->db->where('mjestoID', $mjesto_id);
        $query = $this->db->get();
        return $query->result_array();
    }

}
