<?php

class Plaats_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Plaats Model
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
        $this->db->where('id', $id);
        $query = $this->db->get('plaats');
        return $query->row();
    }
    
    function getAll()
    {
        $this->db->order_by('locatie', 'asc');
        $query = $this->db->get('plaats');
        return $query->result();
    }
    


}

?>