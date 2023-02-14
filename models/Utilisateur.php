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
            $this->connect = BDD::getConnexion();
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

        public function getAdresseUser(){
            return $this->adresseUser;
        }
    
        public function setAdresseUser($adresseUser){
            $this->adresseUser = $adresseUser;
        }
    
        public function getIdRole(){
            return $this->idRole;
        }
    
        public function setIdRole($idRole){
            $this->idRole = $idRole;
        }

        public function createUser(): bool {
            $myQuery = "INSERT INTO
                            utilisateur
                        SET
                            mailUser = :mailUser,
                            mdpUser = :mdpUser,
                            adresseUser = :adresseUser,
                            nomUser = :nomUser,
                            prenomUser = :prenomUser,
                            idRole = :idRole";
            
            $stmt = $this->connect->prepare($myQuery);

            $password = password_hash($this->mdpUser, PASSWORD_BCRYPT);

            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->bindParam(':mdpUser', $password);
            $stmt->bindParam(':adresseUser', $this->adresseUser);
            $stmt->bindParam(':nomUser', $this->nomUser);
            $stmt->bindParam(':prenomUser', $this->prenomUser);
            $stmt->bindParam(':idRole', $this->idRole);

            return $stmt->execute();
        }

        public function readUserById(): bool {
            $myQuery = "SELECT
                            *
                        FROM
                            utilisateur
                        WHERE
                            idUser = :idUser";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }

        public function readUserByMail(): bool {
            $myQuery = "SELECT
                            idUser, mailUser, adresseUser, nomUser, prenomUser
                        FROM
                            utilisateur
                        WHERE
                            mailUser = :mailUser
                        LIMIT 1";
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->execute();

            return $result = $stmt->fetchAll();
        }

        //permet de vérifier si un utilisateur existe déjà via son mail
        public function checkUserMail(){
            $myQuery = "SELECT 
                            COUNT(*)
                        FROM
                            utilisateur
                        WHERE
                            mailUser = :mailUser";
                        
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->execute();

            return $result = $stmt->fetchAll();
        }

        public function getPasswordById() {
            $myQuery = "SELECT
                            mdpUser
                        FROM
                            utilisateur
                        WHERE
                            idUser = :idUser
                        LIMIT 1";
            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            $stmt->execute();

            return $result = $stmt->fetchAll();
        }

        public function connectUser() {
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

            if (password_verify($this->getMdpUser(), $row['mdpUser']) === true) {
                return true;
            }

            return false;
        }

        public function updateUser(){
            $myQuery = "UPDATE
                            utilisateur
                        SET
                            mailUser = :mailUser,
                            mdpUser = :mdpUser,
                            adresseUser = :adresseUser,
                            nomUser = :nomUser,
                            prenomUser = :prenomUser
                        WHERE
                            idUser = :idUser";
            
            $stmt = $this->connect->prepare($myQuery);

            $password = password_hash($this->mdpUser, PASSWORD_BCRYPT);

            $stmt->bindParam(':mailUser', $this->mailUser);
            $stmt->bindParam(':mdpUser', $password);
            $stmt->bindParam(':adresseUser', $this->adresseUser);
            $stmt->bindParam(':nomUser', $this->nomUser);
            $stmt->bindParam(':prenomUser', $this->prenomUser);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }

        public function deleteUser(){
            $myQuery = "DELETE FROM
                            utilisateur
                        WHERE
                            idUser = :idUser";

            $stmt = $this->connect->prepare($myQuery);
            $stmt->bindParam(':idUser', $this->idUser);
            return $stmt->execute();
        }
    }
?>