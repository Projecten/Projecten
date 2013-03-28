<?php

class Login_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | login Model
    // |
    // +----------------------------------------------------------
    // | Groep 28
    // | Glenn Van Rymenant
    // | Giel Reijns
    // | Sander Vanelven
    // | Yoeri Stessens
    // +----------------------------------------------------------

    function __construct() {
        parent::__construct();
    }

    function get($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('login');
        return $query->row();
    }

    function getAlumnusByLogin($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('login');
        $login = $query->row();

        $this->load->model("alumnus_model");
        $login->alumnus = $this->alumnus_model->getByLoginId($id);

        if ($this->session->userdata["recht"] == 1) {
            $this->load->model("specialisatie_model");
            $login->alumnus->specialisatie = $this->specialisatie_model->get($id);

            $this->load->model("school_model");
            $login->alumnus->school = $this->school_model->get($id);

            $this->load->model("richting_model");
            $login->alumnus->richting = $this->richting_model->get($id);
        }
        return $login;
    }

    function getAll() {
        $this->db->order_by('achternaam', 'asc');
        $query = $this->db->get('login');
        return $query->result();
    }

    function getAllbyId($ids) {
        $this->db->order_by('achternaam', 'asc');
        $this->db->where_in('id', $ids);
        $query = $this->db->get('login');
        $logins =  $query->result();
        
        $this->load->model("alumnus_model");
        
        foreach ($logins as $login) {
        $login->alumnus = $this->alumnus_model->getByLoginId($login->id);
        }
        return $logins;
    }

    function getAccount($email, $password) {
        // geef user-object met $email en $password EN geactiveerd = 1
        $this->db->where('email', $email);
        $this->db->where('password', sha1($password));
        $this->db->where('geactiveerd', 1);
        $query = $this->db->get('tv_user');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function updateLaatstAangemeld($id) {
        // pas tijd laatstAangemeld aan
        $user->laatstAangemeld = date("Y-m-d H-i-s");
        $this->db->where('loginId', $id);
        $this->db->update('login', $user);
    }

    function emailVrij($email) {
        // is email al dan niet aanwezig
        $this->db->where('email', $email);
        $query = $this->db->get('login');
        if ($query->num_rows() == 0) {
            return true;
        } else {
            return false;
        }
    }

    function insert($naam, $email, $password) {
        // voeg nieuwe user toe
        $user->naam = $naam;
        $user->email = $email;
        $user->password = sha1($password);
        $user->rechtId = 1;
        $user->creatie = date("Y-m-d H-i-s");
        $user->laatstAangemeld = date("Y-m-d H-i-s");
        $user->geactiveerd = 0;
        $this->db->insert('login', $user);
        return $this->db->insert_id();
    }

    function activeer($id) {
        // plaats geactiveerd op 1
        $user->geactiveerd = 1;
        $this->db->where('loginId', $id);
        $this->db->update('login', $user);
    }

    function update($gebruiker) {
        
        $this->db->where('id', $gebruiker->id);
        $this->db->update('login', $gebruiker);
    }

}

?>