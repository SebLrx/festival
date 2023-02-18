<?php
class GenreMusical
{
    //attributs
    public $connect;
    private string $table = 'genremusical';

    private int $idGenre;
    private string $nomGenre;

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

    public function getIdGenre(): int
    {
        return $this->idGenre;
    }

    public function setIdGenre(int $idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function getNomGenre(): string
    {
        return $this->nomGenre;
    }

    public function setNomGenre($nomGenre): void
    {
        $this->nomGenre = $nomGenre;
    }

    public function createGenre(): bool
    {
        $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            nomGenre = :nomGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':nomGenre', $this->nomGenre);

        return $stmt->execute();
    }

    public function getAllGenres()
    {
        $myQuery = "SELECT
                            idGenre, nomGenre
                        FROM
                            $this->table";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function updateGenre(): bool
    {
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

    public function delete(): bool
    {
        $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idGenre', $this->idGenre);
        return $stmt->execute();
    }
}
