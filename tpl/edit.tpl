<!--edit.tpl-->
<h2>Themen upload</h2>
<form method="POST" action="index.php" enctype="multipart/form-data">


<?php
echo '<select name="themen_id">';
foreach($data as $col){
    echo '<option value="'.$col['id'].'">'.$col['name'].'</option>';
}
echo '</select>';
echo '<input type="file" name="userfile">';
?>
<button>OK</button>
</form>