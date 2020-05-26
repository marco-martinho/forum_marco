<?php
class Controller{
    private $r;//Auffang der QUERY String ? search = A
    public static $referer = "index.php";//index.php?search=xyz
    public static $info = "";
    public function __construct(){
        //index.php?
        $this->r = $_REQUEST;//assoziatives Array
        print_r($_REQUEST);//Test
        // wenn  Referer vorhanden dann speichern in static $referer
        if(isset($_SERVER['HTTP_REFERER'])) SELF::$referer = $_SERVER['HTTP_REFERER'];//Link + Query
        
        switch(key($this->r)){
            case "alpha":  $this->getAlpha();// Auswahl über Buttons A,B,C
                           break;
            case "search": $this->getSearch();// Sucheingabe 
                           break;
            case "content_id":$this->getContent();//Contentfiles anzeigen
                           break;
            case "edit":   $this->getEdit();// öffnen des Editierungsbereiches
                           break;  
            case "edit_select":  switch($this->r["select"]){
                                 case 'userfile': $this->uploadContent();
                                                  break;
                                 case 'add':      $this->addTheme();
                                                  break; 
                                 case 'rename':   $this->renameTheme();
                                                  break;
                                 case 'del':      $this->deleteTheme();
                                                  break;              
                                }
                                $this->getEdit();//Ansicht
                                break;
            default: $data = Model::getAllThemes();
                     View::setLayout($data,"start");
        }
        View::toDisplay();//user Ansicht
        self::$info = "";//Info entfernen
    }
    private function deleteTheme(){
    }
    private function renameTheme(){
    }

    private function addTheme(){//Hinzufügen neues Thema
        Model::setAddTheme($this->r['add']);
        self::$info =  '<div class="infogreen">Thema hinzugefügt</div>';
    }
    private function uploadContent(){// Hochladen von Content bzw.Änderung Themen
        if(isset($_FILES['userfile']['name'])){// upload File hat Name
            $name = $_FILES['userfile']['name'];
            //php Befehl für uplaod,userfile= input name,tmp_name = fest, pfad, Dateiname
            if(move_uploaded_file($_FILES['userfile']['tmp_name'],DOCUPATH.$name)){

            }else{
               echo $_FILES['userfile']['error']; 
            }
        }
           //wenn vorhanden nur File wurde hochgeladen
        if(Model::getIdImageContent($name,$this->r['themen_id'])){
            self::$info =  '<div class="infogreen">Datei wurde erneuert</div>';
        }else{
           //wenn nicht vorhanden anlegen
           if(Model::setImageToContent($name,$this->r['themen_id'])){
            self::$info = '<div class="infogreen"> Erfolgreich eingetragen</div>';
          }else{
            self::$info = '<div class="infored">Eintrag nicht in Datenbank</div>';
          }
       }
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