<?php
class Model{
    // hier alle Sql Anweisungen
public static function getAllThemes(){
 
    
   $sql = "SELECT x.title , GROUP_CONCAT(DISTINCT name) AS ut
            FROM (SELECT v.id_c AS new_id, t.name as title
             FROM tb_verteiler v
               LEFT JOIN tb_themes t
               ON v.id_p = t.id
            ) AS x
           LEFT JOIN tb_themes t
               ON x.new_id = t.id
           GROUP BY x.title
           ";
      /* $sql = "SELECT t.name AS ht , GROUP_CONCAT(DISTINCT t.name) AS ut 
            FROM tb_themes t
            JOIN tb_verteiler v
            ON   v.id_p = t.id OR  v.id_c = t.id
           ";*/
    //Vorbereiten Schutz    gegen SQL Injection 
    // Speicher hat jetzt diese Maske
    $maske = Service::setPrepare($sql);
    return Service::getAll($maske);//Abholen der Daten
    
    //"Thema1"=>['A','B']
} 
    
 public static function getAllThemesAlpha($alpha){
     $sql = "SELECT name,id FROM tb_themes WHERE name LIKE ? ORDER BY name ASC";
     $maske = Service::setPrepare($sql);
     $maske->bindValue(1,$alpha.'%',PDO::PARAM_STR);
     return Service::getAll($maske);
 }
public static function getAllThemesSearch($search){
     $sql = "SELECT name,id FROM tb_themes WHERE name LIKE ? ORDER BY name ASC";
     $maske = Service::setPrepare($sql);
     $maske->bindValue(1,'%'.$search.'%',PDO::PARAM_STR);
     return Service::getAll($maske);
 }  
    

    public static function getAllContent($content_id){
    //var_dump($content_id); exit;    
     $sql = "SELECT path FROM tb_content WHERE id_themes = ? ";
     $maske = Service::setPrepare($sql);
     $maske->bindValue(1,$content_id,PDO::PARAM_STR);
     return Service::getAll($maske);
 }

 public static function getAllEdit(){
     $sql = "SELECT id, name FROM tb_themes ORDER BY name ASC";
     $maske = Service::setPrepare($sql);
     return Service::getAll($maske);
 }
 public static function setImageToContent($name,$id_themes){
    $sql = "INSERT INTO tb_content (path,id_themes)
            VALUES (?,?)";
    $maske = Service::setPrepare($sql);
    $maske->bindValue(1,$name,PDO::PARAM_STR);
    $maske->bindValue(2,$id_themes,PDO::PARAM_INT);       
    return Service::setIntoDB($maske);//Eintrag erfolgreich = 1
 }
 // gib eine Id zurück wenn Datei und themse id vorhanden
 public static function getIdImageContent($name,$id_themes){
    $sql = "SELECT id FROM tb_content WHERE path = ? AND id_themes = ? ";
    $maske = Service::setPrepare($sql);
    $maske->bindValue(1,$name,PDO::PARAM_STR);
    $maske->bindValue(2,$id_themes,PDO::PARAM_INT); 
    return Service::getOneValue($maske);//id wird geliefert wenn path & thema bereits vorhanden
 }

 public static function setUpdateTheme($thema, $id_themes){
    $sql = "UPDATE tb_themes SET name = ? WHERE id = ?";
    $maske = Service::setPrepare($sql);
    $maske->bindValue(1,$thema,PDO::PARAM_STR);
    $maske->bindValue(2,$id_themes,PDO::PARAM_INT); 
    return Service::setIntoDB($maske);
}



 public static function setAddTheme($thema){
    $sql = "INSERT INTO tb_themes (name) VALUES (?)";
    $maske = Service::setPrepare($sql);
    $maske->bindValue(1,$thema,PDO::PARAM_STR);
    Service::setIntoDB($maske);
    return Service::getLastId();  //die neue id, wenn 0 thema existiert
 }


 public static function getIdFromThemes($thema){
    $sql = "SELECT id FROM tb_themes WHERE name= ? ";
    $maske = Service::setPrepare($sql);   //sql injection
    $maske->bindValue(1,$thema,PDO::PARAM_STR);
    return Service::getOneValue($maske);   // nur 1 wert abholen
 }


 public static function setDeleteTheme($id_themes){
    $sql = "DELETE from tb_themes WHERE id = ? ";
    $maske = Service::setPrepare($sql);   //sql injection
    $maske->bindValue(1,$id_themes,PDO::PARAM_INT);
    return Service::setIntoDB($maske);   //delete ausführen
 }

}
?>