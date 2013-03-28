<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller {

// +----------------------------------------------------------
// | Alumni
// +----------------------------------------------------------
// | Thomas More - 2TI2 - 2012-2013
// +----------------------------------------------------------
// | Admin controller
// |
// +----------------------------------------------------------
// | Groep 28
// | Glenn Van Rymenant
// | Giel Reijns
// | Sander Vanelven
// | Yoeri Stessens
// +----------------------------------------------------------
    //librabries en helpers laden
    //beveiligen van url
    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('notation');
        $this->load->library('email');
        if (!$this->authex->loggedIn()) {
            redirect('home/login');
        } else {
            $user = $this->authex->getUserInfo();
        }
    }

    //recht ophalen en in $recht steken
    //kijken of recht gelijk is aan administrator
    //Indien geen administrator, fout boodschap meegeven
    //alumnus ophalen en alle alumnus ophalen
    public function alumniZoekenMail() {
        $recht = $this->session->userdata('recht');

        if ($recht == 3) {
            $data['title'] = 'Alumni zoeken - Admin';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            $this->load->model('alumnus_model');
            $data['alumni'] = $this->alumnus_model->getAll();

            $partials = array('header' => 'main_header', 'content' => 'admin/alumnizoeken_mail', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
    }

    //controle op inschrijvingen
    //recht ophalen en in $recht steken
    //kijken of recht gelijk is aan administrator
    //laden van evemenet model en evenement verwijderen d.m.v evenementId
    //indien geen administrator is, naar functie fouteUser gaan
    public function controleDelete() {
        $recht = $this->session->userdata('recht');

        if ($recht == 3) {
            $id = $this->input->get(mysql_real_escape_string('id'));

            $this->load->model('evenement_model');
            echo $this->evenement_model->delete($id);
        } else {
            $this->fouteUser();
        }
    }

    //verwijderen van evenementen
    //recht ophalen en in $recht steken
    //kijken of recht gelijk is aan administrator
    //kijken of boodschap successvol of niet kan verwijdert worden
    //enkele gegevens meegeven met $data
    //indien geen administrator, naar functie FouteUser
    public function delete() {
        $recht = $this->session->userdata('recht');

        $id = $this->input->get(mysql_real_escape_string('id'));

        if ($recht == 3) {
            $this->load->model('evenement_model');

            if ($this->evenement_model->delete($id)) {
                $data['message'] = 'Het evenement werd succesvol verwijderd.';
            } else {
                $data['message'] = 'Het evenement kan niet verwijderd worden.';
            }

            $data['title'] = 'Alumni verwijderen - Alumni';
            $data['recht'] = $recht;
            $data['username'] = $this->session->userdata('username');
            $data['vorigePagina'] = 'index.php/alumnus/evenementenBekijken';

            redirect('user/evenementenZoeken');
        } else {
            $this->fouteUser();
        }
    }

    //// Evenementen bewerken
    // recht ophalen en controleren op goede gebruiker
    // controle of men evenementen wil toevoegen of aanpassen
    // Alle locaties ophalen
    // Naargelang wat men wil doen: nieuw object aanmaken of evenment ophalen
    // Naargelang wat men wil doen: knop andere naam geven
    // Doorsturen naar juiste pagina
    public function evenementBewerken($id) {

        if ($this->session->userdata('recht') != 1) {
            $data['title'] = 'Evenement aanpassen - Admin';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            $this->load->model('plaats_model');

            if ($id != 0) {

                foreach ($this->plaats_model->getAll() as $plaats) {
                    $plaatsen[$plaats->id] = $plaats->locatie;
                }

                $data['plaatsen'] = $plaatsen;
                $this->load->model('evenement_model');
                $data['evenement'] = $this->evenement_model->get($id);
                $data['actie'] = 'Bewerken';
            } else {

                $plaatsen[0] = "--Selecteer een plaats--";
                foreach ($this->plaats_model->getAll() as $plaats) {
                    $plaatsen[$plaats->id] = $plaats->locatie;
                }

                $data['plaatsen'] = $plaatsen;
                $this->load->model('evenement_model');
                $data['evenement'] = $this->evenement_model->newObject();
                $data['actie'] = 'Toevoegen';
            }

            $partials = array('header' => 'main_header', 'content' => 'admin/evenementBewerken', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
    }

    //Deze functie is indien er een gebruiker met een ander recht op een pagina komt die er helemaal niet moet zijn
    //men geeft enkele gegevens mee door in $data
    //naar pagina verwijzen fout_message
    public function fouteUser() {
        $data['title'] = 'Fout - project Alumni';
        $data['recht'] = $this->session->userdata('recht');
        $data['username'] = $this->session->userdata('username');
        ;
        $data['message'] = 'U bent niet bevoegd om deze pagina te bezoeken.';

        $partials = array('header' => 'main_header', 'content' => 'user/fout_message', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }

    //recht ophalen en in $recht steken
    //kijken of recht gelijk is aan administrator
    //enkele gegevens meegeven met $data
    //template laden
    //indien er een foute user is, naar functie fouteUser gaan
    public function index() {
        $recht = $this->session->userdata('recht');

        if ($recht == 3) {
            $data['title'] = 'Administrator';
            $data['recht'] = $recht;
            $data['username'] = $this->session->userdata('username');

            $partials = array('header' => 'main_header', 'content' => 'home_index', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {
            $this->fouteUser();
        }
    }

//BEWERKEN OF AANMAKEN EVENEMENT
//Recht ophalen en controleren naar de juiste gebruiker
//ophalen belangrijke gegevens uit de sessie
//Ingevoerde gegevens inladen
//Controle op al dan niet bestaand evenement
//Update of insert naargelang uitkomst controle
//Doorsturen naar detailpagina of naar de fouteUser-functie
    public function update($evenementId) {

        $recht = $this->session->userdata('recht');

        if ($recht != 1) {

            $data['title'] = 'Evenementen bekijken - Alumni';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            if ($evenementId != 0) {
                $evenement->id = $this->input->post(mysql_real_escape_string('id'));
            }
            $evenement->naam = $this->input->post(mysql_real_escape_string('naam'));
            $evenement->omschrijving = $this->input->post(mysql_real_escape_string('omschrijving'));
            $evenement->plaatsId = $this->input->post(mysql_real_escape_string('plaats'));
            $evenement->begintijd = toYYYYMMDD($this->input->post('datumbegin')) . ' ' . str_replace("u", ":", $this->input->post('startuur') . ':00');
            $evenement->eindtijd = toYYYYMMDD($this->input->post('datumeind')) . ' ' . str_replace("u", ":", $this->input->post('einduur') . ':00');
            $evenement->deadlineInschrijving = toYYYYMMDD($this->input->post('deadlineInschrijving'));

            $this->load->model('evenement_model');
            if ($evenementId == 0) {
                $this->evenement_model->insert($evenement);
                redirect('user/evenementenZoeken');
            } else {
                $this->evenement_model->update($evenement);
                redirect('alumnus/evenementdetail/' . $evenement->id);
            }
        }

        $this->fouteUser();
    }

    ////MAILEN NAAR ALUMNI
    //Stuurt alle emailadressen door die aangevinkt zijn
    //steekt recht in $recht
    //indien recht gelijk is aan administrator
    //enkele gegevens meegeven aan $data
    //indien een andere gebruiker hier wilt opkomen, doorsturen naar functie fouteUser
    public function emailAdressen() {
        $recht = $this->session->userdata('recht');

        if ($recht != 1) {

            $data['title'] = 'Mailen - Alumni';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            $this->load->model('login_model');
            $data['logins'] = $this->login_model->getAllbyId($this->input->post('ids'));

            foreach ($data['logins'] as $login) {
                $emails[] = $login->emailadres;
            }
            $this->session->set_userdata('emails', $emails);

            $partials = array('header' => 'main_header', 'content' => 'admin/emailAdressen', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {

            $this->fouteUser();
        }
    }

    public function emailSturen() {
        $recht = $this->session->userdata('recht');

        if ($recht != 1) {

            $data['title'] = 'Mailen - Alumni';
            $data['recht'] = $this->session->userdata('recht');
            $data['username'] = $this->session->userdata('username');

            

            $this->email->from('s5063208@stu.khk.be');
            $this->email->to($this->session->userdata('emails'));

            $this->email->subject($this->input->post('onderwerp'));
            $this->email->message($this->input->post('mail'));

            $this->email->send();

            $data['test'] = $this->email->print_debugger();

            $partials = array('header' => 'main_header', 'content' => 'admin/bevestiging_email', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
            $this->template->load('main_master', $partials, $data);
        } else {

            //    $this->fouteUser();
        }
    }

    ////EIGEN PROFIEL BEWERKEN
    // Recht ophalen
    // ophalen gegevens uit de database
    // doorsturen naar juiste view
    public function profielAdmin() {
        $data['title'] = 'Admin profiel';
        $data['recht'] = $this->session->userdata('recht');
        $data['username'] = $this->session->userdata('username');

        $this->load->model('login_model');

        $data['login'] = $this->login_model->get($this->session->userdata('id'));

        $partials = array('header' => 'main_header', 'content' => 'admin/profiel', 'footer' => 'main_footer', 'menu' => 'main_menu', 'sidebar' => 'main_sidebar', 'login' => 'main_login', 'nieuws' => 'main_nieuws');
        $this->template->load('main_master', $partials, $data);
    }

    ////BEWERKEN VAN PROFIEL
    // naam splitsen en verdelen onder voor- en achternaam
    // alle gegevens ophalen en steken in $gebruiker 
    // laden van login model en functie Update gebruiken
    // redirect naar admin/profiel
    public function updateProfiel() {
        $naam = $this->input->post('naam');
        $naamArray = explode(" ", $naam);

        $gebruiker->id = $this->input->post('id');
        $gebruiker->voornaam = $naamArray[0];
        $gebruiker->achternaam = $naamArray[1];
        $gebruiker->emailadres = $this->input->post('emailadres');

        $this->load->model('login_model');
        $this->login_model->update($gebruiker);
        
        $this->session->set_userdata("username", $naam);

        redirect('admin/profielAdmin');
    }

}