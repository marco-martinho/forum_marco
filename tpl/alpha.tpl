<?php require_once("alpha_menu.tpl")?>

<?php 
echo "Es wurden folgende Einträge funden: ".count($data)."<br><ul>";
foreach($data as $spalte){
echo '<li><a href="?content_id='.$spalte['id'].'">'.$spalte['name'].'</a></li>';
} 
echo "</ul>";
?>