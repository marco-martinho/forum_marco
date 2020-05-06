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

 public static function db_create(){
    SELF::$PDO->exec("SET NAMES utf8;SET CHARACTER SET UTF8"); 
    SELF::$PDO->exec("CREATE DATABASE IF NOT EXISTS ".SELF::DBNAME);
    SELF::$PDO->exec("USE ".SELF::DBNAME);

    SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_themes(
                      id INT(11) AUTO_INCREMENT PRIMARY KEY,
                      name VARCHAR(255) NOT NULL UNIQUE
                    )");

    SELF::$PDO->exec("CREATE TABLE IF NOT EXISTS tb_uthemes(
                     id_themes INT(11) NOT NULL,
                     name VARCHAR(255) NOT NULL UNIQUE,
                     FOREIGN KEY(id_themes) REFERENCES tb_themes(id))");
 }


}