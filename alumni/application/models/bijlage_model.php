<?php

class Bijlage_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Bijlage Model
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
        $this->db->where('bijlageId', $id);
        $query = $this->db->get('bijlage');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('bijlageId', 'asc');
        $query = $this->db->get('bijlage');
        return $query->result();
    }
}
?>