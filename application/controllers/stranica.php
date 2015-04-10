<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Stranica extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('stranica/homemodel');
        $this->load->model('stranica/oglasmodel');
        $this->load->model('stranica/korisnikmodel');
    }

    // -- početna stranica
    public function index() {
        //--$this->output->enable_profiler(TRUE);	
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $najgledanijiID = $this->homemodel->najgledanijiOglasi();
        $istaknutiID = $this->homemodel->istaknutiOglasi('home');
        $najgledanijiOglasiIntro = $this->oglasmodel->posebniOglasi($najgledanijiID, 'najgledaniji');
        $istaknutiOglasiIntro = $this->oglasmodel->posebniOglasi($istaknutiID, 'istaknuti');

        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['potraznja'] = $this->homemodel->potraznjaIntro();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $data['najgledanijiOglasiIntro'] = $najgledanijiOglasiIntro;
        $data['istaknutiOglasiIntro'] = $istaknutiOglasiIntro;
        $data['najgledaniji_glavna_slika'] = parent::najgledanijiGlavnaSlika($najgledanijiOglasiIntro);
        $data['istaknuti_glavna_slika'] = parent::najgledanijiGlavnaSlika($istaknutiOglasiIntro);
        $data['regije'] = $this->homemodel->popisRegija();
        $data['banner'] = $this->homemodel->banneri();

        $this->lang->load('common', parent::getLang());
        $this->lang->load('home', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/home', $data);
        $this->load->view('includes/footer');
    }

    // -- o nama
    public function o_nama() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $this->lang->load('common', parent::getLang());
        $this->lang->load('o_nama', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/o-nama');
        $this->load->view('includes/footer');
    }

    // -- kontakt
    public function kontakt() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $this->lang->load('common', parent::getLang());
        $this->lang->load('kontakt', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/kontakt');
        $this->load->view('includes/footer');
    }

    // -- karta
    public function karta() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $this->lang->load('common', parent::getLang());
        $this->lang->load('karta', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/karta');
        $this->load->view('includes/footer');
    }

    // -- upute korištenja
    public function upute_koristenja() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $this->lang->load('common', parent::getLang());
        $this->lang->load('upute', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/upute-koristenja');
        $this->load->view('includes/footer');
    }

    // -- uvjeti korištenja
    public function uvjeti_koristenja() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('uvjeti', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/uvjeti-koristenja');
        $this->load->view('includes/footer');
    }

    // -- cijena 
    public function cijena() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('cijena', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/cijena');
        $this->load->view('includes/footer');
    }

    // -- posao
    public function posao() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('posao', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/posao');
        $this->load->view('includes/footer');
    }

    // -- dodatna zarada 
    public function zarada() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('zarada', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/zarada');
        $this->load->view('includes/footer');
    }

    //-- prezentacija
    public function prezentacija() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('prezentacija', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/prezentacija');
        $this->load->view('includes/footer');
    }

    public function poslovnice() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $this->lang->load('common', parent::getLang());
        $this->lang->load('poslovnice', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('stranica/poslovnice');
        $this->load->view('includes/footer');
    }

    // -- registracija
    public function registracija() {
        if (parent::prijavljen() == FALSE) {
            parent::brojacPosjeta();
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $this->lang->load('registracija', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('stranica/registracija');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url());
        }
    }

    // -- zaboravljena lozinka
    public function zaboravljena_lozinka() {
        if (parent::prijavljen() == FALSE) {
            parent::brojacPosjeta();
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
            $this->lang->load('common', parent::getLang());
            $this->lang->load('zaboravljena_lozinka', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('stranica/zaboravljena-lozinka');
            $this->load->view('includes/footer');
        } else {
            redirect(base_url());
        }
    }

}
