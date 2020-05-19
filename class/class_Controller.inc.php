<?php
class Controller{
    private $r;//Auffang der QUERY String ? search = A
    public static $referer = "index.php";//index.php?search=xyz
    public function __construct(){
        $this->r = $_REQUEST;//assoziatives Array
        print_r($_REQUEST);//Test
        // wenn  Referer vorhanden dann speichern in static $referer
        if(isset($_SERVER['HTTP_REFERER'])) SELF::$referer = $_SERVER['HTTP_REFERER'];//Link + Query
        
        switch(key($this->r)){
            case "alpha": $this->getAlpha();// Auswahl über Buttons A,B,C
                           break;
            case "search":$this->getSearch();// Sucheingabe 
                           break;
            case "content_id":$this->getContent();//Contentfiles anzeigen
                           break;
            case "edit":$this->getEdit();// öffnen des Editierungsbereiches
                           break;
            case "themen_id":$this->setIntoDB();//id des Themas soll upload oder Thema
                             break;
            default: $data = Model::getAllThemes();
                     View::setLayout($data,"start");
        }
        View::toDisplay();//user Ansicht
    }
    private function setIntoDB(){// Hochladen von Content bzw.Änderung Themen
        if(isset($_FILES['userfile']['name'])){// File hat Name
            $name = $_FILES['userfile']['name'];
            //php Befehl für uplaod,userfile= input name,tmp_name = fest, pfad, Dateiname
            if(move_uploaded_file($_FILES['userfile']['tmp_name'],DOCUPATH.$name)){

            }else{
               echo $_FILES['userfile']['error']; 
            }
        }
        $data = Model::getAllEdit();//Anzeige des Options Felder
        View::setLayout($data,"edit");
    }    

    private function getEdit(){//Redaktion und Upload anzeigen
        $data = Model::getAllEdit();
        View::setLayout($data,"edit");
    }
   

    private function getContent(){
        $data = Model::getAllContent($this->r['content_id']);
        View::setLayout($data,"content");
    }
    
    private function getSearch(){// Suchefunktion nach Buchstaben
       $data = Model::getAllThemesSearch($this->r['search']); 
       View::setLayout($data,"alpha"); 
    }
    
    
    private function getAlpha(){// Suchefunktion nach Buchstaben
       $data = Model::getAllThemesAlpha($this->r['alpha']);  
       View::setLayout($data,"alpha"); 
    }
}


      
?>