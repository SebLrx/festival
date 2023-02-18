<?php
require_once(__DIR__ . '.\..\utilitaires\BDD.php');

class Represente
{
    //attributs
    public $connect;
    private $table = 'represente';

    private int $idArtiste;
    private int $idGenre;

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

    public function setIdArtiste(string $idArtiste)
    {
        $this->idArtiste = $idArtiste;
    }

    public function getIdGenre(): int
    {
        return $this->idGenre;
    }

    public function setIdGenre(string $idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function createRepresente(): bool
    {
        $myQuery = "INSERT INTO
                            $this->table
                        SET
                            idArtiste = :idArtiste,
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }

    // Recupere les genres en fonction d'un artiste
    public function getArtistGenres(): array
    {
        $myQuery = "SELECT
                            genreMusical.idGenre, nomGenre
                        FROM
                            genreMusical
                        INNER JOIN
                            $this->table 
                        ON
                            genreMusical.idGenre = $this->table.idGenre
                        WHERE
                            idArtiste = :idArtiste";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // Recupere les artistes en fonction d'un genre
    public function getGenreArtists(): array
    {
        $myQuery = "SELECT
                            nomArtist
                        FROM
                            artist
                        INNER JOIN
                            $this->table.
                        ON
                        artist.idArtiste = '.$this->table.'.idArtiste
                        WHERE
                        idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }

    public function readArtistes(string $varTri): array
    {
        $myQuery = "SELECT
                            nomArtiste,
                            nomGenre
                        FROM
                            $this->table
                        INNER JOIN
                            genremusical
                        ON
                            $this->table.idGenre = genremusical.idGenre
                        INNER JOIN
                            artiste
                        ON
                        $this->table.idArtiste = artiste.idArtiste
                        ORDER BY
                            $varTri";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function updateRepresente(): bool
    {
        $myQuery = "UPDATE
                            $this->table
                        SET
                            idGenre = :idGenre
                        WHERE
                            idArtiste = :idArtiste
                        AND
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }

    public function deleteRepresente(): bool
    {
        $myQuery = "DELETE FROM
                            $this->table
                        WHERE
                            idArtiste = :idArtiste
                        AND
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }
}
