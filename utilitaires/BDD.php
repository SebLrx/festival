<?php
    abstract class Bdd {
        // je crée les attributs de ma classe de config db
        private static $host = "127.0.0.1";
        private static $dbName = "festival";
        private static $userName = "root";
        private static $password = "";

        // l'attribut suivant sera lui en public
        // pour permettre aux autres classes d'accéder à la connexion 
        // de la fonction de connexion à la base de données
        public static $connect;
        
        // je crée la fonction pour appeler le système de connexion à ma BDD
        // celle-ci va permettre d'injecter mes attributs en private dans 
        // l'attribut qui est en public. 
        public static function getConnexion() {
            if(self::$connect == null) {
                try{
                    self::$connect = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName."",self::$userName,self::$password);
                        
                    // self::$connect->exec('set names utf8');
                } catch(PDOException $exception) {
                    echo "Database could not be connected:".$exception->getMessage();
                }
            } 
                return self::$connect;
        }
    }
?>