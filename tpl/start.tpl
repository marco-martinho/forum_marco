<form method="POST">
   <?php 
    foreach(range('A','Z') as $char){
      echo '<button value="'.$char.'" name="alpha">'.$char.'</button>';
    }
    echo '<button value="Ä" name="alpha">Ä</button><button value="Ö" name="search">Ö</button><button value="Ü" name="alpha">Ü</button>';
   ?>
   

</form>

<!--normal data ['Thema'->'A,B,C']    
     alpha data ['A..','A..',]-->
<ul  class="title_link">
<?php    
foreach($data as $w){
  echo '<li>'.$w['title']."<ul>";
  $liste = explode(",", $w['ut']);
  foreach($liste as $ut){
  
    echo "<li>".$ut."</li>";
  
  }
  echo "</ul></li>"; 
}
?>
</ul>