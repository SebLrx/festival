<?php
    require_once(__DIR__ . '.\..\utilitaires\BDD.php');

    class Utilisateur {
        //attributs
        public $connect;
        private $table ='utilisateur';
        
        private $idUser;
        private $mailUser;
        private $mdpUser;
        private $adresseUser;
        private $nomUser;
        private $prenomUser;
        private $idRole;

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
    
        public function getMailUser(){
            return $this->mailUser;
        }
    
        public function setMailUser($mailUser){
            $this->mailUser = $mailUser;
        }
    
        public function getMdpUser(){
            return $this->mdpUser;
        }
    
        public function setMdpUser($mdpUser){
            $this->mdpUser = $mdpUser;
        }
    
        public function getNomUser(){
            return $this->nomUser;
        }
    
        public function setNomUser($nomUser){
            $this->nomUser = $nomUser;
        }
    
        public function getPrenomUser(){
            return $this->prenomUser;
        }
    
        public function setPrenomUser($prenomUser){
            $this->prenomUser = $prenomUser;
        }
    
        public function getIdRole(){
            return $this->idRole;
        }
    
        public function setIdRole($idRole){
            $this->idRole = $idRole;
        }

        public function createUser(){
            $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            mailUser = :mailUser,
                            mdpUser = :mdpUser,
                            adresseUser = :adresseUser,
                            nomUser = :nomUser,
                            prenomUser = :prenomUser,
                            idRole = :idRole";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->bindParam(':mdpUser', $this->mdpUser);
            $stmt->bindParam(':adresseUser', $this->adresseUser);
            $stmt->bindParam(':nomUser', $this->nomUser);
            $stmt->bindParam(':prenomUser', $this->prenomUser);
            $stmt->bindParam(':idRole', $this->idRole);
            return $stmt->execute();
        }

        public function readUser(){
            $myQuery = "SELECT
                            *
                        FROM
                            '.$this->table.'
                        WHERE
                            idUser = :idUser";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }

        public function connectUser(){
            $myQuery = "SELECT
                            `idUser`, `mailUser`, `mdpUser`
                        FROM
                            `$this->table`
                        WHERE
                            mailUser = :mailUser";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':mailUser', $this->mailUser);
    
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (strcmp($this->getMdpUser(), $row['mdpUser']) === 0) {
                return true;
            }

            return false;
        }

        public function updateUser(){
            $myQuery = "UPDATE
                            '.$this->table.'
                        SET
                            mailUser = :mailUser,
                            mdpUser = :mdpUser,
                            adresseUser = :adresseUser,
                            nomUser = :nomUser,
                            prenomUser = :prenomUser,
                            idRole = :idRole
                        WHERE
                            idUser = :idUser";
            
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->bindParam(':mdpUser', $this->mdpUser);
            $stmt->bindParam(':adresseUser', $this->adresseUser);
            $stmt->bindParam(':nomUser', $this->nomUser);
            $stmt->bindParam(':prenomUser', $this->prenomUser);
            $stmt->bindParam(':idRole', $this->idRole);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }

        public function deleteUser(){
            $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idUser = :idUser";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }
    }
?>