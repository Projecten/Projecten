<?php

class Evenement_model extends CI_Model {

    // +----------------------------------------------------------
    // | Alumni - Alumnus_Model
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | evenement Model
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
        $query = $this->db->get('evenement');
        return $query->row();
    }

    //get 1 locatie met de plaats erbij
    function getWithPlaats($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('evenement');
        $evenement = $query->row();

        $this->load->model("plaats_model");
        $evenement->plaats = $this->plaats_model->get($evenement->plaatsId);

        return $evenement;
    }

    function getAll() {
        $this->db->order_by('begintijd', 'asc');
        $query = $this->db->get('evenement');
        $evenementen = $query->result();

        $this->load->model("plaats_model");
        $this->load->model("uitgenodigd_model");
        
        foreach ($evenementen as $evenement) {
            $evenement->plaats = $this->plaats_model->get($evenement->plaatsId);
            $controle = $this->uitgenodigd_model->controle($evenement->id, $this->session->userdata['id']);
             if ($controle == 1) {
                    //indien je nog niet bent ingeschreven voor evenement
                    $evenement->actie = "Inschrijven";
                } else {
                    //indien je al wel bent ingeschreven voor evenement
                    $evenement->actie = "Uitschrijven";
                }
            
        }
        
        return $evenementen;
    }

    function getCount() {
        return $this->db->count_all('evenement');
    }

    //paging + plaats ophalen
    function getAllPagination($aantal, $startRow) {
        $this->db->order_by('begintijd');
        $this->db->limit($aantal, $startRow);
        $query = $this->db->get('evenement');
        $evenementen = $query->result();

        $this->load->model("plaats_model");
        $this->load->model("uitgenodigd_model");
        
        foreach ($evenementen as $evenement) {
            $evenement->plaats = $this->plaats_model->get($evenement->plaatsId);
            $controle = $this->uitgenodigd_model->controle($evenement->id, $this->session->userdata['id']);
             if ($controle == 1) {
                    //indien je nog niet bent ingeschreven voor evenement
                    $evenement->actie = "Inschrijven";
                } else {
                    //indien je al wel bent ingeschreven voor evenement
                    $evenement->actie = "Uitschrijven";
                }
        }
        return $evenementen;
    }

    //zoeken van evenementen op naam, plaats en datum
    function getAllByNaamPlaatsDatum($info) {

        //nakijken of deze velden wel ingevuld zijn
        if ($info['naam'] != "") {
            $this->db->like('naam', $info['naam']);
        }
        if ($info['omschrijving'] != "") {
            $this->db->like('omschrijving', $info['omschrijving']);
        }
        if ($info['plaatsId'] != 0) {
            $this->db->where('plaatsId', $info['plaatsId']);
        }
        if ($info['datum1'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum1'])));
            $this->db->where('eindtijd >=', $datum);
        }
        if ($info['datum2'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum2'])));
            $this->db->where('begintijd <=', $datum);
        }


        $this->db->order_by('begintijd');
        $query = $this->db->get('evenement');
        return $query->num_rows();
    }

    function getAllPaginationByNaamPlaatsDatum($info, $aantal, $startRow) {

        //nakijken of deze velden wel ingevuld zijn
        if ($info['naam'] != "") {
            $this->db->like('naam', $info['naam']);
        }
        if ($info['omschrijving'] != "") {
            $this->db->like('omschrijving', $info['omschrijving']);
        }
        if ($info['plaatsId'] != 0) {
            $this->db->where('plaatsId', $info['plaatsId']);
        }
        if ($info['datum1'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum1'])));
            $this->db->where('eindtijd >=', $datum);
        }
        if ($info['datum2'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum2'])));
            $this->db->where('begintijd <=', $datum);
        }
        $this->db->order_by('begintijd');
        $this->db->limit($aantal, $startRow);
        $query = $this->db->get('evenement');
        $evenementen = $query->result();

        $this->load->model("plaats_model");
        foreach ($evenementen as $evenement) {
            $evenement->plaats = $this->plaats_model->get($evenement->plaatsId);
        }
        return $query->result();
    }

    function getCountByNaamPlaatsDatum($info) {

        //nakijken of deze velden wel ingevuld zijn
        if ($info['naam'] != "") {
            $this->db->like('naam', $info['naam']);
        }
        if ($info['omschrijving'] != "") {
            $this->db->like('omschrijving', $info['omschrijving']);
        }
        if ($info['plaatsId'] != 0) {
            $this->db->where('plaatsId', $info['plaatsId']);
        }
        if ($info['datum1'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum1'])));
            $this->db->where('eindtijd >=', $datum);
        }
        if ($info['datum2'] != "") {
            $datum = date('Y-m-d', strtotime(str_replace('/', '-', $info['datum2'])));
            $this->db->where('begintijd <=', $datum);
        }


        $this->db->order_by('begintijd');
        $query = $this->db->get('evenement');
        return $query->num_rows();
    }

    //nieuw evenement toevoegen
    function insert($evenement) {
        $this->db->insert('evenement', $evenement);
        return $this->db->insert_id();
    }

    //evenement update
    function update($evenement) {
        $this->db->where('id', $evenement->id);
        $this->db->update('evenement', $evenement);
    }

    //evenement verwijderen
    function delete($id) {
        $this->load->model('uitgenodigd_model');
        if ($this->uitgenodigd_model->countLijnen($id) == 0) {
            $this->db->where('id', $id);
            $this->db->delete('evenement');
            return 1;
        } else {
            return 0;
        }
    }

    function newObject() {
        $evenement = null;
        $evenement->id = 0;
        $evenement->naam = '';
        $evenement->plaatsId = 0;
        $evenement->begintijd = date('Y-m-d H:i:s');
        $evenement->eindtijd = date('Y-m-d H:i:s');
        $evenement->deadlineInschrijving = date('Y-m-d');
        $evenement->omschrijving = '';
        $evenement->geannuleerd = '';
        $evenement->actie = "pipo";

        return $evenement;
    }

}

?>