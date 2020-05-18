
<!-- alpha_Menu.tpl -->

  

<form method="POST" action="index.php">
<div class="btn-group-lg ml-3">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button type="button" class="btn btn-outline-dark" value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button type="button" class="btn btn-outline-dark" value="Ä" name="alpha">Ä</button><button type="button" class="btn btn-outline-dark" value="Ö" name="search">Ö</button><button type="button" class="btn btn-outline-dark" value="Ü" name="alpha">Ü</button>';
?>
</div>
</form>


