<?php

if (!defined('BASEPATH'))
    exit('Pristup zabranjen!');

class Oglasmodel extends CI_Model {

    // -- osnovni detalji oglasa koji su prikazani na stranici pojedinog mjesta
    public function oglasIntro($mjestoID, $num, $offset) {
        $this->db->cache_off();
        $this->db->select('oglasID, nazivObjekta, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
        $this->db->from('oglas');
        $this->db->where('mjestoID', $mjestoID);
        $this->db->where('aktivan', 1);
        $this->db->where('vidljiv', 1);
        $this->db->order_by('oglasID', 'asc');
        $this->db->limit($num, $offset);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- najgledaniji oglasi
    public function posebniOglasi($oglasi, $tip) {
        if (!empty($oglasi)) { //echo "<pre>", print_r($oglasi), "</pre>"; die;
            if ($tip == 'najgledaniji') {
                foreach ($oglasi as $value) {
                    $this->db->cache_off();
                    $this->db->select('oglasID, mjestoID, nazivObjekta, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
                    $this->db->from('oglas');
                    $this->db->where('oglasID', $value['tipID']);
                    //$this->db->where('aktivan', 1);
                    //$this->db->where('vidljiv', 1);
                    $this->db->order_by('oglasID', 'asc');
                    $query = $this->db->get();
                    $rezultat[] = $query->result_array();
                }

                return $rezultat;
            } elseif ($tip == 'istaknuti') {
                foreach ($oglasi as $value) {
                    $this->db->cache_off();
                    $this->db->select('oglasID, mjestoID, nazivObjekta, tipSmjestaja, brojZvijezdica, adresaBrojPoste, slike');
                    $this->db->from('oglas');
                    $this->db->where('oglasID', $value['oglasID']);
                    //$this->db->where('aktivan', 1);
                    //$this->db->where('vidljiv', 1);
                    $this->db->order_by('oglasID', 'asc');
                    $query = $this->db->get();
                    $rezultat[] = $query->result_array();
                }

                return $rezultat;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    // -- ukupan broj oglasa iz nekog mjesta
    public function ukupno($id) {
        $this->db->cache_off();
        $this->db->select('COUNT(*) AS ukupno');
        $this->db->from('oglas');
        $this->db->where('mjestoID', $id);
        $this->db->where('aktivan', 1);
        $this->db->where('vidljiv', 1); // -- bilo je 0
        $query = $this->db->get();
        return $query->result_array();
    }

    // -- status oglasa - aktivan, vidljiv
    public function status($oglasID) {
        $this->db->cache_off();
        $this->db->select('aktivan, vidljiv');
        $this->db->from('oglas');
        $this->db->where('oglasID', $oglasID);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- detalji oglasa
    public function oglasDetalji($oglasID) {
        $this->db->cache_off();
        $this->db->select('*');
        $this->db->from('oglas');
        $this->db->where('oglasID', $oglasID);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- popis apartmana
    public function popisApartmana($oglasID) {
        $this->db->cache_off();
        $this->db->select('apartmanID, nazivApartmana');
        $this->db->from('apartman');
        $this->db->where('oglasID', $oglasID);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- detalji apartmana/...
    public function apartmanDetalji($oglasID) {
        $this->db->cache_off();
        $this->db->select('*');
        $this->db->from('apartman');
        $this->db->where('oglasID', $oglasID);
        $this->db->order_by('apartmanID', 'asc');
        $this->db->limit(1);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- detalji apartmana/...
    public function apartmanDetaljiAjax($apartmanID) {
        $this->db->cache_off();
        $this->db->select('*');
        $this->db->from('apartman');
        $this->db->where('apartmanID', $apartmanID);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- popis slika objekt
    public function popisSlikaObjekt($oglas_id) {
        $this->db->cache_off();
        $this->db->select('slike');
        $this->db->from('oglas');
        $this->db->where('oglasID', $oglas_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    // -- popis slika apartman
    public function popisSlikaApartman($oglas_id) {
        $this->db->cache_off();
        $this->db->select('slike');
        $this->db->from('apartman');
        $this->db->where('oglasID', $oglas_id);
        $query = $this->db->get();

        return $query->result_array();
    }

    public function slikeApartman($apartman_id) {
        $this->db->cache_off();
        $this->db->select('slike');
        $this->db->from('apartman');
        $this->db->where('apartmanID', $apartman_id);
        $query = $this->db->get();

        return $query->result_array();
    }

}
