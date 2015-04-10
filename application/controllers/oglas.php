<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Oglas extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('stranica/homemodel');
		$this->load->model('stranica/oglasmodel');
		$this->load->model('stranica/korisnikmodel');
    }
	
	// -- prikazuje popis mjesta u nekoj regiji
	public function regija()
	{
		parent::brojacPosjeta();
		$id = $this->uri->segment(3);
		if(parent::checkID('regija', 'regijaID', $id) == TRUE)
		{
			$result = $this->homemodel->getHead();
			$data['head'] = $result;
			$data['tecajna'] = parent::tecajnaLista();
			$data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
			$data['regije'] = $this->homemodel->popisRegija();
			$data['regija'] = $this->homemodel->detaljiRegije((int)$id);
			$data['mjesta'] = $this->homemodel->popisMjesta((int)$id);
			$this->lang->load('oglas', parent::getLang());
			$this->lang->load('common', parent::getLang());
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('oglas/mjesta', $data);
			$this->load->view('includes/footer');
		} else {
			show_404();
		}
	}
	
	// -- prikazuje popis oglasa iz nekog mjesta
	public function mjesto()
	{
		//$this->output->enable_profiler(TRUE);
		parent::brojacPosjeta();
		$id = $this->uri->segment(3);
		if(parent::checkID('mjesto', 'mjestoID', $id) == TRUE)
		{
			$ukupno = $this->oglasmodel->ukupno($id);
			$config['base_url'] = base_url().'oglas/mjesto/'.$id.'/stranica';
			$config['total_rows'] = $ukupno[0]['ukupno'];
			$config['per_page'] = 9;
			$config['num_links']= 5;
			$config['uri_segment'] = 5;
			$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
			$this->pagination->initialize($config);
			
			$result = $this->homemodel->getHead();
			$oglas = $this->oglasmodel->oglasIntro($id, $config['per_page'], $this->uri->segment(5));
			$data['head'] = $result;
			$data['tecajna'] = parent::tecajnaLista();
			$data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
			$data['regije'] = $this->homemodel->popisRegija();
			$data['regija'] = $this->homemodel->nazivRegije((int)$id);
			$data['mjesto'] = $this->homemodel->nazivMjesta((int)$id);
			$data['oglas'] = $oglas;
			foreach($oglas as $key => $value)
			{
				$data['glavna_slika'][$key] = parent::glavnaSlikaThumb($value['slike']);
			}
			$this->lang->load('oglas', parent::getLang());
			$this->lang->load('common', parent::getLang());
			$this->load->view('includes/head', $data);
			$this->load->view('includes/header');
			$this->load->view('oglas/popis-oglasa', $data);
			$this->load->view('includes/footer');
		} else {
			show_404();
		}
	}
	
	// -- prikazuje detalje oglasa
	public function detalji()
	{
		//$this->output->enable_profiler(TRUE);
		$mjestoID = $this->uri->segment(3);
		$oglasID = $this->uri->segment(4);
		parent::brojacPosjeta();
		if(parent::checkID('mjesto', 'mjestoID', $mjestoID) == TRUE && parent::checkID('oglas', 'oglasID', $oglasID) == TRUE)
		{
			if (parent::statusOglas($oglasID) == TRUE)
			{
				parent::brojPregledaOglasa($oglasID);
				$result = $this->homemodel->getHead();
				$oglas = $this->oglasmodel->oglasDetalji($oglasID);
				//$apartman = $this->oglasmodel->apartmanDetalji($oglasID);
                                //echo "<pre>", print_r($apartman, 1), "</pre>"; die;
				$data['head'] = $result;
				$data['tecajna'] = parent::tecajnaLista();
				$data['brojac'] = $this->korisnikmodel->ukupnoPosjeta('stranica', FALSE);
				$data['regije'] = $this->homemodel->popisRegija();
				$data['regija'] = $this->homemodel->nazivRegije((int)$mjestoID);
				$data['mjesto'] = $this->homemodel->nazivMjesta((int)$mjestoID);
				$data['oglas'] = $oglas;
				$data['jezici'] = parent::jeziciOglasa($oglas[0]['jeziciDomacin']);
				$data['detalji_objekta'] = parent::detaljiObjekta($oglas[0]['detaljiSmjestajneJedinice']);
				$data['detalji_aktivnosti_okolica'] = parent::detaljiKampa($oglas[0]['detaljiAktivnostiOkolica']);
				$data['slike'] = parent::slikeOglasa($oglas[0]['slike']);
				$data['posjeti'] = $this->korisnikmodel->ukupnoPregleda('oglas', $oglasID); //echo "<pre>",print_r($data['detalji_aktivnosti_okolica']),"</pre>"; die;
				//$data['popis_apartmana'] = $this->oglasmodel->popisApartmana($oglasID);
				//$data['apartman'] = $apartman;
				//$data['detalji_apartmana'] = parent::detaljiObjekta($apartman[0]['detaljiApartmana']);
				//$data['slike_apartman'] = parent::slikeOglasa($apartman[0]['slike']);
			
				$this->lang->load('oglas_detalji', parent::getLang());
				$this->lang->load('common', parent::getLang());
				$this->load->view('includes/head', $data);
				$this->load->view('includes/header');
				$this->load->view('oglas/detalji', $data);
				$this->load->view('includes/footer');
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}
	
}