<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Alumnus extends CI_Controller {

// +----------------------------------------------------------
// | Alumni
// +----------------------------------------------------------
// | KHK - 2 TI - 2012-2013
// +----------------------------------------------------------
// | Alumnus controller
// |
// +----------------------------------------------------------
// | Groep 28
// | Glenn Van Rymenant
// | Giel Reijns
// | Sander Vanelven
// | Yoeri Stessens
// +----------------------------------------------------------

    //laden van extra libraries en helpers
    //beveiligen van url
    public function __construct() {
        parent::__construct();
        //laden van libraries en helpers
        $this->load->library('pagination');
        $this->load->helper('notation');
        $this->load->helper('cookie');
        $this->load->helper('notation_helper');
        
        if (!$this->authex->loggedIn()) {
            redirect('home/login');
        } else {
            $user = $this->authex->getUserInfo();
        }
    }

    ////HOME PAGINA
    public function index() {
        $partials = array('header' => 'main_header', 'content' => 'home_index', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login');
        $this->template->load('main_master', $partials, $data);
    }

    ////VOOR MENSEN MET GEEN BEVOEGDHEID
    //Deze functie is indien er een gebruiker met geen recht op een pagina komt die er helemaal niet moet zijn
    //naar login gaan
    public function fouteUser() {
        $partials = array('header' => 'main_header', 'content' => 'home/login', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login');
        $this->template->load('main_master', $partials, $data);
    }

    //2X PAGINATION????
    //evenementen bekijken + zoeken met pagination
    //aantal ophalen en recht ophalen en in variabelen steken
    //als recht niet leeg is, kan men evenementen zoeken
    //laden van evenement_model
    //gegevens meegeven met $data
    //paging meegeven
    //alle plaatsen ophalen via plaats_model
    //controle op inschrijvingen ( indien ingescreven => uitschrijven ) & andersom
    //indien foute user naar functie fouteUser gaan
//    public function evenementenBekijkenZoeken($startRow = 0) {
//        $aantal = $this->input->get("aantal");
//        $recht = $this->session->userdata("recht");
//
//        if ($recht != 0) {
//            $data['title'] = 'Evenementen bekijken - project Alumni';
//
//            $this->load->model('evenement_model');
//
//            $info = $this->session->userdata('zoekinfoEvenementen');
//            $data['info'] = $info;
//
//            $data['evenementen'] = $this->evenement_model->getAllByNaamPlaatsDatum($info);
//
//            //paging 
////            if (($info['pagination']) == NULL) {
////                $aantal = 10;
////            } else {
////                $aantal = $info['pagination'];
////            }
//            $config['base_url'] = site_url('alumnus/evenementenBekijkenZoeken');
//            $config['total_rows'] = $this->evenement_model->getCountByNaamPlaatsDatum($info);
//            $config['per_page'] = $aantal;
//            $config['first_link'] = "&lt;&lt; Eerste";
//            $config['last_link'] = "Laatste &gt;&gt;";
//            $config['num_links'] = 10;
//            $this->pagination->initialize($config);
//
//            //paging 
////            if (($info['pagination']) == NULL) {
////               $aantal = 10;
////            } else {
////                $aantal = $info['pagination'];
////            }
//            $config['base_url'] = site_url('alumnus/evenementenBekijkenZoeken');
//            $config['total_rows'] = $this->evenement_model->getCountByNaamPlaatsDatum($info);
//            $config['per_page'] = $aantal;
//            $config['first_link'] = "&lt;&lt; Eerste";
//            $config['last_link'] = "Laatste &gt;&gt;";
//            $config['num_links'] = 10;
//            $this->pagination->initialize($config);
//
//            $data['evenementen'] = $this->evenement_model->getAllPaginationByNaamPlaatsDatum($info, $aantal, $startRow);
//            $data['links'] = $this->pagination->create_links();
//
//            $plaatsen[0] = "";
//            foreach ($this->plaats_model->getAll() as $plaats) {
//                $plaatsen[$plaats->id] = $plaats->locatie;
//            }
//            $data['plaatsen'] = $plaatsen;
//
//            $this->load->model('uitgenodigd_model');
//            $data['evenementen'] = $this->evenement_model->getAll();
//
//            $partials = array('header' => 'main_header', 'content' => 'user/evenementenzoeken', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
//            $this->template->load('main_master', $partials, $data);
//        } else {
//            $this->fouteUser();
//        }
//    }

    ////EVENEMENT DETAIL PAGINA
    //detail pagina van evenementen opvragen
    //recht ophalen en in $recht steken
    //kijken of er een gebruiker is met een recht
    //gegevens meegeven met $data
    //2 models inladen 
    //1 evenement ophalen met plaats
    //alle uitgenodigden meegeven voor dat evenement
    //indien geen gebruiker is met recht, naar functie fouteUser gaan
    public function evenementdetail($id) {
        $recht = $this->session->userdata("recht");

        if (isset($recht)) {
            $data['title'] = 'Details - project Alumni';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            $this->load->model('evenement_model');
            $this->load->model('uitgenodigd_model');
            
            $data['evenement'] = $this->evenement_model->getWithPlaats($id);
            $data['uitgenodigden'] = $this->uitgenodigd_model->getAllByEvenement($id);

            $partials = array('header' => 'main_header', 'content' => 'user/evenementendetails', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
        }

        ////INSCHRIJVEN VOOR EVENEMENT && UITSCHRIJVEN
        //insert in tabel uitgenodigt
        //alumnus ophalen d.m.v loginId
        //Inschrijven indien evenementId en LoginId matchen
        //Uitschrijven indien de gebruiker wilt uitschrijven voor evenement
        //Als men inschrijft of uitschrijft terug naar vorige pagina kunnen laten gaan nadat ze boodschap hebben gelezen
        
        public function inschrijven($id, $actie) {
        $uitgenodigde = null;    
        $uitgenodigde->evenementId = $id;
        $uitgenodigde->aanwezig = 1; 
        $uitgenodigde->wasAanwezig = 0;
        $uitgenodigde->datumInschrijving = date('Y-m-d');
        
        $this->load->model('alumnus_model');
        $alumnusId = $this->alumnus_model->getByLoginId($this->session->userdata('id'));
        $uitgenodigde->loginId = $alumnusId->loginId;

        $this->load->model("uitgenodigd_model");
        $this->load->model("evenement_model");

        $evenement = $this->evenement_model->get($id);
        $controle = $this->uitgenodigd_model->insert($uitgenodigde);
        if ($controle == 1) {
            echo $data['message'] = "Je bent ingeschreven voor het '" . $evenement->naam . "' evenement.";
            $data['title'] = 'Inschrijven - Alumni project';
        } else {
            $this->uitgenodigd_model->delete($uitgenodigde);
            echo $data['message'] = "Je bent uitgeschreven voor het evenement '" . $evenement->naam . "'";
            $data['title'] = 'Uitschrijven - Alumni project';
        }
        
        $data['vorigePagina'] = 'index.php/alumnus/evenementenBekijken';
        $data['recht'] = $this->session->userdata("recht");

        $partials = array('header' => 'main_header', 'content' => 'user/fout_message', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }

     
    ////PROFIEL BEKIJKEN & BEWERKEN
    //enkele gegevens meegeven met $data
    //als recht gelijk is aan alumnus 
    //laden van models
    //alle scholen mee doorgeven en in array zetten
    //hetzelfde voor alle richtingen
    //login & alumnus ophalen
    //indien geen alumnus naar adminprofiel gaan
    public function profiel() {
        $data['title'] = 'Profiel aanpassen - Alumnus';
        $data['recht'] = $this->session->userdata('recht');
        $data['username'] = $this->session->userdata('username');

        if (1 == $this->session->userdata('recht')) {
            $this->load->model('school_model');
            $this->load->model('richting_model');
            $this->load->model('login_model');
            $this->load->model('alumnus_model');

            foreach ($this->school_model->getAll() as $school) {
                $scholen[$school->id] = $school->naam;
            }
            $data['scholen'] = $scholen;

            foreach ($this->richting_model->getAll() as $richting) {
                $richtingen[$richting->id] = $richting->naam;
            }
            $data['richtingen'] = $richtingen;

            $data['login'] = $this->login_model->getAlumnusByLogin($this->session->userdata('id'));
            $data['alumnus'] = $this->alumnus_model->getByLoginId($this->session->userdata('id'));
        } else {
            redirect('admin/profielAdmin');
        }
        $partials = array('header' => 'main_header', 'content' => 'alumnus/profiel', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }

    ////BEWERKEN VAN PROFIEL
    //alle gegevens ophalen en steken in $alumnus
    //laden van alumnus model en functie Update gebruiken
    //enkele gegevens meegeven met $data
    public function updateProfiel() {
        $alumnus->id = $this->input->post('id');
        $alumnus->loginId = $this->input->post('loginId');
        $alumnus->richtingId = $this->input->post('richting');
        $alumnus->schoolId = $this->input->post('school');
        $alumnus->werkgever = $this->input->post('werkgever');
        $alumnus->jobomschrijving = $this->input->post('jobomschrijving');
        $alumnus->startdatumWerk = toYYYYMMDD($this->input->post('startdatumWerk'));
        $alumnus->secundairMail = $this->input->post('secundairEmailadres');

        $this->load->model('alumnus_model');
        $this->alumnus_model->updateProfiel($alumnus);

        $data['title'] = 'Profiel - Alumni';
        $data['username'] = $this->session->userdata('username');

        redirect('alumnus/profiel');
    }

}



    