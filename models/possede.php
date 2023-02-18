<?php
class Possede
{
    //attributs
    public $connect;
    private string $table = 'possede';

    private int $idUser;
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

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser)
    {
        $this->idUser = $idUser;
    }

    public function getIdGenre(): int
    {
        return $this->idGenre;
    }

    public function setIdGenre(int $idGenre)
    {
        $this->idGenre = $idGenre;
    }

    public function createPossede(): bool
    {
        $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            idUser = :idUser,
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }

    public function readUserGenres(): array
    {
        $myQuery = "SELECT
                            nomGenre
                        FROM
                            genreMusical
                        INNER JOIN
                            '.$this->table.' 
                        ON
                            genreMusical.idGenre = '.$this->table.'.idGenre
                        WHERE
                            idUser = :idUser";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);

        return $stmt->execute();
    }

    //delete un genre d'un utilisateur
    public function deletePossede(): bool
    {
        $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idUser = :idUser
                        AND
                            idGenre = :idGenre";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idUser', $this->idUser);
        $stmt->bindParam(':idGenre', $this->idGenre);

        return $stmt->execute();
    }
}
