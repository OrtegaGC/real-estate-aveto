<?php if ( ! defined('BASEPATH')) exit('Pristup zabranjen!');

class Homemodel extends CI_Model {
	
	public function getHead()
	{
		$this->db->cache_on();
		$meta = $this->db->get('meta');
		$gmaps = $this->db->get('gmaps_api');
		
		$result = array(
				'meta'   => $meta->result_array(),
				'gmAPIkey'  => $gmaps->result_array()
			);
		
        return $result;
	}
	
	public function getAPIkey()
	{
		$this->db->cache_on();
		$query = $this->db->get('gmaps_api');
        return $query->result_array();
	}
	
	// -- provjerava da li postoji ID u nekoj tablci
	public function checkID($table, $atr, $id)
	{
		$this->db->select('COUNT(*) AS ukupno');
		$this->db->from($table);
		$this->db->where($atr, $id);
		$query = $this->db->get(); 
		return $query->result_array(); 
	}
	
	// -- popis regija(regije na karti na početnoj stranici)
	 public function popisRegija()
	 {
	 	$this->db->cache_on();
	 	$this->db->select();
  		$this->db->from('regija');
  		$this->db->order_by('naziv_regije', 'asc');
                $query = $this->db->get();
                return $query->result_array();
	 }
	 
	 // -- naziv regije(oglasi-karta)
	 public function detaljiRegije($id)
	 {
	 	$this->db->cache_on();
	 	$this->db->select('naziv_regije, map_center_latitude, map_center_longitude');
  		$this->db->from('regija');
  		$this->db->where('regijaID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 // -- popis mjesta(oglasi)
	 public function popisMjesta($id)
	 {
	 	$this->db->cache_on();
	 	$this->db->select('mjestoID, naziv_mjesta, latitude, longitude');
  		$this->db->from('mjesto');
  		$this->db->where('regijaID', $id);
		$this->db->order_by("naziv_mjesta", "asc"); 
		$query = $this->db->get();
		
		return $query->result_array();
	 }

	// -- naziv regije(breadcrumb)
	public function nazivRegije($id)
	{
		$this->db->cache_on();
		$this->db->select('naziv_regije, regija.regijaID');
		$this->db->from('mjesto');
		$this->db->join('regija', 'regija.regijaID = mjesto.regijaID');
		$this->db->where('mjestoID', $id);
		$query = $this->db->get();
		
		$this->db->last_query();  
		return $query->result_array();
	}
	
	// -- potraznja intro
	public function potraznjaIntro()
	{
		$this->db->cache_off();
		$this->db->select('potraznjaID, naslov, potraznja.mjestoID, mjesto.naziv_mjesta');
		$this->db->from('potraznja');
		$this->db->join('mjesto', 'mjesto.mjestoID = potraznja.mjestoID');
		$this->db->where('aktivan', 1);
		$this->db->order_by('potraznjaID', 'desc');
		$this->db->limit(4); 
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	// -- naziv mjesta(breadcrumb)
	public function nazivMjesta($id)
	{
		$this->db->cache_on();
		$this->db->select('mjestoID, naziv_mjesta');
		$this->db->from('mjesto');
		$this->db->where('mjestoID', $id);
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	 // -- najgledaniji oglasi
	 public function najgledanijiOGlasi()
	 {
	 	$this->db->cache_off();
	 	$this->db->select('tipID, COUNT(*) AS najgledaniji');
  		$this->db->from('oglas');
		$this->db->join('stats', 'stats.tipID = oglas.oglasID');
		$this->db->where('tip', 'oglas');
		$this->db->where('oglas.aktivan', 1);
		$this->db->where('oglas.vidljiv', 1);
  		$this->db->group_by('tipID'); 
		$this->db->order_by('najgledaniji', 'desc');
		$this->db->limit(9);
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	 // -- istaknuti oglasi
	 public function istaknutiOglasi($pozicija)
	 {
	 	$this->db->cache_off();
	 	$this->db->select('istaknuti_oglas.oglasID');
  		$this->db->from('oglas');
		$this->db->join('istaknuti_oglas', 'istaknuti_oglas.oglasID = oglas.oglasID');
		$this->db->where('oglas.aktivan', 1);
		$this->db->where('oglas.vidljiv', 1);
		$this->db->where('pozicija', $pozicija);
		$this->db->limit(9); 
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }
	 
	  // -- banneri
	 public function banneri()
	 {
	 	$this->db->cache_off();
	 	$this->db->select('bannerID, naziv, webStranica, slika');
  		$this->db->from('banner');
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }

	 // -- url bannera
	 public function banner($id)
	 {
	 	$this->db->cache_off();
	 	$this->db->select('webStranica');
  		$this->db->from('banner');
		$this->db->where('bannerID', $id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	 }
}