<?php
    class Scene {
        //attributs
        public $connect;
        private $table ='scene';
        
        private $idScene;
        private $nomScene;
        private $idFestival = 1;

        public function __construct(){
            $this->connect = BDD::getConnexion();
        }

        public function getTable(){
            return $this->table;
        }
    
        public function setTable($table){
            $this->table = $table;
        }
    
        public function getIdScene(){
            return $this->idScene;
        }
    
        public function setIdScene($idScene){
            $this->idScene = $idScene;
        }

        public function getNomScene(){
            return $this->nomScene;
        }
    
        public function setNomScene($nomScene){
            $this->nomScene = $nomScene;
        }

        public function getIdFestival(){
            return $this->idFestival;
        }
    
        public function setIdFestival(int $idFestival){
            $this->idFestival = $idFestival;
        }

        public function createScene(){
            $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            nomScene = :nomScene,
                            idFestival = :idFestival";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomScene', $this->nomScene);
            $stmt->bindParam(':idFestival', $this->idFestival);
            return $stmt->execute();
        }

        public function getAllScenes() {
            $myQuery = "SELECT
                            idScene, nomScene, idFestival
                        FROM
                            $this->table
                        WHERE
                            idFestival = :idFestival";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idFestival', $this->idFestival);
            $stmt->execute();

            return $stmt->fetchAll();
        }

        public function updateScene(){
            $myQuery = "UPDATE
                            '.$this->table.'
                        SET
                            nomScene = :nomScene,
                            idFestival = :idFestival
                        WHERE
                            idScene = :idScene";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':nomScene', $this->nomScene);
            $stmt->bindParam(':idFestival', $this->idFestival);
            $stmt->bindParam(':idScene', $this->idScene);
            return $stmt->execute();
        }

        public function delete(){
            $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idScene = :idScene";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idScene', $this->idScene);
            return $stmt->execute();
        }
    }
?>