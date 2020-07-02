<!--edit.tpl-->

<h2>Themen upload</h2>
<?php echo Controller::$info ?>

<!-- Start Themen wählen -->
<form method="POST" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="edit_select">
<select id="themen_id" onchange="createDeleteFiles()" name="themen_id">

<?php
// linke Seite pulldown 
foreach($data as $col){
    echo '<option value="'.$col['id'].'" ';
    s('themen_id',$col['id']);//Ausgabe selected
    echo ' >'.$col['name'].'</option>';
}
?>
</select>
<!-- Optionen Thema hinzufügen, löschen etc...-->

<select id="optionen" onchange="pruefeSelect()" name="select">
 <option value="t_add"    <?php s('select','t_add')?> >Thema hinzufügen</option>
 <option value="t_rename" <?php s('select','t_rename')?> >Thema umbenennen</option>
 <option value="t_del"    <?php s('select','t_del')?> >Thema löschen</option>
 <option value="f_upload" <?php s('select','f_upload')?> >File upload</option>
 <option value="f_del"    <?php s('select','f_del')?> >File löschen</option>
</select>
<!-- Area unvisible -->
<!-- Thema Löschen -->
<input id="t_add"    class="area" type="text"   name="t_add" placeholder="neues Thema" >
<!-- Thema umbenennen -->
<input id="t_rename" class="area" type="text"   name="t_rename" placeholder="umbenennen"  >
<!-- Thema löschen -->
<input id="t_del"    class="area" type="hidden" name="t_del" >
<!-- File Upload -->
<input id="f_upload" class="area" type="file"   name="userfile" placeholder="upload" >
<select id="f_del"   class="area" name="f_del"></select>


<!-- end Area unvisible -->
<br><button >OK</button>
</form>

<!--
Noch zu erledigen
onsubmit="return checkFile()"
-->

<script src="js/upload_confirm.js"></script>