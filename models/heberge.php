<?php
class Heberge
{
    //attributs
    public $connect;
    private string $table = 'heberge';

    private int $idArtiste;
    private int $idScene;
    private string $datePassage;

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

    public function getIdScene(): int
    {
        return $this->idScene;
    }

    public function setIdScene(int $idScene)
    {
        $this->idScene = $idScene;
    }

    public function getDatePassage(): string
    {
        return $this->datePassage;
    }

    public function setDatePassage(string $datePassage)
    {
        $this->datePassage = $datePassage;
    }

    public function createHeberge(): bool
    {
        $myQuery = "INSERT INTO
                            '.$this->table.'
                        SET
                            idArtiste = :idArtiste,
                            idScene = :idScene,
                            datePassage = :datePassage";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->bindParam(':idScene', $this->idScene);
        $stmt->bindParam(':datePassage', $this->datePassage);

        return $stmt->execute();
    }

    public function getArtistScenes(): array
    {
        $myQuery = "SELECT
                            scene.idScene,
                            nomScene,
                            datePassage
                        FROM
                            scene
                        INNER JOIN
                            $this->table 
                        ON
                            scene.idScene = $this->table.idScene
                        WHERE
                            idArtiste = :idArtiste";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    public function readSceneArtists(): array
    {
        $myQuery = "SELECT
                            nomArtist,
                            datePassage
                        FROM
                            artist
                        INNER JOIN
                            '.$this->table.' 
                        ON
                        artist.idArtiste = '.$this->table.'.idArtiste
                        WHERE
                        idScene = :idScene";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idScene', $this->idScene);
        $result = $stmt->fetchAll();

        return $result;
    }

    public function deleteHeberge(): bool
    {
        $myQuery = "DELETE FROM
                            '.$this->table.'
                        WHERE
                            idArtiste = :idArtiste";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idArtiste', $this->idArtiste);

        return $stmt->execute();
    }
}
