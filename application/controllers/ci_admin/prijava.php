<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Prijava extends MY_Controller {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('ci_admin/adminmodel');
    }
	
	public function index()
	{
		if(parent::admPrijavljen() == TRUE)
		{
			redirect('ci_admin/opcija/index');
		} else {
			$data['page_title'] = 'Prijava';
			$this->load->view('includes/ci_admin/header', $data);
			$this->load->view('ci_admin/prijava');
			$this->load->view('includes/ci_admin/footer');
		}
	}
	
	public function provjera()
	{
		if(parent::admPrijavljen() == TRUE)
		{
			redirect('ci_admin');
		} else {
			$this->form_validation->set_rules('prijava_korisnicko_ime', 'Korisničko ime', 'required|xss_clean|prep_for_form|encode_php_tags');
			$this->form_validation->set_rules('prijava_lozinka', 'Lozinka', 'required|xss_clean|prep_for_form|encode_php_tags');
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		
			if ($this->form_validation->run() == FALSE)
			{
				$data['page_title'] = 'Prijava';
				$this->load->view('includes/ci_admin/header', $data);
				$this->load->view('ci_admin/prijava');
				$this->load->view('includes/ci_admin/footer');
			} else {
				$arrPrijava = $this->adminmodel->adminPrijava();
				if($arrPrijava['match'] == TRUE) // -- provjerava da li se podaci slažu s podacima u bazi
				{
					parent::admPrijava($arrPrijava['match'], $arrPrijava['ID'], $arrPrijava['korisnicko_ime'], $arrPrijava['tip']);
					redirect('ci_admin');
				} else {
					$data['page_title'] = 'Prijava';
					$data['greska'] = 'Neispravno korisničko ime ili lozinka!';
					$this->load->view('includes/ci_admin/header', $data);
					$this->load->view('ci_admin/prijava', $data);
					$this->load->view('includes/ci_admin/footer');
				}
			}
			
		}
	}
	
	
}

