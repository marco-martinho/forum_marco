
<!-- alpha_Menu.tpl -->
<form method="get" action="index.php">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button value="Ä" name="alpha">Ä</button><button value="Ö" name="search">Ö</button><button value="Ü" name="alpha">Ü</button>';
?>
</form>