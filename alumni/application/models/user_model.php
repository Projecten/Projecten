<?php

class User_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | User Model
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
        $query = $this->db->get('login');
        return $query->row();
    }
    
    function getByAlumnus($loginId)
    {
        $this->db->where('id', $loginId);
        $query = $this->db->get('login');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('naam', 'asc');
        $query = $this->db->get('login');
        return $query->result();
    }
    
    //Alles van Authex:
    function getAccount($email, $password)
    {
        // geef user-object met $email en $password EN geactiveerd = 1
        $this->db->where('emailadres', $email);
        $this->db->where('wachtwoord', sha1($password));
        $this->db->where('geactiveerd', 1);
        $query = $this->db->get('login');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }
    
    function updateLaatstAangemeld($id)
    {
        // pas tijd laatstAangemeld aan
        $user->laatstAangemeld = date("Y-m-d H-i-s");
        $this->db->where('id', $id);
        $this->db->update('login', $user); 
    }
    
    function emailVrij($email)
    {
        // is email al dan niet aanwezig
        $this->db->where('email', $email);
        $query = $this->db->get('login');
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }
    
    function insert($naam, $email, $password)
    {
        // voeg nieuwe user toe
        $user->naam = $naam;
        $user->email = $email;
        $user->password = sha1($password);
        $user->level = 1;
        $user->laatstAangemeld = date("Y-m-d H-i-s");
        $user->geactiveerd = 0;
        $this->db->insert('login', $user);
        return $this->db->insert_id();
    }
    
    function activeer($id)
    {
        // plaats geactiveerd op 1
        $user->geactiveerd = 1;
        $this->db->where('id', $id);
        $this->db->update('login', $user); 
    }
    
}