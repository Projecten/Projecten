<?php

class User extends CI_Controller {

// +----------------------------------------------------------
// | Alumni
// +----------------------------------------------------------
// | Thomas More - 2TI2 - 2012-2013
// +----------------------------------------------------------
// | User controller
// |
// +----------------------------------------------------------
// | Groep 28
// | Glenn Van Rymenant
// | Giel Reijns
// | Sander Vanelven
// | Yoeri Stessens
// +----------------------------------------------------------


    //laden van libraries en helpers
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('notation');
        $this->load->helper('cookie');
    }

    ////AANMELDEN OP DE APPLICATIE
    //men haalt email en wachtwoord uit de invoervelden
    //als het lukt, redirect men naar home pagina
    //als het niet lukt, komt men op dezelfde pagina uit met foutmelding
    public function aanmelden() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if ($this->authex->login(mysql_real_escape_string($email), mysql_real_escape_string($password))) {
            redirect('home/index');
        } else {
            $data['title'] = 'Aanmelden - project Alumni';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');
            $data["foutmelding"] = "e-mailadres en wachtwoord komen niet overeen.";

            $partials = array('header' => 'main_header', 'content' => 'home_login', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        }
    }

    ////AFMELDEN VAN DE APPLICATIE
    //gebruikt een methode uit library authex
    public function afmelden() {
        $this->authex->logout();
        redirect('home/index');
    }

    ////VOOR MENSEN MET GEEN BEVOEGDHEID
    //Deze functie is voor mensen die geen bevoegdheid heeft om op die pagina te komen
    //men geeft enkele gegevens mee door met $data
    public function fouteUser() {
        $data['title'] = 'Aanmelden - project Alumni';
        $data['recht'] = $this->session->userdata('recht');
        $data['username'] = $this->session->userdata('username');
        $data['message'] = 'U bent niet bevoegd om deze pagina te bezoeken.';

        $partials = array('header' => 'main_header', 'content' => 'user/fout_message', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }

    ////EVENEMENTEN ZOEKEN MET PAGING
    //recht ophalen uit sessie en in $recht steken
    //indien er een recht is die groter is als 0
    //geeft enkele gegevens mee door aan $data
    //laden van evenement model
    //pagination instellingen
    //indien er een gebruiker via de url wilt komen, een foutmelding geven via functie fouteUser
    public function evenementenZoeken($startRow = 0) {
        $recht = $this->session->userdata('recht');

        if ($recht > 0) {
            $data['title'] = 'Evenementen';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');
            $data['vorigePagina'] = 'index.php/user/evenementenZoeken';

            $this->load->model('evenement_model');
            if ((get_cookie('pagination')) == NULL) {
                $aantal = get_cookie('pagination');
            } else {
                $aantal = 10;
            }
            $config['base_url'] = site_url('user/evenementenZoeken');
            $config['total_rows'] = $this->evenement_model->getCount();
            $config['per_page'] = $aantal;
            $config['first_link'] = "&lt;&lt; Eerste";
            $config['last_link'] = "Laatste &gt;&gt;";
            $config['num_links'] = 10;
            $this->pagination->initialize($config);
            $data['evenementen'] = $this->evenement_model->getAllPagination($aantal, $startRow);
            $data['links'] = $this->pagination->create_links();

            $info['pagination'] = $aantal;
            $info['geavanceerdZoeken'] = 0;
            $info['naam'] = '';
            $info['plaatsId'] = '';
            $info['datum1'] = '';
            $info['datum2'] = '';
            $info['omschrijving'] = '';
            $this->session->set_userdata('zoekinfoEvenementen', $info);

            $partials = array('header' => 'main_header', 'content' => 'user/evenementenzoeken', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
    }
    
////OVERBODIGE CODE ( MAG WEG INDIEN ER GEEN PROBLEMEN VOORDOEN ) 
//evenementen zoeken
//    public function evenementenZoekactie() {
////recht ophalen
//        $recht = $this->session->userdata('recht');
////indien er een recht is opgehaald
//        if ($recht > 0) {
//            $data['recht'] = $recht;
//
//            $this->load->model('evenement_model');
//
//            $info['geavanceerdZoeken'] = (!$this->input->get('pagination')) ? 0 : 1;
//            $info['naam'] = $this->input->get(mysql_real_escape_string('naam'));
//            $info['plaatsId'] = $this->input->get(mysql_real_escape_string('plaats'));
//            $info['datum1'] = $this->input->get(mysql_real_escape_string('begindatum'));
//            $info['datum2'] = $this->input->get(mysql_real_escape_string('einddatum'));
//            $info['omschrijving'] = $this->input->get(mysql_real_escape_string('omschrijving'));
//
////paging
//            if (($this->input->get('pagination')) != NULL) {
//                $aantal = $this->input->get('pagination');
//                set_cookie(array('name' => 'pagination', 'value' => $aantal));
//            } elseif ((get_cookie('pagination')) == NULL) {
//                $aantal = 10;
//                set_cookie(array('name' => 'pagination', 'value' => $aantal));
//            } else {
//                $aantal = get_cookie('pagination');
//            }
//            $info['pagination'] = $aantal;
//            $config['base_url'] = site_url('alumnus/evenementenBekijkenZoeken');
//            $config['total_rows'] = $this->evenement_model->getCountByNaamPlaatsDatum($info);
//            $config['per_page'] = $aantal;
//            $config['first_link'] = "&lt;&lt; Eerste";
//            $config['last_link'] = "Laatste &gt;&gt;";
//            $config['num_links'] = 10;
//            $this->pagination->initialize($config);
//
//
//            $data['evenementen'] = $this->evenement_model->getAllPaginationByNaamPlaatsDatum($info, $aantal, 0);
//            $data['links'] = $this->pagination->create_links();
//            $data['recht'] = $recht;
//            $data['info'] = $info;
//
//            $this->session->set_userdata('zoekinfoEvenementen', $info);
//
//
//            $this->load->view('user/evenementenzoeken_ajax', $data);
//        } else {
////verwijzen naar function fouteUser()
//            $this->fouteUser();
//        }
//    }

//geavenceerd zoeken
//    public function evenementenGeavanceerdZoeken() {
//        $recht = $this->session->userdata('recht');
//        if (isset($recht)) {
//            $data['recht'] = $recht;
//
//// locaties in array zetten om door te geven aan de pagina
//            $this->load->model('plaats_model');
//            $plaatsen[0] = "-- Alle plaatsen --";
//            foreach ($this->plaats_model->getAll() as $plaats) {
//                $plaatsen[$plaats->id] = $plaats->locatie;
//            }
//            $data['plaatsen'] = $plaatsen;
//            $data['zoekinfoEvenementen'] = $this->session->userdata('zoekinfoEvenementen');
//
//            $this->load->view('user/evenementenGeavanceerdZoeken_ajax', $data);
//        } else {
////verwijzen naar function fouteUser()
//            $this->fouteUser();
//        }
//    }

    ////ALUMNUS OPZOEKEN/OPHALEN
    //recht ophalen uit sessie en in $recht steken
    //indien recht is ingesteld
    //gegevens meegeven in $data
    //laden van alumnus model
    //alle alumni ophalen
    public function alumniZoeken() {
        $recht = $this->session->userdata('recht');

        if ($recht > 0) {
            $data['title'] = 'Alumnus zoeken - Alumni project';
            $data['recht'] = $recht;
            $data['username'] = $this->session->userdata('username');

            $this->load->model('alumnus_model');

            $data['alumni'] = $this->alumnus_model->getAll();

            $partials = array('header' => 'main_header', 'content' => 'user/alumnizoeken', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
    }

    ////IS OVERBODIG ( mag weg indien er geen problemen voor doen )
//    public function alumniZoekactie($startRow = 0) {
////recht ophalen
////        $recht = $this->tank_auth->get_recht();
//        $recht = $this->session->userdata('recht');
////indien er een recht is opgehaald
//        if ($recht > 0) {
//            $data['recht'] = $recht;
//
//            $this->load->model('alumnus_model');
//
//            $info['geavanceerdZoeken'] = (!$this->input->get('pagination')) ? 0 : 1;
//            $info['naam'] = $this->input->get(mysql_real_escape_string('naam'));
//            $info['plaatsId'] = $this->input->get(mysql_real_escape_string('plaats'));
//            $info['datum1'] = $this->input->get(mysql_real_escape_string('begindatum'));
//            $info['datum2'] = $this->input->get(mysql_real_escape_string('einddatum'));
//            $info['omschrijving'] = $this->input->get(mysql_real_escape_string('omschrijving'));
//
////paging
//            if (($this->input->get('pagination')) != NULL) {
//                $aantal = $this->input->get('pagination');
//                set_cookie(array('name' => 'pagination', 'value' => $aantal));
//            } elseif ((get_cookie('pagination')) == NULL) {
//                $aantal = 10;
//                set_cookie(array('name' => 'pagination', 'value' => $aantal));
//            } else {
//                $aantal = get_cookie('pagination');
//            }
//            $info['pagination'] = $aantal;
//            $config['base_url'] = site_url('user/alumniZoekactie'); /* nog aanpassen */
//            $config['total_rows'] = $this->alumnus_model->getCountByVoornaamAchternaamAfstudeerjaar($info);
//            $config['per_page'] = $aantal;
//            $config['first_link'] = "&lt;&lt; Eerste";
//            $config['last_link'] = "Laatste &gt;&gt;";
//            $config['num_links'] = 10;
//            $this->pagination->initialize($config);
//
//            $data['username'] = $this->session->userdata('username');
//            $data['alumni'] = $this->alumnus_model->getCountByVoornaamAchternaamAfstudeerjaar($info, $aantal, $startRow);
//            $data['links'] = $this->pagination->create_links();
//            $data['recht'] = $recht;
//            $data['info'] = $info;
//
//            $this->session->set_userdata('zoekinfoAlumni', $info);
//
//
//            $this->load->view('user/alumnizoeken_ajax', $data);
//        } else {
////verwijzen naar function fouteUser()
//            $this->fouteUser();
//        }
//    }

}
?>