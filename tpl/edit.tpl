<!--edit.tpl-->
<h2>Themen upload</h2>

<?php echo Controller::$info ?>

<form method="POST" action="index.php" onsubmit="return checkFile()" 
enctype="multipart/form-data">


<?php

echo '<select name="themen_id">';
foreach($data as $col){
    echo '<option value="'.$col['id'].'">'.$col['name'].'</option>';
}
echo '</select>';
echo '<input type="file" name="userfile">';
?>
<button >OK</button>
</form>

<script src="js/upload_confirm.js"></script>