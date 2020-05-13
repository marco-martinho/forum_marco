<form method="POST">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button value="Ä" name="alpha">Ä</button><button value="Ö" name="search">Ö</button><button value="Ü" name="alpha">Ü</button>';
   ?>

</form>


<?php 
echo "Es wurden folgende Einträge funden: ".count($data)."<br><ul>";
foreach($data as $spalte){
echo '<li><a href="?content_id='.$spalte['id'].'">'.$spalte['name'].'</a></li>';
} 
echo "</ul>";
?>