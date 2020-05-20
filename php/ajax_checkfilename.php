<?php
//php/ajax_checkfilename.php?name= sterne.jpg
 /*$filename = $_GET['name'];
 $erg = file_exists('../upload/'.$filename);
 echo $erg;*/

 echo file_exists('../upload/'.$_GET['name']);
?>