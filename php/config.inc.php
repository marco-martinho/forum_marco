<?php
session_start();
define('DOCUPATH','upload/');//Pfad zu den Dokumenten der Ansicht

// in den Optionsfelder selected generieren
function s($n,$v){
    if(isset($_REQUEST[$n]) && $_REQUEST[$n] == $v) echo " selected "; 
}
?>