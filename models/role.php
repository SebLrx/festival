<?php
    class Role {
        //attributs
        public $connect;
        private $table ='role';
        
        private $idRole;
        private $nomRole;

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
    
        public function getIdRole(){
            return $this->idRole;
        }
    
        public function setIdRole($idRole){
            $this->idRole = $idRole;
        }

        public function getNomRole(){
            return $this->nomRole;
        }
    
        public function setNomRole($nomRole){
            $this->nomRole = $nomRole;
        }
    }
?>