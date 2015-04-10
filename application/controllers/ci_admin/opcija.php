<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Opcija extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('ci_admin/adminmodel');
		$this->load->model('stranica/registracijamodel');
		$this->load->model('stranica/korisnikmodel');
		$this->load->library('funkcija');
    }
	
	public function index()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Početna';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/home');
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- backup baze na lokalno računalo
	public function db_backup_desktop()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->load->dbutil();
			$backup =& $this->dbutil->backup(); 
			$this->load->helper('download');
			force_download('db_backup.gz', $backup); 
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	
	// -- backup baze na server
	public function db_backup_server()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->load->dbutil();
			$prefs = array(
                'tables'      => array('apartman', 'banner', 'gmaps_api', 'istaknuti_oglas', 'korisnik', 'meta', 'mjesto', 'oglas', 'potraznja', 'primatelji_obavijesti', 'regija', 'stats', 'temp_oglas', 'tip_korisnika'),  
                'ignore'      => array(),           
                'format'      => 'zip',             
                'filename'    => 'cro-aveto-'.date("d-m-Y_H-i-s") .'.zip',   
                'add_drop'    => TRUE,              
                'add_insert'  => TRUE,             
                'newline'     => "\n"               
            );


        $backup =& $this->dbutil->backup($prefs); 

        $db_name = 'db_backup-'. date("d-m-Y_H-i-s") .'.zip';
        $save = 'backup/db/'.$db_name;

        $this->load->helper('file');
        write_file($save, $backup); 


       // $this->load->helper('download');
       // force_download($db_name, $backup);
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	// -- popis korisnika
	public function korisnici()
	{
		if(parent::admPrijavljen() == TRUE) {
			$filter = $this->uri->segment(5);
			switch ($filter) {
				case 'datum':
					$data['page_title'] = 'Korisnici';
					$datumi[0] = $this->uri->segment(6);
					$datumi[1] = $this->uri->segment(7);
					$ukupno = $this->adminmodel->ukupnoFilterDatum($datumi, 'korisnik');
					$config['base_url'] = base_url().'ci_admin/opcija/korisnici/filter/datum/'.$datumi[0].'/'.$datumi[1];
					$config['total_rows'] = $ukupno[0]['ukupno'];
					$config['per_page'] = 20;
					$config['num_links']= 5;
					$config['uri_segment'] = 8;
					$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
					$this->pagination->initialize($config);
			
					$data['korisnici'] = $this->adminmodel->popisKorisnikaFilterDatum($datumi, $config['per_page'], $this->uri->segment(8));
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/korisnici', $data);
					$this->load->view('includes/ci_admin/footer');
					/*$datumi = array();
					$datumi[0] = $this->uri->segment(6);
					$datumi[1] = $this->uri->segment(7);
					echo $datumi[0];*/
					break;
				
				default:
					$data['page_title'] = 'Korisnici';
					$config['base_url'] = base_url().'ci_admin/opcija/korisnici';
					$config['total_rows'] = $this->adminmodel->ukupno('korisnik');
					$config['per_page'] = 20;
					$config['num_links']= 5;
					$config['uri_segment'] = 4;
					$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
					$this->pagination->initialize($config);
			
					$data['korisnici'] = $this->adminmodel->popisKorisnika($config['per_page'], $this->uri->segment(4));
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/korisnici', $data);
					$this->load->view('includes/ci_admin/footer');
					break;
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}


	// -- novi korisnik
	public function novi_korisnik()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Novi korisnik';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/novi-korisnik');
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- uredi korisnika
	public function uredi_korisnika()
	{
		if(parent::admPrijavljen() == TRUE) {
			$id = $this->uri->segment(4);
			if (parent::checkID('korisnik', 'korisnikID', $id) == TRUE) {
				$data['page_title'] = 'Uredi korisnika';
				$data['korisnik'] = $this->adminmodel->detaljiKorisnika($id);
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/uredi-korisnika', $data);
				$this->load->view('includes/ci_admin/footer');
			} else {
				show_404();
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- spremi korisnika
	public function spremi_korisnika()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			if ($this->form_validation->run('administrator_novi_korisnik') == FALSE) 
			{
				$data['page_title'] = 'Novi korisnik';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-korisnik');
				$this->load->view('includes/ci_admin/footer');
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
				
				$data['page_title'] = 'Korisnik spremljen';
				$data['info'] = 'Podaci o korisniku su spremljeni!';
				$data['uri_segment'] = 'korisnici';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/info/info', $data);
				$this->load->view('includes/ci_admin/footer');
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	
	// -- popis oglasa
	public function oglasi()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Oglasi';
			$config['base_url'] = base_url().'ci_admin/opcija/oglasi';
			$config['total_rows'] = $this->adminmodel->ukupno('oglas');
			$config['per_page'] = 20;
			$config['num_links']= 5;
			$config['uri_segment'] = 4;
			$config['use_page_numbers'] = FALSE; // -- po defaultu TRUE - ako je true oglasi paginacija ne radi ispravno (oglasi se 'ponavljaju')
			$this->pagination->initialize($config);
			
			$data['oglasi'] = $this->adminmodel->popisOglasa($config['per_page'], $this->uri->segment(4));
			$this->lang->load('common', 'croatian');
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/oglasi', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- popis usluga
	public function usluge()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Usluge';
			$oglas_id = $this->uri->segment(4);
			$korisnik_id = $this->uri->segment(5);
			$data['usluge'] = $this->korisnikmodel->oglasUsluge($korisnik_id, $oglas_id);
			$this->lang->load('common', 'croatian');
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/usluge', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- popis oglasa
	public function novi_oglas()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->load->model('stranica/homemodel');
			$this->load->model('stranica/korisnikmodel');
			$data['page_title'] = 'Novi oglas';
			$data['zupanija'] = $this->korisnikmodel->popisRegija();
			$data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta();
			$data['head'] = $this->homemodel->getHead();
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/novi-oglas', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	public function dodaj_slike()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$this->lang->load('novi_oglas', 'croatian');
			if ($this->form_validation->run('administrator_novi_oglas') == FALSE) 
			{
				$this->load->model('stranica/homemodel');
				$data['page_title'] = 'Novi oglas';
				$data['zupanija'] = $this->korisnikmodel->popisRegija();
				$data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($this->input->post('zupanija'));
				$data['head'] = $this->homemodel->getHead();
				$data['page_title'] = 'Novi oglas';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-oglas');
				$this->load->view('includes/ci_admin/footer');
			} else {
				$korisnik_id = $this->input->post('korisnik');
				
				if (get_cookie('oid') == FALSE) {
					$this->adminmodel->spremiOglas();
					$oglas_id_tmp = $this->korisnikmodel->zadnjiOglas($korisnik_id);
					$oglas_id = $oglas_id_tmp[0]['oglasID'];
					$cookie = array(
						'name'   => 'oid',
						'value'  => $oglas_id,
						'expire' => '1800'  // -- 30 minuta
						);
					set_cookie($cookie);
				} else {
					$oglas_id = get_cookie('oid', TRUE);
				}
				
				$this->load->model('stranica/homemodel');
				$data['head'] = $this->homemodel->getHead();
				$data['page_title'] = 'Dodaj slike';
				$data['oglas_id'] = $oglas_id;
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/dodaj-slike', $data);
				$this->load->view('includes/ci_admin/footer');
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	public function spremi_slike()
	{
		if(parent::admPrijavljen() == TRUE) {
			$path = 'objekti';
			$result = parent::doUpload($path);
			if (isset($result['greska']) && $result['greska'] == TRUE) {
				$data['greska'] = $result;
				$data['oglas_id'] = get_cookie('oid', TRUE);
				$data['page_title'] = 'Dodaj slike';
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/dodaj-slike', $data);
					$this->load->view('includes/ci_admin/footer');
			} else {
				$oglasID = $this->input->post('oglas_id');
			
				if (get_cookie('o_img') == FALSE) {
					$slike = $result['naziv_slika'];
					$this->korisnikmodel->spremiSlikeObjekt($slike, $oglasID);
				
					$cookie = array(
						'name'   => 'o_img',
						'value'  => '1',
						'expire' => '1800'  // -- 30 minuta
						);
					set_cookie($cookie);
				
					redirect('ci_admin/opcija/novi_apartman_oglas/'.$oglasID);
				}
			}
			
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	public function novi_apartman_oglas()
	{
		if(parent::admPrijavljen() == TRUE) {
			$url_id = $this->uri->segment(4);
			$cookie_id = get_cookie('oid', TRUE);
			//if (parent::checkID($url_id) == TRUE && $url_id == $session_id)
			if ($url_id == $cookie_id) {
				$data['page_title'] = 'Novi apartman';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-apartman-oglas');
				$this->load->view('includes/ci_admin/footer');
			} else {
				show_404();
			}
			
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	public function spremi_apartman_oglas()
	{
		if(parent::admPrijavljen() == TRUE) {
			$url_id = $this->uri->segment(4);
			$cookie_id = get_cookie('oid', TRUE);
			//if (parent::checkID($url_id) == TRUE && $url_id == $session_id)
			if ($url_id == $cookie_id) {
			
				$this->lang->load('novi_oglas', 'croatian');
				$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
				// -- provjerava da li su ispravni podaci u obrascu
				if ($this->form_validation->run('administrator_novi_apartman_oglas') == FALSE) {
					$data['page_title'] = 'Novi apartman';
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/novi-apartman-oglas', $data);
					$this->load->view('includes/ci_admin/footer');
				} else {
					// -- provjerava da li su podaci već spremljeni
					if (get_cookie('aid') == FALSE) {
						
						$oglasID = $this->input->post('oglas_id');
						$path = 'apartmani';
						$result = parent::doUpload($path);
						// -- provjerava da li su slike sipravne
						if (isset($result['greska']) && $result['greska'] == TRUE) {
							$data['greska'] = $result;
							//$this->lang->load('novi_oglas', parent::getLang());
							//$this->lang->load('common', parent::getLang());
							$data['page_title'] = 'Novi apartman';
							$this->load->view('includes/ci_admin/header', $data);
							$this->load->view('ci_admin/novi-apartman-oglas', $data);
							$this->load->view('includes/ci_admin/footer');
						} else {
							if (get_cookie('aid') == FALSE) {
								$slike = $result['naziv_slika'];
								$this->korisnikmodel->spremiApartman($slike, $oglasID);
								$cookie = array(
									'name'   => 'aid',
									'value'  => '1',
									'expire' => '1800'  // -- 30 minuta
								);
							set_cookie($cookie);
								
							}

							redirect('ci_admin/opcija/oglas_spremljen');
						}
				
					} else {
						redirect('ci_admin/opcija/oglas_spremljen');
					}
					
				}
			}else{
				show_404();
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	public function oglas_spremljen()
	{
		
		if(parent::admPrijavljen() == TRUE) {
			delete_cookie('oid');
			delete_cookie('o_img');
			delete_cookie('aid');
			$data['page_title'] = 'Oglas spremljen';
			$data['info'] = 'Oglas spremljen!';
			$data['uri_segment'] = 'oglasi';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/info/info', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- novi apartman
	public function novi_apartman()
	{
		if(parent::admPrijavljen() == TRUE) {
			$url_id = $this->uri->segment(4);
			$cookie_id = get_cookie('oid', TRUE);
			//if (parent::checkID($url_id) == TRUE && $url_id == $session_id)
			if ($url_id == $cookie_id)
			{
				$data['page_title'] = 'Novi apartman';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-apartman');
				$this->load->view('includes/ci_admin/footer');
			} else {
				show_404();
			}
			
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	public function spremi_apartman()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->lang->load('novi_oglas', 'croatian');
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			// -- provjerava da li su ispravni podaci u obrascu
			if ($this->form_validation->run('administrator_novi_apartman') == FALSE) {
				$data['page_title'] = 'Novi apartman';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-apartman', $data);
				$this->load->view('includes/ci_admin/footer');
			} else {
				// -- provjerava da li su podaci već spremljeni
				if (get_cookie('aid') == FALSE) {
						
					$oglasID = $this->input->post('oglas');
					$path = 'apartmani';
					$result = parent::doUpload($path);
					// -- provjerava da li su slike sipravne
					if (isset($result['greska']) && $result['greska'] == TRUE) {
						$data['greska'] = $result;
						//$this->lang->load('novi_oglas', parent::getLang());
						//$this->lang->load('common', parent::getLang());
						$data['page_title'] = 'Novi apartman';
						$this->load->view('includes/ci_admin/header', $data);
						$this->load->view('ci_admin/novi-apartman', $data);
						$this->load->view('includes/ci_admin/footer');
					} else {
						if (get_cookie('aid') == FALSE) {
							$slike = $result['naziv_slika'];
							$this->korisnikmodel->spremiApartman($slike, $oglasID);
							$cookie = array(
								'name'   => 'aid',
								'value'  => '1',
								'expire' => '1800'  // -- 30 minuta
							);
							set_cookie($cookie);	
						}

						redirect('ci_admin/opcija/apartman_spremljen');
					}
				} else {
					redirect('ci_admin/opcija/apartman_spremljen');
				}
					
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	public function apartman_spremljen()
	{
		if(parent::admPrijavljen() == TRUE) {
			delete_cookie('oid');
			delete_cookie('o_img');
			delete_cookie('aid');
			$data['page_title'] = 'Apartman spremljen';
			$data['info'] = 'Apartman spremljen!';
			$data['uri_segment'] = 'oglasi';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/info/info', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- promjene spremljene
	public function promjene_spremljene()
	{
		if(parent::admPrijavljen() == TRUE) {
			delete_cookie('uredi_korisnika');
			delete_cookie('uredi_oglas');
			delete_cookie('uredi_uslugu');
			$data['page_title'] = 'Promjene spremljene';
			$data['info'] = 'Promjene spremljene!';
			$data['uri_segment'] = 'oglasi';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/info/info', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- uređivanje oglasa
	public function uredi_oglas()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->load->model('stranica/oglasmodel');
			$id = $this->uri->segment(4);
			if (parent::checkID('oglas', 'oglasID', $id) == TRUE) {
				$data['page_title'] = 'Uredi oglas';
				$data['head'] = $this->homemodel->getHead();
				$data['zupanija'] = $this->korisnikmodel->popisRegija();
				$oglas = $this->oglasmodel->oglasDetalji($id);
				$regija = $this->korisnikmodel->regijaID($oglas[0]['mjestoID']);
				$data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($regija[0]['regijaID']);
				$data['oglas'] = $this->oglasmodel->oglasDetalji($id);
				$data['korisnik'] = $this->adminmodel->detaljiKorisnika($oglas[0]['korisnikID']);
				$data['regija'] = $regija;
				$data['jezici'] = parent::parseStringUredi($oglas[0]['jeziciDomacin'], 1);
				$data['detalji_smjestajne_jedinice'] = parent::parseStringUredi($oglas[0]['detaljiSmjestajneJedinice'], 1);
				$data['detalji_autokampa'] = parent::parseStringUredi($oglas[0]['detaljiAutoKampa'], 1);
				$data['ostale_informacije'] = parent::parseStringUredi($oglas[0]['ostaleInformacije'], 2);
				$this->lang->load('common', 'croatian');
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/uredi-oglas', $data);
				$this->load->view('includes/ci_admin/footer');
				
			} else {
				show_404();
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- uredi slike
	public function uredi_slike()
	{
		if(parent::admPrijavljen() == TRUE) {
			$tip = $this->uri->segment(4);
			$oglas_id = $this->uri->segment(5);
			$korisnik_id = $this->uri->segment(6);
			switch ($tip) {
				case 'oglas':
					if (parent::vlasnikOglasa($korisnik_id, $oglas_id) == TRUE) {
						$this->load->model('stranica/oglasmodel');
						$oglas = $this->oglasmodel->popisSlikaObjekt($oglas_id);
						$data['slike_objekt'] = parent::slikeOglasa($oglas[0]['slike']);
						$data['page_title'] = 'Uredi slike';
						$this->lang->load('common', 'croatian');
						$this->load->view('includes/ci_admin/header', $data);
						$this->load->view('ci_admin/uredi-slike-objekt', $data);
						$this->load->view('includes/ci_admin/footer');
					} else {
						// -- greška ako oglas nije u vlasništvu korisnika
						show_404();
					}
					break;
				case 'usluga':
					$apartman_id = $this->uri->segment(6);
					if (parent::uslugaOglas($apartman_id, $oglas_id) == TRUE) {
						$this->load->model('stranica/oglasmodel');
						$apartman = $this->oglasmodel->slikeApartman($apartman_id);
						$data['slike_apartman'] = parent::slikeOglasa($apartman[0]['slike']);
						$data['page_title'] = 'Uredi slike';
						$this->lang->load('common', 'croatian');
						$this->load->view('includes/ci_admin/header', $data);
						$this->load->view('ci_admin/uredi-slike-usluga', $data);
						$this->load->view('includes/ci_admin/footer');
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
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- spremi promjene oglasa
	public function spremi_promjene_oglasa()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$this->lang->load('novi_oglas', 'croatian');
			if ($this->form_validation->run('administrator_novi_oglas') == FALSE) 
			{
				$this->load->model('stranica/homemodel');
				$data['page_title'] = 'Novi oglas';
				$data['zupanija'] = $this->korisnikmodel->popisRegija();
				$data['mjesto'] = $this->korisnikmodel->pocetniPopisMjesta($this->input->post('zupanija'));
				$data['head'] = $this->homemodel->getHead();
				$data['page_title'] = 'Uredi oglas';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/uredi-oglas-greska');
				$this->load->view('includes/ci_admin/footer');
			} else {
				$korisnik_id = $this->input->post('korisnik');
				$oglas_id = $this->uri->segment(4);
				if (get_cookie('uredi_oglas') == FALSE) {
					$this->adminmodel->spremiPromjeneOglasa($oglas_id);
					$oglas_id = $this->uri->segment(4);
					$cookie = array(
						'name'   => 'uredi_oglas',
						'value'  => $oglas_id,
						'expire' => '1800'  // -- 30 minuta
						);
					set_cookie($cookie);
				}
				redirect('ci_admin/opcija/promjene_spremljene');
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- uređivanje usluga
	public function uredi_uslugu()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->load->model('stranica/oglasmodel');
			$id = $this->uri->segment(6);
			if (parent::checkID('apartman', 'apartmanID', $id) == TRUE) {
				$data['page_title'] = 'Uredi uslugu';
				$data['head'] = $this->homemodel->getHead();
				$apartman = $this->oglasmodel->apartmanDetaljiAjax($id);
				$data['apartman'] = $apartman;
				$data['detalji_apartmana'] = parent::parseStringUredi($apartman[0]['detaljiApartmana'], 1);
				$this->lang->load('common', 'croatian');
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/uredi-uslugu', $data);
				$this->load->view('includes/ci_admin/footer');
				
			} else {
				show_404();
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- spremi promjene usluge
	public function spremi_promjene_usluge()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$this->lang->load('novi_oglas', 'croatian');
			$this->lang->load('form_validation', parent::getLang());
			$oglas_id = $this->uri->segment(4);
			$apartman_id = $this->uri->segment(5);

			if ($this->form_validation->run('novi_oglas_apartman') == FALSE) {
				$data['page_title'] = 'Uredi uslugu';
				$data['head'] = $this->homemodel->getHead();
				$apartman = $this->oglasmodel->apartmanDetaljiAjax($id);
				$data['apartman'] = $apartman;
				$data['detalji_apartmana'] = parent::parseStringUredi($apartman[0]['detaljiApartmana'], 1);
				$this->lang->load('common', 'croatian');
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/uredi-uslugu-greska', $data);
				$this->load->view('includes/ci_admin/footer');
			} else {
				if (parent::uslugaOglas($apartman_id, $oglas_id) == TRUE) {
					if (get_cookie('uredi_uslugu') == FALSE) {
						$this->korisnikmodel->spremiPromjeneUsluge($apartman_id);
						$cookie = array(
							'name'   => 'uredi_uslugu',
							'value'  => '1',
							'expire' => '1800'  // -- 30 minuta
						);
						set_cookie($cookie);
					}
					redirect('ci_admin/opcija/promjene_spremljene');
				} else {
					// -- greška ako usluga (apartman) ne pripada oglasu
					show_404();
				}
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	

	// -- istaknuti oglasi
	public function istaknuti_oglasi()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Istaknuti oglasi';
			$config['base_url'] = base_url().'ci_admin/opcija/istaknuti_oglasi';
			$config['total_rows'] = $this->adminmodel->ukupno('istaknuti_oglas');
			$config['per_page'] = 50;
			$config['num_links']= 5;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			
			$data['korisnici'] = $this->adminmodel->popisIstaknutihOglasa($config['per_page'], $this->uri->segment(4));
			$this->lang->load('common', 'croatian');
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/istaknuti-oglasi', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- banneri
	public function banneri()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Banneri';
			$config['base_url'] = base_url().'ci_admin/opcija/banneri';
			$config['total_rows'] = $this->adminmodel->ukupno('banner');
			$config['per_page'] = 50;
			$config['num_links']= 5;
			$config['uri_segment'] = 4;
			$this->pagination->initialize($config);
			
			$data['banneri'] = $this->adminmodel->popisBannera($config['per_page'], $this->uri->segment(4));
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/banneri', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}

	// -- novi banner
	public function novi_banner()
	{
		if(parent::admPrijavljen() == TRUE) {
			$data['page_title'] = 'Novi banner';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/novi-banner');
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- spremi banner
	public function spremi_banner()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			if ($this->form_validation->run('administrator_novi_banner') == FALSE) 
			{
				$data['page_title'] = 'Novi banner';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/novi-banner');
				$this->load->view('includes/ci_admin/footer');
			} else {
				$path = 'banneri';
				$result = parent::doBannerUpload($path);
				if(isset($result['greska']) && $result['greska'] == TRUE)
				{
					$data['page_title'] = 'Novi banner';
					$data['greska'] = $result;
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/novi-banner');
					$this->load->view('includes/ci_admin/footer');
				} else {
					$slike = $result['naziv_slika'];
					$this->adminmodel->spremiBanner($slike);
					$data['page_title'] = 'Banner';
					$data['info'] = 'Banner spremljen';
					$data['uri_segment'] = 'banneri';
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/info/info', $data);
					$this->load->view('includes/ci_admin/footer');
				}
				
			}
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- čišćenje MySQL cachea
	public function ccache()
	{
		if(parent::admPrijavljen() == TRUE) {
			$this->adminmodel->ccache_all();
			
			$data['page_title'] = 'Query cache';
			$data['info'] = 'Query cache očišćen!';
			$data['uri_segment'] = '';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/info/info', $data);
			$this->load->view('includes/ci_admin/footer');
		} else {
			$data['page_title'] = 'Prijava';
			$data['greska'] = 'Pristup zabranjen! Morate se prijaviti!';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava', $data);
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	// -- odjava administratora
	public function odjava()
	{
		$session = array('adm_ID' => '', 'adm_korisnicko_ime' => '', 'adm_tip' => '', 'adm_prijavljen' => '', 'administrator' => '');
		$this->session->unset_userdata($session);
		delete_cookie('oid');
		delete_cookie('o_img');
		delete_cookie('aid');
		redirect('ci_admin');
	}
	
}

