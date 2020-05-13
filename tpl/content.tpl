<form method="POST">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button value="Ä" name="alpha">Ä</button><button value="Ö" name="search">Ö</button><button value="Ü" name="alpha">Ü</button>';
   ?>

</form>
<?php echo '<a href="index.php?search='.$data['search'].'"> << </a>' ?>
<h2>Ihr Content</h2>
<?php 
# Ausgabe Bilder
foreach($data['docu'] as $spalte){
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