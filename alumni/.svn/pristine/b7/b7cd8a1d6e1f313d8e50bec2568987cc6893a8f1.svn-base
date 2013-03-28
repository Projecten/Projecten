<?php

class Alumnus_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Alumnus Model
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
        $query = $this->db->get('alumnus');
        return $query->row();
    }

    function getAll()
    {
        $this->db->order_by('afstudeerjaar', 'asc');
        $query = $this->db->get('alumnus');
        $alumni = $query->result();

        $this->load->model("login_model");
        foreach ($alumni as $alumnus) {
            $alumnus->login = $this->login_model->get($alumnus->loginId);
        }
        return $query->result();
    }
    
    function insertAlumnus($alumnus) {
        $this->db->insert('alumnus', $alumnus);
        return $this->db->insert_id();
    }
     function updateProfiel($alumnus) {
        $this->db->where('id', $alumnus->id);
        $this->db->update('alumnus', $alumnus);
    }
    
     function getByLoginId($id)
    {
        $this->db->where('loginId', $id);
        $query = $this->db->get('alumnus');
        return $query->row();
        
        
        
//        $this->db->select('alumnus.id, alumnus.loginId, alumnus.afstudeerjaar, alumnus.werkgever, alumnus.jobomschrijving, alumnus.startdatumWerk, alumnus.secundairMail, richting.naam as richting, school.naam as school, specialisatie.omschrijving as specialisatie');
//            $this->db->from('alumnus');
//            $this->db->join('richting', 'alumnus.richtingId = richting.id');
//            $this->db->join('school', 'alumnus.schoolId = school.id');
//            $this->db->join('specialisatie', 'alumnus.specialisatieId = specialisatie.id');
//            $query = $this->db->get();
//
//            return $query->result();
//        
//
//        $query = $this->db->where('loginId', $id);
//        return $query->row();
    }
}

?>