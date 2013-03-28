<?php

class Recht_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Recht Model
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

     function get($id)
    {
        $this->db->where('rechtId', $id);
        $query = $this->db->get('recht');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('rechtId', 'asc');
        $query = $this->db->get('recht');
        return $query->result();
    }
}

?>