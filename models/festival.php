<?php
require_once(__DIR__ . '.\..\utilitaires\BDD.php');

class Festival
{
    //attributs
    public $connect;
    private $table = 'festival';

    private int $idFestival;
    private string $nomFestival;
    private string $dateDebut;
    private string $dateFin;

    public function __construct()
    {
        $this->connect = BDD::getConnexion();
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function getIdFestival(): int
    {
        return $this->idFestival;
    }

    public function setIdFestival(string $idFestival)
    {
        $this->idFestival = $idFestival;
    }

    public function getNomFestival(): string
    {
        return $this->nomFestival;
    }

    public function setNomFestival(string $nomFestival)
    {
        $this->nomFestival = $nomFestival;
    }

    public function getDateDebut(): string
    {
        return $this->dateDebut;
    }

    public function setDateFin(string $dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function createFestival(): bool
    {
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

    public function getAllFestival(): array
    {
        $myQuery = "SELECT
                        *
                    FROM
                        '.$this->table.'";

        $stmt = $this->connect->prepare($myQuery);

        return $stmt->execute();
    }

    public function updateFestival(): array
    {
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

    public function delete(): bool
    {
        $myQuery = "DELETE FROM
                        '.$this->table.'
                    WHERE
                        idFestival = :idFestival";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idFestival', $this->idFestival);

        return $stmt->execute();
    }
}
