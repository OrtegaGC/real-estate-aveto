<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Trazi extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('stranica/homemodel');
		$this->load->model('stranica/trazimodel');
    }
	
	private function setCookieData($post_arr)
	{
		// -- [upit;zupanija;mjesto:tip_smjestaja]
		$data = '';
		if ($post_arr['upit'] == '' AND $post_arr['zupanija'] == '0' AND !isset($post_arr['mjesto']) AND !isset($post_arr['tip_smjestaja']))
		{
			$data .= ';0;:';
		} else {
			if (!isset($post_arr['upit'])) { $post_arr['upit'] = ''; }
			
			//if (!isset($post_arr['zupanija'])) { $post_arr['zupanija'] = '0'; }
			
			if (!isset($post_arr['mjesto'])) { $post_arr['mjesto'] = ''; }
			
			if (!isset($post_arr['tip_smjestaja'])) { $post_arr['tip_smjestaj'] = ''; }
			
			$tip_smjestaja = '';
			if (isset($post_arr['tip_smjestaja']))
			{
				foreach ($post_arr['tip_smjestaja'] as $value)
				{
					$tip_smjestaja .= $value.';';
				}
			}
			$data .= $post_arr['upit'].';'.$post_arr['zupanija'].';'.$post_arr['mjesto'].':'.$tip_smjestaja;
		}
		return $data;
	}
	
	private function setSearchQuery($data)
	{
		$cookie = array(
			'name'   => 's_query',
			'value'  => $data,
			'expire' => '1800'  // -- 30 minuta
		);
		set_cookie($cookie);
	}
	
	private function parseCookie($cookie)
	{
		$temp_data = array();
		$data = array();
		$arr = explode(':', $cookie);
		foreach ($arr as $key => $value) 
		{
			$temp_data[$key] = $value;
		}
		
		$arr_1 = explode(';',$temp_data[0]);
		foreach ($arr_1 as $key_1 => $value_1) 
		{
			while ($key_1 == 0) {
					$data['upit'] = $value_1;
				break;
			} 
			
			while ($key_1 == 1) {
   				if ($value_1 != '')
				{
					$data['zupanija'] = $value_1;
				}
				break;
			}
			
			while ($key_1 == 2) {
				if ($value_1 != '')
				{
					$data['mjesto'] = $value_1;
				}
				break;
			} 
		}
		
		$arr_2 = explode(';', $temp_data[1]);
		foreach ($arr_2 as $key_2 => $value_2) 
		{	if ($value_2 != '')
			{
				$data['tip_smjestaja'][$key_2] = $value_2;	
			}
		}
		
		return $data;
	}

	public function upit()
	{
		$trazi = $this->input->post('trazi');
		if ($trazi == '') {
			show_404();
		} else {
			$this -> form_validation -> set_error_delimiters('<p class="error">', '</p>');
			$this -> lang -> load('form_validation', parent::getLang());
			$this -> lang -> load('common', parent::getLang());
			if (get_cookie('s_query') == TRUE) {
				delete_cookie('s_query');
			}

			if ($this -> form_validation -> run('trazi') == FALSE) {
				// -- greška kod treženja - form validation
				/*
				 $result = $this->homemodel->getHead();
				 $data['head'] = $result;
				 $data['tecajna'] = parent::tecajnaLista();
				 $data['regije'] = $this->homemodel->popisRegija();
				 $this->lang->load('common', parent::getLang());
				 $this->lang->load('trazi', parent::getLang());
				 $this->load->view('includes/head', $data);
				 $this->load->view('includes/header');
				 $this->load->view('stranica/trazi');
				 $this->load->view('includes/footer');*/
			} else {
				$result = $this -> homemodel -> getHead();
				$post_arr = $this -> input -> post();
				$data['head'] = $result;
				$data['tecajna'] = parent::tecajnaLista();
				$data['regije'] = $this -> homemodel -> popisRegija();
				$data['upit'] = $post_arr;

				if ($post_arr['upit'] == '' AND $post_arr['zupanija'] == '0' AND !isset($post_arr['mjesto']) AND !isset($post_arr['tip_smjestaja'])) {
					$cookie = $this -> setCookieData($post_arr);
					$this -> setSearchQuery($cookie);

					$ukupno = $this -> trazimodel -> prebrojiSve();
					$config['base_url'] = base_url() . 'trazi/rezultat';
					$config['total_rows'] = $ukupno[0]['ukupno'];
					$config['per_page'] = 20;
					$config['num_links'] = 5;
					$config['uri_segment'] = 3;
					$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
					$this -> pagination -> initialize($config);

					$result = $this -> trazimodel -> traziSve($config['per_page'], $this -> uri -> segment(3));
					$data['ukupno'] = $ukupno[0]['ukupno'];
					$data['query_result'] = $result;
					$data['trazi_slika'] = parent::traziRezultatiSlika($result);
					$this -> lang -> load('common', parent::getLang());
					$this -> lang -> load('trazi', parent::getLang());
					$this -> load -> view('includes/head', $data);
					$this -> load -> view('includes/header');
					$this -> load -> view('stranica/trazi', $data);
					$this -> load -> view('includes/footer');

				} else {
					$cookie = $this -> setCookieData($post_arr);
					$this -> setSearchQuery($cookie);
					
					$ukupno = $this -> trazimodel -> prebrojiSveUvjeti($post_arr);
					$config['base_url'] = base_url() . 'trazi/rezultat';
					$config['total_rows'] = $ukupno[0]['ukupno'];
					$config['per_page'] = 20;
					$config['num_links'] = 5;
					$config['uri_segment'] = 3;
					$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
					$this -> pagination -> initialize($config);
					
					$data['query_info'] = $this -> trazimodel -> upitInfo($post_arr);
					$result = $this -> trazimodel -> traziUvjeti($post_arr, $config['per_page'], $this -> uri -> segment(3));
					$data['ukupno'] = $ukupno[0]['ukupno'];
					$data['query_result'] = $result;
					$data['trazi_slika'] = parent::traziRezultatiSlika($result);
					$this -> lang -> load('common', parent::getLang());
					$this -> lang -> load('trazi', parent::getLang());
					$this -> load -> view('includes/head', $data);
					$this -> load -> view('includes/header');
					$this -> load -> view('stranica/trazi', $data);
					$this -> load -> view('includes/footer');
				}

			}
		}
	}

	public function rezultat()
	{
		if(get_cookie('s_query') == FALSE)
		{
			show_404();
		} else {
			$post_arr =  $this->parseCookie(get_cookie('s_query'));
			if ($post_arr['upit'] == '' AND $post_arr['zupanija'] == '0') {
				$result = $this->homemodel->getHead();
				$data['head'] = $result;
				$data['tecajna'] = parent::tecajnaLista();
				$data['regije'] = $this->homemodel->popisRegija();
				$data['upit'] = $post_arr;
			
				$ukupno = $this->trazimodel->prebrojiSve();
				$config['base_url'] = base_url().'trazi/rezultat';
				$config['total_rows'] = $ukupno[0]['ukupno'];
				$config['per_page'] = 20;
				$config['num_links']= 5;
				$config['uri_segment'] = 3;
				$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
				$this->pagination->initialize($config);
				
				$result = $this->trazimodel->traziSve($config['per_page'], $this->uri->segment(3));
				$data['ukupno'] = $ukupno[0]['ukupno'];
				$data['query_result'] = $result;
				$data['trazi_slika'] = parent::traziRezultatiSlika($result);
				$this->lang->load('common', parent::getLang());
				$this->lang->load('trazi', parent::getLang());
				$this->load->view('includes/head', $data);
				$this->load->view('includes/header');
				$this->load->view('stranica/trazi', $data);
				$this->load->view('includes/footer');
			} else {
				$result = $this->homemodel->getHead();
				$data['head'] = $result;
				$data['tecajna'] = parent::tecajnaLista();
				$data['regije'] = $this->homemodel->popisRegija();
				$data['upit'] = $post_arr;
			
				$ukupno = $this->trazimodel->prebrojiSveUvjeti($post_arr);
				$config['base_url'] = base_url().'trazi/rezultat';
				$config['total_rows'] = $ukupno[0]['ukupno'];
				$config['per_page'] = 20;
				$config['num_links']= 5;
				$config['uri_segment'] = 3;
				$config['use_page_numbers'] = FALSE; // -- ako je true, ne prikazuje ispravno rezultate
				$this->pagination->initialize($config);
				
				$result = $this->trazimodel->traziUvjeti($post_arr, $config['per_page'], $this->uri->segment(3));
				$data['query_info'] = $this -> trazimodel -> upitInfo($post_arr);
				$data['ukupno'] = $ukupno[0]['ukupno'];
				$data['query_result'] = $result;
				$data['trazi_slika'] = parent::traziRezultatiSlika($result);
				$this->lang->load('common', parent::getLang());
				$this->lang->load('trazi', parent::getLang());
				$this->load->view('includes/head', $data);
				$this->load->view('includes/header');
				$this->load->view('stranica/trazi', $data);
				$this->load->view('includes/footer');
			}
		}
	}
	
}

