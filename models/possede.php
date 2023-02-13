<?php
    class Possede {
        //attributs
        public $connect;
        private $table ='possede';
        
        private $idUser;
        private $idGenre;

        public function __construct(){
            $this->connect = new Bdd();
            $this->connect = $this->connect->getConnexion();
        }

        public function getTable(){
            return $this->table;
        }
    
        public function setTable($table){
            $this->table = $table;
        }
    
        public function getIdUser(){
            return $this->idUser;
        }
    
        public function setIdUser($idUser){
            $this->idUser = $idUser;
        }
    
        public function getIdGenre(){
            return $this->idGenre;
        }
    
        public function setIdGenre($idGenre){
            $this->idGenre = $idGenre;
        }

        public function createPossede(){
            $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            idUser = :idUser,
                            idGenre = :idGenre";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }

        public function readUserGenres(){
            $myQuery = "SELECT
                            nomGenre
                        FROM
                            genreMusical
                        INNER JOIN
                            '.$this->table.' 
                        ON
                            genreMusical.idGenre = '.$this->table.'.idGenre
                        WHERE
                            idUser = :idUser";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }

        // public function updatePossede(){
        //     $myQuery = "UPDATE
        //                     '.$this->table.'
        //                 SET
        //                     idUser = :idUser,
        //                 WHERE
        //                     idUser = :idUser";
            
        //     $stmt = $this->connect->prepare($myQuery);
        //     $stmt->bindParam(':idUser', $this->idUser);
        //     return $stmt->execute();
        // }

        public function deletePossede(){
            $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idUser = :idUser
                        AND
                            idGenre = :idGenre";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            $stmt->bindParam(':idGenre', $this->idGenre);
            return $stmt->execute();
        }
    }
?>