<?php
class Scene
{
    //attributs
    public $connect;
    private string $table = 'scene';

    private int $idScene;
    private string $nomScene;
    private int $idFestival = 1;

    public function __construct()
    {
        $this->connect = BDD::getConnexion();
    }

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table): void
    {
        $this->table = $table;
    }

    public function getIdScene(): int
    {
        return $this->idScene;
    }

    public function setIdScene(int $idScene): void
    {
        $this->idScene = $idScene;
    }

    public function getNomScene(): string
    {
        return $this->nomScene;
    }

    public function setNomScene(string $nomScene): void
    {
        $this->nomScene = $nomScene;
    }

    public function getIdFestival(): int
    {
        return $this->idFestival;
    }

    public function setIdFestival(int $idFestival): void
    {
        $this->idFestival = $idFestival;
    }

    public function createScene(): bool
    {
        $myQuery = "INSERT INTO
                        '.$this->table.'
                    SET
                        nomScene = :nomScene,
                        idFestival = :idFestival";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':nomScene', $this->nomScene);
        $stmt->bindParam(':idFestival', $this->idFestival);

        return $stmt->execute();
    }

    public function getAllScenes(): array
    {
        $myQuery = "SELECT
                        idScene, nomScene, idFestival
                    FROM
                        $this->table
                    WHERE
                        idFestival = :idFestival";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idFestival', $this->idFestival);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function updateScene(): bool
    {
        $myQuery = "UPDATE
                        $this->table
                    SET
                        nomScene = :nomScene,
                        idFestival = :idFestival
                    WHERE
                        idScene = :idScene";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':nomScene', $this->nomScene);
        $stmt->bindParam(':idFestival', $this->idFestival);
        $stmt->bindParam(':idScene', $this->idScene);

        return $stmt->execute();
    }

    public function delete(): bool
    {
        $myQuery = "DELETE FROM
                        '.$this->table.'
                    WHERE
                        idScene = :idScene";

        $stmt = $this->connect->prepare($myQuery);
        $stmt->bindParam(':idScene', $this->idScene);
        return $stmt->execute();
    }
}
