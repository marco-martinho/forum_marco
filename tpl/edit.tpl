<!--edit.tpl-->
<h2>Themen upload</h2>

<?php echo Controller::$info ?>

<!-- Start Themen wählen -->
<form method="POST" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="edit_select">
<select name="themen_id">
<?php
foreach($data as $col){
    echo '<option value="'.$col['id'].'" ';
    s('themen_id',$col['id']);//Ausgabe selected
    echo ' >'.$col['name'].'</option>';
}
?>
</select>
<!-- End Themen wählen -->

<select onchange="visibleArea(this.value)" name="select">
 <option value="upload" <?php s('select','upload')?> >upload</option>
 <option value="add"    <?php s('select','add')?> >hinzufügen</option>
 <option value="rename" <?php s('select','rename')?> >ändern</option>
 <option value="del"    <?php s('select','del')?> >löschen</option>
</select>
<!-- Area unvisible -->
<input id="upload" class="area" type="file"   name="userfile" placeholder="upload" >
<input id="add" class="area" type="text"   name="add" placeholder="neues Thema" >
<input id="rename" class="area" type="text"   name="rename" placeholder="umbenennen"  >
<input id="del" class="area" type="hidden" name="del" >
<!-- end Area unvisible -->
<br><button >OK</button>
</form>

<!--
Noch zu erledigen
onsubmit="return checkFile()"
-->
 


<script src="js/upload_confirm.js"></script>