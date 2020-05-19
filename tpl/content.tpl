<?php require_once("alpha_menu.tpl")?>

</form>
<?php 
     echo '<a href="' .  Controller::$referer .  '"> << </a>'; 
 ?>

<h2>Ihr Content</h2>
<?php 
# Ausgabe Bilder
foreach($data as $spalte){
  $path = DOCUPATH.$spalte['path'];
  $link = $path; 
  $parts = pathinfo($path);
  switch($parts['extension']){
    case 'pdf': $path = "img/pdf-icon.png";
          break;
    case 'rtf': $path = "img/rtf-icon.png";
          break;
    case 'txt': $path = "img/txt-icon.png";
          break;
  }
  echo '<a href="'.$link.'">';
  echo '<div class="docu shadow-lg rounded" style="background-image:url('.$path.')">';
  echo '</div></a>';
} 

?>