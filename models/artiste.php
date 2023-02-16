<?php
    require_once(__DIR__ . '.\..\utilitaires\BDD.php');
    
    class Artiste {
        //attributs
        public $connect;
        private $table ='artiste';
        
        private int $idArtiste;
        private string $nomArtiste;

        public function __construct(){
            $this->connect = BDD::getConnexion();
        }
        public function getTable(){
            return $this->table;
        }
    
        public function setTable($table){
            $this->table = $table;
        }
    
        public function getIdArtiste(){
            return $this->idArtiste;
        }
    
        public function setIdArtiste($idArtiste){
            $this->idArtiste = $idArtiste;
        }

        public function getNomArtiste(){
            return $this->nomArtiste;
        }
    
        public function setNomArtiste($nomArtiste){
            $this->nomArtiste = $nomArtiste;
        }

        public function createArtiste(){
            $myQuery = "INSERT INTO
                            $this->table
                        SET
                            nomArtiste = :nomArtiste";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomArtiste', $this->nomArtiste);
            return $stmt->execute();
        }

        public function getArtiste(){
            $myQuery = "SELECT
                            idArtiste, nomArtiste
                        FROM
                            $this->table
                        WHERE
                            idArtiste = :idArtiste";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->execute();

            return $stmt->fetch();
        }

        public function getAllArtiste(){
            $myQuery = "SELECT
                            *
                        FROM
                            $this->table";
                        
            $stmt = $this->connect->prepare($myQuery);

            $stmt->execute();

            $result = $stmt->fetchAll();

            return $result;
        }

        public function updateArtiste() {
            $myQuery = "UPDATE
                            $this->table
                        SET
                            nomArtiste = :nomArtiste
                        WHERE
                            idArtiste = :idArtiste";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomArtiste', $this->nomArtiste);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            return $stmt->execute();
        }

        public function deleteArtiste(){
            $myQuery = "DELETE FROM
                            $this->table
                        WHERE
                            idArtiste = :idArtiste";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            return $stmt->execute();
        }
    }
?>