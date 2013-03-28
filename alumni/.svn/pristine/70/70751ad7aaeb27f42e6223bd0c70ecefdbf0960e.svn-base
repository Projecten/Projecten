<?php

class Mail_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Mail Model
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
        $this->db->where('mailId', $id);
        $query = $this->db->get('mail');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('mailId', 'asc');
        $query = $this->db->get('mail');
        return $query->result();
    }
}

?>