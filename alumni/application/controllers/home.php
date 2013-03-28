<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    // +----------------------------------------------------------
    // | Alumni
    // +----------------------------------------------------------
    // | KHK - 2 TI - 2012-2013
    // +----------------------------------------------------------
    // | Home controller
    // |
    // +----------------------------------------------------------
    // | // | Groep 28
    // | Glenn Van Rymenant
    // | Giel Reijns
    // | Sander Vanelven
    // | Yoeri Stessens
    // +----------------------------------------------------------

    public function __construct() {
        parent::__construct();
    }

    ////HOME PAGINA
    //gegevens ophalen en in $data steken
    //alles doorsturen naar home_index
    public function index() {
        $data['username'] = $this->session->userdata('username');
        $data['email'] = $this->session->userdata('email');
        $data['recht'] = $this->session->userdata('recht');
        $data['title'] = "Alumni";
        $data['sessie_id'] = $this->session->userdata('session_id');
        
        $partials = array('header' => 'main_header', 'content' => 'home_index', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }
    
    ////AANMELD FUNCTIE
    //alle gegevens in $data steken
    public function login() {
        $data['recht'] = $this->session->userdata('recht');
        $data['username'] = $this->session->userdata('username');
        $data['email'] = $this->session->userdata('email');
        $data['title'] = 'Aanmelden - project Alumni';
        
        $partials = array('header' => 'main_header', 'content' => 'home_login', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login');
        $this->template->load('main_master', $partials, $data);
    }
    
    

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
