<?php
    class GenreMusical {
        //attributs
        public $connect;
        private $table ='genremusical';
        
        private $idGenre;
        private $nomGenre;

        public function __construct(){
            $this->connect = BDD::getConnexion();
        }

        public function getTable(){
            return $this->table;
        }
    
        public function setTable($table){
            $this->table = $table;
        }
    
        public function getIdGenre(){
            return $this->idGenre;
        }
    
        public function setIdGenre($idGenre){
            $this->idGenre = $idGenre;
        }

        public function getNomGenre(){
            return $this->nomGenre;
        }
    
        public function setNomGenre($nomGenre){
            $this->nomGenre = $nomGenre;
        }

        public function createGenre(){
            $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            nomGenre = :nomGenre";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomGenre', $this->nomGenre);
            return $stmt->execute();
        }

        public function getAllGenres(){
            $myQuery = "SELECT
                            idGenre, nomGenre
                        FROM
                            $this->table";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        public function updateGenre(){
            $myQuery = "UPDATE
                            '.$this->table.'
                        SET
                            nomGenre = :nomGenre
                        WHERE
                            idGenre = :idGenre";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomGenre', $this->nomGenre);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }

        public function delete(){
            $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idGenre = :idGenre";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }
    }
?>