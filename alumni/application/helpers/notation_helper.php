<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

// +----------------------------------------------------------
// | Alumni
// +----------------------------------------------------------
// | Thomas More - 2TI2 - 2012-2013
// +----------------------------------------------------------
// | Admin Controller
// |
// +----------------------------------------------------------
// | Groep 28
// | Glenn Van Rymenant
// | Giel Reijns
// | Sander Vanelven
// | Yoeri Stessens
// +----------------------------------------------------------

// databasedatum in juiste formaat zetten (van yyyy-mm-dd naar dd/mm/jjjj)

function toDDMMYYYY($input) {
    if ($input == NULL) {
        return "";
    } else {
//        return date("d/m/Y", strtotime($input));
        $datum = explode("-", $input);
        return $datum[2] . "/" . $datum[1] . "/" . $datum[0];
    }
}

// ingegeven datum in formaat van database plaatsen (van dd/mm/jjjj naar yyyy-mm-dd)

function toYYYYMMDD($input) {
    if ($input == "") {
        return "";
    } else {
        if (strpos($input, "/") > 0){
            $datum = explode("/", $input);
        } else {
            $datum = explode("-", $input);
        }
        return $datum[2] . "-" . $datum[1] . "-" . $datum[0];
    }
}

// database decimaal getal tonen met komma (van 999.99 naar 999,99)

function toKomma($input) {
    if ($input == NULL) {
        return "";
    } else {
        return number_format($input, 2, ',', '');
    }
}

// ingegeven decimaal getal omzetten in databaseformaat (van 999,99 naar 999.99)

function toPunt($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode(",", $input);
        if (count($getal) == 2) {
            return $getal[0] . '.' . $getal[1];
        } else {
            return $getal[0];
        }
    }
}

function toHour($input) {
    if ($input == "") {
        return "";
    } else {
        $getal = explode("u", $input);
        return $getal[0] . ":" . $getal[1] . ":00";
    }
}

/* End of file notation_helper.php */
/* Location: helpers/notation_helper.php */