<?php
class View{
 private static $out = "Template konnte nicht gefunden werden";
 
 public static function setLayout($data,$tpl){
   ob_start();// Puffer auf Server mit Interpreter
     require_once "tpl/head.tpl";//statisch
     require_once "tpl/".$tpl.".tpl";// sich änderne Teil dynamisch
     require_once "tpl/footer.tpl";
     SELF::$out = ob_get_contents(); //alles was im Puffer berechnet worden ist
     ob_end_clean();//Puffer leeren
 }

 public static function toDisplay(){ // View::toDisplay
   echo SELF::$out;//send to Client
}

}

?>