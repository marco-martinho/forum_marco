<?php
class Controller{
    private $r;//Auffang der QUERY String ? search = A
    public function __construct(){
        $this->r = $_REQUEST;//assoziatives Array
        switch(key($this->r)){
            case "alpha": $this->getAlpha();
                           break;
            case "search":$this->getSearch(); 
                           break;
            case "content_id":$this->getContent();
                           break;    
            default: $data = Model::getAllThemes();
                     View::setLayout($data,"start");
        }
        View::toDisplay();//user Ansicht
    }
    private function getContent(){
        $data['docu'] = Model::getAllContent($this->r['content_id']);
        $data['search'] =  $_SESSION['search'];
        View::setLayout($data,"content");
    }
    
    private function getSearch(){// Suchefunktion nach Buchstaben
       $_SESSION['search'] = $this->r['search'];//Speichern Suchwort
       $data = Model::getAllThemesSearch($this->r['search']); 
       View::setLayout($data,"alpha"); 
    }
    
    
    private function getAlpha(){// Suchefunktion nach Buchstaben
       $data = Model::getAllThemesAlpha($this->r['alpha']);  
       View::setLayout($data,"alpha"); 
    }
}


      
?>