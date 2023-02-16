<?php
    class Heberge {
        //attributs
        public $connect;
        private $table ='heberge';
        
        private int $idArtiste;
        private int $idScene;
        private string $datePassage;

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
    
        public function getIdScene(){
            return $this->idScene;
        }
    
        public function setIdScene($idScene){
            $this->idScene = $idScene;
        }

        public function getDatePassage(){
            return $this->datePassage;
        }
    
        public function setDatePassage($datePassage){
            $this->datePassage = $datePassage;
        }

        public function createHeberge(){
            $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            idArtiste = :idArtiste,
                            idScene = :idScene,
                            datePassage = :datePassage";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->bindParam(':idScene', $this->idScene);
            $stmt->bindParam(':datePassage', $this->datePassage);
            return $stmt->execute();
        }

        public function getArtistScenes(){
            $myQuery = "SELECT
                            scene.idScene,
                            nomScene,
                            datePassage
                        FROM
                            scene
                        INNER JOIN
                            $this->table 
                        ON
                            scene.idScene = $this->table.idScene
                        WHERE
                            idArtiste = :idArtiste";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            $stmt->execute();

            $result = $stmt->fetchAll();
            return $result;
        }

        public function readSceneArtists(){
            $myQuery = "SELECT
                            nomArtist,
                            datePassage
                        FROM
                            artist
                        INNER JOIN
                            '.$this->table.' 
                        ON
                        artist.idArtiste = '.$this->table.'.idArtiste
                        WHERE
                        idScene = :idScene";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idScene', $this->idScene);

            $result = $stmt->fetchAll();
            return $result;
        }

        // public function updateHeberge(){
        //     $myQuery = "UPDATE
        //                     $this->table
        //                 SET
        //                     idGenre = :idGenre,
        //                 WHERE
        //                     idArtiste = :idArtiste
        //                 AND 
        //                     idScene = :idScene";
            
        //     $stmt = $this->connect->prepare($myQuery);
        //     $stmt->bindParam(':idArtiste', $this->idArtiste);
        //     $stmt->bindParam(':idGenre', $this->idGenre);
        //     return $stmt->execute();
        // }

        public function deleteHeberge(){
            $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idArtiste = :idArtiste";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idArtiste', $this->idArtiste);
            return $stmt->execute();
        }
    }
?>