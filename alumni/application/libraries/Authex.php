<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Authex {
    // +----------------------------------------------------------
// | Alumni
// +----------------------------------------------------------
// | Thomas More - 2TI2 - 2012-2013
// +----------------------------------------------------------
// | Authex Library
// |
// +----------------------------------------------------------
// | Groep 28
// | Glenn Van Rymenant
// | Giel Reijns
// | Sander Vanelven
// | Yoeri Stessens
// |
// | Nelson Wells
// | http://nelsonwells.net/2010/05/creating-a-simple-extensible-codeigniter-authentication-library/
// +----------------------------------------------------------


    public function __construct() {
        $CI = & get_instance();

        $CI->load->model('user_model');
    }

    function loggedIn() {
        // gebruiker is aangemeld als sessievariabele user_id bestaat
        $CI = & get_instance();
        if ($CI->session->userdata('id')) {
            return true;
        } else {
            return false;
        }
    }

    function getUserInfo() {
        // geef user-object als gebruiker aangemeld is
        $CI = & get_instance();
        if (!$this->loggedIn()) {
            return null;
        } else {
            $id = $CI->session->userdata('user_id');
            return $CI->user_model->get($id);
        }
    }

    function login($email, $password) {
        // gebruiker aanmelden met opgegeven email en wachtwoord
        $CI = & get_instance();
        $user = $CI->user_model->getAccount($email, $password);
        if ($user == null) {
            return false;
        } else {
            $sessieArray = array(
                'id' => $user->id,
                'username' => $user->voornaam . " " . $user->achternaam,
                'recht' => $user->rechtId,
                'alumnusId' => $user->alumnusId,
                'email' => $user->emailadres
            );
            $CI->user_model->updateLaatstAangemeld($user->id);
            $CI->session->set_userdata($sessieArray);
            return true;
        }
    }

    function logout() {
        // uitloggen, dus sessievariabele wegdoen
        $CI = & get_instance();

        $sessieArray = array(
            'id' => "",
            'username' => "",
            'recht' => 0,
            'alumnusId' => 0,
            'email' => ""
        );
        $CI->session->set_userdata($sessieArray);
    }

    function register($naam, $email, $password) {
        // nieuwe gebruiker registreren als email nog niet bestaat
        $CI = & get_instance();
        if ($CI->user_model->emailVrij($email)) {
            $id = $CI->user_model->insert($naam, $email, $password);
            return $id;
        } else {
            return 0;
        }
    }

    function activate($id) {
        // nieuwe gebruiker activeren
        $CI = & get_instance();
        $CI->user_model->activeer($id);
    }

}