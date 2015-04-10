<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Registracijamodel extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->library('funkcija');
    }
	
	// -- provjera da li korisničko ime postoji u bazi
	public function checkUsername($user)
	{
		$this->db->select('korisnikID');
		$this->db->from('korisnik');
		$this->db->where('korisnicko_ime', $user);
		$query = $this->db->get();
		
		$ukupno = $query->num_rows(); 
		
		if($ukupno == 0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// -- provjera da li email adresa postoji u bazi
	public function checkEmail($email)
	{
		$this->db->select('korisnikID');
		$this->db->from('korisnik');
		$this->db->where('email', $email);
		$query = $this->db->get();
		
		$ukupno = $query->num_rows(); 
		
		if($ukupno == 0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	// -- postavljanje defaultne vrijednosti za string tip podataka
	private function optionalFieldString($input)
	{
		if($input == '')
		{
			$input = '-';
			return $input;
		} else {
			return $input;
		}
	}
	
	// -- postavljanje defaultne vrijednosti za INT tip podataka
	private function optionalFieldInt($input)
	{
		if($input == '')
		{
			$input = 0;
			return $input;
		} else {
			return $input;
		}
	}
	
	// -- spremanje korisničkih podataka u bazu
	/*public function spremiKorisnika() // -- stara metoda spremanja lozinke
	{
		$data['tipID'] = (int) $this->input->post('tip_korisnika');
		$data['ime'] = $this->input->post('ime');
		$data['prezime'] = $this->input->post('prezime');
		$data['korisnicko_ime'] = $this->input->post('korisnicko_ime');
		$data['lozinka'] = crypt($this->input->post('lozinka'), PASS_SALT);
		$data['email'] = $this->input->post('email');
		$data['adresa'] = $this->optionalFieldString ($this->input->post('adresa'));
		$data['broj_poste'] = $this->optionalFieldInt ($this->input->post('broj_poste'));
		$data['grad'] = $this->optionalFieldString ($this->input->post('grad'));
		$data['drzava'] = $this->optionalFieldString ($this->input->post('drzava'));
		$data['broj_telefona'] = $this->optionalFieldString ($this->input->post('broj_telefona'));
		$data['broj_mobitela'] = $this->optionalFieldString ($this->input->post('broj_mobitela'));
		$data['oib'] = $this->optionalFieldString ($this->input->post('oib'));
		$data['naziv_tvrtke'] = $this->optionalFieldString ($this->input->post('naziv_tvrtke'));
		$data['datum_registracije'] =$this->funkcije->dbInputDate(); 
		$data['aktivan'] = 1;
		$query = $this->db->insert('korisnik', $data); 
		return $query;
	}*/
	
	// -- spremanje korisničkih podataka u bazu
	public function spremiKorisnika($lozinka)
	{
		$data['tipID'] = (int) $this->input->post('tip_korisnika');
		$data['ime'] = $this->input->post('ime');
		$data['prezime'] = $this->input->post('prezime');
		$data['korisnicko_ime'] = $this->input->post('korisnicko_ime');
		$data['lozinka'] = $lozinka;
		$data['email'] = $this->input->post('email');
		$data['adresa'] = $this->optionalFieldString ($this->input->post('adresa'));
		$data['broj_poste'] = $this->optionalFieldInt ($this->input->post('broj_poste'));
		$data['grad'] = $this->optionalFieldString ($this->input->post('grad'));
		$data['drzava'] = $this->optionalFieldString ($this->input->post('drzava'));
		$data['broj_telefona'] = $this->optionalFieldString ($this->input->post('broj_telefona'));
		$data['broj_mobitela'] = $this->optionalFieldString ($this->input->post('broj_mobitela'));
		$data['oib'] = $this->optionalFieldString ($this->input->post('oib'));
		$data['naziv_tvrtke'] = $this->optionalFieldString ($this->input->post('naziv_tvrtke'));
		$data['datum_registracije'] = $this->funkcija->dbInputDate(); 
		$data['aktivan'] = 1;
		$query = $this->db->insert('korisnik', $data); 
		return $query;
	}
	
	
}