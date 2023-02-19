<?php
require_once(__DIR__ . '.\..\utilitaires\BDD.php');

class Artiste
{
    //attributs
    public $connect;
    private string $table = 'artiste';

    private int $idArtiste;
    private string $nomArtiste;

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

    public function getIdArtiste(): int
    {
        return $this->idArtiste;
    }

    public function setIdArtiste(int $idArtiste)
    {
        $this->idArtiste = $idArtiste;
    }

    public function getNomArtiste(): string
    {
        return $this->nomArtiste;
    }

    public function setNomArtiste(string $nomArtiste)
    {
        $this->nomArtiste = $nomArtiste;
    }

    public function createArtiste()
    {
        $myQuery = "INSERT INTO
                            $this->table
                        SET
                            nomArtiste = :nomArtiste";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':nomArtiste', $this->nomArtiste);

        return $stmt->execute();
    }

    public function getArtiste(): array
    {
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

    public function getAllArtiste(): array
    {
        $myQuery = "SELECT
                            *
                        FROM
                            $this->table";

        $stmt = $this->connect->prepare($myQuery);

        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function updateArtiste(): bool
    {
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

    public function deleteArtiste(): bool
    {
        $myQuery = "DELETE FROM
                            $this->table
                        WHERE
                            idArtiste = :idArtiste";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);

        return $stmt->execute();
    }
}
