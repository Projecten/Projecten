<?php

class Uitgenodigd_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Uitgenodigd Model
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

    function get($alumnusId, $evenementId) {
        $this->db->where('alumnusId', $alumnusId);
        $this->db->where('evenementId', $evenementId);
        $query = $this->db->get('uitgenodigd');
        return $query->row();
    }

    function getAll() {
        $this->db->order_by('evenementId', 'asc');
        $query = $this->db->get('uitgenodigd');
        return $query->result();
    }

    function getAllByEvenement($id) {

        $this->db->where('evenementId', $id);
        $this->db->order_by('aanwezig');
        $query = $this->db->get('uitgenodigd');
        $uitgenodigden = $query->result();


        $this->load->model("user_model");
        $this->load->model("alumnus_model");
        foreach ($uitgenodigden as $uitgenodigd) {
            $uitgenodigdeAlumnus = $this->alumnus_model->getByLoginId($uitgenodigd->loginId);
            $uitgenodigd->login = $this->user_model->getByAlumnus($uitgenodigdeAlumnus->loginId);
        }

        return $uitgenodigden;
    }
    function controle($evenementId, $loginId) {
        $this->db->where('evenementId', $evenementId);
        $this->db->where('loginId', $loginId);
        
        $query = $this->db->get('uitgenodigd');
        
        if ($query->num_rows() == 0) {
            return 1;
        } else {
            return 0;
        }
        
       
    }
    function insert($uitgenodigde) {

        $this->db->where('loginId', $uitgenodigde->loginId);
        $this->db->where('evenementId', $uitgenodigde->evenementId);
        $query = $this->db->get('uitgenodigd');

        if ($query->num_rows() == 0) {
            $this->db->insert('uitgenodigd', $uitgenodigde);
            $this->db->insert_id();
            return 1;
        } else {
            return 0;
        }

//        $this->db->insert('uitgenodigd', $uitgenodigde);
//        return $this->db->insert_id();
    }
    //Uitschrijven
        function delete($uitgenodigde) {
        $this->db->where('loginId', $uitgenodigde->loginId);
        $this->db->where('evenementId', $uitgenodigde->evenementId);
        $this->db->delete('uitgenodigd');
    }
    //alumni tellen
    function countLijnen($id) {

        $this->db->where('evenementId', $id);
        $this->db->from('uitgenodigd');
        return $this->db->count_all_results();
    }

}

?>