<form method="POST">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button value="Ä" name="alpha">Ä</button><button value="Ö" name="search">Ö</button><button value="Ü" name="alpha">Ü</button>';
   ?>

</form>

<h2>Ihr Content</h2>
<?php 
# Ausgabe Bilder
foreach($data as $spalte){
  $path = DOCUPATH.$spalte['path'];
  echo '<div class="docu shadow-lg rounded" style="background-image:url('.$path.')">';
  echo '</div>';
} 

?>