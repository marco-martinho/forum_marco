// js/upload_confirm.js

var infile = document.querySelector('#area_1');


function checkFile(){
    //AJAX Programmierung
    var n = infile.files[0].name;
    var engine = new XMLHttpRequest();// AJAX, Engine
     engine.open("get","php/ajax_checkfilename.php?name=" + n,false);
     engine.send();//komplexen Vorgang ausführen
     // 4 = complete - Fully loaded
     if(engine.readyState == 4 && engine.status == 200){
           answer = engine.responseText;// true oder  false
           if(answer == '1'){//file auf Server existiert
               var check = confirm('Die Datei existiert auf dem Server! Wollen Sie die Datei überschreiben?');
               if(check == false)return false;//Nein Formular nicht abschicken
           }
    }
    return true;
}

function visibleArea($value){
   document.querySelectorAll(".area").forEach(function(area,index){
     area.style.display = 'none';
     area.value = '';
   });
   document.querySelector('#'+$value).style.display ='block';
}