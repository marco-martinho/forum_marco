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
                                 case 'f_upload':   $this->checkContent();   
                                                  break;
                                 case 't_add':      $this->checkAddTheme();
                                                  break; 
                                 case 't_rename':   $this->checkRenameTheme();
                                                  break;
                                 case 't_del':      $this->checkDeleteTheme();
                                                  break;              
                                }
                                $this->getEdit();//Ansicht editfenster
                                break;
            default: $data = Model::getAllThemes();
                     View::setLayout($data,"start");
        }
        View::toDisplay();//user Ansicht
        self::$info = "";//Info entfernen
    }
   

    private function checkDeleteTheme(){

        $muster = "/^[0-9]+$/";

        if(preg_match($muster,$this->r['themen_id'])){
            $this->deleteTheme();
        }else{
            self::$info = '<div class="infogreen">Thema nicht gelöscht</div>';
        }
    }

    private function deleteTheme(){

        if(MODEL::setDeleteTheme($this->r['themen_id'])){      //Übegabe der id
              
            self::$info = '<div class="infogreen">Thema gelöscht</div>';
        }else{
            self::$info = '<div class="infored">Löschen fehlgeschlagen</div>';
        }

            
    }


    
    private function checkAddTheme(){// Validierung der Eingaben
     $neueThema = trim($this->r['t_add']); //Leerzeichen am Ende und Anfang entfernen
     $neueThema = strip_tags($neueThema);//alle php html tags XSS Scripting vermeiden
     //str_pad($neueThema,5,)        Thema ist sehr... xxxx
                        // Text Hallo   H=0,o = 4    
     $neueThema = substr($neueThema,0,255); //Thema auf Maximallänge 5 Buchstaben kürzen
     $arr1 = ['Shit',':(','ß','Fuck'];//Zeichen ersetzen
     $arr2 = ['S***',''  ,'ss','F***'];
     $neueThema = str_ireplace($arr1,$arr2,$neueThema);    
     if(strlen($neueThema) > 0 && ctype_print($neueThema)) $this->addTheme($neueThema);   
    }

    private function checkRenameTheme(){
        $neueThema = trim($this->r['t_rename']); //Leerzeichen am Ende und Anfang entfernen
        $neueThema = strip_tags($neueThema);//alle php html tags XSS Scripting vermeiden
        //str_pad($neueThema,5,)        Thema ist sehr... xxxx
                           // Text Hallo   H=0,o = 4    
        $neueThema = substr($neueThema,0,255); //Thema auf Maximallänge 5 Buchstaben kürzen
        $arr1 = ['Shit',':(','ß','Fuck'];//Zeichen ersetzen
        $arr2 = ['S***',''  ,'ss','F***'];
        $neueThema = str_ireplace($arr1,$arr2,$neueThema);    
        if(strlen($neueThema) > 0 && ctype_print($neueThema)) $this->renameTheme($neueThema);   
    }

    private function renameTheme($updateThema){ //setRenameTheme
        //setRenameTheme
        //"UPDATE tb_themes SET name = $updateThema WHERE id = [themen_id]"
        if(MODEL::setUpdateTheme($updateThema, $this->r['themen_id'])){
            self::$info  = '<div class="infogreen">Thema umbenannt</div>';
        }else{
            self::$info  = '<div class="infored">Thema nicht umbenannt</div>';
        }

    }


    private function addTheme(){     //Hinzufügen neues Thema

        // neue themen id wird generiert und selected Optionsfelder zugeoordnet
        $_REQUEST['themen_id'] = Model::setAddTheme($this->r['t_add']);

            if ( $_REQUEST['themen_id'] > 0 ) {  //id wurde angelegt
               self::$info =  '<div class="infogreen">Thema hinzugefügt</div>';
            }else{
                self::$info = '<div class="infored">Thema existiert bereits</div>';
            }
    }



    private function checkContent(){ //Prüfen des neuen Files

         if($_FILES['userfile']['size'] > MAX_FILE_SIZE){
             self::$info = '<div class="infored">File größer 1 MB</div>';
         }
        
         if(!in_array($_FILES['userfile']['type'],MIME_TYP)){//Datei ist nicht Mimetype gerecht
            self::$info = '<div class="infored">Falscher Dateityp</div>';
         }
         if(self::$info == "")$this->uploadContent();
    }
        
   private function uploadContent(){   // Hochladen von Content bzw.Änderung Themen  
        if(isset($_FILES['userfile']['name'])){// upload File hat Name
            $name = $_FILES['userfile']['name'];//straße.jpeg
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