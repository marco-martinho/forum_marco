<?php 
class Service{
 const HOST = "localhost";
 const USER = "root";
 const PASS = "";
 const DBNAME = "db_cerebro";
 private static $PDO;


 public static function connectDB(){
   try{
       SELF::$PDO = new PDO("mysql:host=".SELF::HOST,SELF::USER,SELF::PASS);
   }catch(Exeption $e){
       exit("Fehler DB connect");
   }
   SELF::db_create();
 }
  public static function test(){
      $arr = SELF::$PDO->errorInfo();
      echo $arr[2];
      
  }    
    
  public static function setPrepare($sql){//SQL Injection Schutz
       SELF::connectDB();// connectivität nur durch prepare
       return SELF::$PDO->prepare($sql);// ergibt Maske
  } 
    
  public static function getAll($maske){
    $maske->execute();
    SELF::test();//nur für Testphase  
    return $maske->fetchAll();//Array mehrdimensional  
  }  
  
  public static function setIntoDB($maske){
    return $maske->execute();//Eintragen in Datenbank betroffene Zeilen zurück liefern
  }

  public static function getLastId(){ 

      return SELF::$PDO->lastInsertId();  //frish neues Theme
  }


  public static function getOneValue($maske){
    $maske->execute();
    return $maske->fetchColumn();//gib nur 1 wert zurück
  }
    

 public static function db_create(){
    SELF::$PDO->exec("SET NAMES utf8;SET CHARACTER SET UTF8"); 
    SELF::$PDO->exec("CREATE DATABASE IF NOT EXISTS ".SELF::DBNAME);
    SELF::$PDO->exec("USE ".SELF::DBNAME);

    /*SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_themes(
                      id INT(11) AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(255) NOT NULL UNIQUE
                    )");

    SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_uthemes(
                     id_themes INT(11) NOT NULL,
                     name VARCHAR(255) NOT NULL UNIQUE,
                     FOREIGN KEY(id_themes) REFERENCES tb_themes(id))");*/
     
   SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_themes(
                     id INT(11) AUTO_INCREMENT PRIMARY KEY,
                     name VARCHAR(255) NOT NULL UNIQUE )"
                    );
   SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_verteiler(
                     id INT(11) AUTO_INCREMENT PRIMARY KEY,
                     id_p INT(11) NOT NULL,
                     id_c INT(11) NOT NULL,
                     FOREIGN KEY(id_p) REFERENCES tb_themes(id),
                     FOREIGN KEY(id_c) REFERENCES tb_themes(id))"
                   );
   SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_content(
                     id INT(11) AUTO_INCREMENT PRIMARY KEY,
                     path VARCHAR(500) NOT NULL,
                     id_themes INT(11) NOT NULL,
                     FOREIGN KEY(id_themes) REFERENCES tb_themes(id))  
                    ");
  /*SELF::$PDO->exec("INSERT INTO tb_content(path,id_themes)
                    VALUES ('test_1.png',4),('image.jpg',4),('filezilla.gif',6),('bgr_license.rtf',6),('Ajax.pdf',5),('image.jpg',5),('text.txt',5)
                    ");*/
   
  /* SELF::$PDO->exec("INSERT INTO tb_themes(name)
                     VALUES ('Thema 1'),('Thema 2'),
                     ('A'),('B'),('C'),('D'),('E'),('F')");
    //(DML)    
    //SELF::$PDO->exec("INSERT INTO tb_verteiler(id_p,id_c)
                    // VALUES (1,3),(1,4),(2,5),(1,5),(2,6),(2,4)");
                     
                     
   /* Thema 1   A
              B
              C
         
    Thema 2   D
              B
              C    E
                   F 
    B         A
              C
                     
                     
                     
                     
                     
                     
                     
                     
                     
   /*  Thema 1   A
               B
               C
         
    Thema 2    D
               E
               F
         
    Parent child Tabelle     
    p_id themen_id  name(unique)
    1     NULL      Thema 1
    2     NULL      Thema 2
    3      1        A
    4      1        B
    5      2        D 
    6      1        C     
    7      2        C 
    
    #############################     
     Thema 1   A
               B
               C
         
    Thema 2    D
               B
               C    E
                    F
         
    tb_allTheme
    id    name(unique)
    1     Thema 1
    2     A
    3     B
    4     Thema 2
    5     D
    6     C
    7     E
    8     F   

    tb_verteiler
    fk_id    fk_name
    1        2
    1        3
    1        6
    4        6
    6        7
    6        8  */   
         
 }


}