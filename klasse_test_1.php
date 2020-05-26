<?php
define('PLH','-');//globale Konstante PHP speziell

class MyName{
    private $vorname;//Attribut, Eigenschaft einer Klasse(Object) 
    private $nachname;//kein Inhalt nur deklariert
    private $platzhalter = ' ';
    public const PL = '!';//Eigenschaft nur einer Klasse 
                   // 1 mal für alle Objekte gespeichert
                   // nicht überschreibbar
    public static $stat = '$';//überschreibbar 
                      //1 mal für alle Objekte gespeichert
                      //überschreibbar  
    public function __construct($vorname,$nachname,$datum = ""){//Parameter
        if($datum == "")$datum = date("d.m.Y");
        $this->vorname = $vorname;//local wird zu Eigenschaft des Objekt
        $this->nachname = $nachname;
        echo $vorname. " ". $nachname." ".$datum;
    }
    public function getfullName(){
        return $this->vorname.SELF::PL.$this->nachname.SELF::$stat    ;//return gibt einen Wert
                                        // z.B. array, Textkette, binär,boolean
    }
    public static function getPlatzhalter(){
        return SELF::PL;
    } 
}

echo "Platzhalter ist zur Zeit:".MyName::getPlatzhalter()."<br>";//statische Methode Klassenbezogen


$instanz1 = new MyName('Franz','Gustav','01.05.2020');//Argumente
$instanz2 = new MyName('Hans','Müller','01.05.2020');
MyName::$stat = '#';

echo "<h3>Zugriff auf private</h3>
       Zugriff nur über Instanz möglich<br>";
//echo $instanz1->vorname;
// Zugang über private nicht möglich
//Ausgabe der private Variable eines instanzierten Objektes
echo $instanz1->getfullName();
echo $instanz2->getfullName();
//echo MyName::PL;//aufruf von const


?>