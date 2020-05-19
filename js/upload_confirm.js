// js/upload_confirm.js
//
function checkFile(){
    //AJAX Programmierung
    var engine = new XMLHttpRequest();// AJAX, Engine
     engine.open("get","php/checkfilename.php",false);
     // 4 = complete - Fully loaded
     if(engine.readyState == 4 && engine.status == 200){
           file_auf_server = engine.responseText;// true oder  false
     }
     if(file_auf_server == "true"){//file auf Server existiert
          var check = confirm('Die Datei existiert auf dem Server! Wollen Sie die Datei überschreiben?');
          if(check == false)return false;//Nein Formular nicht abschicken
    }
    return true;
}