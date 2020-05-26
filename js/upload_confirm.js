//Prüfung ob File bereits auf Server vorhanden
function checkFile(){
    var infile = document.querySelector('#area_1');
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
//Einblenden verschiedener Auswahlmöglichkeiten
function visibleArea($value){
    // Alle Area erstmal ausschalten
   document.querySelectorAll(".area").forEach(function(area,index){
     area.style.display = 'none';
     area.value = '';
   });
   // Ein spezifisches Area einblenden
   document.querySelector('#'+$value).style.display ='block';
   if($value == 'f_del')createDeleteFiles();
}
//Optionsfeld für Löschen von Dateien erstellen
function createDeleteFiles(){
var id = document.querySelector('#themen_id').value;
var select = document.querySelector("#f_del");
var e = new XMLHttpRequest();
e.open("get","php/getFileForDelete.php?id=" + id,false);
e.send();
if(e.readyState == 4 && e.status == 200){
   jsonObj = JSON.parse(e.responseText);

   select.innerHTML = null;//Leeren zum neu auffüllen
   for(i in jsonObj){
      var option = document.createElement("option");
      option.text = jsonObj[i];
      select.add(option); 
   }
 }
}