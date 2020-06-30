<?php
session_start();
define('DOCUPATH','upload/');//Pfad zu den Dokumenten der Ansicht
// Uploadbegrenzung Filetypen
define('MIME_TYP',['image/jpeg','image/pjpeg','image/png','application/pdf','application/rtf','text/plain','text/rtf']);
//Maximum der Dateigröße
define('MAX_FILE_SIZE',1048576);// 1MB

//ini_set('post_max_size', '20M');
//var_dump(ini_get('post_max_size'));  

// in den Optionsfelder selected generieren
function s($n,$v){

    //themen_id = lastInsertId  $n = name  $v = value   ist id vom thema
    //echo $_POST['themen_id'];exit;

    //<option selected>
    if(isset($_REQUEST[$n]) && $_REQUEST[$n] == $v) echo " selected "; 
}
?>