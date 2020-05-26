<?php
class Schiff{ //Basisklasse
    protected $name;
    private $reederei; 
    private $verbrauch;
    public const KLASSE = 'Oceanliner';
    public static $tonnage = '10000BRT';

    public function __construct($bez,$v,$r){
        $this->name = $bez;
        $this->verbrauch = $v;
        $this->setReederei($r);
    }
    public function __get($n){//Magische Methoden
       return "gesperrt";//Zugriff auf nicht vorhanden Variablen// private
    }
    public function __set($name,$v){// setzen von nicht deklarieren// Variablen oder Funktionen
        return "gesperrt";
    }
    public function getVerbrauch($zugang){
       if($zugang=="Kapitän") return $this->verbrauch;
    }
    public function setReederei($text){
        $this->reederei = $text;
    }
    public function getReederei(){
        return $this->reederei;
    }
    public function getTonnage(){
        return SELF::$tonnage;
    }
}

class Personen extends Schiff{ //Subklasse
  //Die Subklasse kann auf alle Attribute bzw. Methoden zugreifen
   private $liste = array();
   public function __construct($bez,$v,$r){
       parent::__construct($bez,$v,$r);
   }
   public function setPerson($n){
       array_push($this->liste,$n);//sammeln von Namen in array
   }
   public function getPersonen(){
      //$liste  [Max,Lisa,Susi,Otto]
      return implode(',',$this->liste);//array to text Max,Lisa,Susi,Otto
   }
   public function getSchiffsname(){
       return $this->name;
   } 
}

class Rettungsboot extends Schiff{
    const KAP = 3;
    public function __construct($bez,$v,$r){
        parent::__construct($bez,$v,$r);
    }
    
    public function getKap($liste){ //"text Max,Lisa,Susi,Otto
        if(count(explode(",",$liste)) > SELF::KAP) return "überladen";
        else return "passt";
    }
}


$inst = new Schiff('MS Fröhlich','100l/h','Ginzburg');
echo Schiff::KLASSE;//fest
Schiff::$tonnage = "10000BRT";//veränderbar
echo $inst->name;
echo $inst->getReederei();
echo $inst->getVerbrauch('Kapitän');
echo Schiff::$tonnage;

echo '<h3> 2. Schiff</h3>';
$inst2 = new Schiff('MS Jan','90l/h','Ginzburg');
Schiff::$tonnage = "100BRT";//veränderbar
echo Schiff::KLASSE;
echo $inst2->name;
echo $inst2->getReederei();
echo $inst2->getVerbrauch('Kapitän');
echo Schiff::$tonnage;

echo '<h3> 2. Personen zu Schiff</h3>';

$schiff_a = new Personen('MS Otto','90l/h','Ginzburg');
$schiff_a->setPerson("Max");
$schiff_a->setPerson("Lisa");
$schiff_a->setPerson("Susi");
$schiff_a->setPerson("Otto");
echo $schiff_a->getSchiffsname().$schiff_a->getPersonen();

echo '<h3> Rettungsboot zu Schiff</h3>';
$boot = new Rettungsboot('MS Otto','90l/h','Ginzburg');
echo Rettungsboot::KAP;
echo $boot->getKap($schiff_a->getPersonen());



//echo $inst->verbrauch;
//$inst->cholera = "Virus eingeschleust";//Überladung
//echo $inst->cholera;
//$inst->nahme = "Neuer Name";

//echo "<br>Tonnage:<br>";
//echo $inst->getTonnage();
//echo $inst2->getTonnage();

?>