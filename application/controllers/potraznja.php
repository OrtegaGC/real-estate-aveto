<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Potraznja extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('stranica/homemodel');
        $this->load->model('stranica/oglasmodel');
        $this->load->model('stranica/korisnikmodel');
        $this->load->model('stranica/potraznjamodel');
    }

    public function index() {
        parent::brojacPosjeta();
        $result = $this->homemodel->getHead();
        $data['head'] = $result;
        $data['tecajna'] = parent::tecajnaLista();
        $data['najnoviji'] = $this->potraznjamodel->najnoviji();
        $data['regije'] = $this->homemodel->popisRegija();
        $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
        $this->lang->load('common', parent::getLang());
        $this->lang->load('potraznja', parent::getLang());
        $this->load->view('includes/head', $data);
        $this->load->view('includes/header');
        $this->load->view('potraznja/potraznja-home', $data);
        $this->load->view('includes/footer');
    }

    // -- prikazuje popis mjesta u nekoj regiji
    public function regija() {
        parent::brojacPosjeta();
        $id = $this->uri->segment(3);
        if (parent::checkID('regija', 'regijaID', $id) == TRUE) {
            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
            $data['regija'] = $this->homemodel->detaljiRegije((int) $id);
            $data['mjesta'] = $this->homemodel->popisMjesta((int) $id);
            $this->lang->load('potraznja', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('potraznja/mjesta', $data);
            $this->load->view('includes/footer');
        } else {
            show_404();
        }
    }

    // -- prikazuje popis potražnje iz nekog mjesta
    public function mjesto() {
        //$this->output->enable_profiler(TRUE);
        parent::brojacPosjeta();
        $id = $this->uri->segment(3);
        if (parent::checkID('mjesto', 'mjestoID', $id) == TRUE) {
            $ukupno = $this->oglasmodel->ukupno($id);
            $config['base_url'] = base_url() . 'potraznja/mjesto/' . $id . '/stranica';
            $config['total_rows'] = $ukupno[0]['ukupno'];
            $config['per_page'] = 9;
            $config['num_links'] = 5;
            $config['uri_segment'] = 5;
            $config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
            $this->pagination->initialize($config);

            $result = $this->homemodel->getHead();
            $data['head'] = $result;
            $data['tecajna'] = parent::tecajnaLista();
            $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
            $data['regija'] = $this->homemodel->nazivRegije((int) $id);
            $data['mjesto'] = $this->homemodel->nazivMjesta((int) $id);
            $data['potraznja'] = $this->potraznjamodel->potraznjaIntro($id, $config['per_page'], $this->uri->segment(5));

            $this->lang->load('potraznja', parent::getLang());
            $this->lang->load('common', parent::getLang());
            $this->load->view('includes/head', $data);
            $this->load->view('includes/header');
            $this->load->view('potraznja/popis-oglasa', $data);
            $this->load->view('includes/footer');
        } else {
            show_404();
        }
    }

    // -- detalji oglasa potražnje
    public function detalji() {
        parent::brojacPosjeta();
        $mjestoID = $this->uri->segment(3);
        $id = $this->uri->segment(4);
        $korisnik_id = $this->session->userdata('ID'); 
        if (parent::checkID('mjesto', 'mjestoID', $mjestoID) == TRUE && parent::checkID('potraznja', 'potraznjaID', $id) == TRUE) {
            parent::brojPregledaPotraznja($id);
            $detalji_osnovno = $this->potraznjamodel->detaljiOsnovno($id);
            $detalji_svi = $this->potraznjamodel->detaljiSvi($id);
            $this->lang->load('detalji_potraznja', parent::getLang());
            if (parent::prijavljen() == 2) {
                if (parent::statusUplate($korisnik_id) == TRUE) {
                    $data['potraznja'] = $detalji_svi; 
                    $data['kategorija'] = parent::parseString($detalji_svi[0]['kategorija'], 1);
                    $data['sobe'] = parent::parseString($detalji_svi[0]['sobe'], 2);
                    $data['cijena'] = parent::parseString($detalji_svi[0]['cijena'], 0);
                    $data['tip_objekta'] = parent::parseString($detalji_svi[0]['tipObjekta'], 1);
                    $data['objekt_uvjeti'] = parent::parseString($detalji_svi[0]['objektUvjeti'], 1);
                    $data['opcije_soba'] = parent::parseString($detalji_svi[0]['opcijeSoba'], 2);
                    $data['opcije_smjestaj'] = parent::parseString($detalji_svi[0]['opcijeSmjestaj'], 2);
                    $data['opcije_udaljenost'] = parent::parseString($detalji_svi[0]['opcijeUdaljenost'], 2); //echo "<pre>",print_r($data), "</pre>"; die;
                } else {
                    $this->load->model('stranica/korisnikmodel');
                    $result = $this->korisnikmodel->statusUplate($korisnik_id); 

                    $data['potraznja'] = $detalji_osnovno;
                    $data['kategorija'] = parent::parseString($detalji_osnovno[0]['kategorija'], 1);
                    $data['sobe'] = parent::parseString($detalji_osnovno[0]['sobe'], 2);
                    $data['min_cijena'] = $detalji_osnovno[0]['min_cijena'];
                    $data['max_cijena'] = $detalji_osnovno[0]['max_cijena'];
                    $data['tip_objekta'] = parent::parseString($detalji_osnovno[0]['tipObjekta'], 1);
                    $data['objekt_uvjeti'] = parent::parseString($detalji_osnovno[0]['objektUvjeti'], 1);
                    $data['opcije_soba'] = parent::parseString($detalji_osnovno[0]['opcijeSoba'], 2);
                    $data['opcije_smjestaj'] = parent::parseString($detalji_osnovno[0]['opcijeSmjestaj'], 2);
                    $data['opcije_udaljenost'] = parent::parseString($detalji_osnovno[0]['opcijeUdaljenost'], 2);
                    //$data['info'] = lang('detalji_potraznja_detalji_osnovno_pretplata'); 
                    //echo "<pre>",print_r($data, 1), "</pre>"; die;
                }
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();

                $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
                $data['regija'] = $this->homemodel->nazivRegije((int) $mjestoID);
                $data['mjesto'] = $this->homemodel->nazivMjesta((int) $mjestoID);
                $this->lang->load('common', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('potraznja/detalji', $data);
                $this->load->view('includes/footer');
            } else {
                $result = $this->homemodel->getHead();
                $data['head'] = $result;
                $data['tecajna'] = parent::tecajnaLista();
                $data['potraznja'] = $detalji_osnovno;
                $data['kategorija'] = parent::parseString($detalji_osnovno[0]['kategorija'], 1);
                $data['sobe'] = parent::parseString($detalji_osnovno[0]['sobe'], 2);
                /*$data['min_cijena'] = parent::parseString($detalji_osnovno[0]['min_cijena'], 0);
                $data['max_cijena'] = parent::parseString($detalji_osnovno[0]['max_cijena'], 0);*/
                $data['min_cijena'] = $detalji_osnovno[0]['min_cijena'];
                $data['max_cijena'] = $detalji_osnovno[0]['max_cijena'];
                $data['tip_objekta'] = parent::parseString($detalji_osnovno[0]['tipObjekta'], 1);
                $data['objekt_uvjeti'] = parent::parseString($detalji_osnovno[0]['objektUvjeti'], 1); 
                $data['opcije_soba'] = parent::parseString($detalji_osnovno[0]['opcijeSoba'], 2);
                $data['opcije_smjestaj'] = parent::parseString($detalji_osnovno[0]['opcijeSmjestaj'], 2);
                $data['opcije_udaljenost'] = parent::parseString($detalji_osnovno[0]['opcijeUdaljenost'], 2);
                $data['info'] = lang('detalji_potraznja_detalji_osnovno_prijava');
                $data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
                $data['regija'] = $this->homemodel->nazivRegije((int) $mjestoID);
                $data['mjesto'] = $this->homemodel->nazivMjesta((int) $mjestoID); //echo "<pre>",print_r($data, 1), "</pre>"; die("Helloo");

                $this->lang->load('common', parent::getLang());
                $this->lang->load('detalji_potraznja', parent::getLang());
                $this->load->view('includes/head', $data);
                $this->load->view('includes/header');
                $this->load->view('potraznja/detalji-osnovno', $data);
                $this->load->view('includes/footer');
            }
        } else {
            show_404();
        }
    }

}
