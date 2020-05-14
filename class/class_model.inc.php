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



}
?>