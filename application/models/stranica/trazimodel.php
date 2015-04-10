<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Trazimodel extends CI_Model {
	
	// -- naziv regije za detalje o upitu pretrage
	private function nazivRegije($id)
	{
		$id = (int)$id;
		$this->db->cache_on();
		$this->db->select('naziv_regije');
		$this->db->from('regija');
		$this->db->where('regijaID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	// -- naziv mjesta za detalje o upitu pretrage
	private function nazivMjesta($id)
	{
		$id = (int)$id;
		$this->db->cache_on();
		$this->db->select('naziv_mjesta');
		$this->db->from('mjesto');
		$this->db->where('mjestoID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	// -- naziv regije/mjesta u detaljima upita
	public function upitInfo($post_arr) 
	{
		$data = array();
		
		if ($post_arr['zupanija'] != '0')
		{
                    $data['nazivZupanije'] = $this->nazivRegije($post_arr['zupanija']);
		}
		
		if (isset($post_arr['mjesto']))
		{
			if ($post_arr['mjesto'] != '0')
			{
                            $data['nazivMjesta'] = $this->nazivMjesta($post_arr['mjesto']);	
			}
		}
		
		return $data;
	}
	
	// -- ukupan broj oglasa ako nije izabrano ništa u tražilici
	public function prebrojiSve()
	{
		$this->db->cache_off();
		$this->db->select('COUNT(*) AS ukupno');
		$this->db->from('oglas');
		$this->db->where('aktivan', 1);
		$this->db->where('vidljiv', 1);
		$query = $this->db->get(); 
		return $query->result_array(); 
	}
	
	// -- svi oglasi
	public function traziSve($num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('oglasID, nazivObjekta, oglas.mjestoID, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
  		$this->db->from('oglas');
		$this->db->where('aktivan', 1);
		$this->db->where('vidljiv', 1);
		$this->db->order_by('oglasID', 'asc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	
	// -- 
	public function prebrojiSveUvjeti($post_arr)
	{
		$this->db->cache_off();
		$this->db->select('COUNT(*) AS ukupno');
  		$this->db->from('oglas');
		if (isset($post_arr['upit']) AND $post_arr['upit'] != '') {
			$upit = trim( htmlspecialchars($post_arr['upit'], ENT_QUOTES), "[];/\s" ); //echo $upit;
			$where = "nazivObjekta LIKE '%$upit%'";
   			$this->db->where($where);
		}
		if ($post_arr['zupanija'] != '0' AND $post_arr['mjesto'] == '0') {
			$this->db->join('mjesto', 'mjesto.mjestoID = oglas.mjestoID');
			$this->db->join('regija', 'regija.regijaID = mjesto.regijaID');
			$this->db->where('regija.regijaID', $post_arr['zupanija']);
		}
		if (isset($post_arr['mjesto']) AND $post_arr['mjesto'] != '0') {
			$this->db->where('oglas.mjestoID', $post_arr['mjesto']);
		}
		if (isset($post_arr['tip_smjestaja'])) {
			foreach ($post_arr['tip_smjestaja'] as $key => $value) {
				$tip_smjestaja[$key] = $value;
			}
			if (count($tip_smjestaja) == 1) {
				$this->db->where('tipSmjestaja', $tip_smjestaja[0]);
			} else {
				$prvi = $tip_smjestaja[0];
				$where = "(tipSmjestaja = '$prvi'";
				foreach ($tip_smjestaja as $t_key => $t_value) {
					while ($t_key > 0) {
						$where .= " OR tipSmjestaja = '$t_value'";
						break;
					}
				}
				$where .= ')';
				$this->db->where($where);
			}
		}
		$this->db->where('aktivan', 1);
		$this->db->where('vidljiv', 1);
		$this->db->order_by('oglasID', 'asc'); 
		$query = $this->db->get(); //echo '<pre>', print_r($query), '</pre>';
		
		return $query->result_array();
	}

	// -- 
	public function traziUvjeti($post_arr, $num, $offset)
	{
		$this->db->cache_off();
		$this->db->select('oglasID, nazivObjekta, oglas.mjestoID, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
  		$this->db->from('oglas');
		if (isset($post_arr['upit']) AND $post_arr['upit'] != '') {
			$upit = $post_arr['upit'];
			$where = "nazivObjekta LIKE '%$upit%'";
   			$this->db->where($where);
		}
		if ($post_arr['zupanija'] != '0' AND $post_arr['mjesto'] == '0') {
			$this->db->join('mjesto', 'mjesto.mjestoID = oglas.mjestoID');
			$this->db->join('regija', 'regija.regijaID = mjesto.regijaID');
			$this->db->where('regija.regijaID', $post_arr['zupanija']);
		}
		if (isset($post_arr['mjesto']) AND $post_arr['mjesto'] != '0') {
			$this->db->where('oglas.mjestoID', $post_arr['mjesto']);
		}
		if (isset($post_arr['tip_smjestaja'])) {
			foreach ($post_arr['tip_smjestaja'] as $key => $value) {
				$tip_smjestaja[$key] = $value;
			}
			if (count($tip_smjestaja) == 1) {
				$this->db->where('tipSmjestaja', $tip_smjestaja[0] );
			} else {
				$prvi = $tip_smjestaja[0];
				$where = "(tipSmjestaja = '$prvi'";
				foreach ($tip_smjestaja as $t_key => $t_value) {
					while ($t_key > 0) {
						$where .= " OR tipSmjestaja = '$t_value'";
						break;
					}
				}
				$where .= ')';
				$this->db->where($where);
			}
		}
		$this->db->where('aktivan', 1);
		$this->db->where('vidljiv', 1);
		$this->db->order_by('oglasID', 'asc'); 
		$this->db->limit($num, $offset);
		$query = $this->db->get();
		
		return $query->result_array();
	}

}