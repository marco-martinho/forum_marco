<?php
session_start();
if(!isset($_SESSION['search'])) $_SESSION['search'] = "";// neustart
define('DOCUPATH','upload/');//Pfad zu den Dokumenten der Ansicht

?>