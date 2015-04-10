<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Potraznjamodel extends CI_Model {

    // -- najnoviji oglasi
    public function najnoviji() {
        $this->db->cache_off();
        $this->db->select('potraznjaID, naslov, potraznja.mjestoID, mjesto.naziv_mjesta');
        $this->db->from('potraznja');
        $this->db->join('mjesto', 'mjesto.mjestoID = potraznja.mjestoID');
        $this->db->where('aktivan', 1);
        $this->db->order_by('potraznjaID', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- potraznja intro
    public function potraznjaIntro($mjestoID, $num, $offset) {
        $this->db->cache_off();
        $this->db->select('potraznjaID, naslov, mjesto.naziv_mjesta');
        $this->db->from('potraznja');
        $this->db->join('mjesto', 'mjesto.mjestoID = potraznja.mjestoID');
        $this->db->where('potraznja.mjestoID', $mjestoID);
        $this->db->where('aktivan', 1);
        $this->db->order_by('potraznjaID', 'asc');
        $this->db->limit($num, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- osnovni podaci o potražnji - za neprijavljenje korisnike
    public function detaljiOsnovno($id) {
        $this->db->cache_off();
        $this->db->select('potraznjaID, naslov, kategorija, adresa, telefon, mobitel, email, datumPostavljanja, datumPrekida, sobe, min_cijena, max_cijena, tipObjekta, objektUvjeti, opcijeSoba, opcijeSmjestaj, opcijeUdaljenost, datumObjave, mjesto.naziv_mjesta');
        $this->db->from('potraznja');
        $this->db->join('mjesto', 'mjesto.mjestoID = potraznja.mjestoID');
        $this->db->where('potraznjaID', $id);
        $this->db->where('aktivan', 1);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- svi podaci potražnje - za prijavljene korisnike
    public function detaljiSvi($id) {
        $this->db->cache_off();
        $this->db->select('potraznjaID, naslov, kategorija, adresa, telefon, mobitel, email, datumPostavljanja, datumPrekida, sobe, min_cijena, max_cijena, tipObjekta, objektUvjeti, opcijeSoba, opcijeSmjestaj, opcijeUdaljenost, datumObjave, mjesto.naziv_mjesta');
        $this->db->from('potraznja');
        $this->db->join('mjesto', 'mjesto.mjestoID = potraznja.mjestoID');
        $this->db->where('potraznjaID', $id);
        $this->db->where('aktivan', 1);
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function mojiOglasi($korisnik_id) {
        $this->db->cache_off();
        //$this->db->select('oglasID, nazivObjekta, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
        $this->db->select('potraznjaID, naslov, aktivan');
        $this->db->from('potraznja');
        $this->db->where('korisnikID', $korisnik_id);

        $query = $this->db->get();
        return $query->result_array();
    }
    
    // -- vlasnik oglasa
    public function vlasnikOglasa($korisnik_id, $oglas_id) {
        $this->db->cache_off();
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('potraznja');
        $this->db->where('korisnikID', $korisnik_id);
        $this->db->where('potraznjaID', $oglas_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    // -- detalji oglasa potraznja
    public function oglasDetalji($oglasID) {
        $this->db->cache_off();
        $this->db->select('*');
        $this->db->from('potraznja');
        $this->db->where('potraznjaID', $oglasID);
        $query = $this->db->get();

        return $query->result_array();
    }


}
