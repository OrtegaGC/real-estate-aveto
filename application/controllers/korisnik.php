<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Korisnik extends MY_Controller {
    /*
      xss_clean
      prep_for_form
      prep_url
      strip_image_tags
      encode_php_tags
     */

    // -- index stranica korisnika
    // -- preusmjerava na početnu stranicu u slučaju pristupa preko url-a

    public function __construct() {
        parent::__construct();
        $this->load->model('stranica/homemodel');
        $this->load->model('stranica/korisnikmodel');
        $this->load->model('stranica/registracijamodel');
    }

    /*
      public function insert_ip()
      {
      for ($i = 1; $i <= 140000; $i++) {
      $inum1 = rand(0,255);
      $inum2 = rand(0,255);
      $inum3 = rand(0,255);
      $inum4 = rand(0,255);
      $ip = $inum1.'.'.$inum2.'.'.$inum3.'.'.$inum4;
      $vrijeme = date('Y-m-d H:i:s');
      $query = "INSERT INTO stats (tip, ipAdresa, preglednik, vrijeme, tipID) VALUES ('stranica', '$ip', 'Mozilla/5.0 (Windows NT 5.1; rv:25.0) Gecko/20100101 Firefox/25.0', '$vrijeme', '0')";
      $this->db->query($query);
      }
      }
     */

    public function index() {
        redirect('stranica');
    }

    // -- sprema podatke u bazu
    public function spremi() {
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->lang->load('form_validation', parent::getLang());
        $this->lang->load('registracija', parent::getLang());

        if ($this->form_validation->run('registracija') == FALSE) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $this->lang->load('common', parent::getLang());
            $this->lang->load('registracija', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('stranica/registracija');
            $this->load->view('includes/footer');
        } else {
            $lozinka = parent::passwordGenerator($this->input->post('lozinka'));
            $this->registracijamodel->spremiKorisnika($lozinka);
            $adresa = $this->input->post('email');
            $ime = $this->input->post('ime');
            $korisnicko_ime = $this->input->post('korisnicko_ime');
            $lozinka = $this->input->post('lozinka');
            $prezime = $this->input->post('prezime');
            $email = $this->input->post('email');
            parent::registracijaObavijestAdmin($ime, $prezime, $email);
            parent::registracijaObavijest($adresa, $ime, $korisnicko_ime, $lozinka);

            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $this->lang->load('registracija', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $infoData['class'] = 'info';
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/registracija-info', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- prijava korisnika
    public function prijava() {
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->lang->load('form_validation', parent::getLang());
        $this->lang->load('common', parent::getLang());


        if ($this->form_validation->run('prijava') == FALSE) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $this->lang->load('common', parent::getLang());
            $this->lang->load('prijava', parent::getLang());
            $infoData['class'] = 'warning';
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/prijava-info', $infoData);
            $this->load->view('includes/footer');
        } else {
            $arrPrijava = $this->korisnikmodel->korisnikPrijava();
            if ($arrPrijava['match'] == TRUE) {
                parent::prijava($arrPrijava['match'], $arrPrijava['ID'], $arrPrijava['korisnicko_ime'], $arrPrijava['tip']);
                redirect(base_url());
            } else {
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $infoData['class'] = 'warning';
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('info/prijava-info', $infoData);
                $this->load->view('includes/footer');
            }
        }
    }

    // -- odjava
    public function odjava() {
        $session = array('ID' => '', 'korisnicko_ime' => '', 'tip' => '', 'prijavljen' => '');
        $this->session->unset_userdata($session);
        redirect(base_url());
    }

    // -- obrazac za novi oglas (oglašivač)
    public function novi_oglas() {
        if (parent::prijavljen() == 2) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['zupanija'] = $this->korisnikmodel->popisRegija();
            $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta();
            $this->lang->load('novi_oglas', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('korisnik/novi-oglas-objekt');
            $this->load->view('includes/footer');
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- dodaj slike
    public function dodaj_slike() {
        if (parent::prijavljen() == 2) {
            
            // added by stiiv -> if cancel unosi_novi_oglas - redirect to base_url
            if($this->input->post('novi_oglas_odustani')) {
                redirect( base_url() );
            }

            $this->lang->load('form_validation', parent::getLang());
            $this->lang->load('novi_oglas', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            
            if ($this->form_validation->run('novi_oglas_objekt') == FALSE) {
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['zupanija'] = $this->korisnikmodel->popisRegija();
                $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($this->input->post('zupanija'));
                $this->lang->load('novi_oglas', parent::getLang());
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/novi-oglas-objekt');
                $this->load->view('includes/footer');
            } else {
                $korisnik_id = $this->session->userdata('ID');

                if (get_cookie('oid') == FALSE) {
                    $this->korisnikmodel->spremiOglas();
                    $oglas_id_tmp = $this->korisnikmodel->zadnjiOglas($korisnik_id);
                    $oglas_id = $oglas_id_tmp[0]['oglasID'];
                    $cookie = array(
                        'name' => 'oid',
                        'value' => $oglas_id,
                        'expire' => '1800'  // -- 30 minuta
                    );
                    set_cookie($cookie);
                } else {
                    $oglas_id = get_cookie('oid', TRUE);
                }

                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['oglas_id'] = $oglas_id;
                $this->lang->load('novi_oglas', parent::getLang());
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/dodaj-slike-objekt', $data);
                $this->load->view('includes/footer');
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- spremi slike
    public function spremi_slike_objekt() {
        // -- treba provjera da li je korisnik prijavljen 
        $path = 'objekti';
        $result = parent::doUpload($path);
        if (isset($result['greska']) && $result['greska'] == TRUE) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['greska'] = $result;
            $data['oglas_id'] = get_cookie('oid', TRUE);
            $this->lang->load('novi_oglas', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('korisnik/dodaj-slike-objekt', $data);
            $this->load->view('includes/footer');
        } else {
            $oglasID = $this->input->post('oglas_id');

            //if (get_cookie('o_img') == FALSE) {
                $slike = $result['naziv_slika'];
                $this->korisnikmodel->spremiSlikeObjekt($slike, $oglasID);

                $cookie = array(
                    'name' => 'o_img',
                    'value' => '1',
                    'expire' => '1800'  // -- 30 minuta
                );
                set_cookie($cookie);

                //redirect('korisnik/novi_apartman/' . $oglasID);
                redirect('korisnik/oglas_spremljen');
            //}
        }
    }

    // -- obrazac za dodavanje apartmana
    /*public function novi_apartman() {
        if (parent::prijavljen() == 2) {
            $url_id = $this->uri->segment(3);
            $cookie_id = get_cookie('oid', TRUE);
            //if (parent::checkID($url_id) == TRUE && $url_id == $session_id)
            if ($url_id == $cookie_id) {
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $this->lang->load('novi_oglas', parent::getLang());
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/novi-apartman');
                $this->load->view('includes/footer');
            } else {
                show_404();
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }*/

    // -- spremi apartman - zadnji korak
    /*public function spremi_apartman() {
        if (parent::prijavljen() == 2) {
            $url_id = $this->uri->segment(3);
            $cookie_id = get_cookie('oid', TRUE);
            //if (parent::checkID($url_id) == TRUE && $url_id == $session_id)
            if ($url_id == $cookie_id) {

                $this->lang->load('form_validation', parent::getLang());
                $this->lang->load('novi_oglas', parent::getLang());
                $this->lang->load('common', parent::getLang());
                $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                // -- provjerava da li su ispravni podaci u obrascu
                if ($this->form_validation->run('novi_oglas_apartman') == FALSE) {
                    $result = $this->homemodel->getHead();
                    $data['head'] = $result;
                    $data['tecajna'] = parent::tecajnaLista();
                    $this->lang->load('novi_oglas', parent::getLang());
                    $this->lang->load('common', parent::getLang());
                    $this->load->view('includes/head', $data);
                    $this->load->view('includes/header');
                    $this->load->view('korisnik/novi-apartman');
                    $this->load->view('includes/footer');
                } else {
                    // -- provjerava da li su podaci već spremljeni
                    if (get_cookie('aid') == FALSE) {

                        $oglasID = $this->input->post('oglas_id');
                        $path = 'apartmani';
                        $result = parent::doUpload($path);
                        // -- provjerava da li su slike sipravne
                        if (isset($result['greska']) && $result['greska'] == TRUE) {
                            $result = $this->homemodel->getHead();
                            $data['head'] = $result;
                            $data['tecajna'] = parent::tecajnaLista();
                            $data['greska'] = $result;
                            $this->lang->load('novi_oglas', parent::getLang());
                            $this->lang->load('common', parent::getLang());
                            $this->load->view('includes/head', $data);
                            $this->load->view('includes/header');
                            $this->load->view('korisnik/novi-apartman');
                            $this->load->view('includes/footer');
                        } else {
                            if (get_cookie('aid') == FALSE) {
                                $slike = $result['naziv_slika'];
                                $this->korisnikmodel->spremiApartman($slike, $oglasID);
                                $cookie = array(
                                    'name' => 'aid',
                                    'value' => '1',
                                    'expire' => '1800'  // -- 30 minuta
                                );
                                set_cookie($cookie);
                            }

                            redirect('korisnik/oglas_spremljen');
                        }
                    } else {
                        redirect('korisnik/oglas_spremljen');
                    }
                }
            } else {
                show_404();
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }*/

    // -- oglas spremljen
    public function oglas_spremljen() {
        if (parent::prijavljen() == 2) {
            delete_cookie('oid');
            delete_cookie('o_img');
            delete_cookie('aid');

            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'info';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/oglas-spremljen', $infoData);
            $this->load->view('includes/footer');
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- pregled objavljenih oglasa
    public function oglasi() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['oglasi'] = $this->korisnikmodel->mojiOglasi($korisnik_id);
            $this->lang->load('common', parent::getLang());
            $this->lang->load('moji_oglasi', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('korisnik/oglasi');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url());
        }
    }

    // -- pregled usluga (apartmana) pojedinog oglasa
    public function usluge() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id = $this->uri->segment(3);
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['usluge'] = $this->korisnikmodel->oglasUsluge($korisnik_id, $oglas_id);
            $this->lang->load('common', parent::getLang());
            $this->lang->load('moji_oglasi', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('korisnik/usluge');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url());
        }
    }

    // -- uređivanje oglasa
    public function uredi_oglas() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id = $this->uri->segment(3);
            if (parent::vlasnikOglasa($korisnik_id, $oglas_id) == TRUE) {
                $this->load->model('stranica/oglasmodel');
                $result = $this->homemodel->getHead();
                $oglas = $this->oglasmodel->oglasDetalji($oglas_id);
                $regija = $this->korisnikmodel->regijaID($oglas[0]['mjestoID']);
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['zupanija'] = $this->korisnikmodel->popisRegija();
                $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($regija[0]['regijaID']);
                $data['oglas'] = $oglas;
                $data['regija'] = $regija;
                $data['jezici'] = parent::parseStringUredi($oglas[0]['jeziciDomacin'], 1);
                $data['detalji_smjestajne_jedinice'] = parent::parseStringUredi($oglas[0]['detaljiSmjestajneJedinice'], 1);
                $data['detalji_aktivnosti_okolica'] = parent::parseStringUredi($oglas[0]['detaljiAktivnostiOkolica'], 1);
                $data['ostale_informacije'] = parent::parseStringUredi($oglas[0]['ostaleInformacije'], 2); //echo "<pre>",print_r($data), "</pre>"; die;
                $this->lang->load('common', parent::getLang());
                $this->lang->load('uredi_oglas', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/uredi-oglas');
                $this->load->view('includes/footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }

    // -- uređivanje usluga (apartmana)
    public function uredi_uslugu() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id = $this->uri->segment(3);
            $apartman_id = $this->uri->segment(4);
            if (parent::vlasnikOglasa($korisnik_id, $oglas_id) == TRUE) {
                $this->load->model('stranica/oglasmodel');
                $result = $this->homemodel->getHead();
                $apartman = $this->oglasmodel->apartmanDetaljiAjax($apartman_id);
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['apartman'] = $apartman;
                $data['detalji_apartmana'] = parent::parseStringUredi($apartman[0]['detaljiApartmana'], 1);
                $this->lang->load('common', parent::getLang());
                $this->lang->load('uredi_oglas', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/uredi-uslugu');
                $this->load->view('includes/footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }

    // -- spremanje promjena
    public function spremi_promjene() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id_url = $this->uri->segment(3);
            $oglas_id_post = $this->input->post('oglas_id');
            if (parent::vlasnikOglasa($korisnik_id, $oglas_id_url) == TRUE) {
                if ($oglas_id_post == $oglas_id_url) {
                    $this->lang->load('form_validation', parent::getLang());
                    $this->lang->load('novi_oglas', parent::getLang());
                    $this->lang->load('common', parent::getLang());
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    if ($this->form_validation->run('novi_oglas_objekt') == FALSE) {
                        $this->load->model('stranica/oglasmodel');
                        $result = $this->homemodel->getHead();
                        $oglas = $this->oglasmodel->oglasDetalji($oglas_id_url);
                        $regija = $this->korisnikmodel->regijaID($oglas[0]['mjestoID']);
                        $data['head'] = $result;
                        $data['tecajna'] = parent::tecajnaLista();
                        $data['zupanija'] = $this->korisnikmodel->popisRegija();
                        $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($this->input->post('zupanija'));
                        $data['oglas'] = $oglas; //echo "<pre>",print_r($data), "</pre>"; die;
                        $this->lang->load('common', parent::getLang());
                        $this->lang->load('uredi_oglas', parent::getLang());
                        $this->load->view('includes/head', $data);
                        $this->load->view('includes/header');
                        $this->load->view('korisnik/uredi-oglas-greska');
                        $this->load->view('includes/footer');
                    } else {
                        if (get_cookie('uredi_oglas') == FALSE) {
                            $this->korisnikmodel->spremiPromjeneOglasa($oglas_id_post);
                            $cookie = array(
                                'name' => 'uredi_oglas',
                                'value' => '1',
                                'expire' => '1800'  // -- 30 minuta
                            );
                            set_cookie($cookie);
                        }
                        redirect('korisnik/promjene_spremljene');
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }

    public function spremi_promjene_usluge() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id_url = $this->uri->segment(3);
            $oglas_id_post = $this->input->post('oglas_id');
            $apartman_id_post = $this->input->post('apartman_id');
            if (parent::vlasnikOglasa($korisnik_id, $oglas_id_url) == TRUE) {
                if ($oglas_id_post == $oglas_id_url) {
                    $this->lang->load('form_validation', parent::getLang());
                    $this->lang->load('novi_oglas', parent::getLang());
                    $this->lang->load('common', parent::getLang());
                    $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
                    if ($this->form_validation->run('novi_oglas_apartman') == FALSE) {
                        $result = $this->homemodel->getHead();
                        $data['head'] = $result;
                        $data['tecajna'] = parent::tecajnaLista();
                        $this->lang->load('common', parent::getLang());
                        $this->lang->load('uredi_oglas', parent::getLang());
                        $this->load->view('includes/head', $data);
                        $this->load->view('includes/header');
                        $this->load->view('korisnik/uredi-uslugu-greska');
                        $this->load->view('includes/footer');
                    } else {
                        if (parent::uslugaOglas($apartman_id_post, $oglas_id_post) == TRUE) {
                            if (get_cookie('uredi_uslugu') == FALSE) {
                                $this->korisnikmodel->spremiPromjeneUsluge($apartman_id_post);
                                $cookie = array(
                                    'name' => 'uredi_uslugu',
                                    'value' => '1',
                                    'expire' => '1800'  // -- 30 minuta
                                );
                                set_cookie($cookie);
                            }
                            redirect('korisnik/promjene_spremljene');
                        } else {
                            // -- greška ako usluga (apartman) ne pripada oglasu
                            show_404();
                        }
                    }
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }

    public function uredi_slike() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $tip = $this->uri->segment(3);
            $oglas_id = $this->uri->segment(4);
            $apartman_id = $this->uri->segment(5);
            switch ($tip) {
                case 'oglas':
                    if (parent::vlasnikOglasa($korisnik_id, $oglas_id) == TRUE) {
                        $this->load->model('stranica/oglasmodel');
                        $result = $this->homemodel->getHead();
                        $data['head'] = $result;
                        $data['tecajna'] = parent::tecajnaLista();
                        $oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
                        $data['slike_objekt'] = parent::slikeOglasa($oglas[0]['slike']);
                        $this->lang->load('common', parent::getLang());
                        $this->lang->load('uredi_slike', parent::getLang());
                        $this->load->view('includes/head', $data);
                        $this->load->view('includes/header');
                        $this->load->view('korisnik/uredi-slike-objekt');
                        $this->load->view('includes/footer');
                    } else {
                        // -- greška ako oglas nije u vlasništvu korisnika
                        show_404();
                    }
                    break;
                case 'usluga':
                    if (parent::uslugaOglas($apartman_id, $oglas_id) == TRUE) {
                        $this->load->model('stranica/oglasmodel');
                        $result = $this->homemodel->getHead();
                        $data['head'] = $result;
                        $data['tecajna'] = parent::tecajnaLista();
                        $apartman = $this->oglasmodel->slikeApartman($apartman_id);
                        $data['slike_apartman'] = parent::slikeOglasa($apartman[0]['slike']);
                        $this->lang->load('common', parent::getLang());
                        $this->lang->load('uredi_slike', parent::getLang());
                        $this->load->view('includes/head', $data);
                        $this->load->view('includes/header');
                        $this->load->view('korisnik/uredi-slike-usluga');
                        $this->load->view('includes/footer');
                    } else {
                        // -- greška ako usluga (apartman) ne pripada oglasu
                        show_404();
                    }
                    break;

                default:
                    redirect('korisnik/oglasi');
                    break;
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- promjene spremljene
    public function spremi_promjene_slika() {
        if (parent::prijavljen() == 2) {
            $korisnik_id = $this->session->userdata('ID');
            $tip = $this->uri->segment(3);
            $oglas_id = $this->uri->segment(4);
            $apartman_id = $this->uri->segment(5);
            switch ($tip) {
                case 'oglas': // -- oglas (objekt)
                    if (parent::vlasnikOglasa($korisnik_id, $oglas_id) == TRUE) {
                        $this->load->model('stranica/oglasmodel');
                        $oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
                        $slike = parent::slikeOglasa($oglas[0]['slike']);
                        $broj_slika = count($slike);
                        if ($broj_slika >= 6) {
                            $result = $this->homemodel->getHead();
                            $data['head'] = $result;
                            $data['tecajna'] = parent::tecajnaLista();
                            $oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
                            $data['slike_objekt'] = parent::slikeOglasa($oglas[0]['slike']);
                            $this->lang->load('common', parent::getLang());
                            $this->lang->load('uredi_slike', parent::getLang());
                            $data['greska'] = lang('uredi_slike_napomena_2');
                            $this->load->view('includes/head', $data);
                            $this->load->view('includes/header');
                            $this->load->view('korisnik/uredi-slike-objekt');
                            $this->load->view('includes/footer');
                        } else {
                            $upload_result = parent::doUpload('objekti');
                            if (isset($upload_result['greska']) && $upload_result['greska'] == TRUE) {
                                $result = $this->homemodel->getHead();
                                $data['head'] = $result;
                                $data['tecajna'] = parent::tecajnaLista();
                                $oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
                                $data['slike_objekt'] = parent::slikeOglasa($oglas[0]['slike']);
                                $data['greska_slika'] = $upload_result['slika'];
                                $this->lang->load('common', parent::getLang());
                                $this->lang->load('uredi_slike', parent::getLang());
                                $this->load->view('includes/head', $data);
                                $this->load->view('includes/header');
                                $this->load->view('korisnik/uredi-slike-objekt');
                                $this->load->view('includes/footer');
                            } else {
                                $oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
                                $slike_db = $oglas[0]['slike'];
                                if (get_cookie('uredi_slike') == FALSE) {
                                    $this->korisnikmodel->spremiPromjeneSlika('objekt', $oglas_id, $slike_db . $upload_result['naziv_slika']);
                                    $cookie = array(
                                        'name' => 'uredi_slike',
                                        'value' => '1',
                                        'expire' => '1800'  // -- 30 minuta
                                    );
                                    set_cookie($cookie);
                                }
                                redirect('korisnik/promjene_spremljene');
                            }
                        }
                    } else {
                        // -- greška ako oglas nije u vlasništvu korisnika
                        show_404();
                    }
                    break;
                case 'usluga': // -- apartman (usluga)
                    if (parent::uslugaOglas($apartman_id, $oglas_id) == TRUE) {
                        $this->load->model('stranica/oglasmodel');
                        $apartman = $this->oglasmodel->slikeApartman($apartman_id);
                        $slike = parent::slikeOglasa($apartman[0]['slike']);
                        $broj_slika = count($slike);
                        if ($broj_slika >= 6) {
                            $result = $this->homemodel->getHead();
                            $data['head'] = $result;
                            $data['tecajna'] = parent::tecajnaLista();
                            $apartman = $this->oglasmodel->slikeApartman($apartman_id);
                            $data['slike_apartman'] = parent::slikeOglasa($apartman[0]['slike']);
                            $this->lang->load('common', parent::getLang());
                            $this->lang->load('uredi_slike', parent::getLang());
                            $data['greska'] = lang('uredi_slike_napomena_2');
                            $this->load->view('includes/head', $data);
                            $this->load->view('includes/header');
                            $this->load->view('korisnik/uredi-slike-usluga');
                            $this->load->view('includes/footer');
                        } else {
                            $upload_result = parent::doUpload('apartmani');
                            if (isset($upload_result['greska']) && $upload_result['greska'] == TRUE) {
                                $result = $this->homemodel->getHead();
                                $data['head'] = $result;
                                $data['tecajna'] = parent::tecajnaLista();
                                $apartman = $this->oglasmodel->slikeApartman($apartman_id);
                                $data['slike_apartman'] = parent::slikeOglasa($apartman[0]['slike']);
                                $data['greska_slika'] = $upload_result['slika'];
                                $this->lang->load('common', parent::getLang());
                                $this->lang->load('uredi_slike', parent::getLang());
                                $this->load->view('includes/head', $data);
                                $this->load->view('includes/header');
                                $this->load->view('korisnik/uredi-slike-usluga');
                                $this->load->view('includes/footer');
                            } else {
                                $apartman = $this->oglasmodel->slikeApartman($apartman_id);
                                $slike_db = $apartman[0]['slike'];
                                if (get_cookie('uredi_slike') == FALSE) {
                                    $this->korisnikmodel->spremiPromjeneSlika('apartman', $apartman_id, $slike_db . $upload_result['naziv_slika']);
                                    $cookie = array(
                                        'name' => 'uredi_slike',
                                        'value' => '1',
                                        'expire' => '1800'  // -- 30 minuta
                                    );
                                    set_cookie($cookie);
                                }
                                redirect('korisnik/promjene_spremljene');
                            }
                        }
                    } else {
                        // -- greška ako usluga (apartman) ne pripada oglasu
                        show_404();
                    }
                    break;

                default:
                    redirect('korisnik/oglasi');
                    break;
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- promjene spremljene
    public function promjene_spremljene() {
        if (parent::prijavljen() == 2) {
            delete_cookie('uredi_oglas');
            delete_cookie('uredi_uslugu');
            delete_cookie('uredi_slike');

            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'info';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/promjene-spremljene', $infoData);
            $this->load->view('includes/footer');
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- obrazac za novi oglas potraznje
    public function potraznja_novi_oglas() {
        if (parent::prijavljen() == 3) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['zupanija'] = $this->korisnikmodel->popisRegija();
            $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta();
            $this->lang->load('common', parent::getLang());
            $this->lang->load('novi_oglas_potraznja', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('korisnik/novi-oglas-potraznja');
            $this->load->view('includes/footer');
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['regije'] = $this->homemodel->popisRegija();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $data['page_title'] = lang('page_title_greska_prijava');
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }

    // -- spremi oglas potražnja
    public function potraznja_spremi_oglas() {
        if (parent::prijavljen() == 3) {
            $this->lang->load('form_validation', parent::getLang());
            $this->lang->load('novi_oglas_potraznja', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
            if ($this->form_validation->run('novi_oglas_potraznja') == FALSE) {
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['zupanija'] = $this->korisnikmodel->popisRegija();
                $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta();
                $this->lang->load('common', parent::getLang());
                $this->lang->load('novi_oglas_potraznja', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('korisnik/novi-oglas-potraznja');
                $this->load->view('includes/footer');
            } else {
                $this->korisnikmodel->spremiOglasPotraznja();
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $infoData['class'] = 'info';
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('info/oglas-spremljen', $infoData);
                $this->load->view('includes/footer');
            }
        } else {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['regije'] = $this->homemodel->popisRegija();
            $infoData['class'] = 'warning';
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/pristup-zabranjen', $infoData);
            $this->load->view('includes/footer');
        }
    }
    
    
    //-- oglasi potraznja
    public function potraznja_oglasi() {
        if (parent::prijavljen() == 3) {
            $this->load->model('stranica/potraznjamodel');
            $korisnik_id = $this->session->userdata('ID');
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['oglasi'] = $this->potraznjamodel->mojiOglasi($korisnik_id);
            $this->lang->load('common', parent::getLang());
            $this->lang->load('moji_oglasi', parent::getLang());
            $this->load->view('includes/head', $data); //echo "<pre>",print_r($data), "</pre>"; die;
            $this->load->view('includes/header');
            $this->load->view('potraznja/potraznja-oglasi');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url());
        }
    }
    
    public function uredi_oglas_potraznja() {
        if (parent::prijavljen() == 3) {
            $korisnik_id = $this->session->userdata('ID');
            $oglas_id = $this->uri->segment(3);
            if (parent::vlasnikOglasaPotraznja($korisnik_id, $oglas_id) == TRUE) {
                //$this->load->model('stranica/oglasmodel');
                $result = $this->homemodel->getHead();
                $oglas = $this->potraznjamodel->oglasDetalji($oglas_id); echo "<pre>", print_r($oglas),"</pre>"; //die;
                $regija = $this->korisnikmodel->regijaID($oglas[0]['mjestoID']);
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['zupanija'] = $this->korisnikmodel->popisRegija();
                $data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($regija[0]['regijaID']);
                $data['oglas'] = $oglas;
                $data['regija'] = $regija;
                $data['jezici'] = parent::parseStringUredi($oglas[0]['jeziciDomacin'], 1);
                $data['detalji_smjestajne_jedinice'] = parent::parseStringUredi($oglas[0]['detaljiSmjestajneJedinice'], 1);
                $data['detalji_aktivnosti_okolica'] = parent::parseStringUredi($oglas[0]['detaljiAktivnostiOkolica'], 1);
                $data['ostale_informacije'] = parent::parseStringUredi($oglas[0]['ostaleInformacije'], 2);
                $this->lang->load('common', parent::getLang());
                $this->lang->load('novi_oglas_potraznja', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('potraznja/potraznja-uredi-oglas');
                $this->load->view('includes/footer');
            } else {
                show_404();
            }
        } else {
            redirect(base_url());
        }
    }

    // -- zaboravljena lozinka
    public function zaboravljena_lozinka() {
        $this->lang->load('form_validation', parent::getLang());
        $this->form_validation->set_error_delimiters('<p class="error">', '</p>');
        $this->lang->load('zaboravljena_lozinka', parent::getLang());
        if ($this->form_validation->run('zaboravljena_lozinka') == FALSE) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['brojac']['ukupno'] = $this->korisnikmodel->ukupnoPosjeta('stranica');
            $data['brojac']['danas'] = $this->korisnikmodel->ukupnoPosjetaDanas();
            $this->lang->load('common', parent::getLang());
            $this->lang->load('zaboravljena_lozinka', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('stranica/zaboravljena-lozinka');
            $this->load->view('includes/footer');
        } else {
            $email = $this->input->post('email');
            $lozinka_rnd = parent::genRandomPassword(6);
            $lozinka_hash = parent::passwordGenerator($lozinka_rnd);
            $this->korisnikmodel->zaboravljenaLozinka($email, $lozinka_hash);
            parent::zaboravljenaLozinka($email, $lozinka_rnd);

            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();

            $infoData['class'] = 'info';
            $this->lang->load('common', parent::getLang());
            $data['page_title'] = lang('page_title_zaboravljena_lozinka');
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('info/zaboravljena-lozinka', $infoData);
            $this->load->view('includes/footer');
        }
    }

}
