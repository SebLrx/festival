<?php
require_once(__DIR__ . '.\..\utilitaires\BDD.php');

class Festival {
    //attributs
    public $connect;
    private $table ='festival';
    
    private $idFestival;
    private $nomFestival;
    private $dateDebut;
    private $dateFin;

    public function __construct(){
        $this->connect = BDD::getConnexion();
    }

    public function getTable(){
        return $this->table;
    }

    public function setTable($table){
        $this->table = $table;
    }

    public function getIdFestival(){
        return $this->idFestival;
    }

    public function setIdFestival($idFestival){
        $this->idFestival = $idFestival;
    }

    public function getNomFestival(){
        return $this->nomFestival;
    }

    public function setNomFestival($nomFestival){
        $this->nomFestival = $nomFestival;
    }

    public function getDateDebut(){
        return $this->dateDebut;
    }

    public function setDateFin($dateDebut){
        $this->dateDebut = $dateDebut;
    }

    public function createFestival(){
        $myQuery = "INSERT INTO
                        '.$this->table.'
                    SET
                        idFestival = :idFestival,
                        nomFestival = :nomFestival,
                        dateDebut = :dateDebut,
                        dateFin = :dateFin";
        
        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idFestival', $this->idFestival);
        $stmt->bindParam(':nomFestival', $this->nomFestival);
        $stmt->bindParam(':dateDebut', $this->dateDebut);
        $stmt->bindParam(':dateFin', $this->dateFin);
        return $stmt->execute();
    }

    public function getAllFestival() {
        $myQuery = "SELECT
                        *
                    FROM
                        '.$this->table.'";
                    
        $stmt = $this->connect->prepare($myQuery);

        return $stmt->execute();
    }

    public function updateFestival(){
        $myQuery = "UPDATE
                        '.$this->table.'
                    SET
                        nomFestival = :nomFestival,
                        dateDebut = :dateDebut,
                        dateFin = :dateFin
                    WHERE
                        idFestival = :idFestival";
        
        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idFestival', $this->idFestival);
        $stmt->bindParam(':nomFestival', $this->nomFestival);
        $stmt->bindParam(':dateDebut', $this->dateDebut);
        $stmt->bindParam(':dateFin', $this->dateFin);
        return $stmt->execute();
    }

    public function delete(){
        $myQuery = "DELETE FROM
                        '.$this->table.'
                    WHERE
                        idFestival = :idFestival";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idFestival', $this->idFestival);
        return $stmt->execute();
    }
}
?>