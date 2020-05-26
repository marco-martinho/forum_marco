<?php
//klasse.php
class MyName{
 function __construct(){
     echo "automatisch";
 }   
 function myMethod(){//Methoden des Klasse/Objekts
     echo "hier";
 }
 function myMethod2(){
     echo "hier 2";
 }
 function __destruct(){// Object wird aus Arbeitsspeicher entfernt
     echo "Ende ";
 }
}

MyName::myMethod2();//statischer Aufruf (es gibt kein Objekt im Speicher)

/*$instanz1 =   new MyName();
$instanz1->myMethod();
$instanz2 =   new MyName();
$instanz2->myMethod();//Auflösung
new MyName();*





//$instanz -> myMethod2();







/*new MyName();
new MyName();
$instanz = new MyName();
$instanz->myMethod();
$instanz->myMethod2();*/

?>