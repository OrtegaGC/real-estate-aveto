<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Adminmodel extends CI_Model {
	
	public function __construct()
    {
        parent::__construct();
		$this->load->library('funkcija');
    }
	
	//-- 
	private function dbInputString($data, $delimiter)
	{
		$result = '';
		switch ($delimiter) {
			case 1:
				if ($data != '') {
					foreach ($data as $d_value) {
						$result .= $d_value.';';
					}
				}
				return $result;
				break;
			case 2:
				foreach ($data as $d_value) {
					if ($this->input->post($d_value) != '') {
						$result .= $d_value.':'.$this->input->post($d_value).';';
					}
				}
				return $result;
				break;
			
			default: 
				return $result;
				break;
		}
		
	}
	
	// -- prijava administratora
	public function adminPrijava()
	{
		$korisnicko_ime = $this->input->post('prijava_korisnicko_ime');
		$lozinka = $this->input->post('prijava_lozinka');
		$this->db->select('korisnikID, tipID, korisnicko_ime, lozinka');
		$this->db->from('korisnik');
		$this->db->where('korisnicko_ime', $korisnicko_ime);
		
		$query = $this->db->get();
		$result = $query->result_array();
		// -- nova metoda provjere
		if (empty($result)) {
			return FALSE;
		} else {
			$pass_array = explode(':', $result[0]['lozinka']);
			$hash_pass = $pass_array[0];
			$hash_salt = $pass_array[1];
			if ( $korisnicko_ime == $result[0]['korisnicko_ime'] && $hash_pass == md5($lozinka.$hash_salt) ) {
				$userData = array(
					'ID'	=> $result[0]['korisnikID'],
					'korisnicko_ime'	=> $result[0]['korisnicko_ime'],
					'tip'	=> $result[0]['tipID'],
					'match'	=> TRUE
               );
				return $userData;
			} else {
				return FALSE;
			}
		}
	}
	
	// -- broj zapisa u tablici
	public function ukupno($table)
	{
		$query = $this->db->count_all($table);
		return $query;
	}
	
	// --
	public function ukupnoFilterDatum(array $datumi, $table)
	{
		if (!isset($datumi[1])) {
			$datum_od = $datumi[0];
			$datum_do = $datumi[0];
		} else {
			$datum_od = $datumi[0];
			$datum_do = $datumi[1];
		}
		$datum_od_db = $this->funkcija->dbInputDate($datum_od);
		$datum_do_db = $this->funkcija->dbInputDate($datum_do);
		$where = "(datum_registracije BETWEEN '$datum_od_db' AND '$datum_do_db')";
		$this->db->select('COUNT(*) as ukupno');
		$this->db->from($table);
		$this->db->where($where);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- popis korisnika
	public function popisKorisnika($num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('korisnikID, ime, prezime, korisnicko_ime, korisnik.tipID, email, naziv');
  		$this->db->from('korisnik');
		$this->db->join('tip_korisnika', 'korisnik.tipID = tip_korisnika.tipID');
		$this->db->order_by('prezime', 'asc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- popis korisnika
	public function popisKorisnikaFilterDatum(array $datumi, $num, $offset)
	{
		if ($datumi[1] == '') {
			$datum_od = $datumi[0];
			$datum_do = $datumi[0];
		} else {
			$datum_od = $datumi[0];
			$datum_do = $datumi[1];
		}
		$datum_od_db = $this->funkcija->dbInputDate($datum_od);
		$datum_do_db = $this->funkcija->dbInputDate($datum_do);
		$where = "(datum_registracije BETWEEN '$datum_od_db' AND '$datum_do_db')";
		$this->db->cache_off();
		$this->db->select('korisnikID, ime, prezime, korisnicko_ime, korisnik.tipID, email, naziv');
  		$this->db->from('korisnik');
		$this->db->join('tip_korisnika', 'korisnik.tipID = tip_korisnika.tipID');
		$this->db->where($where);
		$this->db->order_by('prezime', 'asc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- detalji korisnik
	public function detaljiKorisnika($id)
	{
		$this->db->cache_off();
		$this->db->select('*');
		$this->db->from('korisnik');
		$this->db->where('korisnikID', $id);
		$query =  $this->db->get();
		return $query->result_array();
	}
	
	// -- izbriši korisnika
	public function izbrisiKorisnika($id)
	{
		$this->db->delete('korisnik', array('korisnikID' => $id)); 
	}
	
	// -- popis oglasa
	public function popisOglasa($num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('oglasID, nazivObjekta, tipSmjestaja, brojZvijezdica, naziv_mjesta, naziv_regije, vidljiv');
  		$this->db->from('oglas');
		$this->db->join('mjesto', 'mjesto.mjestoID = oglas.mjestoID');
		$this->db->join('regija', 'mjesto.regijaID = regija.regijaID');
		$this->db->order_by('oglasID', 'desc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- popis istaknutih oglasa
	public function popisIstaknutihOglasa($num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('oglas.oglasID, oglas.nazivObjekta, oglas.tipSmjestaja, oglas.brojZvijezdica, mjesto.naziv_mjesta, regija.naziv_regije, istaknuti_oglas.pozicija, istaknuti_oglas.datumIsteka');
  		$this->db->from('oglas');
		$this->db->join('mjesto', 'mjesto.mjestoID = oglas.mjestoID');
		$this->db->join('regija', 'mjesto.regijaID = regija.regijaID');
		$this->db->join('istaknuti_oglas', 'oglas.oglasID = istaknuti_oglas.oglasID');
		/*$where = "oglas.oglasID = istaknuti_oglas.oglasID";
   		$this->db->where($where);*/
		$this->db->order_by('oglasID', 'desc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}

	// -- spremanje oglasa
	public function spremiOglas()
	{
		$data_ostale_informacije = array('kvadratura_objekta', 'broj_soba', 'broj_parkirnih_mjesta', 'povrsina_autokampa', 
					'broj_kamp_jedinica', 'broj_wc_jedinica', 'broj_tuseva', 'velicina_plovila',
					'centar', 'plaza', 'restoran', 'posta', 'banka', 'ljekarna',
					'ambulanta', 'policija', 'najblize_mjesto', 'najblizi_grad', 'autobusna_stanica', 'autobusni_kolodvor',
					'zracna_luka', 'zeljeznicki_kolodvor', 'brodska_luka', 'trgovina', 'nogometno_igraliste', 'kosarkasko_igraliste',
					'vaterpolo', 'profesionalno_trcanje', 'staza_za_trcanje', 'profesionalno_ronjenje', 'najam_camaca', 'spustanje_camca_u_more',
					'duljina_biciklisticke_staze', 'jedrenje_na_dasci', 'lunapark_za_djecu'
					);
		
		$ostale_informacije = $this->dbInputString($data_ostale_informacije, 2);
		
		$data = array(
   			'korisnikID' => $this->input->post('korisnik'),
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
   			'detaljiAutoKampa' => '',
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
			'vidljiv' => 0
			);
			
		$jezici = $this->input->post('jezici');
		$detalji_smjestajne_jedinice = $this->input->post('detalji_smjestajne_jedinice');
		$detalji_auto_kampa = $this->input->post('detalji_auto_kampa');
		
		if (!empty($jezici)) {
			foreach($this->input->post('jezici') as $value) {
				$data['jeziciDomacin'] .= $value.';';
			}
		}

		if (!empty($detalji_smjestajne_jedinice)) {
			foreach($this->input->post('detalji_smjestajne_jedinice') as $value) {
				$data['detaljiSmjestajneJedinice'] .= $value.';';
			}
		}
		
		if (!empty($detalji_auto_kampa)) {
			foreach($this->input->post('detalji_auto_kampa') as $key => $value) {
				$data['detaljiAutoKampa'] .= $value.';';
			}

		}

		$this->db->insert('oglas', $data); 
	}
	
	// -- spremanje promjena oglasa
	public function spremiPromjeneOglasa($oglas_id)
	{
		$data_ostale_informacije = array('kvadratura_objekta', 'broj_soba', 'broj_parkirnih_mjesta', 'povrsina_autokampa', 
					'broj_kamp_jedinica', 'broj_wc_jedinica', 'broj_tuseva', 'velicina_plovila',
					'centar', 'plaza', 'restoran', 'posta', 'banka', 'ljekarna',
					'ambulanta', 'policija', 'najblize_mjesto', 'najblizi_grad', 'autobusna_stanica', 'autobusni_kolodvor',
					'zracna_luka', 'zeljeznicki_kolodvor', 'brodska_luka', 'trgovina', 'nogometno_igraliste', 'kosarkasko_igraliste',
					'vaterpolo', 'profesionalno_trcanje', 'staza_za_trcanje', 'profesionalno_ronjenje', 'najam_camaca', 'spustanje_camca_u_more',
					'duljina_biciklisticke_staze', 'jedrenje_na_dasci', 'lunapark_za_djecu'
					);
		
		$ostale_informacije = $this->dbInputString($data_ostale_informacije, 2);
		
		$data = array(
			'korisnikID' => $this->input->post('korisnik'),
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
   			'detaljiAutoKampa' => '',
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
		$detalji_auto_kampa = $this->input->post('detalji_auto_kampa');
		
		if (!empty($jezici)) {
			foreach($this->input->post('jezici') as $value) {
				$data['jeziciDomacin'] .= $value.';';
			}
		}

		if (!empty($detalji_smjestajne_jedinice)) {
			foreach($this->input->post('detalji_smjestajne_jedinice') as $value) {
				$data['detaljiSmjestajneJedinice'] .= $value.';';
			}
		}
		
		if (!empty($detalji_auto_kampa)) {
			foreach($this->input->post('detalji_auto_kampa') as $key => $value) {
				$data['detaljiAutoKampa'] .= $value.';';
			}

		}

		$this->db->where('oglasID', $oglas_id);
		$this->db->update('oglas', $data); 
	}
	
	
	// -- izbriši oglas
	public function izbrisiOglas($id)
	{
		$this->db->delete('oglas', array('oglasID' => $id)); 
	}
	
	// -- aktiviraj oglas
	public function aktivirajOglas($id)
	{
		$data = array(
               'aktivan' => 1,
               'vidljiv' => 1
            );
		$this->db->where('oglasID', $id);
		$this->db->update('oglas', $data); 
	}
	
	// -- aktiviraj oglas
	public function deaktivirajOglas($id)
	{
		$data = array(
               'aktivan' => 1,
               'vidljiv' => 0
            );
		$this->db->where('oglasID', $id);
		$this->db->update('oglas', $data); 
	}

	// -- popis bannera
	public function popisBannera($num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('bannerID, naziv, webStranica, datumObjave, datumIsteka');
  		$this->db->from('banner');
		$this->db->order_by('bannerID', 'asc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- spremi banner
	public function spremiBanner($slika)
	{
		$datum = $this->input->post('datum_isteka');
		$data = array(
   			'naziv' => $this->input->post('naziv_bannera'),
   			'webStranica' => $this->input->post('web_stranica'),
   			'datumObjave' => $this->funkcija->dbInputDate(),
   			'datumIsteka' => $this->funkcija->dbInputDate($datum),
   			'slika' => $slika
			);

		$this->db->insert('banner', $data); 
	}
	
	// -- ajax funkcija
	public function korisnikID(array $input, $input_tip)
	{
		$this->db->cache_off();
		$this->db->select('korisnikID, ime, prezime, korisnicko_ime');
  		$this->db->from('korisnik');
		switch ($input_tip) {
			case 1:
				$ime = $input[0];
				$where = "ime LIKE '%$ime%'";
				$this->db->where($where);
				break;
			case 2:
				$ime = $input[0];
				$prezime = $input[1];
				$where = "ime LIKE '%$ime%' AND prezime LIKE '%$prezime%'";
				$this->db->where($where);
				break;
			case 3:
				$ime = $input[0];
				$prezime = $input[1].' '.$input[2];
				$where = "ime LIKE '%$ime%' AND prezime LIKE '%$prezime%'";
				$this->db->where($where);
				break;
			
			default:
				$ime = $input[0];
				$prezime = $input[1].' '.$input[2];
				$where = "ime LIKE '%$ime%' AND prezime LIKE '%$prezime%'";
				$this->db->where($where);
				break;
		}
		$this->db->where('tipID', '2');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- ajax funkcija
	public function oglasID(array $input, $input_tip)
	{
		$this->db->cache_off();
		$this->db->select('oglasID, nazivObjekta');
  		$this->db->from('oglas, korisnik');
		switch ($input_tip) {
			case 1:
				$ime = $input[0];
				$where = "oglas.korisnikID = korisnik.korisnikID";
				$this->db->where($where);
				$and = "ime LIKE '%$ime%'";
				$this->db->where($and);
				break;
			case 2:
				$ime = $input[0];
				$prezime = $input[1];
				$where = "oglas.korisnikID = korisnik.korisnikID";
				$this->db->where($where);
				$and = "korisnik.ime LIKE '%$ime%' AND korisnik.prezime LIKE '%$prezime%'";
				$this->db->where($and);
				break;
			case 3:
				$ime = $input[0];
				$prezime = $input[1].' '.$input[2];
				$where = "oglas.korisnikID = korisnik.korisnikID";
				$this->db->where($where);
				$and = "korisnik.ime LIKE '%$ime%' AND korisnik.prezime LIKE '%$prezime%'";
				$this->db->where($and);
				break;
			
			default:
				$ime = $input[0];
				$prezime = $input[1].' '.$input[2];
				$where = "oglas.korisnikID = korisnik.korisnikID";
				$this->db->where($where);
				$and = "korisnik.ime LIKE '%$ime%' AND korisnik.prezime LIKE '%$prezime%'";
				$this->db->where($and);
				break;
		}
		$this->db->where('tipID', '2');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	// -- lista primatelja
	public function primateljiObavijesti()
	{
		$this->db->cache_off();
		$this->db->select('email');
  		$this->db->from('primatelji_obavijesti');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// -- 
	public function ccache_all()
	{
		$this->db->cache_delete_all();
	}
}