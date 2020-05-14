<?php require_once("alpha_menu.tpl")?>
   

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