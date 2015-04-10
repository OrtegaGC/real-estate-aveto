<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('email');
        $this->load->library('pagination');
        $this->load->library('session');
        $this->load->library('form_validation');
        //$this->load->library('funkcija'); 
        $this->load->helper('html');
        $this->defaultLanguage();
    }

    // -- postavlja cookie i defaultni jezik ako nije izabran
    protected function defaultLanguage() {
        if (get_cookie('lang') == FALSE) {
            $cookie = array(
                'name' => 'lang',
                'value' => 'hr',
                'expire' => '86400'  // -- jedan dan izražen u sekundama
            );
            set_cookie($cookie);

            //$lang = get_cookie('lang', TRUE); // -- vraća FALSE kod prvog učitavanja
            $lang = 'hr';
            return $lang;
        } else {
            $lang = get_cookie('lang', TRUE);
            return $lang;
        }
    }

    // -- get language
    protected function getLang() {
        $lang = get_cookie('lang', TRUE);

        switch ($lang) {
            case 'hr':
                return 'croatian';
                break;

            case 'en':
                return 'english';
                break;

            case 'de':
                return 'german';
                break;

            case 'it':
                return 'italian';
                break;

            case 'fr':
                return 'french';
                break;
            default:
                return 'croatian';
        }
    }

    // -- debug
    protected function debug($oglasID) {
        $this->load->model('stranica/korisnikmodel');
        $tip = 'oglas';
        $rezultat = $this->korisnikmodel->vrijemePregleda($tip, $oglasID);
        return $rezultat;
    }

    // -- brojač posjeta na stranici
    protected function brojacPosjeta() {
        $this->load->model('stranica/korisnikmodel');
        if (get_cookie('pv_cnt') == FALSE) {
            $cookie = array(
                'name' => 'pv_cnt',
                'value' => '1',
                'expire' => '1'  // -- 1 = jedna sekunda (fejkanje posjeta), 1800 = 30 minuta
            );
            set_cookie($cookie);

            $tip = 'stranica';
            $this->korisnikmodel->brojacPosjeta($tip);
        }
    }

    // -- broj pregleda oglasa
    protected function brojPregledaOglasa($oglasID) {
        $this->load->model('stranica/korisnikmodel');
        $tip = 'oglas';
        $rezultat = $this->korisnikmodel->vrijemePregleda($tip, $oglasID);
        if ($rezultat == FALSE) {
            $this->korisnikmodel->brojacPosjeta($tip, $oglasID);
        }
    }

    // -- broj pregleda bannera
    protected function brojPregledaBannera($bannerID) {
        $this->load->model('stranica/korisnikmodel');
        $tip = 'banner';
        $rezultat = $this->korisnikmodel->vrijemePregleda($tip, $bannerID);
        if ($rezultat == FALSE) {
            $this->korisnikmodel->brojacPosjeta($tip, $bannerID);
        }
    }

    // -- broj pregleda potražnje
    protected function brojPregledaPotraznja($potraznjaID) {
        $this->load->model('stranica/korisnikmodel');
        $tip = 'potraznja';
        $rezultat = $this->korisnikmodel->vrijemePregleda($tip, $potraznjaID);
        if ($rezultat == FALSE) {
            $this->korisnikmodel->brojacPosjeta($tip, $potraznjaID);
        }
    }

    // -- tečajna lista
    protected function tecajnaLista() {
        $tecajna_lista_url = 'http://www.pbz.hr/Downloads/HNBteclist.xml';
        $url_to_save = 'modules/tecajna_lista/xml/tecajna_lista_local.xml';
        $cachetime = 18000;
        $cachefile = 'modules/tecajna_lista/xml/tecajna_lista_local.xml';
        if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
            $tecajna_lista = file_get_contents($cachefile);
            $xml = simplexml_load_string($tecajna_lista, NULL, LIBXML_NOCDATA);
            return $xml;
        } else {
            $dom = new DOMDocument();
            $dom->load($tecajna_lista_url);
            $dom->save($url_to_save);
            $xml_url = 'modules/tecajna_lista/xml/tecajna_lista_local.xml';
            $tecajna_lista = file_get_contents($xml_url);
            $xml = simplexml_load_string($tecajna_lista, NULL, LIBXML_NOCDATA);
            return $xml;
        }
    }

    // -- generiranje random passworda
    function genRandomPassword($length = 32) {
        $salt = PASS_SALT;
        $len = strlen($salt);
        $makepass = '';
        mt_srand(10000000 * (double) microtime());

        for ($i = 0; $i < $length; $i ++) {
            $makepass .= $salt[mt_rand(0, $len - 1)];
        }

        return $makepass;
    }

    // -- password generator
    protected function passwordGenerator($lozinka) {
        $salt = $this->genRandomPassword();
        $pass = md5(stripslashes($lozinka) . $salt) . ':' . $salt;
        return $pass;
    }

    // -- prijava korisnika
    protected function prijava($input, $id, $username, $tip) {
        if ($input == TRUE) {
            $sessionData = array(
                'ID' => $id,
                'korisnicko_ime' => $username,
                'tip' => $tip,
                'prijavljen' => TRUE
            );

            $this->session->set_userdata($sessionData);
        }
    }

    // -- provjera da li je korisnik prijavljen - da li su podaci u sessionu ispranvni
    protected function prijavljen() {
        if ($this->session->userdata('prijavljen') == TRUE) {
            if ($this->session->userdata('tip') == '2') {
                return 2;
            } elseif ($this->session->userdata('tip') == '3') {
                return 3;
            } else {
                return NULL;
            }
        } else {
            return FALSE;
        }
    }

    // -- provjera da li je korisnik izvršio uplatu
    protected function statusUplate($korisnik_id) {
        $this->load->model('stranica/korisnikmodel');
        $result = $this->korisnikmodel->statusUplate($korisnik_id);
        if ($result[0]['ukupno'] >= 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // -- prijava administratora
    protected function admPrijava($input, $id, $username, $tip) {
        if ($input == TRUE) {
            $sessionData = array(
                'adm_ID' => $id,
                'adm_korisnicko_ime' => $username,
                'adm_tip' => $tip,
                'adm_prijavljen' => TRUE,
                'administrator' => TRUE
            );

            $this->session->set_userdata($sessionData);
        }
    }

    // -- provjerava da li je administrator prijavljen
    protected function admPrijavljen() {
        if ($this->session->userdata('adm_prijavljen') == TRUE && $this->session->userdata('adm_tip') == 1 && $this->session->userdata('administrator') == TRUE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // -- provjerava da li je postavljen ID i da li je broj
    protected function checkID($table, $atr, $id) {
        $this->load->model('stranica/homemodel');
        $ukupno = $this->homemodel->checkID($table, $atr, $id);

        if ($ukupno[0]['ukupno'] == '0') {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- vlasnik oglasa
    protected function vlasnikOglasa($korisnik_id, $oglas_id) {
        $this->load->model('stranica/korisnikmodel');
        $result = $this->korisnikmodel->vlasnikOglasa($korisnik_id, $oglas_id);

        if ($result[0]['ukupno'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // -- vlasnik oglasa
    protected function vlasnikOglasaPotraznja($korisnik_id, $oglas_id) {
        $this->load->model('stranica/potraznjamodel');
        $result = $this->potraznjamodel->vlasnikOglasa($korisnik_id, $oglas_id);

        if ($result[0]['ukupno'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // -- provjera da li usluga (apartman) pripadaju oglasu
    protected function uslugaOglas($apartman_id, $oglas_id) {
        $this->load->model('stranica/korisnikmodel');
        $result = $this->korisnikmodel->uslugaOglas($apartman_id, $oglas_id);

        if ($result[0]['ukupno'] == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // -- status oglasa
    protected function statusOglas($oglasID) {
        $this->load->model('stranica/oglasmodel');
        $status = $this->oglasmodel->status($oglasID);

        if ($status[0]['aktivan'] == 0 OR $status[0]['vidljiv'] == 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- kreiranje thumbnaila
    protected function createThumb($path, $image) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 200;
        $config['height'] = 150;
        $config['source_image'] = './uploads/' . $path . '/' . $image;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    // -- resize image
    protected function resizeImage($path, $slika) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        $config['width'] = 640;
        $config['height'] = 480;
        $config['source_image'] = './uploads/' . $path . '/' . $slika;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }

    // -- upload slika
    protected function doUpload($path) {
        $greska = array();
        foreach ($_FILES as $key => $value) {
            if ($value['type'] == 'image/jpeg' || $value['type'] == 'image/jpg' || $value['type'] == 'image/png' || $value['type'] == 'image/gif') {
                $temp_name[] = $value['tmp_name'];
                $name[] = $value['name'];
                $ext[] = $value['type'];
            } else {
                $greska[$key] = 'Format nije podržan. Slika mora biti u JPG/PNG/GIF formatu.';
            }
        }

        if (empty($greska)) {
            $result['naziv_slika'] = '';
            // -- petlja se ponavlja onoliko puta koliko ima index-a u svakom polju
            for ($i = 0; isset($temp_name[$i]) && isset($name[$i]); $i++) {
                $extension = explode('/', $ext[$i]);
                $naziv_slike = md5(rand(0, 99)) . sha1(rand(100, 1000)) . '.' . $extension[1];
                move_uploaded_file($temp_name[$i], 'uploads/' . $path . '/' . $naziv_slike);
                $result['naziv_slika'] .= $naziv_slike . ';';
            }

            $slike = explode(';', $result['naziv_slika']);
            array_pop($slike);
            foreach ($slike as $naziv) {
                $this->createThumb($path, $naziv);
            }

            foreach ($slike as $naziv) {
                $this->resizeImage($path, $naziv);
            }

            // -- ako ide kroz jednu petlju, gubi se kvaliteta slike i ne promijeni veličinu svim slikama - samo prvoj
            return $result;
        } else {
            $greska['greska'] = TRUE;
            return $greska;
        }
    }

    // -- upload bannera
    protected function doBannerUpload($path) {
        $greska = array();
        foreach ($_FILES as $key => $value) {
            if ($value['type'] == 'image/jpeg' || $value['type'] == 'image/jpg' || $value['type'] == 'image/png' || $value['type'] == 'image/gif') {
                $temp_name[] = $value['tmp_name'];
                $name[] = $value['name'];
                $ext[] = $value['type'];
            } else {
                $greska[$key] = 'Format nije podržan. Slika mora biti u JPG/PNG/GIF formatu.';
            }
        }

        if (empty($greska)) {
            $result['naziv_slika'] = '';
            // -- petlja se ponavlja onoliko puta koliko ima index-a u svakom polju
            for ($i = 0; isset($temp_name[$i]) && isset($name[$i]); $i++) {
                $extension = explode('/', $ext[$i]);
                $naziv_slike = md5(rand(0, 99)) . sha1(rand(100, 1000)) . '.' . $extension[1];
                move_uploaded_file($temp_name[$i], 'uploads/' . $path . '/' . $naziv_slike);
                $result['naziv_slika'] .= $naziv_slike;
            }


            return $result;
        } else {
            $greska['greska'] = TRUE;
            return $greska;
        }
    }

    // -- glavna slika
    protected function glavnaSlika($slike) {
        $polje = explode(';', $slike);
        $glavna_slika = array_shift($polje);
        return $glavna_slika;
    }

    // -- glavna slika
    protected function glavnaSlikaThumb($slike) {
        $polje = explode(';', $slike);
        $glavna_slika = array_shift($polje);
        $thumb_tmp = explode('.', $glavna_slika); //echo "<pre>thumb_",print_r($thumb_tmp, 1),"</pre>";
        // check added by stiiv - check if the array[1] is empty to prevent notice
        if( !empty($thumb_tmp[1]) ) { 
            $thumb = $thumb_tmp[0] . '_thumb.' . $thumb_tmp[1];
            return $thumb;
        }
    }

    // -- glavna slika najgledanijih oglasa
    protected function najgledanijiGlavnaSlika($najgledanijiOglasiIntro) {
        if (!empty($najgledanijiOglasiIntro)) {
            foreach ($najgledanijiOglasiIntro as $key => $value) {
                $data['glavna_slika'][$key] = $this->glavnaSlikaThumb($value[0]['slike']);
            }
            return $data;
        }
    }

    // -- glavna slika rezultata traženja
    protected function traziRezultatiSlika($trazi_rezultati) {
        if (!empty($trazi_rezultati)) {
            foreach ($trazi_rezultati as $key => $value) {
                $data['glavna_slika'][$key] = $this->glavnaSlikaThumb($value['slike']);
            }
            return $data;
        }
    }

    // -- slike oglasa
    protected function slikeOglasa($slike) {
        $polje = explode(';', $slike);
        array_pop($polje); //echo "<pre>",print_r($polje, 1),"</pre>";
        // check added by stiiv
        if($polje) {
            foreach ($polje as $key => $value) {
                $thumb_tmp = explode('.', $value);
                $thumb[$key]['naziv'] = $thumb_tmp[0];
                $thumb[$key]['ext'] = $thumb_tmp[1];
            }
            return $thumb;
        }
        return null;
    }

    protected function izbrisiSliku($tip, $file) {
        switch ($tip) {
            case 'objekt':
                foreach ($file as $key => $value) {
                    $file_tmp = explode('.', $value);
                    $slika = 'uploads/objekti/' . $file_tmp[0] . '.' . $file_tmp[1];
                    $thumb = 'uploads/objekti/' . $file_tmp[0] . '_thumb.' . $file_tmp[1];
                    if (file_exists($slika)) {
                        //unlink($path) or die('Brisanje neuspješno: ' . $path);
                        unlink($slika);
                    }
                    if (file_exists($thumb)) {
                        //unlink($path) or die('Brisanje neuspješno: ' . $path);
                        unlink($thumb);
                    }
                }
                break;
            case 'apartman':
                $data = '';
                foreach ($file as $key => $value) {
                    $file_tmp = explode('.', $value);
                    $slika = 'uploads/apartmani/' . $file_tmp[0] . '.' . $file_tmp[1];
                    $thumb = 'uploads/apartmani/' . $file_tmp[0] . '_thumb.' . $file_tmp[1];
                    //$debug .= $slika."\n";
                    if (file_exists($slika)) {
                        //unlink($path) or die('Brisanje neuspješno: ' . $path);
                        unlink($slika);
                    }
                    if (file_exists($thumb)) {
                        //unlink($path) or die('Brisanje neuspješno: ' . $path);
                        unlink($thumb);
                    }
                }
                //return $debug;				
                break;
            // -- case banneri

            default:
                return FALSE;
                break;
        }
    }

    // -- jezici koje govori domaćin
    protected function jeziciOglasa($jezici) {
        if (!empty($jezici)) {
            $polje = explode(';', $jezici);
            array_pop($polje);
            foreach ($polje as $key => $value) {
                $result[$key]['jezik'] = $value;
            }
            return $result;
        } else {
            return NULL;
        }
    }

    // -- detalji smještajne jedinice
    protected function detaljiObjekta($detalji) {
        if (!empty($detalji)) {
            $polje = explode(';', $detalji);
            array_pop($polje);
            foreach ($polje as $key => $value) {
                $result[$key]['detalji_objekt'] = $value;
            }
            return $result;
        } else {
            return NULL;
        }
    }

    // -- detalji kampa
    protected function detaljiKampa($kamp) {
        if (!empty($kamp)) {
            $polje = explode(';', $kamp);
            array_pop($polje);
            foreach ($polje as $key => $value) {
                $result[$key]['detalji_kamp'] = $value;
            }
            return $result;
        } else {
            return NULL;
        }
    }

    // -- parse db string (0 = 'string:string', 1 = 'string;string;string;', 2 = 'string:string;string:string;')
    protected function parseString($string, $delimiter) {
        if ($string != '') {
            switch ($delimiter) {
                case 0:
                    $polje = explode(':', $string);
                    $result[$polje[0]] = $polje[1];
                    return $result;
                    break;

                case 1:
                    $polje = explode(';', $string);
                    array_pop($polje);
                    foreach ($polje as $key => $value) {
                        $result[$key] = $value;
                    }
                    return $result;
                    break;

                case 2:
                    $polje = explode(';', $string);
                    array_pop($polje);
                    foreach ($polje as $key => $value) {
                        $temp = explode(':', $value);
                        $result[$temp[0]] = $temp[1];
                    }
                    return $result;
                    break;

                default:
                    return NULL;
                    break;
            }
        } else {
            return NULL;
        }
    }

    // -- parse db string (1 = 'string;string;string;', 2 = 'string:string;string:string;')
    protected function parseStringUredi($string, $delimiter) {
        if ($string != '') {
            switch ($delimiter) {
                case 1:
                    $polje = explode(';', $string);
                    array_pop($polje);
                    foreach ($polje as $key => $value) {
                        $result[$value] = $value;
                    }
                    return $result;
                    break;
                case 2:
                    $polje = explode(';', $string);
                    array_pop($polje);
                    foreach ($polje as $key => $value) {
                        $temp = explode(':', $value);
                        $result[$temp[0]] = $temp[1];
                    }
                    return $result;
                    break;
                default:
                    return NULL;
                    break;
            }
        } else {
            return NULL;
        }
    }

    // -- 
    // -- Callback funkcije
    // -- 
    // -- provjera da li korisničko ime postoji u bazi
    public function username_check($user) {
        $this->load->model('stranica/registracijamodel');
        $result = $this->registracijamodel->checkUsername($user);
        if ($result == FALSE) {
            $this->lang->load('common', $this->getLang());
            $greska_1 = lang('com_greska_korisnicko_ime_1');
            $greska_2 = lang('com_greska_korisnicko_ime_2');
            $this->form_validation->set_message('username_check', $greska_1 . $user . $greska_2);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- provjera da li email adresa postoji u bazi
    public function email_check($email) {
        $this->load->model('stranica/registracijamodel');
        $result = $this->registracijamodel->checkEmail($email);
        if ($result == FALSE) {
            $this->lang->load('common', $this->getLang());
            $greska_1 = lang('com_greska_email_1');
            $greska_2 = lang('com_greska_email_2');
            $this->form_validation->set_message('email_check', $greska_1 . $email . $greska_2);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- provjera da li email adresa postoji u bazi
    public function zaboravljena_lozinka_email_check($input) {
        $this->load->model('stranica/registracijamodel');
        $result = $this->registracijamodel->checkEmail($input);
        if ($result == TRUE) {
            $this->lang->load('common', $this->getLang());
            $greska_1 = lang('com_greska_zaboravljena_lozinka_email_1');
            $greska_2 = lang('com_greska_zaboravljena_lozinka_email_2');
            $this->form_validation->set_message('zaboravljena_lozinka_email_check', $greska_1 . $input . $greska_2);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- postavljanje custom error poruke za uvjete korištenja
    public function user_agreement($input) {
        if ($input == FALSE) {
            $this->lang->load('common', $this->getLang());
            $greska = lang('com_greska_uvjeti_koristenja');
            $this->form_validation->set_message('user_agreement', $greska);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- provjera telefonskog broja
    public function broj_telefona($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^[0-9-,+,\/,\s]{6,16}+$/", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_broj_telefona');
                $this->form_validation->set_message('broj_telefona', $greska);
                return FALSE;
            }
        }
    }

    // -- udaljenost
    public function udaljenost($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^[0-9]{1,4}+\s?+[a-zA-Z]{1,2}+$/", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_udaljenost');
                $this->form_validation->set_message('udaljenost', $greska);
                return FALSE;
            }
        }
    }

    // -- alpha-numeric string s razmakom i sa €
    public function cijena($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^([a-z0-9\sČčĆćĐđŠšŽž€])+$/i", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_alpha_num');
                $this->form_validation->set_message('cijena', $greska);
                return FALSE;
            }
        }
    }

    // -- alpha string s razmakom
    public function alpha_space($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^([a-z\sČčĆćĐđŠšŽž])+$/i", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_alpha_space');
                $this->form_validation->set_message('alpha_space', $greska);
                return FALSE;
            }
        }
    }

    // -- alpha-numeric string s razmakom
    public function alpha_num($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^([a-z0-9\sČčĆćĐđŠšŽž])+$/i", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_alpha_num');
                $this->form_validation->set_message('alpha_num', $greska);
                return FALSE;
            }
        }
    }

    // -- alpha-numeric string s razmakom i nekim znakovima
    public function alpha_num_dash($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^([a-z0-9\s\,\.\-\+\_\/ČčĆćĐđŠšŽž])+$/i", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = lang('com_greska_alpha_num_dash');
                $this->form_validation->set_message('alpha_num_dash', $greska);
                return FALSE;
            }
        }
    }

    public function text_string($input) {
        if ($input == '') {
            return TRUE;
        } else {
            if (preg_match("/^([a-z0-9\s\,\.\!\?\:\;\(\)\-\+\_\/ČčĆćĐđŠšŽž])+$/i", $input)) {
                return TRUE;
            } else {
                $this->lang->load('common', $this->getLang());
                $greska = "Koristili ste zabranjene znakove!";
                $this->form_validation->set_message('text_string', $greska);
                return FALSE;
            }
        }
    }

    // -- datum dolaska(greška ako nije unešen datum odlaska)
    public function rezervni_datum_dolaska($input) {
        $input = $this->input->post('rezervni_datum_odlaska');
        $rezervni_datum_dolaska = $this->input->post('rezervni_datum_dolaska');
        if ($rezervni_datum_dolaska != '' AND $input == '') {
            $this->lang->load('common', $this->getLang());
            $greska = lang('com_greska_rezervni_datum_odlaska');
            $this->form_validation->set_message('rezervni_datum_dolaska', $greska);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- datum odlaska(greška ako nije unešen datum dolaska)
    public function rezervni_datum_odlaska($input) {
        $input = $this->input->post('rezervni_datum_dolaska');
        $rezervni_datum_odlaska = $this->input->post('rezervni_datum_odlaska');
        if ($rezervni_datum_odlaska != '' AND $input == '') {
            $this->lang->load('common', $this->getLang());
            $greska = lang('com_greska_rezervni_datum_dolaska');
            $this->form_validation->set_message('rezervni_datum_odlaska', $greska);
            return FALSE;
        } else {
            return TRUE;
        }
    }

    // -- 
    // -- Mailovi
    // -- 
    // -- obavijest korisnicima prilikom registracije
    protected function registracijaObavijest($adresa, $ime, $korisnicko_ime, $lozinka) {
        $this->load->library('email');
        $this->email->to($adresa);
        $this->email->from('admin@croatia-aveto.com.hr', 'Croatia-Aveto');
        $this->email->subject('Croatia Aveto - obavijest o registraciji');
        $data['ime'] = $ime;
        $data['korisnicko_ime'] = $korisnicko_ime;
        $data['lozinka'] = $lozinka;
        $msg = $this->load->view('email/registracija-obavijest', $data, true);
        $this->email->message($msg);
        $this->email->send();
    }

    // -- obavijest administratorima prilikom registracije korisnika
    protected function registracijaObavijestAdmin($ime, $prezime, $email) {
        $this->load->model('ci_admin/adminmodel');
        $this->load->library('email');
        $adrese = $this->adminmodel->primateljiObavijesti();
        foreach ($adrese as $value) {
            $this->email->clear();

            $this->email->to($value['email']);
            $this->email->from('admin@croatia-aveto.com.hr', 'Croatia-Aveto');
            $this->email->subject('Obavijest o novom korisniku!');
            $data['ime'] = $ime;
            $data['prezime'] = $prezime;
            $data['email'] = $email;
            $msg = $this->load->view('email/registracija-obavijest-admin', $data, true);
            $this->email->message($msg);
            $this->email->send();
        }
    }

    // -- obavijest administratorima prilikom objave novog oglasa - ponuda
    protected function oglasPonudaObavijest($korisnicko_ime, $id_oglasa) {
        $this->load->model('ci_admin/adminmodel');
        $this->load->library('email');
        $adrese = $this->adminmodel->primateljiObavijesti();
        foreach ($adrese as $value) {
            $this->email->clear();

            $this->email->to($value['email']);
            $this->email->from('admin@croatia-aveto.com.hr', 'Croatia-Aveto');
            $this->email->subject('Obavijest o novom oglasu!');
            $data['ime'] = $ime;
            $data['prezime'] = $prezime;
            $data['email'] = $email;
            $msg = $this->load->view('email/oglas-ponuda', $data, true);
            $this->email->message($msg);
            $this->email->send();
        }
    }

    // -- obavijest administratorima prilikom objave novog oglasa - potražnja
    protected function oglasPotraznjaObavijest($ime, $prezime, $email) {
        $this->load->model('ci_admin/adminmodel');
        $this->load->library('email');
        $adrese = $this->adminmodel->primateljiObavijesti();
        foreach ($adrese as $value) {
            $this->email->clear();

            $this->email->to($value['email']);
            $this->email->from('admin@croatia-aveto.com.hr', 'Croatia-Aveto');
            $this->email->subject('Obavijest o novom oglasu!');
            $data['ime'] = $ime;
            $data['prezime'] = $prezime;
            $data['email'] = $email;
            $msg = $this->load->view('email/oglas-potraznja', $data, true);
            $this->email->message($msg);
            $this->email->send();
        }
    }

    // -- zaboravljena lozinka
    protected function zaboravljenaLozinka($email, $lozinka) {
        $this->load->library('email');

        $this->email->to($email);
        $this->email->from('admin@croatia-aveto.com.hr', 'Croatia-Aveto');
        $this->email->subject('Croatia Aveto - zaboravljena lozinka');
        $data['lozinka'] = $lozinka;
        $msg = $this->load->view('email/zaboravljena-lozinka', $data, true);
        $this->email->message($msg);
        $this->email->send();
    }

    /*
      // -- jezik stranice
      protected function language($lang, $page)
      {
      $navPath = base_url().'includes/language/'.$lang.'/'.$lang.'-izbornik.txt';
      $contentPath = base_url().'includes/language/'.$lang.'/'.$lang.'-'.$page.'.txt';
      $modulePath = base_url().'includes/language/'.$lang.'/'.$lang.'-moduli.txt';

      $fileNav = fopen($navPath, 'r');
      $fileContent = fopen($contentPath, 'r');
      $fileModule = fopen($modulePath, 'r');

      $inputNav = explode("\n", trim(fread($fileNav, 4096)));
      $inputContent = explode("\n", trim(fread($fileContent, 4096)));
      $inputModule = explode("\n", trim(fread($fileModule, 4096)));

      fclose($fileNav);
      fclose($fileContent);

      //$array = array_filter($input);
      //$langArr = array_slice($array, 2);

      // -- izbornik
      foreach($inputNav as $row => $data)
      {

      $row_data = explode('=', $data);
      if(isset($row_data[1])){
      $info['izbornik'][$row_data[0]] = $row_data[1];
      }


      }

      // -- sadržaj
      foreach($inputContent as $row => $data)
      {

      $row_data = explode('=', $data);
      if(isset($row_data[1])){
      $info['sadrzaj'][$row_data[0]] = $row_data[1];
      }


      }

      // -- moduli
      foreach($inputModule as $row => $data)
      {

      $row_data = explode('=', $data);
      if(isset($row_data[1])){
      $info['moduli'][$row_data[0]] = $row_data[1];
      }


      }

      return $info;

      } */
}
