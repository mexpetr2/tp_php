<?php
require_once 'config.php';

$erreur='';

$succes='';

define("URL", "http://localhost/PHP/TP/");

define("BASE", $_SERVER['DOCUMENT_ROOT'] . "/PHP/TP/");

session_start();

function userConnect() {

    if (isset($_SESSION['auth'])) {
        return true;
    } else {
        return false;
    }

}