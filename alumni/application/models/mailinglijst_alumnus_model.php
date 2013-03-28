<?php

class Mailinglijst_alumnus_model extends CI_Model {

   // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | mailingLijst_alumnus Model
    // |
    // +----------------------------------------------------------
    // | Groep 28
    // | Glenn Van Rymenant
    // | Giel Reijns
    // | Sander Vanelven
    // | Yoeri Stessens
    // +----------------------------------------------------------

    function __construct()
    {
        parent::__construct();
    }

     function get($alumnusid, $lijstid)
    {
        $this->db->where('alumnusId', $alumnusid);
        $this->db->where('lijstId', $lijstid);
        $query = $this->db->get('mailinglijst_alumnus');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('lijstId', 'asc');
        $query = $this->db->get('mailinglijst_alumnus');
        return $query->result();
    }
}

?>