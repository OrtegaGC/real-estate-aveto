<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Ajax extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('stranica/homemodel');
        $this->load->model('stranica/oglasmodel');
        $this->load->model('stranica/korisnikmodel');
        $this->load->model('ci_admin/adminmodel');
        $this->load->library('funkcija');
    }
	
    // -- index stranica korisnika
    // -- preusmjerava na početnu stranicu u slučaju pristupa preko url-a
    public function index()
    {
        redirect('stranica');
    }
    
    // -- 
    public function mjesto_trazilica()
    {
        if(isset($_POST['id']))
        {
            usleep(500000);
            $data = '';
            if ($_POST['id'] == '0')
            {
                $this->lang->load('common', parent::getLang());
                $data .= '<option value="0">'.lang('home_trazilica_mjesto').'</option>'."\n";
                $this->output->set_output($data);
            } else {
                $id = $_POST['id'];
                $result = $this->korisnikmodel->popisMjesta($id);
                $this->lang->load('common', parent::getLang());
                $data .= '<option value="0">'.lang('home_trazilica_mjesto').'</option>'."\n";
                foreach ($result as $value)
                {
                    //echo '<option value="'.$value['mjestoID'].'">'.$value['naziv_mjesta'].'</option>';
                    $data .= '<option value="'.$value['mjestoID'].'">'.$value['naziv_mjesta'].'</option>'."\n";
                }
                $this->output->set_output($data);
            }
                        
                        
        }
                
    }
	
	// -- 
	public function mjesto()
	{
		if(isset($_POST['id']))
		{
			usleep(500000);
			$data = '';
			if ($_POST['id'] == '0') {
				$this->lang->load('common', parent::getLang());
				$data .= '<option value="0">'.lang('home_trazilica_mjesto').'</option>'."\n";
				$this->output->set_output($data);
			} else {
				$id = $_POST['id'];
				$result = $this->korisnikmodel->popisMjesta($id);
				foreach ($result as $value) {
					//echo '<option value="'.$value['mjestoID'].'">'.$value['naziv_mjesta'].'</option>';
					$data .= '<option value="'.$value['mjestoID'].'">'.$value['naziv_mjesta'].'</option>'."\n";
				}
				$this->output->set_output($data);
			}
			
			
		}
		
	}
	
	// -- popis mjesta ispod karte - oglasi
	public function popis_mjesta()
	{
		if(isset($_POST['id']))
		{
			usleep(500000);
			$result = $this->homemodel->popisMjesta($_POST['id']);
			$data = '';
			foreach($result as $value)
			{
				//echo '<p> <a href="'.base_url().'oglas/mjesto/'.$value['mjestoID'].'"> '.$value['naziv_mjesta'].' </a> </p>';
				$data .= '<p> <a href="'.base_url().'oglas/mjesto/'.$value['mjestoID'].'"> '.$value['naziv_mjesta'].' </a> </p>'."\n";
			}
			$this->output->set_output($data);
		}
	}
	
	// -- popis mjesta ispod karte - potraznja
	public function popis_mjesta_potraznja()
	{
		if(isset($_POST['id']))
		{
			usleep(500000);
			$result = $this->homemodel->popisMjesta($_POST['id']);
			$data = '';
			foreach($result as $value)
			{
				//echo '<p> <a href="'.base_url().'oglas/mjesto/'.$value['mjestoID'].'"> '.$value['naziv_mjesta'].' </a> </p>';
				$data .= '<p> <a href="'.base_url().'potraznja/mjesto/'.$value['mjestoID'].'"> '.$value['naziv_mjesta'].' </a> </p>'."\n";
			}
			$this->output->set_output($data);
		}
	}
	
	// -- izbriši korisnika
	public function izbrisi_korisnika()
	{
		if(isset($_POST['id'])) {
			$this->adminmodel->izbrisiKorisnika($_POST['id']);
			$this->output->set_output('Korisnik izbrisan!');
		}
	}
	
	// -- izbriši oglas
	public function izbrisi_oglas()
	{
		if(isset($_POST['id'])) {
			$oglas_id = $_POST['id'];
			$popis_slika_objekt_db = $this->oglasmodel->popisSlikaObjekt($oglas_id);
			$popis_slika_apartman_db = $this->oglasmodel->popisSlikaApartman($oglas_id);
			foreach ($popis_slika_objekt_db as $o_value) {
				$popis_slika_objekt = substr($o_value['slike'], 0, -1);
				$popis_slika_objekt_arr[] = explode(";", $popis_slika_objekt);
			}
			foreach ($popis_slika_objekt_arr as $slika) {
				parent::izbrisiSliku('objekt', $slika);
			}
		
			foreach ($popis_slika_apartman_db as $a_value) {
				if (!empty($a_value)) {
					$popis_slika_apartman = substr($a_value['slike'], 0, -1);
					$popis_slika_apartman_arr[] = explode(";", $popis_slika_apartman);
				}
			}
			foreach ($popis_slika_apartman_arr as $slika) {
				parent::izbrisiSliku('apartman', $slika)."\n"; 
			}
			
			$this->adminmodel->izbrisiOglas($oglas_id);
			$this->output->set_output('Oglas izbrisan!');
		}
	}

	// -- aktiviraj oglas
	public function aktiviraj_oglas()
	{
		if(isset($_POST['id'])) {
			$this->adminmodel->aktivirajOglas($_POST['id']);
			$this->output->set_output('Oglas aktiviran!');
		}
	}
	
	// -- deaktiviraj oglas
	public function deaktiviraj_oglas()
	{
		if(isset($_POST['id'])) {
			$this->adminmodel->deaktivirajOglas($_POST['id']);
			$this->output->set_output('Oglas deaktiviran!');
		}
	}

	// -- izbriši oglas
	public function detalji_apartmana()
	{
		if(isset($_POST['id'])) {
			$this->lang->load('oglas_detalji', parent::getLang());
			$result = $this->oglasmodel->apartmanDetaljiAjax($_POST['id']);
			$slike_apartman = parent::slikeOglasa($result[0]['slike']);
			$detalji_apartmana = parent::detaljiObjekta($result[0]['detaljiApartmana']);
			$data = '';
			foreach($result as $value)
			{
				$data .= "\t".'<h3>'.$value['nazivApartmana'].'</h3>'."\n";
				$data .= "\t".'<p class="opis">'.lang('detalji_vrsta_usluge').' <span>'.$value['vrstaUsluge'].'</span> </p>'."\n";
				$data .= "\t".'<p class="opis">'.lang('detalji_broj_soba').' <span>'.$value['brojSoba'].'</span> </p>'."\n";
				$data .= "\t".'<div class="dodatne-usluge">'."\n";
				if (!empty($detalji_apartmana)){
					$data .= "\t".'<p class="opis">'.lang('detalji_detalji_smjestaja').'</p>'."\n";
					$data .= '<ul class="detalji-apartmana">'."\n";
					foreach ($detalji_apartmana as $da_key => $da_value) {
						$data .= "\t".'<li>'.lang('detalji_detalji_jedinice_'.$da_value['detalji_objekt']).'</li>'."\n";
					}
					$data .= '</ul>'."\n";
				}
				$data .= "\t".'<table>'."\n";
				$data .= "\t".'<tr class="leading-row">'."\n";
				$data .= "\t".'<td>'.lang('detalji_period_iznajmljivanja').'</td>'."\n";
				$data .= "\t".'<td>'.$value['predsezona'].'</td>'."\n";
				$data .= "\t".'<td>'.$value['sezona'].'</td>'."\n";
				$data .= "\t".'<td>'.$value['postsezona'].'</td>'."\n";
				$data .= "\t".'</tr>'."\n";
				$data .= "\t".'<tr>'."\n";
				$data .= "\t".'<td>'.lang('detalji_cijena_iznajmljivanja').'</td>'."\n";
				$data .= "\t".'<td>'.$value['cijenaPredsezona'].'</td>'."\n";
				$data .= "\t".'<td>'.$value['cijenaSezona'].'</td>'."\n";
				$data .= "\t".'<td>'.$value['cijenaPostsezona'].'</td>'."\n";
				$data .= "\t".'</tr>'."\n";
				$data .= "\t".'</table>'."\n";
				$data .= "\t".'</div>'."\n";
				$data .= '<div id="gallery-apartman">'."\n";
				$data .= "\t".'<ul>'."\n";
				foreach ($slike_apartman as $sa_key => $sa_value)
				{
					$data .= "\t".'<li>'."\n";
					$data .= "\t".'<a href="'.base_url().'uploads/apartmani/'.$sa_value['naziv'].'.'.$sa_value['ext'].'" title="'.$value['nazivApartmana'].'">'."\n";
					$data .= "\t".'<img class="slika-'.$sa_key.'" src="'.base_url().'uploads/apartmani/'.$sa_value['naziv'].'_thumb.'.$sa_value['ext'].'" title="'.$value['nazivApartmana'].'" alt="'.$value['nazivApartmana'].'" />';
					$data .= "\t".'</a>'."\n";
					$data .= "\t".'</li>'."\n";
				}
				$data .= "\t".'</ul>'."\n";
				$data .= '</div>'."\n";
				
			}
			$this->output->set_output($data);
		}
	}

	public function korisnik()
	{
		if (isset($_POST['ime_korisnika'])) {
			$data = '';
			$input = $this->funkcija->pocisti($_POST['ime_korisnika']);
			$input_arr = explode(' ', $input);
			$input_tip = count($input_arr); // -- 1 = ime, 2 = ime i prezime, 3 = ime i prezime (dva prezimena)
			switch ($input_tip) {
				case 1:
					$result = $this->adminmodel->korisnikID($input_arr, 1);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['korisnikID'].'" class="izaberi">'.$value['ime'].' '.$value['prezime'].'('.$value['korisnicko_ime'].')</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				case 2:
					$result = $this->adminmodel->korisnikID($input_arr, 2);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['korisnikID'].'" class="izaberi">'.$value['ime'].' '.$value['prezime'].'('.$value['korisnicko_ime'].')</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				case 3:
					$result = $this->adminmodel->korisnikID($input_arr, 3);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['korisnikID'].'" class="izaberi">'.$value['ime'].' '.$value['prezime'].'('.$value['korisnicko_ime'].')</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				
				default:
					$data .= '<p class="result-info">Greška</p>'."\n";
					break;
			}
			$this->output->set_output($data);
		}
	}

	public function oglas()
	{
		if (isset($_POST['ime_korisnika'])) {
			$data = '';
			$input = $this->funkcija->pocisti($_POST['ime_korisnika']);
			$input_arr = explode(' ', $input);
			$input_tip = count($input_arr); // -- 1 = ime, 2 = ime i prezime, 3 = ime i prezime (dva prezimena)
			switch ($input_tip) {
				case 1:
					$result = $this->adminmodel->oglasID($input_arr, 1);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['oglasID'].'" class="izaberi">'.$value['nazivObjekta'].'</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				case 2:
					$result = $this->adminmodel->oglasID($input_arr, 2);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['oglasID'].'" class="izaberi">'.$value['nazivObjekta'].'</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				case 3:
					$result = $this->adminmodel->oglasID($input_arr, 3);
					if (empty($result)) {
						$data .= '<p class="result-info">Nema rezultata</p>'."\n";
					} else {
						foreach ($result as $value) {
							$data .='<p id="'.$value['oglasID'].'" class="izaberi">'.$value['nazivObjekta'].'</p>'."\n";
						}	
						$data .= '<p class="hide">Sakrij rezultate</p>';
					}
					break;
				
				default:
					$data .= '<p class="result-info">Greška</p>'."\n";
					break;
			}
			$this->output->set_output($data);
		}
	}

	public function izbrisi_sliku_usluge()
	{
		if (isset($_POST['slika']) AND isset($_POST['id'])) {
			$slika = $_POST['slika'];
			$slika_arr[0] = $slika; // -- polje za izbriSliku()
			$string = $_POST['id'];
			$arr = explode(':', $string);
			$oglas_id = $arr[0];
			$apartman_id = $arr[1];
			//$result = $this->oglasmodel->apartmanDetaljiAjax($apartman_id);
			$result = $this->oglasmodel->slikeApartman($apartman_id);
			$slike_db_output = parent::slikeOglasa($result[0]['slike']);
			
			foreach ($slike_db_output as $value) {
				$slike[] = $value['naziv'].'.'.$value['ext'];
			}
			
			if (($key = array_search($slika, $slike)) !== false) {
 			   unset($slike[$key]);
			}
			
			$slike_db_input = '';
			foreach ($slike as $s_value) {
				$slike_db_input .= $s_value.';';
			}
			
			//$this->korisnikmodel->izbrisiSlikuApartman($slike_db_input, $apartman_id);
			$this->korisnikmodel->izbrisiSliku('apartman', $slike_db_input, $apartman_id);
			parent::izbrisiSliku('apartman', $slika_arr);
			
			$this->lang->load('uredi_slike', parent::getLang());
			$data = '<p class="info">'.lang('uredi_slike_info_1').'</p>';
			$this->output->set_output($data);
		}
	}
	
	public function izbrisi_sliku_oglas()
	{
		if (isset($_POST['slika']) AND isset($_POST['id'])) {
			$slika = $_POST['slika'];
			$slika_arr[0] = $slika; // -- polje za izbriSliku()
			$string = $_POST['id'];
			$oglas_id = $_POST['id'];
			$result = $this->oglasmodel->popisSlikaObjekt($oglas_id);
			$slike_db_output = parent::slikeOglasa($result[0]['slike']);
			
			foreach ($slike_db_output as $value) {
				$slike[] = $value['naziv'].'.'.$value['ext'];
			}
			
			if (($key = array_search($slika, $slike)) !== false) {
 			   unset($slike[$key]);
			}
			
			$slike_db_input = '';
			foreach ($slike as $s_value) {
				$slike_db_input .= $s_value.';';
			}
			
			$this->korisnikmodel->izbrisiSliku('oglas', $slike_db_input, $oglas_id);
			parent::izbrisiSliku('objekt', $slika_arr);
			
			$this->lang->load('uredi_slike', parent::getLang());
			$data = '<p class="info">'.lang('uredi_slike_info_1').'</p>';
			$this->output->set_output($data);
		}
	}
	
}