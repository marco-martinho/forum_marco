<?php
class Controller{
    public function __construct(){
        Model::getAllThemes();
        $data =["Thema 1","Thema 2","Thema 3"];
        View::setLayout($data,"start");
        View::toDisplay();//user Ansicht
    }
}
?>